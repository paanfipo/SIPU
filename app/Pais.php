<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo País
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Paises
 */

class Pais extends Model
{

    protected $table = 'paises';

    protected $fillable = [
        'nombre',
        'codigo_dane',
        'codigo_iso',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

     /**
     * Departamentos asociados al país
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Departamento>
     */
    public function departamentos()
    {
        return $this->hasMany('App\Departamento');
    }

    /**
     * Retorna el listado de estados que pueden tener los paises
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
     * Retorna el estado del país
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
