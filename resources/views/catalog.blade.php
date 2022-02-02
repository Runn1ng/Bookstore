@include('view.header')

<div class='filters'>
<div class="categories">
<h3>Издатели</h3>

<ul>
@foreach ($publishers as $publisher)

<li><a href="/?pub_id={{$publisher->pub_id }}"> {{$publisher->name}}</a> </li>

@endforeach
</ul>
</div>


<div class="categories">
    <h3>Категории</h3>
    <ul>
@foreach ($categories as $category)

<li><a href="/?cat_id={{$category->cat_id }}"> {{$category->name}}</a>

@endforeach
</ul>
</div>
</div>

<div class='results'>
    @foreach ($books as $book) 
    <table>
        <tr><td align="right"><i>Автор: </i></td>
        <td>{{ $book->author }}</td></tr>
        <tr><td align="right"><i>Название: </i></td>
        <td>{{ $book->title }}</td></tr>
        <tr><td align="right"><i>Издательство: </i></td>
        <td>{{ $book->publisher->name }}</td></tr>	
        <tr><td align="right"><i>Количество страниц: </i></td>
        <td>{{ $book->pages }}</td></tr>
        <tr><td align="right"><i>Цена: </i></td>
        <td>{{ $book->price }}</td></tr>
        <tr><td align="right"><i>Год издания: </i></td>
        <td>{{ $book->dat }}</td></tr>
        </tr>
        </table>
    
    @endforeach
</div>

@include('view.footer')
