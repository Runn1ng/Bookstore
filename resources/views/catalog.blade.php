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
    <div class="book_result">
        <img  width = "200" src="{{ url('storage/images/'.$book->image) }}"" alt="{{ $book->image }}" border="0">
        <div class="book_info">
            <span><i>Автор: </i> {{ $book->author }}</span></td>
            <span><i>Название: </i> {{ $book->title }} </span> </td>
            <span><i>Издательство: </i> {{ $book->publisher->name }} </span></td>
            <span><i>Количество страниц: </i>{{ $book->pages }}</span></td>
            <span><i>Цена: </i> {{ $book->price }}</span>
            <span><i>Год издания: </i> {{ $book->dat }}</span>
            <span><a class="addToCart" href="/addToCart?book_id={{$book->book_id}}">Добавить в корзину</a></span>
        </div>
    </div>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let elements = document.getElementsByClassName("addToCart");
        console.log(elements);
        for(let i = 0; i < elements.length; i++) {
            let element = elements[i];
            console.log(element);
            element.onclick = function (e) {
                e.preventDefault();
                let url = e.target.href;
                fetch(url, {
                    method: 'GET',
                });
            }
        }
            
    });
</script>

@include('view.footer')
