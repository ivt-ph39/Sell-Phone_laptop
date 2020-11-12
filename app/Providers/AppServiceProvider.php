<?php

namespace App\Providers;

use App\Model\Contact;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\AssignOp\Concat;

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
        $dataContact = Contact::where('active', 1)->get();
        View::share('contacts', $dataContact);
    }
}