@include('view.header')

<div class='cart'>
@foreach ($orders as $order)

    <div class="order">
        <div>
            {{ $order['bookName'] }}
        </div>
        <div>
            Кол-во: {{ $order['count'] }}
        </div>
        <div>
            {{ $order['price'] }} руб. / шт. 
        </div>
        <div>
            {{ $order['sum'] }} руб.
        </div>
        <div>
            <a class="dropFromCart" href="/dropFromCart?book_id={{ $order['book_id'] }}">Убрать из корзины</a>
        </div>
    </div>
@endforeach
<div class="cart_sum">
    Итого: {{ $sumAll }} руб.
</div>

<div class="buy">

@guest
<a href="/login"><b>Авторизоваться</b></a></td>
@endguest

@auth
<form action="/makeOrder" method="POST">
    @csrf
    <div>
        Доставка
    <select name="dostavka" >
        <option value="1">Почта</option>
        <option value="2">Самовывоз</option>
        <option value="3">Курьер</option>
    </select>
    </div>

    <button>Купить</button>
</form>
@endauth
</div>
</div>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        let elements = document.getElementsByClassName("dropFromCart");
        for(let i = 0; i < elements.length; i++) {
            let element = elements[i];
            element.onclick = function (e) {
                e.preventDefault();
                let url = e.target.href;
                fetch(url, {
                    method: 'POST',
                });
                e.target.parentElement.parentElement.parentElement.removeChild(e.target.parentElement.parentElement);
            }
        }
            
    });
</script>

@include('view.footer')