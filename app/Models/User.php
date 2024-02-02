<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\User\Role;
use App\Models\Market\Order;
use App\Models\Ticket\Ticket;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use App\Models\User\Permission;
use App\Models\Market\OrderItem;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ticket\TicketAdmin;
use Laravel\Jetstream\HasProfilePhoto;
use Nagy\LaravelRating\Traits\CanRate;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'status',
        'user_type',
        'activation',
        'profile_photo_path',
        'password',
        'email_verified_at',
        'mobile_verified_at',
        'national_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    } 
    
    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }



    public function isUserPurchedProduct($product_id)
    {
        $productIds = collect();
        foreach ($this->orderItems()->where('product_id', $product_id)->get() as $item) {
            $productIds->push($item->product_id);
        }
        $productIds = $productIds->unique();
        return $productIds;
    }


    public function compare()
    {
        return $this->hasOne(Compare::class);
    }

}
