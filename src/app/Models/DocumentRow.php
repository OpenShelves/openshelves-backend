<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRow extends Model
{
    use HasFactory;

    function document()
    {
        return $this->belongsTo(Document::class);
    }
    function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
