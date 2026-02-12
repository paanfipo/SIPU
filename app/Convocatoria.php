<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Convocatoria
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 * @subpackage Convocatorias
 */
class Convocatoria extends Model
{
    //
    protected $table = 'convocatorias';


    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'user_created_at',
        'user_updated_at'
    ];


    protected $dates = ['fecha_inicio', 'fecha_fin'];

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
     * Etapas asociadas a la convocatoria tomadas del pivote convocatoria_etapa
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
     */
    public function etapas(){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa','convocatoria_id','etapa_id')
        ->withPivot('posicion')->orderBy('posicion', 'ASC');
    }

    /**
     * Etapa asociadas a la convocatoria tomadas del pivote convocatoria_etapa según la posición
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
     */
    public function etapasxposicion($posicion){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa','convocatoria_id','etapa_id')
        ->wherePivot('posicion',$posicion);
    }

    /**
     * Etapa de la primera posición asociada a la convocatoria tomadas del pivote convocatoria_etapa
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
     */
    public function primeraetapa(){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa','convocatoria_id','etapa_id')
        ->wherePivot('posicion',1);
    }

    /**
     * Cronogramas asociados a la convocatoria
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Cronograma>
     */
    public function cronogramas()
    {
        return $this->hasMany('App\Cronograma');
    }

    /**
     * Cronogramas asociados a la convocatoria según la etapa
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Cronograma>
     */
    public function cronogramasxetapa($etapa)
    {
        return $this->hasMany('App\Cronograma')->where('etapa_id',$etapa)->get();
    }

    /**
     * Etapas asociadas a la convocatoria tomadas del pivote convocatoria_etapa_user por cada inscripto
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
     */
    public function etapaAvance(){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa_user','convocatoria_id','etapa_id')
        ->withPivot('emprendimiento','finalizado','user_id');
    }

    /**
     * Etapas asociadas a la convocatoria tomadas del pivote convocatoria_etapa_user por cada inscripto
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
    */
    public function etapaAvanceUsuario(){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa_user','convocatoria_id','etapa_id')
        ->withPivot('emprendimiento','finalizado','user_id','caracterizacion');
    }

    /**
     * Inscriptos asociados a la convocatoria 
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
    */
    public function registrados(){
        return $this->belongsToMany(User::class,'convocatoria_etapa_user','convocatoria_id','user_id')
        ->withPivot('emprendimiento','finalizado','etapa_id');
    }

    /**
     * Retorna el listado de estados que pueden tener las convocatorias
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function estadoLst(){

        return array(
            1=>'Abierto',
            2=>'Cerrado',
        );
    }

    /**
     * Retorna el estado de la convocatoria
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadoLst()[$value];
    }

     /**
     * Valida si el usuario finalizo la etapa correspondiente
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapas>
     */
    public function if_finish_etapaxconvocatoria($usuario, $etapa){
        return $this->belongsToMany(User::class,'convocatoria_etapa_user','convocatoria_id','user_id')        
        ->wherePivot('etapa_id',$etapa)
        ->wherePivot('user_id',$usuario);
    }

    
    /**
     * Inscriptos asociados a la convocatoria 
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
    */
    public function registradosfiltrados(){
        return $this->belongsToMany(User::class,'convocatoria_etapa_user','etapa_id','user_id')
        ->withPivot('emprendimiento','finalizado','convocatoria_id');
    }

}
