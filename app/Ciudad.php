<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Ciudad
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Ciudades
 */
class Ciudad extends Model
{

    protected $table = 'ciudades';

    protected $fillable = [
        'nombre',
        'codigo_dane',
        'observacion',
        'departamento_id',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];

     /**
     * Departamentos asociado a la ciudad
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Departamento>
     */
    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

     /**
     * Retorna el listado de estados que pueden tener una ciudad
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
     * Retorna el estado de una ciudad
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadoLst()[$value];
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
