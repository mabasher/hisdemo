<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Setup\Department;
use App\Model\Doctor\Doctorinfo;

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
       $specialty = Department::where('area_type_no', 115)->select('dept_no', 'dept_name')->get();
       $doctors = Doctorinfo::all();
       view()->share(['specialty'=> $specialty, 'doctors' => $doctors]);

    }
}
