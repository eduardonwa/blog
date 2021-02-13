<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'slug',
        'image_url',
        'category_id',
        'is_approved'
    ];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimeStamps();
    }

    public function comment()
    {
        return $this->morphOne('App\Models\CustomComment', 'commentable');
    }

    use HasFactory, Commentable;
}