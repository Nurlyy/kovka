<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="pages";
    protected $fillable = [
        'image_1',
        'image_1_preview',
        'image_2',
        'image_2_preview',
        'image_3',
        'image_3_preview',
        'image_4',
        'image_4_preview',
        'image_5',
        'image_5_preview',
        'image_6',
        'image_6_preview',
        'header',
        'body_text',
        'title',
        'is_visible',
        'description1',
        'description2',
        'description3',
        'description4',
        'description5',
        'description6',
    ];
}
