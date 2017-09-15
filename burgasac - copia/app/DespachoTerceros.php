<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DespachoTerceros extends Model
{
  protected $table = "despacho_terceros";

  protected $fillable = ["fecha", "proveedor_id"];
}
