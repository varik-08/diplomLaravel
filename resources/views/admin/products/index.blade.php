@extends('layouts.admin')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-12">
			<h1>Товары</h1>
			<table class="table">
				<tbody>
				<tr>
					<th>
						#
					</th>
					<th>
						Код
					</th>
					<th>
						Название
					</th>
					<th>
						Категория
					</th>
					<th>
						Цена
					</th>
					<th>
						Действия
					</th>
				</tr>
				@foreach($list as $product)
					<tr>
						<td>{{ $product->id }}</td>
						<td>{{ $product->code }}</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->category->name }}</td>
						<td>{{ $product->price }}</td>
						<td>
							<div class="btn-group" role="group">
								<form action="{{ route('admin.products.destroy', $product) }}" method="POST">
									<a class="btn btn-success" type="button" href="{{ route('admin.products.show', $product) }}">Открыть</a>
									<a class="btn btn-warning" type="button" href="{{ route('admin.products.edit', $product) }}">Редактировать</a>
									@csrf
									@method('DELETE')
									<input class="btn btn-danger" type="submit" value="Удалить"></form>
							</div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			<a class="btn btn-success" type="button" href="{{route('admin.products.create') }}">Добавить товар</a>
		</div>
	</div>
@endsection