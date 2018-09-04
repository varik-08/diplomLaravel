@extends('layouts.admin')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-12">
			@if(isset($category))
				<h1>Редактировать Категорию</h1>
			@else
				<h1>Добавить Категорию</h1>
			@endif
			@include('layouts.errors')
			<form method="POST" enctype="multipart/form-data"
			      action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store')}}">
				<div>
					@csrf
					@if(isset($category))
						@method('PUT')
					@endif
					<div class="input-group row">
						<label for="code" class="col-sm-2 col-form-label">Код: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="code" id="code"
							       value="{{ old('code', $category->code ?? null) }}">
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="name" class="col-sm-2 col-form-label">Название: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" id="name"
							       value="{{ old('name', $category->name ?? null) }}">
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="description" class="col-sm-2 col-form-label">Описание: </label>
						<div class="col-sm-6">
							<textarea name="description" id="description" cols="72"
							          rows="7">{{ old('description', $category->description ?? null) }}</textarea>
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="image" class="col-sm-2 col-form-label">Картинка: </label>
						<div class="col-sm-10">
							<label class="btn btn-default btn-file">
								Загрузить <input type="file" style="display: none;" name="image" id="image">
							</label>
						</div>
					</div>
					<button class="btn btn-success">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
@endsection