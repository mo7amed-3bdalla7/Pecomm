@extends('layouts.main')

@section('content')

	<div id="product-image">
        {{ HTML::image($product->image, $product->title) }}
    </div><!-- end product-image -->
    <div id="product-details">
        <h1>{{ $product->title }}</h1>
        <p>{{ $product->description }}</p>

        <hr />

        {{ Form::open(array('url'=>'store/item/addtocart')) }}
            {{ Form::label('quantity', 'Qty') }}
            {{ Form::number('quantity', 1, array('maxlength'=>'2','min'=>'0')) }}
            {{ Form::hidden('id', $product->id) }}

            <button type="submit" class="secondary-cart-btn">
                {{ HTML::image('img/white-cart.gif', 'Add to Cart')}}
                 ADD TO CART
            </button>
        {{ Form::close() }}
    </div><!-- end product-details -->
    <div id="product-info">
        <p class="price">${{ $product->price }}</p>
        <p>
        	Availability: 
        	<span class="{{ \App\libs\Availability::displayClass($product->availability) }}">
        		{{ \App\libs\Availability::display($product->availability) }}
        	</span>
        </p>
        <p>Product Code: <span>{{ $product->id }}</span></p>
    </div><!-- end product-info -->

@stop