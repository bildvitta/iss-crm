<?php

namespace Bildvitta\IssCrm\Models\Customer;

use Bildvitta\IssCrm\Models\DocumentType;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Document extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'customer_documents';

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    protected function fileFormatted(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $value = $this->file;
                if (! filter_var($value, FILTER_VALIDATE_URL)) {
                    return $value;
                }
                $fileUrl = parse_url($value);
                $fileHost = $fileUrl['host'];
                $fileFullPath = $fileUrl['path'];
                $filePath = substr($fileFullPath, 1);
                $fileName = explode('/', $fileFullPath);
                $fileName = end($fileName);
                if (Str::contains($fileHost, 's3-bild-sys.s3.amazonaws.com')) {
                    return 'https://gc.bild.com.br/api/clienteAnexos/get?filename='.ltrim($fileFullPath, '/');
                }
                if (! Str::contains($fileHost, 'aws')) {
                    return $value;
                }
                $disk = 's3_crm';
                if (config('filesystems.disks.s3_crm_prod.key') && Str::contains($fileHost, 'pdaw-crmap01-assets.s3.amazonaws.com')) {
                    $disk = 's3_crm_prod';
                }
                $s3 = Storage::disk($disk);
                $adapter = method_exists($s3->getDriver(), 'getAdapter') ? $s3->getAdapter() : $s3;
                $client = $adapter->getClient();
                $bucket = method_exists($adapter, 'getBucket') ? $adapter->getBucket() : $adapter->getConfig()['bucket'];
                $expiry = '+7 days';
                $command = $client->getCommand('GetObject', [
                    'Bucket' => $bucket,
                    'Key' => $filePath,
                    'ContentType' => Storage::disk('s3')->mimeType($filePath),
                    'ContentDisposition' => 'inline',
                    'ResponseContentDisposition' => 'inline; filename="'.$fileName.'"',
                ]);
                $request = $client->createPresignedRequest($command, $expiry);

                return (string) $request->getUri();
            }
        );
    }
}
