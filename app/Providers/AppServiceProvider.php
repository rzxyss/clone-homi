<?php

namespace App\Providers;

use App\Models\Admin\AdminCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layouts.app', function ($view) {
            $loggedInUser = Auth::user();
            $incoming = DB::table('transactions')->where('status', 0)->get()->count();
            $process = DB::table('transactions')->where('status', 2)->get()->count();
            $approve = DB::table('products')->where('approve', 0)->get()->count();


            $view->with(['loggedInUser' => $loggedInUser, 'incoming' => $incoming, 'process' => $process, 'approve' => $approve]);
        });

        View::composer('page.partials.navbar', function ($view) {
            $categories = AdminCategory::with('subcategories')->get();

            foreach ($categories as $category) {
                $subcategories = $category->subcategories;

                $view->with([
                    'category' => $category,
                    'subcategory' => $subcategories
                ]);
            }
        });
    }
}
