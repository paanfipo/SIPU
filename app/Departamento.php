<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Departamento
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Departamentos
 */

class Departamento extends Model
{

    protected $fillable = [
        'nombre',
        'codigo_dane',
        'observacion',
        'pais_id',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

     /**
     * País asociados al departamento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Pais>
     */
    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    /**
     * Retorna el listado de estados que pueden tener los departamentos
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function estadoLst(){

        return array(

            0=>'Inactivo',
            1=>'Activo',
        );
    }

    /**
     * Retorna el estado del departamento
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadoLst()[$value];
    }

    /**
     * Ciudades asociados al departamento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Ciudad>
     */
    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
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
