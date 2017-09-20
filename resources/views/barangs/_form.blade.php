<div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title','Nama Barang',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('title',null,['class'=>'form-control']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('amount') ? 'has-error' : '' }}">
	{!! Form::label('amount','Jumlah',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('amount',null,['class'=>'form-control']) !!}
		{!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group{{ $errors->has('stock') ? 'has-error' : '' }}">
	{!! Form::label('stock','Stok',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('stock',null,['class'=>'form-control']) !!}
		{!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
		@if (isset($barang))
			<p class="help-block">{{ $barang->borrowed }} Barang Sedang Dipinjam</p>
		@endif
	</div>
</div>


<div class="form-group{{ $errors->has('penanggung_id') ? 'has-error' : '' }}">
	{!! Form::label('penanggung_id','Penanggung Jawab',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('penanggung_id',App\Penanggung::pluck('name','id')->all(),null,['class'=>'js-selectize','placeholder'=>'Pilih Penanggung Jawab']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('cover') ? 'has-error' : '' }}">
	{!! Form::label('cover','Sampul',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('cover') !!} <br>
		@if(isset($barang) && $barang->cover)
		<p>
			{!! Html::image(asset('img/'.$barang->cover),null,['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>