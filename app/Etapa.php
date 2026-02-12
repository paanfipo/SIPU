<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Etapa
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 * @subpackage Etapas
 */
class Etapa extends Model
{
    protected $table = 'etapas';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'state',
        'user_created_at',
        'user_updated_at'
    ];

     /**
     * Actividades asociados a la etapa
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Actividad>
     */
    public function actividades()
    {
        return $this->hasMany('App\Actividad');
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


     /**
     * Convocatorias asociadas a la etapa tomado del pivote convocatoria_etapa_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Convocatoria>
     */
    public function convocatoriaAvance(){
        return $this->belongsToMany(Convocatoria::class,'convocatoria_etapa_user','etapa_id','convocatoria_id')
                    ->withPivot('emprendimiento','finalizado','user_id','convocatoria_id');
    }

    /**
     * Registrados por etapa tomado del pivote convocatoria_etapa_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function registrados(){
        return $this->belongsToMany(User::class,'convocatoria_etapa_user','etapa_id','user_id')
        ->withPivot('emprendimiento','finalizado','convocatoria_id');
    }
    
}
