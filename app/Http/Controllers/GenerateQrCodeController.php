<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;

class GenerateQrCodeController extends Controller
{
    public function simpleQrCode() 
    {

      \QrCode::size(300)->generate('A basic example of QR code!');
       
    }    

    public function colorQrCode() 
    {

     return \QrCode::size(300)
             ->backgroundColor(255,55,0)
             ->generate('A simple example of QR code');
       
    }    
    
    public function imageQrCode() 
    {

      $image = \QrCode::format('png')
               ->merge('images/laravel.png', 0.5, true)
               ->size(500)->errorCorrection('H')
               ->generate('A simple example of QR code!');
      return response($image)->header('Content-type','image/png');
       
    }
}
