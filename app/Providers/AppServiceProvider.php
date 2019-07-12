<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Collection;
use App\Models\District;
use App\Models\Choose;
use App\Models\Slider;
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
        View::share('objCollection', Collection::orderby("position",'ASC')->get());
        View::share('objDistrict', District::all());
        View::share('objChoose', Choose::all());
        View::share('SliderIndex', Slider::where('active_id',2)->where('location',1)->orderby('position','ASC')->take(6)->get());
        View::share('SliderProduct', Slider::where('active_id',2)->where('location',2)->orderby('position','ASC')->take(6)->get());
    }
}
