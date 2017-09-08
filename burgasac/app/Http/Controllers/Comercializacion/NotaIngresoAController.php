<?php

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tienda;
use App\Color;
use App\Proveedor;
use App\Producto;
use App\NotaIngresoA;
use App\DetalleNotaIngresoA;
use Carbon\Carbon;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class NotaIngresoAController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        
        /*DB::transaction(function()
        {*/
            /************************ ELMINACION *******************************/
            //eliminamos los que esten en codigos a eliminar
                //verificamos si el codigo esta en la bd,par eliminarlo, sino esta el codigo fue alterado por el navegador, sólo se puede eliminar uno de los registro que se han traido(dentro del filtro pasamos el codigo qeu jala todo)
            
            $arrayElim=explode(",", $request->eliminados);


             /*dNotInga_id (ninga_id)    tienda_id   cod_barras  peso_cant   rollo   impreso estado  fecha

                (ninga_id)    color_id    producto_id proveedor_id    partida fecha*/

            for($j=0;$j<count($arrayElim);$j++)
            {
                DetalleNotaIngresoA::where('dNotInga_id','=',$arrayElim[$j])->delete();   
            }
            //que me vote las partidas segun codigo interno
            //evaluar si no tiene detalles
            //sino delete
            
            $arrayPart=explode(",", $request->parti_eli);

            $partidas = NotaIngresoA::select('partida','ninga_id')
            ->whereIn('partida',$arrayPart)                      
            ->get();

            foreach($partidas as $obj)
            {
                $verdetpar = DB::table('detalle_nota_ingreso_a')
                ->leftJoin('nota_ingreso_a', 'detalle_nota_ingreso_a.ninga_id', '=', 'nota_ingreso_a.ninga_id')
                ->select('detalle_nota_ingreso_a.ninga_id')
                //->where('nota_ingreso_a.desptint_id','=', $request->codint)
                ->where('nota_ingreso_a.partida','=',$obj->partida)            
                ->get()
                ->first();

                if($verdetpar=="")
                {
                    $deletedRows = NotaIngresoA::where('ninga_id','=',$obj->ninga_id)->delete();                                       
                }
            }
            /************************ FIN ELMINACION *******************************/

            for($i=1;$i<=$request->conta;$i++)
            {
                if($request["cod_ndi_".$i]!="")
                {
                    if($request["cod_ndi_".$i]==0)//si es diferente no se ingresa
                    {
                        $ninga_id=NotaIngresoA::select('ninga_id')
                        //->where('despTint_id','=',$request->codint)
                        ->where('partida','=',$request["par_".$i])
                        //->where('fecha','=',$request["fec_".$i])
                        ->orderBy('ninga_id','desc')->get()->first();

                        if($ninga_id=="")
                        {
                            $ninga_id=NotaIngresoA::select('ninga_id')->orderBy('ninga_id','desc')->get()->first();


                            $NotaIngresoa=new NotaIngresoA;
                            $NotaIngresoa->color_id=$request["col_".$i];
                            $NotaIngresoa->producto_id=$request["pro_".$i];
                            $NotaIngresoa->proveedor_id=$request["tie_".$i];
                            $NotaIngresoa->partida=$request["par_".$i];
                            $NotaIngresoa->fecha=$request["fec_".$i];
                            //$NotaIngreso->fecha=$request["fec_".$i];

                            $NotaIngresoa->save();
                        }
                        else
                        {
                            /**************************** ACTUALIZAR *******************************/
                                /*if(in_array($request["cod_ndi_".$i], $arraycad_actt, true))
                                {
                                    DetalleNotaIngreso::where('dNotIng_id',"=",$request["cod_ndi_".$i])                              
                                    ->update(['tienda_id' => $request["tie_".$i],'peso_cant' => $request["pes_".$i],'rollo' => $request["roll_".$i]]);    
                                }*/
                            /**************************** FIN ACTUALIZAR ***************************/
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
                        $ninga_id=NotaIngresoA::select('ninga_id')
                        //->where('despTint_id','=',$request->codint)
                        ->where('partida','=',$request["par_".$i])
                        //->where('fecha','=',$request["fec_".$i])
                        ->orderBy('ninga_id','desc')->get()->first();
                        
                            $DetalleNotaIngreso=new DetalleNotaIngresoA;
                            $DetalleNotaIngreso->ninga_id=$ninga_id->ninga_id;
                            $DetalleNotaIngreso->tienda_id=$request["tie_".$i];
                            $DetalleNotaIngreso->cod_barras="código de prueba";
                            $DetalleNotaIngreso->peso_cant=$request["pes_".$i];
                            $DetalleNotaIngreso->rollo=$request["roll_".$i];
                            $DetalleNotaIngreso->impreso="1";
                            $DetalleNotaIngreso->estado="0";
                            $DetalleNotaIngreso->fecha=$request["fec_".$i];

                            $DetalleNotaIngreso->save();
                        
                    }
                    else
                    {
                        /**************************** ACTUALIZAR *******************************/
                            /*if(in_array($request["cod_ndi_".$i], $arraycad_actt, true))
                            {
                                DetalleNotaIngreso::where('dNotIng_id',"=",$request["cod_ndi_".$i])                              
                                ->update(['tienda_id' => $request["tie_".$i],'peso_cant' => $request["pes_".$i],'rollo' => $request["roll_".$i]]);    
                            }*/
                        /**************************** FIN ACTUALIZAR ***************************/
                    }
                }
            }

        //});

       return redirect()->route('comercializacion.index',$request->codint)->with('info','Se creó correctamente la nota de atípico.'); 
    }    

    public function create()
    {
        $tienda=Tienda::all();
        $proveedor=Proveedor::all();
        $color=Color::all();
        $producto=Producto::all();

        $bandejatabla = DB::table('detalle_nota_ingreso_a')
        ->leftJoin('tienda', 'detalle_nota_ingreso_a.tienda_id', '=', 'tienda.tienda_id')            
        ->leftJoin('nota_ingreso_a', 'detalle_nota_ingreso_a.ninga_id', '=', 'nota_ingreso_a.ninga_id')
        ->leftJoin('color', 'nota_ingreso_a.color_id', '=', 'color.id_color')
        ->leftJoin('productos', 'nota_ingreso_a.producto_id', '=', 'productos.id')            
        ->leftJoin('proveedores', 'nota_ingreso_a.proveedor_id', '=', 'proveedores.id')

        ->select('detalle_nota_ingreso_a.dNotInga_id',
            'detalle_nota_ingreso_a.fecha',                
            'productos.nombre_especifico',
            'productos.id',
            'detalle_nota_ingreso_a.tienda_id',
            'tienda.desc_tienda',
            'nota_ingreso_a.partida',
            'color.nombre',
            'color.id_color',
            'detalle_nota_ingreso_a.peso_cant',
            'detalle_nota_ingreso_a.rollo',
            'detalle_nota_ingreso_a.impreso')
        //->where('nota_ingreso.desptint_id','=', $id)
        ->orderBy('detalle_nota_ingreso_a.dNotInga_id',"Asc")
        ->paginate(5);

        $id=0;

        $partidas_ultima = NotaIngresoA::select('ninga_id')
            ->orderBy('ninga_id',"desc")                      
            ->get()->first();

        $conn=0;

        if($partidas_ultima!="")
            $conn=$partidas_ultima->ninga_id;       

        $cad="PA";
        for($i=strlen( $conn);$i<=11;$i++)
        {
            $cad.="0";
        }
        $cad.= ++$conn;


        $fecha=Carbon::now()->format('Y-m-d');
        return view("comercializacion.notaingresoatipico.create",compact('proveedor','tienda','color','producto','fecha','id','bandejatabla',"cad","conn"));
        //return $bandejatabla;
    }
    
  
}
