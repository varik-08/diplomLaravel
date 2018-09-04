@extends('layouts.master')

@section('content')
	<h1>{{ $category->name }}</h1>
	<p>
		{!! $category->description !!}
	</p>
	<div class="row">
		@foreach($category->products as $product)
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
					<div class="caption">
						<h3>{{ $product->name }}</h3>
						<p>{{ $product->priceText }}</p>
						<p>
							<a href="{{route('basket.add', $product)}}" class="btn btn-primary" role="button">В корзину</a>
							<a href="{{route('product', [$product->category->code, $product->code])}}" class="btn btn-default"
							   role="button">Подробнее</a>
						</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection