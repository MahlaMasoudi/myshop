<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes,CascadeSoftDeletes;

    
    protected $cascadeDeletes = ['children'];

    protected $dates = ['deleted_at'];

 
        protected $casts = ['image' => 'array'];
    
        protected $fillable = ['name', 'url', 'parent_id', 'status'];
    
        public function parent()
        {
            return $this->belongsTo($this, 'parent_id')->with('parent');
        }
    
        public function children()
        {
            return $this->hasMany($this, 'parent_id')->with('children');
        }
    
    
    
    
    



}
