<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regalia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table ='regalia';
    protected $fillable = ['title', 'body', 'image', 'page_id', 'bg_image'];
    
}
