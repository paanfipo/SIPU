<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Ofertas
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Vacantes 
 * @subpackage Ofertas
 */

class Oferta extends Model
{
    protected $table = 'ofertas';

    /**
     * Los atributos que son asignables en masa.
     *  @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
    */
    protected $fillable = [
        'nombre_empresa_dependencia',
        'nombre_oferta',
        'cargo',
        'funciones',
        'tipo_contrato',
        'tipo_oferta',
        'salario',
        'duracion_meses',
        'cantidad',
        'fecha_cierre_vacante',
        'dependencia_id',
        "user_created_at",
        "user_updated_at"        
    ];
    
    protected $dates = ['fecha_cierre_vacante'];

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
     * Usuarios postulados en las diferentes ofertas tomadas del pivote oferta_user
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function postuladosOfertas(){
        return $this->belongsToMany(User::class,'oferta_user','oferta_id','user_id')
        ->withPivot('estado','fase');
    }


    /**
     * Tipo de contratación asociada a la oferta
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tipoContratacion(){
        return $this->hasOne('App\TipoMaestroItem','id','tipo_contrato');
    }

    /**
     * Tipo de oferta 
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tipoOferta(){
        return $this->belongsTo('App\TipoMaestroItem','tipo_oferta','id');
    }

    /**
     * Tipo de oferta según name
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tipoOfertaNombre($nombre){
        return $this->hasOne('App\TipoMaestroItem','id','tipo_oferta')->where('nombre',$nombre);
    }


    /**
     * Usuario postulados a la oferta donde la postulación se encuentra activa tomadas del pivote oferta_user
     * 
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function postuladosOfertasActivas() // solo las activas
    {
        return $this->postuladosOfertas()->wherePivot('estado', true);
    }

     /**
     * Dependencia asociada a la oferta
     * 
     * @author Vanessa Quintero <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Dependencia>
     */
    public function dependencia(){
        return $this->belongsTo('App\Dependencia','dependencia_id','id');
    }

     /**
     * Retorna la fase en la que se encuentra la vinculación del usuario en la oferta
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function faseLst(){

        return array(
            0=>'Pendiente',
            1=>'Aprovada',
            2=>'Vinculación',
        );
    }




    
}
