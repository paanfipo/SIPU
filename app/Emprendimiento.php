<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Emprendimiento
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 */
class Emprendimiento extends Model
{
    //
    protected $table = 'emprendimientos';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'modelo_negocio',

        'ciudad_id',
        'integrantes_hombres',
        'integrantes_mujeres',
        'sector_economico',
        'producto_servicio',
        
        'fase_emprendimiento',
        'user_id',

        'camara_comercio',
        'tipo_empresa',
        'ruta_empresarial',
        
        'tipo_ruta_modulo',
        'tipo_ruta_acompañamiento',

        'user_created_at',
        'user_updated_at'
    ];

    
    /**
     * Asistencias asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Asistencia>
     */
    public function asistencias(){
        return $this->hasMany('App\Asistencia');
    }

     /**
     * Ciudad asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Ciudad>
     */
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad','ciudad_id');
    }

     /**
     * Sector Economico asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function sectorEconomico()
    {
        return $this->belongsTo('App\TipoMaestroItem','sector_economico');
    }

    /**
     * Fase emprendimiento asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function faseEmprendimiento()
    {
        return $this->belongsTo('App\TipoMaestroItem','fase_emprendimiento');
    }
}
