@extends('layouts.master')

@section('content')
	<h1>Корзина</h1>
	<p>Оформление заказа</p>
	<div class="panel">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Название</th>
				<th>Кол-во</th>
				<th>Цена</th>
				<th>Стоимость</th>
			</tr>
			</thead>
			<tbody>
			@foreach($order->products as $product)
				<tr>
					<td>
						<a href="{{ route('product', ['code' => $product->category->code, 'product_code' => $product->code]) }}">
							<img height="56px" src="{{ Storage::url($product->image) }}">
							{{ $product->name }}
						</a>
					</td>
					<td><span class="badge">{{ $product->pivot->count }}</span>
						<div class="btn-group">
							<a type="button" class="btn btn-danger" href="{{ route('basket.remove', $product) }}"><span
										class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
							<a type="button" class="btn btn-success" href="{{ route('basket.add', $product) }}"><span
										class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
						</div>
					</td>
					<td>{{ $product->priceText }}</td>
					<td>{{ $product->priceForCount($product->pivot->count) }}</td>
				</tr>
			@endforeach
			<tr>
				<td colspan="3">Общая стоимость:</td>
				<td>{{ $order->fullPriceText() }}</td>
			</tr>
			</tbody>
		</table>
		<br>
		<div class="btn-group pull-right" role="group">
			<a type="button" class="btn btn-success" href="{{ route('basket.place') }}">Оформить заказ</a>
		</div>
	</div>
@endsection