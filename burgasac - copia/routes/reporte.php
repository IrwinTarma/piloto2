<?php

Route::resource('reportes/reportes','Reportes\\ReportesController');
Route::get('reportes/compras','Reportes\\ReportesController@compras')->name("reportes.compra");
Route::get('reportes/resumen','Reportes\\ReportesController@stockGeneral')->name("reportes.resumen");
Route::get('reportes/tela','Reportes\\ReportesController@telasResumen')->name("reportes.telas");
Route::get('reportes/tintoreria','Reportes\\ReportesController@despachoTintoreria')->name("reportes.despacho_tintoreria");
Route::get('reportes/planeamientos','Reportes\\ReportesController@planeamientosResumen')->name("reportes.planeamientos");
Route::get('reportes/produccion','Reportes\\ReportesController@produccionResumen')->name("reportes.produccion");

Route::get('reportes/compras/descargar','Reportes\\ReportesController@comprasDescargar')->name("reportes.compras_descargar");
Route::get('reportes/resumen/descargar','Reportes\\ReportesController@resumenDescargar')->name("reportes.resumen_descargar");
Route::get('reportes/telas/descargar','Reportes\\ReportesController@telasDescargar')->name("reportes.resumen_telas_descargar");
Route::get('reportes/planeamientos/descargar','Reportes\\ReportesController@planeamientosDescargar')->name("reportes.planeamientos_descargar");
Route::get('reportes/produccion/descargar','Reportes\\ReportesController@produccionDescargar')->name("reportes.produccion_descargar");
Route::resource('reportes/proveedor_tela_deuda','Reportes\ReporteDespachoController');