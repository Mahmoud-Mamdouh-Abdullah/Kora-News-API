<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    function images() {
        return $this->hasMany(Image::class);
    }

    function tags() {
        return $this->belongsToMany(Tag::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
