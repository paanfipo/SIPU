<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Tipo Mestro
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo Maestro
 */

class TipoMaestro extends Model
{

    protected $table = 'tipomaestro';

    protected $fillable = [
        'nombre',
        'observacion',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

     /**
     * Retorna el listado de estados que pueden tener un maestro
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function estadosLst(){

        return array(

            0=>'Inactivo',
            1=>'Activo',
        );
    }

    /**
     * Retorna el estado de un maestro
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadosLst()[$value];
    }


    /**
     * Items asociados al tipo maestro
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tiposmaestroitem()
    {
        return $this->hasMany('App\TipoMaestroItem','tipomaestro_id');
    }

    /**
     * Usuario creador del recurso
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function usuario_creacion(){
        return $this->hasOne('App\User','id','user_created_at');
    }

    /**
     * Usuario modificador del recurso
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
    */
    public function usuario_modificacion(){
        return $this->hasOne('App\User','id','user_updated_at');
    }

}
