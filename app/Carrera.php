<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Carrera
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Carreras
 */
class Carrera extends Model
{
    protected $table = 'carreras';

    /**
     * Los atributos que son asignables en masa.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'email',
        'user_created_at',
        'user_updated_at'
    ];

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
}
