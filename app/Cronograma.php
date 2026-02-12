<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Cronograma
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 * @subpackage Cronograma
 */
class Cronograma extends Model
{
    protected $table = 'cronogramas';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'id',
        'convocatoria_id',
        'actividad_id',
        'etapa_id',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'duracion',
        'observacion',
        'asesor_id',
        'enlace',
        'user_created_at',
        'user_updated_at'
    ];

    protected $dates = ['fecha_hora_inicio', 'fecha_hora_fin'];


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
     * Convocatoria asociada al cronograma
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Convocatoria>
     */
    public function convocatoria()
    {
        return $this->belongsTo('App\Convocatoria','convocatoria_id');
    }

    /**
     * Actividad asociada al cronograma
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Actividad>
     */
    public function actividad()
    {
        return $this->belongsTo('App\Actividad','actividad_id');
    }


    /**
     * Etapa asociada a la actividad del cronograma
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapa>
     */
    public function etapa()
    {
        return $this->belongsTo('App\Etapa','etapa_id');
    }


    /**
     * Asistencias asociada al cronograma
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Asistencia>
     */
    public function asistencias()
    {
        return $this->hasMany('App\Asistencia');
    }

    /**
     * Asesor asociado al cronograma
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function asesor(){
        return $this->belongsTo('App\User','asesor_id');
    }
}
