<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Modulo
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Paquetes
 */

class Modulo extends Model
{


    protected $fillable = [
        'name',
        'url',
        'paquete_id',
        'icon',
        'observation',
        'state',
        'position',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * paquete asociado al modulo
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Paquete>
     */
    public function paquete()
    {
        return $this->belongsTo('App\Paquete');
    }

    /**
     * Retorna el listado de estados que pueden tener los modulos
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
     * Retorna el estado del modulo
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */

    public function getStateAttribute($value){

        return $this->statesLst()[$value];
    }

    /**
     * Permisos asociados al modulo
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Permission>
     */
    public function permisos()
    {
        return $this->hasMany('Spatie\Permission\Models\Permission');
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
