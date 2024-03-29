<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::where('seen', 0)->get());
            //$view->with('notifications', Notification::where('read_at', null)->get());
        });


        view()->composer('customer.layouts.header', function ($view) {
            if (Auth::check()) {
                $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
                $view->with('cartItems', $cartItems);
            }
        });
    }
}
