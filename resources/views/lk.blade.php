@include('view.header')

<div class='cart'>
@foreach ($result as $order)

    <div class="order">
        <div>
            ID{{$order['orderId']}}
        </div>
        <div>
            Дата {{ $order['orderDate'] }}
        </div>
        <div>
            Книги: {{ $order['books'] }}
        </div>
        <div>
            Доставка {{ $order['dostavka'] }} 
        </div>
        <div>
            Бонус {{ $order['bonus'] }} руб.
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
