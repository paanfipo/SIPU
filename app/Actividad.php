<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Actividad
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 * @subpackage Actividad
 */
class Actividad extends Model
{
    protected $table = 'actividades';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'etapa_id',
        'personalizacion',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Etapa asociados a la actividad
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapa>
     */
    public function etapa()
    {
        return $this->belongsTo('App\Etapa','etapa_id');
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
     * Cronogramas asociados a la actividad
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Cronograma>
     */
    public function cronogramas()
    {
        return $this->hasMany('App\Cronograma');
    }

    /**
     * Cronogramas asociados a la actividad según la convocatoria
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  int  $id
     * @return Collection<Cronograma>
     */
    public function cronogramaConvocatoria($id)
    {
        return $this->hasMany('App\Cronograma')->where('convocatoria_id', $id)->first();
    }
}
