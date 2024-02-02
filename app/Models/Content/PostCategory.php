<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable, CascadeSoftDeletes;

    protected $cascadeDeletes = ['posts'];

    protected $dates = ['deleted_at'];


    public function sluggable(): array
    {
        return [

            'slug' => ['source' => 'name']

        ];
    }

    protected $casts = ['image' => 'array'];

    protected $fillable = ['name', 'description', 'slug', 'image', 'status', 'tags'];

    public function posts()
    {

        return $this->hasMany(Post::class,'category_id');
    }
}
