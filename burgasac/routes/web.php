<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend
 */

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
	includeRouteFiles(__DIR__ . '/Frontend/');
});

/* ----------------------------------------------------------------------- */

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
	/**
	 * These routes need view-backend permission
	 * (good if you want to allow more than one group in the backend,
	 * then limit the backend features by different roles or permissions)
	 *
	 * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
	 */
	includeRouteFiles(__DIR__ . '/Backend/');
});
/*
 * Planeamientos
 */
Route::get('planeamientos/planeamientos/reporte','Planeamiento\\PlaneamientoController@genExcel');
Route::resource('planeamientos/planeamientos','Planeamiento\\PlaneamientoController');
Route::get('planeamientos/planeamientos/{id}/liquidacion', 'Planeamiento\\PlaneamientoController@liquidacion')->name('planeamiento.liquidacion');
Route::post('planeamientos/planeamientos/{id}/liquidacion','Planeamiento\\PlaneamientoController@aLiquidacion')->name('planeamiento.añadir_liquidacion');
Route::resource('detalleplaneamientos/detalleplaneamientos','DetallePlaneamiento\\DetallePlaneamientoController');
Route::post('detalleplaneamientos/detalleplaneamientos/{id}/materia', 'DetallePlaneamiento\\DetallePlaneamientoController@materia')->name('DetallePlaneamiento.materia');;
Route::get('despacho-tintoreria/despacho-tintoreria','Planeamiento\\PlaneamientoController@despacho')->name('planeamiento.despacho');
Route::resource('bandeja-produccion/bandeja-produccion', 'Planeamiento\\BandejaProduccionController');
Route::resource('despacho-tintoreria/despacho-tintoreria','DespachoTintoreria\\DespachoTintoreriaController');
Route::get('lotesconstock', 'DespachoTintoreria\\DespachoTintoreriaController@getLotesConStock');
Route::get('stockporlote', 'DespachoTintoreria\\DespachoTintoreriaController@getStockporLote');

Route::get('boletadespachotintoreria','DespachoTintoreria\DespachoTintoreriaController@getBoleta');
Route::resource('despacho-terceros/despacho-terceros','DespachoTerceros\\DespachoTercerosController');
Route::get('boletadespachotercero','DespachoTerceros\DespachoTercerosController@getBoleta');

Route::get('/producto/{producto_id}/proveedores','DespachoTintoreria\\DespachoTintoreriaController@obtenerProveedores');
Route::get('/proveedor/{proveedor_id}/productos','DespachoTerceros\\DespachoTercerosController@obtenerProductos');
Route::get('/telas/{tela_id}/proveedor/{proveedor_id}/stock','Planeamiento\\PlaneamientoController@stockTelas');
/**
 * Compras
 */

Route::get('/verifica-guia','Compra\\ComprasController@verifica_guia');
Route::get('/verifica-comprobante','Compra\\ComprasController@verifica_comprobante');

Route::resource('compra/compras', 'Compra\\ComprasController');
Route::get('compras/compras/liquidacion','Compra\\ComprasController@liquidacion')
			->name('compras.liquidacion');
Route::post('compras/compras/liquidar','Compra\\ComprasController@liquidar')
			->name('compras.liquidar');

Route::get('compras/compras/mp','Compra\\ComprasController@recepcion')
			->name('compras.mp');
Route::post('compras/compras/mp','Compras\\ComprasController@recepcionar')
			->name('compras.mp.agregar');
Route::post('compra/compras/existe_lote', 'Compra\\ComprasController@existeLote');

Route::resource('banco/bancos', 'Banco\\BancosController');
Route::resource('tipospago/tipos-pago', 'TiposPago\\TiposPagoController');
Route::resource('cronograma/cronogramas', 'Cronograma\\CronogramasController');

Route::get('cronograma/cronogramas/create/{compra_id}', 'Cronograma\\CronogramasController@create')->name('compra.cronograma.create');
Route::get('compras/accesorios/{id}/lotes','Compra\\ComprasController@accesorios');
Route::get('compras/insumos/{id}/lotes','Compra\\ComprasController@insumos');
Route::get('insumo/{insumo_id}/proveedor/{proveedor_id}/stock','Compra\\ComprasController@insumo_stock');
Route::get('insumo/{lote}/stock','Compra\\ComprasController@mp_stock');

Route::get('lote/{lote}/stock','Compra\\ComprasController@detalleStock')->name('compra.cronograma.create');
Route::get('compras/titulos/{id}/lotes','Compra\\ComprasController@titulo');

Route::resource('recepcion-mp/recepcion-mp','RecepcionMP\\RecepcionMPController');

Route::get('compras/lote/detalles-insumo','Compra\\ComprasController@detallesCompraInsumoByLote');
Route::get('compras/lote/{id}/detalles-accesorio','Compra\\ComprasController@detallesCompraAccesorioByLote');
Route::post('lotesporproveedor', "Compra\ComprasController@getLotesporproveedor");
Route::get('/boletacompra', "Compra\ComprasController@getPdf");

/**
 * Devoluciones
 */
Route::resource('devolucion/devoluciones', 'Devolucion\\DevolucionesController');
Route::resource('detalledevolucion/detalle-devoluciones', 'DetalleDevolucion\\DetalleDevolucionesController');

Route::get('devolucion/compras', 'Devolucion\\DevolucionesController@compras')->name('devolucion.compras');
Route::get('devolucion/devoluciones/create/{compra_id}', 'Devolucion\\DevolucionesController@create')->name('devolucion.compras.create');
Route::get('produccion/{planeamiento_id}/eliminacion','Planeamiento\\PlaneamientoController@eliminacionProduccion');
/*
 * Abonos
 */
Route::resource('tiposabono/tipos-abono', 'TiposAbono\\TiposAbonoController');

Route::resource('abono/abonos', 'Abono\\AbonosController');
Route::resource('detalleabono/detalle-abonos', 'DetalleAbono\\DetalleAbonosController');

Route::get('abono/compras', 'Abono\\AbonosController@compras')->name('abono.compras');
Route::get('abono/abonos/create/{compra_id}', 'Abono\\AbonosController@create')->name('abono.compras.create');

Route::resource('producto/productos', 'Producto\\ProductoController');
Route::resource('compraestado/compra-estados', 'CompraEstado\\CompraEstadosController');
/*
 * Comercializacion
 */
Route::get('comercializacion/comercializacion/reporte','Comercializacion\\ComercializacionController@genExcel');
Route::resource('comercializacion/comercializacion','Comercializacion\\ComercializacionController');

/*********** BANDEJA DE RECEPCION DE TELA TEÑIDA *******************/
//route::resource("comercializacion/notaingreso",'Comercializacion\\NotaIngresoController');

route::resource("comercializacion/notaingresoatipico",'Comercializacion\\NotaIngresoAController');

Route::get('comercializacion/notaingreso/create/{id}', 'Comercializacion\\NotaIngresoController@create')->name('notaingreso.create');
Route::get('comercializacion/notaingreso/show/{id}', 'Comercializacion\\NotaIngresoController@show')->name('notaingreso.show');
Route::post('comercializacion/notaingreso/store', 'Comercializacion\\NotaIngresoController@store')->name('notaingreso.store');
Route::get('comercializacion/notaingreso/impresion/{id}', 'Comercializacion\\NotaIngresoController@impresion')->name('notaingreso.impresion');
Route::get('comercializacion/notaingresoatipico/impresion/{id}', 'Comercializacion\\NotaIngresoAController@impresion')->name('notaingresoatipico.impresion');
//Route::get('abono/abonos/create/{compra_id}', 'Abono\\AbonosController@create')->name('abono.compras.create');

//Route::post('comercializacion/notaingreso', 'Comercializacion\\NotaIngresoController@store');