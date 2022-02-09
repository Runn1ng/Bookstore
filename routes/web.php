<?php

use App\Book;
use App\Category;
use App\Order;
use App\OrderBasket;
use App\OrderBooks;
use App\Publisher;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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

Route::get('/addToCart', function (Request $request) {
    $bookId = $request->all()['book_id'];

    if (Auth::check()) {
        $userId = Auth::user()->customer_id;
    } else {
        $userId = 0;
    }

    $cookie = $_COOKIE['usename'];

    $order = OrderBasket::where('book_id', $bookId)->where(function($query) use ($userId, $cookie) {
        $query->orWhere('customer_id', $userId)
              ->orWhere('cookie', $cookie);
    })->first();
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

Route::get('/dropFromCart', function (Request $request) {
    $bookId = $request->all()['book_id'];
    if (Auth::check()) {
        $userId = Auth::user()->customer_id;
    } else {
        $userId = 0;
    }

    $cookie = $_COOKIE['usename'];

    OrderBasket::where('book_id', $bookId)->where(function($query) use ($userId, $cookie) {
        $query->orWhere('customer_id', $userId)
              ->orWhere('cookie', $cookie);
    })->delete();

    echo 'ok';
});

Route::get('/cart', function (Request $request) {
    $orders = [];
    $sum = 0;

    if (Auth::check()) {
        $userId = Auth::user()->customer_id;
    } else {
        $userId = 0;
    }

    $cookie = $_COOKIE['usename'];
    $orderBasket = OrderBasket::where(function($query) use ($userId, $cookie) {
        $query->orWhere('customer_id', $userId)
              ->orWhere('cookie', $cookie);
    })->groupBy('book_id')->selectRaw('*, SUM(count) as count')->get();
    
    foreach($orderBasket as $order) {
        $bookSum = $order->book->price * $order->count; 
        $orders []= [
            'book_id' => $order->book_id,
            'sum' => $bookSum,
            'bookName' => $order->book->title,
            'count' => $order->count,
            'price' => $order->book->price
        ];
        $sum += $bookSum;
    }

    return view('cart', ['orders' => $orders, 'sumAll' => $sum]);
});

Route::post('/makeOrder', function (Request $request) {
    $data = $request->all();
    $orders = [];
    $sum = 0;

    if (Auth::check()) {
        $userId = Auth::user()->customer_id;
    } else {
        $userId = 0;
    }

    $cookie = $_COOKIE['usename'];
    $orderBasket = OrderBasket::where(function($query) use ($userId, $cookie) {
        $query->orWhere('customer_id', $userId)
              ->orWhere('cookie', $cookie);
    })->groupBy('book_id')->selectRaw('*, SUM(count) as count')->get();
    
    if (count($orderBasket) == 0) {
        return redirect('/lk');
    }

    $newOrder = Order::create([
        'order_date' => date("Y-m-d H:i:s", strtotime('+5 hour')),
        'customer_id' => $userId,
        'dostavka' => $data['dostavka'] ?? 1,
        'bonus' => 10 
    ]);

    foreach($orderBasket as $order) {
        OrderBooks::create([
            'order_id' => $newOrder->order_id,
            'book_id' => $order->book_id,
            'count' => $order->count,
            'price' => $order->book->price
        ]);
    }

    OrderBasket::where(function($query) use ($userId, $cookie) {
        $query->orWhere('customer_id', $userId)
              ->orWhere('cookie', $cookie);
    })->delete();
    
    return redirect('/lk');
    // return view('cart', ['orders' => $orders, 'sumAll' => $sum]);
});

Route::get('/lk', function() {
    $userId = Auth::user()->customer_id;

    $dostavka = [
        1 => "Почтой",
        2 => "Самовывоз",
        3 => "Курьер"
    ];

    $orders = Order::where('customer_id', $userId)->get();

    $result = [];

    foreach($orders as $order) {
        $books = OrderBooks::where('order_id', $order->order_id)->get();
        $orderBooks = [];
        
        foreach($books as $book) {
            $orderBooks []= $book->book->title;
        }

        $result []= [
            'orderId' => $order->order_id,
            'orderDate' => $order->order_date,
            'books' => implode(', ', $orderBooks),
            'dostavka' => $dostavka[$order->dostavka],
            'bonus' => $order->bonus
        ];
    }

    return view('lk', ['result' => $result]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
