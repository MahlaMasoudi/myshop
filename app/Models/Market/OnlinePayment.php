<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function payments()
    {

        return $this->morphMany(Payment::class, 'commentable');
    }
}
