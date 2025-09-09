<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class DocumentType extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'document_types';

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

    public function extractedDocumentTypes(): HasMany
    {
        return $this->hasMany(ExtractedDocumentType::class);
    }

    public function getExtractedDocumentTypeFor(?string $department = 'juridico'): ?ExtractedDocumentType
    {
        return $this->extractedDocumentTypes()
            ->where('department', $department)
            ->first();
    }
}
