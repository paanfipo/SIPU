<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Tipo Maestro Item
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo maestro item
 */

class TipoMaestroItem extends Model
{

    protected $table = 'tipomaestroitem';

    protected $fillable = [
        'nombre',
        'numitem',
        'observacion',
        'estado',
        'tipomaestro_id',
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Retorna el listado de estados que pueden tener los items
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
    */
    public function estadosLst(){

        return array(

            0=>'Inactivo',
            1=>'Activo',
        );
    }

    /**
     * Retorna el estado del item
     *
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @param  string  $value
     * @return string
     */
    public function getEstadoAttribute($value){

        return $this->estadosLst()[$value];
    }

    /**
     * Tipo Maestro asociados al aitem
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestro>
     */
    public function tipomaestro()
    {
        return $this->belongsTo('App\TipoMaestro');
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
     * Ofertas
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Oferta>
     */
    public function ofertas()
    {
        return $this->hasMany('App\Oferta','tipo_oferta', 'id');
    }


    /**
     * Ofertas Creadas por el usuario en sesión 
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Oferta>
     */
    public function ofertasusercreated($id)
    {
        return $this->hasMany('App\Oferta','tipo_oferta', 'id')->where('user_created_at',$id);
    }


    /**
     * Ofertas según la dependencia 
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Oferta>
     */
    public function ofertasxdependencia($id)
    {
        return $this->hasMany('App\Oferta','tipo_oferta', 'id')->where('dependencia_id',$id);
    }

}
