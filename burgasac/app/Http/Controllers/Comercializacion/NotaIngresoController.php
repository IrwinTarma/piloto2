<?php

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tienda;
use App\NotaIngreso;
use App\DetalleNotaIngreso;
use Carbon\Carbon;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class NotaIngresoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
/*
    public function index()
    {
    	$provedors=provedor::orderBy("nProvCod","ASC")->paginate();
    	return view("provedor.index",compact("provedors"));
    }
*/
    public function store(Request $request)
    {
    	
		/*DB::transaction(function()
		{*/
			/************************ ELMINACION *******************************/
			//eliminamos los que esten en codigos a eliminar
				//verificamos si el codigo esta en la bd,par eliminarlo, sino esta el codigo fue alterado por el navegador, sólo se puede eliminar uno de los registro que se han traido(dentro del filtro pasamos el codigo qeu jala todo)
			
			$arrayElim=explode(",", $request->eliminados);

			for($j=0;$j<count($arrayElim);$j++)
			{
				DetalleNotaIngreso::where('dNotIng_id','=',$arrayElim[$j])->delete();	
			}
			//que me vote las partidas segun codigo interno
			//evaluar si no tiene detalles
			//sino delete
			
			$partidas = NotaIngreso::select('partida','nIng_id')
            ->where('despTint_id','=', $request->codint)                      
            ->get();

            foreach($partidas as $obj)
            {
				$verdetpar = DB::table('detalle_nota_ingreso')
	            ->leftJoin('nota_ingreso', 'detalle_nota_ingreso.ning_id', '=', 'nota_ingreso.ning_id')
	            ->select('desptint_id')
	            ->where('nota_ingreso.desptint_id','=', $request->codint)
	            ->where('nota_ingreso.partida','=',$obj->partida)            
	            ->get()
	            ->first();

	            if($verdetpar=="")
				{
					$deletedRows = NotaIngreso::where('nIng_id','=',$obj->nIng_id)->delete();										
				}
			}
			/************************ FIN ELMINACION *******************************/

			for($i=1;$i<=$request->conta;$i++)
			{
				if($request["cod_ndi_".$i]!="")
				{
					if($request["cod_ndi_".$i]==0)//si es diferente no se ingresa
					{
						$nIng_id=NotaIngreso::select('nIng_id')
						->where('despTint_id','=',$request->codint)
						->where('partida','=',$request["par_".$i])
						//->where('fecha','=',$request["fec_".$i])
						->orderBy('nIng_id','desc')->get()->first();

						if($nIng_id=="")
						{
							$NotaIngreso=new NotaIngreso;
							$NotaIngreso->despTint_id=$request->codint;
							$NotaIngreso->partida=$request["par_".$i];
							//$NotaIngreso->fecha=$request["fec_".$i];

							$NotaIngreso->save();
						}
					}
				}
			}

            $arraycad_actt=explode(",", $request->cad_actt);

			//Recorrer, buscar el reg de la partida y fecha y registrar
			for($i=1;$i<=$request->conta;$i++)
			{
				if($request["cod_ndi_".$i]!="")
				{
					if($request["cod_ndi_".$i]==0)//si es diferente no se ingresa
					{
						$nIng_id=NotaIngreso::select('nIng_id')
						->where('despTint_id','=',$request->codint)
						->where('partida','=',$request["par_".$i])
						//->where('fecha','=',$request["fec_".$i])
						->orderBy('nIng_id','desc')->get()->first();
						
							$DetalleNotaIngreso=new DetalleNotaIngreso;
							$DetalleNotaIngreso->nIng_id=$nIng_id->nIng_id;
							$DetalleNotaIngreso->tienda_id=$request["tie_".$i];
							$DetalleNotaIngreso->cod_barras=$nIng_id->nIng_id.$request["fec_".$i]."-".$request["tie_".$i];
							$DetalleNotaIngreso->peso_cant=$request["pes_".$i];
							$DetalleNotaIngreso->rollo=$request["roll_".$i];
							$DetalleNotaIngreso->impreso="0";
							$DetalleNotaIngreso->fecha=$request["fec_".$i];

					        $DetalleNotaIngreso->save();
					    
				    }
                    else
                    {
                        /**************************** ACTUALIZAR *******************************/
                            if(in_array($request["cod_ndi_".$i], $arraycad_actt, true))
                            {
                                DetalleNotaIngreso::where('dNotIng_id',"=",$request["cod_ndi_".$i])                              
                                ->update(['tienda_id' => $request["tie_".$i],'peso_cant' => $request["pes_".$i],'rollo' => $request["roll_".$i]]);    
                            }
                        /**************************** FIN ACTUALIZAR ***************************/
                    }
				}
			}


            $noimpresos = DetalleNotaIngreso::leftJoin('nota_ingreso', 'detalle_nota_ingreso.ning_id', '=', 'nota_ingreso.ning_id')
                ->select('detalle_nota_ingreso.cod_barras')
                ->where('nota_ingreso.desptint_id','=', $request->codint)
                ->where('detalle_nota_ingreso.impreso','=',"0")            
                ->get();
		//});
            
            return view("comercializacion.notaingreso.impresion",compact("noimpresos"));
       //return redirect()->route('notaingreso.create',$request->codint)->with('info','Las notas se crearon correctamente.'); 
    }

    public function show($id)
    {

        $tienda=Tienda::all();
        $bandeja = DB::table('detalles_despacho_tintoreria')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id_color')
            ->leftJoin('productos', 'detalles_despacho_tintoreria.producto_id', '=', 'productos.id')
            ->leftJoin('proveedores', 'detalles_despacho_tintoreria.proveedor_id', '=', 'proveedores.id')
            ->select('detalles_despacho_tintoreria.created_at',
                'detalles_despacho_tintoreria.id', 
                'proveedores.razon_social', 
                'productos.nombre_generico',
                'detalles_despacho_tintoreria.cantidad',
                'detalles_despacho_tintoreria.rollos',
                'color.nombre',
                'detalles_despacho_tintoreria.estado',
                'detalles_despacho_tintoreria.color_id',
                'detalles_despacho_tintoreria.producto_id',
                'detalles_despacho_tintoreria.proveedor_id',
                'detalles_despacho_tintoreria.nro_lote')            
            ->where('detalles_despacho_tintoreria.id','=', $id)
            ->get()
            ->first();

        $bandejatabla = DB::table('detalle_nota_ingreso')
            ->leftJoin('nota_ingreso', 'detalle_nota_ingreso.ning_id', '=', 'nota_ingreso.ning_id')
            ->leftJoin('tienda', 'detalle_nota_ingreso.tienda_id', '=', 'tienda.tienda_id')
            ->leftJoin('detalles_despacho_tintoreria', 'nota_ingreso.desptint_id', '=', 'detalles_despacho_tintoreria.id')
            ->leftJoin('productos', 'detalles_despacho_tintoreria.producto_id', '=', 'productos.id')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id_color')

            ->select('detalle_nota_ingreso.dNotIng_id',
                'nota_ingreso.ning_id',
                'detalle_nota_ingreso.fecha',
                'productos.nombre_especifico',
                'detalle_nota_ingreso.tienda_id',
                'tienda.desc_tienda',
                'nota_ingreso.partida',
                'color.nombre',
                'detalle_nota_ingreso.peso_cant',
                'detalle_nota_ingreso.rollo',
                'detalle_nota_ingreso.impreso')
            ->where('nota_ingreso.desptint_id','=', $id)
            ->orderBy('detalle_nota_ingreso.dNotIng_id',"Asc")
            ->paginate(5);


        $fecha=Carbon::now()->format('Y-m-d');
        return view("comercializacion.notaingreso.show",compact('bandeja','tienda','fecha','id','bandejatabla'));
    }

    public function create($id)
    {
    	$tienda=Tienda::all();
   		$bandeja = DB::table('detalles_despacho_tintoreria')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id_color')
            ->leftJoin('productos', 'detalles_despacho_tintoreria.producto_id', '=', 'productos.id')
            ->leftJoin('proveedores', 'detalles_despacho_tintoreria.proveedor_id', '=', 'proveedores.id')
            ->select('detalles_despacho_tintoreria.created_at',
                'detalles_despacho_tintoreria.id', 
                'proveedores.razon_social', 
                'productos.nombre_generico',
                'detalles_despacho_tintoreria.cantidad',
                'detalles_despacho_tintoreria.rollos',
                'color.nombre',
                'detalles_despacho_tintoreria.estado',
                'detalles_despacho_tintoreria.color_id',
                'detalles_despacho_tintoreria.producto_id',
                'detalles_despacho_tintoreria.proveedor_id',
                'detalles_despacho_tintoreria.nro_lote')            
            ->where('detalles_despacho_tintoreria.id','=', $id)
            ->get()
            ->first();

        $bandejatabla = DB::table('detalle_nota_ingreso')
            ->leftJoin('nota_ingreso', 'detalle_nota_ingreso.ning_id', '=', 'nota_ingreso.ning_id')
            ->leftJoin('tienda', 'detalle_nota_ingreso.tienda_id', '=', 'tienda.tienda_id')
            ->leftJoin('detalles_despacho_tintoreria', 'nota_ingreso.desptint_id', '=', 'detalles_despacho_tintoreria.id')
            ->leftJoin('productos', 'detalles_despacho_tintoreria.producto_id', '=', 'productos.id')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id_color')

            ->select('detalle_nota_ingreso.dNotIng_id',
            	'nota_ingreso.ning_id',
            	'detalle_nota_ingreso.fecha',
            	'productos.nombre_especifico',
            	'detalle_nota_ingreso.tienda_id',
            	'tienda.desc_tienda',
            	'nota_ingreso.partida',
            	'color.nombre',
            	'detalle_nota_ingreso.peso_cant',
            	'detalle_nota_ingreso.rollo',
            	'detalle_nota_ingreso.impreso')
            ->where('nota_ingreso.desptint_id','=', $id)
            ->orderBy('detalle_nota_ingreso.dNotIng_id',"Asc")
            ->paginate(5);


        $fecha=Carbon::now()->format('Y-m-d');
    	return view("comercializacion.notaingreso.create",compact('bandeja','tienda','fecha','id','bandejatabla'));
    }
    
    public function impresion($id)
    {
        $v=1;
        return view("comercializacion.notaingreso.impresion",compact("v"));
    }  
}
