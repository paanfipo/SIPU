<?php

namespace App;

//Roles y Permisos
use Spatie\Permission\Traits\HasRoles;

//Notificaciones
use Illuminate\Notifications\Notifiable;

//Verificación email
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

//Reset Password
use App\Mail\ResetPassword;
use App\Notifications\CustomResetPasswordNotification;

//Autenticación
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Modelo Usuario
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Usuarios
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Los atributos que deben estar ocultos para las matrices.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Los atributos que se deben convertir en tipos nativos.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Detalle info usuario asociado
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<UserInfo>
     */
    public function userInfo()
    {
        return $this->hasOne('App\UserInfo','user_id');
    }

    /**
     * Hoja del vida del usuario asociado
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Curriculum>
     */
    public function curriculum()
    {
        return $this->hasOne('App\Curriculum','user_id');
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
     * Emprendimientos asociados al usuario
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Emprendimiento>
     */
    public function emprendimientos(){
        return $this->hasMany('App\Emprendimiento','user_id');
    }

    /**
     * Convocatorias asociadas al usuario tomadas del pivote convocatoria_etapa_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Convocatoria>
     */
    public function convocatorias(){
        return $this->belongsToMany(Convocatoria::class,'convocatoria_etapa_user','user_id','convocatoria_id')
                    ->withPivot('emprendimiento','finalizado','etapa_id');
    }

    /**
     * Etapas asociadas al usuario tomadas del pivote convocatoria_etapa_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Etapa>
     */
    public function etapas(){
        return $this->belongsToMany(Etapa::class,'convocatoria_etapa_user','user_id','etapa_id')
                    ->withPivot('emprendimiento','finalizado','convocatoria_id');
    }

     /**
     * Asistencias asociadas al usuario
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Asistencia>
     */
    public function asistencias(){
        return $this->hasMany('App\Asistencia','user_id');
    }

     /**
     * Convocatorias asociadas al usuario tomadas del pivote convocatoria_etapa_user según la etapa 
     * @param  Int  $etapa
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Convocatoria>
     */
    public function avanceConvocatoriaEtapa($etapa,$convocatoria){
        return $this->belongsToMany(Convocatoria::class,'convocatoria_etapa_user','user_id','convocatoria_id')
        ->wherePivot('etapa_id', $etapa)->wherePivot('convocatoria_id', $convocatoria)->withPivot('emprendimiento','finalizado','etapa_id','caracterizacion');
    }

    /**
     * Envia email para hacer reset password 
     * @param  String  $token
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new ResetPassword($token));
    }

    /**
     * Envia email para verificar correo
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        //$this->notify(new App\Notifications\CustomVerifyEmail);
        Mail::to($this->email)->send(new EmailVerification($this->id,$this->email));
    }

    /**
     * Convocatorias asociadas al usuario tomadas del pivote convocatoria_etapa_user según la etapa 
     * @param  Int  $etapa
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Convocatoria>
     */
    public function userEmprendimientoConvocatoria($etapa){
        return $this->belongsToMany(Convocatoria::class,'convocatoria_etapa_user','user_id','convocatoria_id')
        ->wherePivot('etapa_id', $etapa)->withPivot('convocatoria_id','finalizado','etapa_id','caracterizacion','emprendimiento');
    }


    /**
     * Las ofertas donde se ha postulado el usuario tomadas del pivote oferta_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Oferta>
    */
    public function ofertasPostuladas(){
        return $this->belongsToMany(User::class,'oferta_user','user_id','oferta_id')
        ->withPivot('estado','fase');
    }

     /**
     * Dependencias asociadas al usuario
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Dependencia>
     */
    public function dependencias(){
        return $this->hasMany('App\Dependencia','encargado');
    }

    /**
     * Dependencias asociadas al usuario tipo profesor de apoyo
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Dependencia>
     */
    public function dependenciasprofesorapoyo(){
        return $this->hasMany('App\Dependencia','profesor_apoyo');
    }

    /**
     * Retorna el listado de estados que pueden tener un usuario
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function stateLst(){

        return array(

            0=>'Inactivo',
            1=>'Activo',
        );
    }

    /**
     * Retorna el estado de un usuario
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getStateAttribute($value){

        return $this->stateLst()[$value];
    }

}
