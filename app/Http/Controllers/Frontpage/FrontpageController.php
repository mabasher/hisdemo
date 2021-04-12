<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function doctordept()
    {
        return view('frontpage.department');
    }

    public function doctors()
    {
        return view('frontpage.doctors');
    }

    public function services()
    {
        return view('frontpage.services');
    }

    public function about()
    {
        return view('frontpage.about');
    }

    public function contact()
    {
        return view('frontpage.contact');
    }
    
}
