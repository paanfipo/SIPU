<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Dependencia
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Dependencias
 */
class Dependencia extends Model
{
    protected $table = 'dependencias';

    /**
     * Los atributos que son asignables en masa.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'sede',
        'email',
        'encargado',
        'profesor_apoyo',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Usuario encargado de la dependencia
     * 
     * @author Vanessa Quintero <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function usuarioencargado(){
        return $this->belongsTo('App\User','encargado','id');
    }


    /**
     * Usuario creador del recurso
     * 
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function usuario_creacion(){
        return $this->hasOne('App\User','id','user_created_at');
    }

    /**
     * Usuario modificador del recurso
     * 
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return Collection<User>
    */
    public function usuario_modificacion(){
        return $this->hasOne('App\User','id','user_updated_at');
    }


    /**
     * Ofertas asociadas a la dependencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Oferta>
    */
    public function ofertas(){
        return $this->hasMany('App\Oferta','dependencia_id');
    }

    /**
     * Usuarios detalle asociados a la dependencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<UserInfo>
    */
    public function detalleusuarios(){
        return $this->hasMany('App\UserInfo','dependencia_id');
    }

    /**
     * Profesor de apoyo asociado a la dependencia
     * 
     * @author Vanessa Quintero <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function profesordeapoyo(){
        return $this->belongsTo('App\User','profesor_apoyo','id');
    }
}
