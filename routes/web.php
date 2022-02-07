<?php

use App\Book;
use App\Category;
use App\OrderBasket;
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


header("Cache-control: no-cache");

if (!isset($_COOKIE['usename'])) {
    $cookie_value = uniqid("ID");
    setcookie("usename", $cookie_value, time() + 60*60*24*14);
}

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

Route::get('/add/publisher', function () {
    return view('add.publisher');
})->middleware('auth');

Route::post('/add/publisher', function (Request $request) {
    $data = $request->all();
    Publisher::create([
        'name' => $data['name']
    ]);
    return redirect('/');
})->middleware('auth');

Route::get('/add/category', function () {
    return view('add.category');
})->middleware('auth');

Route::post('/add/category', function (Request $request) {
    $data = $request->all();
    Category::create([
        'name' => $data['name']
    ]);
    return redirect('/');
})->middleware('auth');

Route::get('/add/book', function () {

    $publishers = Publisher::all();
    $categories = Category::all();
    return view('add.book', ['publishers' => $publishers, 'categories' => $categories]);
})->middleware('auth');

Route::post('/add/book', function (Request $request) {
    $data = $request->all();
    $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
    $filePath = $request->file('image')->storePubliclyAs('images', $fileName, 'public');

    Book::create([
        'title' => $data['title'],
        'author' => $data['author'],
        'pub_id' => $data['pub_id'],
        'cat_id' => $data['cat_id'],
        'pages' => $data['pages'],
        'price' => $data['price'],
        'dat' => $data['dat'],
        'image' => $fileName
    ]);
    return redirect('/');
})->middleware('auth');

Route::get('/addToCart', function(Request $request) {
    $bookId = $request->all()['book_id'];
    if (Auth::check()) {
        $userId = Auth::user()->customer_id;
    } else {
        $userId = -1;
    }

    $cookie = $_COOKIE['usename'];
    $order = OrderBasket::where('customer_id', $userId)->orWhere('cookie', $cookie)->where('book_id', $bookId)->first();
    if (empty($order)) {
        OrderBasket::create([
            'customer_id' => $userId,
            'cookie' => $cookie,
            'count' => 1,
            'book_id' => $bookId
        ]);
    } else {
        OrderBasket::where('customer_id', $userId)->orWhere('cookie', $cookie)->where('book_id', $bookId)->update(['count' => $order->count + 1]);
    }

    echo 'ok';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
