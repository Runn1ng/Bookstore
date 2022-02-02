<?php

use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {

    $params = $request->all();

    if (!empty($params['cat_id'])) {
        $books = Book::where('cat_id', $params['cat_id'])->get();
    } elseif (!empty($params['pub_id'])) {
        $books = Book::where('pub_id', $params['pub_id'])->get();
    } else {
        $books = Book::all();
    }   


    return view('catalog', ['publishers' => Publisher::all(), 'categories' => Category::all(), 'books' => $books]);
});

Route::get('/add/publisher', function(){
    return view('add.publisher');
})->middleware('auth');

Route::post('/add/publisher', function(Request $request) {
    $data = $request->all();
    Publisher::create([
        'name' => $data['name']
    ]);
    return redirect('/');
})->middleware('auth');

Route::get('/add/category', function(){
    return view('add.category');
})->middleware('auth');

Route::post('/add/category', function(Request $request) {
    $data = $request->all();
    Category::create([
        'name' => $data['name']
    ]);
    return redirect('/');
})->middleware('auth');

Route::get('/add/book', function(){
    return view('add.book');
})->middleware('auth');

Route::post('/add/book', function(Request $request) {
    $data = $request->all();
    Publisher::create([
        'name' => $data['name']
    ]);
    return redirect('/');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
