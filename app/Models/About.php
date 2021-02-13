<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['reading_string', 'listening_string', 'listening_url', 'message'];

    protected $table = 'about';

    use HasFactory;
}
