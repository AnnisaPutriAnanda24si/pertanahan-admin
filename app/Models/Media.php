<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media_id';
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    public function getUrlAttribute()
    {
        return Storage::url('uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($media) {
            Storage::disk('public')->delete('uploads/' . $media->ref_table . '/' . $media->file_name);
        });
    }
}
