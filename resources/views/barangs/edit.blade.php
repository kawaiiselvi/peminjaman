@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Home</a></li>
				<li><a href="{{ url('/admin/barangs') }}">Barang</a></li>
				<li class="active">Ubah Barang</li>
			</ul>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Barang</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($barang, ['url'=>route('barangs.update', $barang->id), 'method'=>'put', 'files'=>'true','class'=>'form-horizontal']) !!}
					@include('barangs._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection