@extends('layouts.admin')

@section('content')
		<div class="row justify-content-center">
			<div class="col-md-12">
				<h1>Категории</h1>
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
							Действия
						</th>
					</tr>
					@foreach($list as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td>{{ $category->code }}</td>
							<td>{{ $category->name }}</td>
							<td>
								<div class="btn-group" role="group">
									<form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
										<a class="btn btn-success" type="button" href="{{ route('admin.categories.show', $category) }}">Открыть</a>
										<a class="btn btn-warning" type="button" href="{{ route('admin.categories.edit', $category) }}">Редактировать</a>
										@csrf
										@method('DELETE')
										<input class="btn btn-danger" type="submit" value="Удалить">
									</form>
								</div>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<a class="btn btn-success" type="button" href="{{route('admin.categories.create') }}">Добавить категорию</a>
			</div>
		</div>
@endsection