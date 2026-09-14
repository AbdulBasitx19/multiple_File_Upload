<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    //
    protected $fillable =[
        'album_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
    
}
