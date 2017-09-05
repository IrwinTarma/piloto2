<?php namespace App\Http\Controllers\Reportes;

use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Http\Request;

interface ReporteInterfaceController
{
	public function index(Request $request);

	public static function getPdf($fitlro);
}