<div class="row">
  <div class="col-md-4">
    <label for="">Fecha</label>
    <input id="fecha" type="text" class="form-control" name="fecha" value="{{date('Y-m-d')}}">
  </div>
  <div class="col-md-4">
    <label for="">Proveedor</label>
    <select id="" class="form-control" name="proveedor">
      <option value=""></option>
      @foreach ($proveedores as $key => $proveedor)
        <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label  for="">Nro. Guia</label>
    <input type="text" name="nro_guia" value="" class="form-control">
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Lote</label>
      <input type="text" id="nro_lote" name="nro_lote" value="" class="form-control">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Materia prima</label>
      <select id="select_insumo" class="form-control" name="insumo">
        @foreach ($insumos as $key => $insumo)
          <option value="{{$insumo->id}}">{{$insumo->nombre_insumo}}</option>
        @endforeach
      </select>
    </div>

  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Titulo</label>
      <select id="select_titulo" class="form-control" name="titulo">
        @foreach ($titulos as $key => $titulo)
          <option value="{{$titulo->id}}">{{$titulo->nombre}}</option>
        @endforeach
      </select>
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="">P. Bruto</label>
      <input type="text" id="peso_bruto" name="peso_bruto" value="" class="form-control" required="">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Peso Tara</label>
      <input type="text" id="peso_tara" name="peso_tara" value="" class="form-control" required="">
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="">N° Paquetes</label>
      <input type="text" name="cantidad_paquetes" id="cantidad_paquetes" value="" class="form-control">
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-2">
  <a href="#" id="add_to_grid" class="btn btn-primary">Agregar</a>
</div>
<div class="col-md-2">
  <a href="#" class="btn btn-primary">Guardar</a>
</div>
</div>
