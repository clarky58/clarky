<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function folders(){
        return $this->hasMany(Folder::class);
    }

    public function files()
    {
        return $this->hasManyThrough(File::class, Folder::class);
    }
}
