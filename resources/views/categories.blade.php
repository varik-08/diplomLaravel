@extends('layouts.master')

@section('content')
	@foreach($categories as $category)
		<div class="panel">
			<a href="{{ route('category', $category->code) }}">
				<img src="{{ Storage::url($category->image) }}" height="240px">
				<h2>{{ $category->name }}</h2>
			</a>
			<p>
				{!! $category->description !!}
			</p>
		</div>
	@endforeach
@endsection