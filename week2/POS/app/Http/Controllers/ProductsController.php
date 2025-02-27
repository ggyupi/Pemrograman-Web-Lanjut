<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function Food_Beverage(){
        return view('Products.Food-Beverage')
        ->with('head', 'Food-Beverage Produtcs')
        ->with('body1','Food-Beverage Produtcs')
        ->with('body2', 'Daging Kambing');
    }
    public function Beauty_Health(){
        return view('Products.Beauty-Health')
        ->with('head', 'Beauty_Health Produtcs')
        ->with('body1', 'Beauty_Health Produtcs')
        ->with('body2', 'Face Wash');
    }
    public function Home_care(){
        return view('Products.Home-care')
        ->with('head', 'Home_care Produtcs')
        ->with('body1', 'Home_care Produtcs')
        ->with('body2', 'Sapu');
    }
    public function Baby_Kid(){
        return view('Products.Baby-Kid')
        ->with('head', 'Baby_Kid Produtcs')
        ->with('body1', 'Baby_Kid Produtcs')
        ->with('body2', 'Susu Sehat');
    }
}
