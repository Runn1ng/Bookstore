
@include('view.header');
<tr><td>
<table border=0 width=100%>
<tr><td width="50%"><center><h3>Издатели</h3></center><ul>

@foreach ($publishers as $publisher)

<li><a href="show.php?type=1&pub_id={{$publisher->pub_id }}"> {{$publisher->name}}</a>
    </ul>
</td>

@endforeach


<td width="50%"><center><h3>Категории</h3></center><ul>
@foreach ($categories as $category)

<li><a href="show.php?type=1&cat_id={{$category->cat_id }}"> {{$category->name}}</a>
    </ul>
</td>

@endforeach

</ul></td>
</tr>
</table>
</td></tr>
@include('view.footer');

