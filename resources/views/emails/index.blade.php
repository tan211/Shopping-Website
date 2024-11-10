<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/rate.css') }}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->
<body>
<table class="table table-condensed">
    <thead>
        <tr class="cart_menu">
            <td class="image">Item</td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total = 0;
            foreach ($data as $value) {
                $image = json_decode($value['image'], true);
                $cart = session()->get('Cart');
                $qty = 0;
                foreach ($cart as $value1) {
                    if ($value1['product_id'] == $value['id']) {
                        $qty = $value1['qty']; 
                        $total += $value1['qty']*$value['price'];
                        break;
                    }
                }
        ?>
            <tr>
                <td class="cart_description">
                    <h4><a href="">{{$value['name']}}</a></h4>
                </td>
                <td class="cart_price">
                    <p>${{$value['price']}}</p>
                </td>
                <td class="cart_quantity">
                    <p>{{$qty}}</p>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">${{$value['price']*$qty}}</p>
                </td>
            </tr>
        <?php
            }
        ?>
            <tr>
                <td class="cart_description">
                </td>
                <td class="cart_price">
                </td>
                <td class="cart_quantity">
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">${{$total}}</p>
                </td>
            </tr>
    </tbody>
</table>
</body>
</html>