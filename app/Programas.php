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
class Programas extends Model
{
    //
    protected $table = 'programas';

    protected $fillable = [
        'codigo',
        'nombre',
        'email',
        'jornada',
        'coordinador_id',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Usuario cordinador asignado
     * 
     * @author Freddy Popo <jhon.popo@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function cordinador(){
        return $this->hasOne('App\User','id','coordinador_id');
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
