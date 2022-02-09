<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>КНИЖНЫЙ МАГАЗИН</title>
<style>
    .filters{
        display: flex;
        justify-content: space-between;
    }
    .categories{
        border: 1px solid black;
        margin: 0 20px;
        padding: 5px;
    }
    .results, .cart{
        display: flex;
        flex-direction: column;
        justify-items: center;
        justify-content: center;
        clear: both;
    }
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white;
        text-align: center;
    }
    .addForm {
        position: relative;
        width: 200px;
        margin: 0 auto 0;
        padding-top: 30px;
    }
    .book_result {
        display: flex;
        height: 150px;
        margin: 10px auto 10px;
        width: 65%;
        clear: both;
    }
    .clear { 
        clear: both;
        height: 60px; 
    }
    .book_result > img {
        float: left;
        height: 100%;
    }
    .book_info {
        float: left;
        margin-left: 10px;
    }
    .book_info > span {
        display: block;
    }
    .order {
        display: flex;
        margin: 5px auto;
    }
    .order > div {
        padding: 5px;
    }
    .cart_sum {
        float: right;
        margin: 25px auto 5px;
    }
    .buy {
        margin: 10px auto;
    }
</style>
</head>


<body background="EULA7.jpg" style="background-repeat:repeat-y" leftmargin="130" rightmargin="5" bgProperties=fixed>
<div style="height:105px;">
    <table border="0" align="right" width="90%" cellpadding="0" cellspacing="0">
<tr><td>

<table border="0" align="right" width="100%" >
<tr>
<td align="center" bgcolor="#cccccc">

@guest

<form action="/login" method="POST">
    @csrf
<table>
<tr><td align="right"><font size=-2>Логин:</font></td>
<td align="left"><input type=text style="width:60; height:20;" name="login"></td></tr>
<tr><td align="right"><font size=-2>Пароль:</font></td>
<td align="left"><input type=password style="width:60; height:20;" name="password">
<input type=submit value=ok style="height:20;"></td></tr>
</table>
@endguest
</td>
</form>
<td colspan="4" align="center" bgcolor="#ccccff">
<font face="Arial" size="+3"><i><b>Книжный магазин</b></i></font></td></tr>
<tr><td align="center" bgcolor="#aaddff" width="20%">
<a href="/"><b>Каталог</b></a></td>
<td align="center" bgcolor="#ddaaff" width="20%">
<a href="/cart"><b>Корзина</b></a></td>
@guest
<td align="center" bgcolor="#aaaaff" width="20%">
<a href="/register"><b>Регистрация</b></a></td>
@endguest
@auth
<td align="center" bgcolor="#ffaaff" width="20%">
<a href="/lk"><b>Заказы</b></a></td>
<td align="center" bgcolor="#aaffee" width="20%">
<form action="/logout" method="POST">
    @csrf
    <button>Выход</button></form></td>
@endauth
</tr>
</table>
</td></tr>
<tr><td align="center"
bgcolor=<?print $color?>><font face="Arial" size="+2">
<i><?print $title?></i></font><br>
</td></tr>
</table>
</div>
