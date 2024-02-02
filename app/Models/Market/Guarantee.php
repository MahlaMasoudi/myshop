<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guarantee extends Model
{
    use HasFactory;


    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'product_id',
        'price_increase',
        'status'
    ];
}
