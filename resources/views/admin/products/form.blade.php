@extends('layouts.admin')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-12">
			@if(isset($product))
				<h1>Редактировать Товар</h1>
			@else
				<h1>Добавить Товар</h1>
			@endif
			@include('layouts.errors')
			<form method="POST" enctype="multipart/form-data"
			      action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store')}}">
				<div>
					@csrf
					@if(isset($product))
						@method('PUT')
					@endif
					<div class="input-group row">
						<label for="code" class="col-sm-2 col-form-label">Код: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="code" id="code"
							       value="{{ old('code', $product->code ?? null) }}">
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="name" class="col-sm-2 col-form-label">Название: </label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" id="name"
							       value="{{ old('name', $product->name ?? null) }}">
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
						<div class="col-sm-6">
							<select class="form-control" name="category_id" id="category_id">
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<div class="input-group row">
						<label for="description" class="col-sm-2 col-form-label">Описание: </label>
						<div class="col-sm-6">
								<textarea name="description" id="description" cols="72"
								          rows="7">{{ old('description', $product->description ?? null) }}</textarea>
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
					<br>
					<div class="input-group row">
						<label for="price" class="col-sm-2 col-form-label">Цена: </label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="price" id="price"
							       value="{{ old('price', $product->price ?? null) }}">
						</div>
					</div>
					<button class="btn btn-success">Сохранить</button>
				</div>
			</form>
		</div>
	</div>
@endsection