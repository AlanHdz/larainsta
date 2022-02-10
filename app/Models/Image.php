<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['public_image_id', 'image_url', 'post_id'];

    public function posts() {
        return $this->belongsTo(Post::class);
    }
}
