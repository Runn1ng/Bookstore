@include('view.header')

<div class='cart'>
@foreach ($result as $order)

    <div class="order">
        <div style="width: 50px">
            ID{{$order['orderId']}}
        </div>
        <div style="width: 150px;">
            Дата {{ $order['orderDate'] }}
        </div>
        <div style="width: 450px">
            <div> Книги: </div> 
            @foreach ($order['books'] as $book) 
            {{ $book }}<br>
            @endforeach 
        </div>
        <div style="width: 75px;">
            Доставка <br>
            {{ $order['dostavka'] }} 
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
