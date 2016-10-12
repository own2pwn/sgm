@extends('layouts.product')

@section('content')
<div id="product" class="container">
	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
			 	<li><a href="#product-about">About</a></li>
			 	<li><a href="#product-spec">Specifications</a></li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li><a href="{{ url('products') }}">Products</a></li>
						@if (!empty($category))<li>{{ $category }}</li>@endif
						<li class="active">{{ $model }}</li>
					</ol>	
				</div>
			</div>
			{{-- @if (sizeof($images) > 1)
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
					@foreach ($images as $image)
						@if (!empty($image))
							<div class="item active">
								<img src="{{ asset('img/'.$image) }}" alt="{{ $model }}-{{ $image }}">
							</div>
						@endif
					@endforeach
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			@else --}}
			@if (sizeof($images) > 0)
				<div class="row">
					<div class="col-md-12">
						<img src="{{ asset('img/'.$images[0]) }}" alt="{{ $model }}-{{ $images[0] }}" class="center-block img-responsive">
					</div>
				</div>
			@endif
			{{-- @endif --}}
			<div id="product-about" class="row">
				<div class="col-md-12">
					<h2>{{ $model }}</h1>
					<p>{{ $description == '' ? 'No description.' : $description }}</p>
					@if (sizeof($videos) > 0)
						<br>
						<div class="embed-responsive embed-responsive-16by9">
							{!! $videos[0] !!}
						</div>
						<br>
					@endif
				</div>
			</div>
			<div id="product-spec" class="row">
				<div class="col-md-3"><label>Color:</label> {{ $color == '' ? 'Not set.' : $color }}</div>
				<div class="col-md-3"><label>Weight:</label> {{ $weight == '' ? 'Not set.' : $weight }}</div>
				<div class="col-md-3"><label>Dimension:</label> {{ $dimension == '' ? 'Not set.' : $dimension }}</div>
				<div class="col-md-3"><label>Weight Capacity:</label> {{ $weight_capacity == '' ? 'Not set.' : $weight_capacity }}</div>
				<div class="col-md-3"><label>Age Requirement:</label> {{ $age_requirement == '' ? 'Not set.' : $age_requirement }}</div>
				<div class="col-md-3"><label>Manual:</label> @if ($download_links == '') Not set. @else <a href="{{ $download_links }}">download</a>@endif</div>
				<div class="col-md-3"><label>Awards:</label> {{ $awards == '' ? 'None.' : $awards }}
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="{{ url('products') }}" class="btn btn-link">Back</a>
					<a href="{{ url('products/'.$id.'/edit') }}"" class="btn btn-link">Edit</a>		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection