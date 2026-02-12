<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Modelo Asistencia
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 * @subpackage Asistencia
 */
class Asistencia extends Model
{
    protected $table = 'asistencia';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'cronograma_id',
        'user_id',
        'asistencia',
        'emprendimiento_id',
        'asesor',
        'user_created_at',
        'user_updated_at'
    ];

    
    /**
     * Cronograma asociado a la asistencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Cronograma>
     */
    public function cronograma()
    {
        return $this->belongsTo('App\Cronograma','cronograma_id');
    }

    /**
     * Usuario asociado a la asistencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
     * Emprendimiento asociado a la asistencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Emprendimiento>
     */
    public function emprendimiento()
    {
        return $this->belongsTo('App\Emprendimiento','emprendimiento_id');
    }

    /**
     * Usuario con rol asesor asociado a la asistencia
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function asesor()
    {
        return $this->belongsTo('App\User','user_id');
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
