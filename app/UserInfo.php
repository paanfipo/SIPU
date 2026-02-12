<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Usuario Info
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Usuarios
 */

class UserInfo extends Model
{
    protected $table = 'user_info';

    /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'foto', 
        'email_institucional',
        'telefonos',
        'facebook',
        'instagram',

        'user_id',
        'encuesta',

        'tipo_documento',
        'numero_documento',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'fecha_lugar_expedicion',
        'libreta_militar',
        'nacionalidad',

        'edad',
        'sexo',
        'direccion',
        'barrio',
        'estrato',
        'ciudad_id',

        'estado_civil',
        'personas_a_cargo',
        'posicion_familiar',

        
        'codigo_estudiante',
        'semestre',
        'sede',
        'jornada',
        'periodo_academico',
        'codigo_carrera',
        'semestre',
        'promedio',
        
        'etnia',
        'tipo_zona',
        'nivel_estudio',

        'nombre_empresa',
        'nit_empresa',
        'file_rut',
        'file_camara_comercio',
        'file_representante',

        'dependencia_id',
        
        'user_created_at',
        'user_updated_at'
    ];

    protected $dates = ['fecha_nacimiento'];


    /**
     * Sexo del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function sexouser()
    {
        return $this->belongsTo('App\TipoMaestroItem','sexo');
    }

    /**
     * Etnia del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function etnia()
    {
        return $this->belongsTo('App\TipoMaestroItem','etnia');
    }

    /**
     * Tipo Zona del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tipoZona()
    {
        return $this->belongsTo('App\TipoMaestroItem','tipo_zona');
    }

    /**
     * Nivel de estudio del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function nivelEstudio()
    {
        return $this->belongsTo('App\TipoMaestroItem','nivel_estudio');
    }

    /**
     * Ciudad del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad','ciudad_id');
    }

    
    /**
     * Dependencia asociada al usuario
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Dependencia>
     */
    public function dependencia()
    {
        return $this->belongsTo('App\Dependencia','dependencia_id','id');
    }

     /**
     * Tipo de documento del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function tipodocumento()
    {
        return $this->belongsTo('App\TipoMaestroItem','tipo_documento','id');
    }

    /**
     * Lugar de nacimiento del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function lugarNacimiento()
    {
        return $this->belongsTo('App\Ciudad','lugar_nacimiento','id');
    }

    /**
     * Nacionalidad del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function nacionalidadUsuario()
    {
        return $this->belongsTo('App\Pais','nacionalidad','id');
    }

    /**
     * Estado civil del usuario asociado
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<TipoMaestroItem>
     */
    public function estadoCivil()
    {
        return $this->belongsTo('App\TipoMaestroItem','estado_civil','id');
    }

    
}
