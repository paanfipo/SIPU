<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Modelo Salones
 * 
 * @author Freddy Popo <jhon.popo@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Salones
 */
class Salones extends Model
{
    //
    protected $table = 'salones';

    protected $fillable = [
        'numero',
        'capacidad',
        'observacion',
        'universidad',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Universidad Detalle
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function universidadDetalle()
    {
        return $this->belongsTo('App\TipoMaestroItem','universidad','id');
    }

    
    /**
     * Retorna el listado de estados que pueden tener los items
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
     * Retorna el estado del item
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadosLst()[$value];
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
