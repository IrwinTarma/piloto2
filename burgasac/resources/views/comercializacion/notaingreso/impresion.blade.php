@extends('backend.layouts.appv2')

@section('content')

    <title>Código Barras</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('cb/css/stylesheet.css') }}" rel="stylesheet">
    <!--style media="screen" type="text/css">/*<![CDATA[*/@import 'http://127.0.0.1:8000/cb/css/stylesheet.css';/*]]>*/</style-->
    <style type="text/css">#title,#glyphs p{font-family:"Code 128"}</style>
	
	
	<div id="glyphs">
		@foreach($noimpresos as $var)
			<div class="g" style="padding: 10px;">{{ $var->cod_barras }}<p>{{ $var->cod_barras }}</p></div>
		@endforeach
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('comercializacion.index')}}" class="btn btn-success">Volver a Bandeja</a>
		</div>
	</div>
	
@endsection