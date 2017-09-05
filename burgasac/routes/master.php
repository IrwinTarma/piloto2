<?php
/**
 * CRUDs
 */

Route::resource('empleado/empleados', 'Empleado\\EmpleadosController');
Route::resource('insumo/insumos', 'Insumo\\InsumosController');
Route::resource('local/locales', 'Insumo\\LocalesController');
Route::resource('proveedor/proveedores', 'Insumo\\ProveedoresController');
Route::resource('empleado/empleados', 'Empleado\\EmpleadosController');
Route::resource('insumo/insumos', 'Insumo\\InsumosController');
Route::resource('local/locales', 'Insumo\\LocalesController');
Route::resource('proveedor/proveedores', 'Insumo\\ProveedoresController');
Route::resource('maquina/maquinas', 'Maquina\\MaquinasController');
Route::resource('accesorio/accesorios', 'Accesorio\\AccesoriosController');
Route::resource('marca/marcas', 'Marca\\MarcasController');
Route::resource('titulo/titulos', 'Titulo\\TitulosController');
Route::resource('procedencias', 'Procedencia\\ProcedenciasController');
/*
* Añadidos por Flavio Antonio Huanacchiri Castillo
* Desarrollador Full - Stack, Semi - Senior
*/
Route::resource('tipo_proveedor', 'Master\TipoProveedorController');
Route::resource('cargo', 'Master\CargoController');
Route::resource('color', 'Master\ColorController');
Route::resource('proveedor_color_producto', 'Master\ProveedorColorProductoController');
Route::post('coloresporproveedor', 'Master\ProveedorColorProductoController@postColores');
Route::post('coloresporproveedorproducto', 'Master\ProveedorColorProductoController@postColoresproducto');
