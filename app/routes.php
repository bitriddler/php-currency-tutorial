<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


// One last step is to use this system in the product class

Route::get('/products.html', function()
{
    return View::make('products.all', array(

        'products' => Product::all()
    ));
});


Route::get('/change-currency/{currency}', function($currency)
{
    \Money\Currency::changeCurrent($currency);

    return Redirect::back();
});