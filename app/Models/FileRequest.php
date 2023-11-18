<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
