<?php

namespace App;

class Empleado extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empleados';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombres', 'apellidos', 'fecha_nacimiento', 'email', 'telefono', 'observaciones', 'cargo_id','user_created_at',
        'user_updated_at',
        'user_deleted_at',
        'userid_created_at',
        'userid_updated_at',
        'userid_deleted_at',
        'created_at',
        'updated_at',
        'deleted_at'];

}
