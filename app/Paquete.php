<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Paquete
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Paquetes
 */

class Paquete extends Model
{
    protected $fillable = [
        'id',
        'name',
        'url',
        'icon',
        'observation',
        'state',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Modulos asociados al paquet
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Modulo>
     */
    public function modulos()
    {
        return $this->hasMany('App\Modulo');
    }

    /**
     * Retorna el listado de estados que pueden tener los paquetes
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
     */

    public function statesLst(){

        return array(

            0=>'Inactivo',
            1=>'Activo',
        );
    }

    /**
     * Retorna el estado del paquete
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */

    public function getStateAttribute($value){

        return $this->statesLst()[$value];
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
