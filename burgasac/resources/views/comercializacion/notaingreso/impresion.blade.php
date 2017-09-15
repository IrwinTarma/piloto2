@extends('backend.layouts.appv2')

@section('content')

    <title>Código Barras</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('cb/css/stylesheet.css') }}" rel="stylesheet">
    <!--style media="screen" type="text/css">/*<![CDATA[*/@import 'http://127.0.0.1:8000/cb/css/stylesheet.css';/*]]>*/</style-->
    <style type="text/css">#title,#glyphs p{font-family:"Code 128"}</style>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<div class="row" style="padding: 0px 32px 30px;">
		<div class="col-md-12 col-centered" style="background-color: #f6f6f6;border: 1px solid #ccc">
			<div id="glyphs">
			<?php $arr=(array) json_decode(stripslashes($noimpresos)); ?>
				@foreach($arr as $var)
					<div class="g">{{ $var }}<p>{{ $var }}</p></div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row" style="padding: 0px 19px;margin-top: -7px;">
		<div class="col-md-12 col-centered">			
			<a href="#" class="btn btn-success">Imprimir</a>
			<!--a href="{{ route('notaingreso.create',$cod_ndi)}}" class="btn btn-primary">Ir a Nota de Ingreso</a-->			
			<a href="{{ route('comercializacion.index')}}" class="btn btn-warning">Ir a Bandeja</a>		

		</div>
	</div>
	
@endsection
<!-- OBSERVACION -->
<!-- Aún no filtra la zona específica para el reporte -->
