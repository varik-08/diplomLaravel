@extends('layouts.master')

@section('content')
	<h1>{{ $product->name }}</h1>
	<p>Цена: <b>{{ $product->priceText }}</b></p>
	<img src="{{ Storage::url($product->image) }}">
	<p>{!! $product->description !!}</p>
	<a class="btn btn-success" href="{{ route('basket.add', $product) }}">Добавить в корзину</a>
@endsection