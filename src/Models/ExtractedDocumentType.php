<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Bildvitta\IssCrm\Models\DocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtractedDocumentType extends Model
{
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'extracted_document_types';
  
    protected $guard_name = 'web';

    /**
     * Relacionamento com DocumentType.
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
