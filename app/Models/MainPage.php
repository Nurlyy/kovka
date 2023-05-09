<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="main_page";
    protected $fillable = [
        'page_title',
        'body_title',
        'body_text',
        'phone_number',
        'email',
        'address',
    ];
}
