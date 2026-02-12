<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Curriculum
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Usuario 
 */
class Curriculum extends Model
{
    protected $table = 'curriculum';

     /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */

    protected $fillable = [
        'id',
        'user_id',
        'bachillerato',
        'educacion_superior',
        'capacitaciones',
        'sistemas',
        'idiomas',
        'experiencia_laboral',
        'perfil_ocupacional',
        'referencias_personales',
        'referencias_profesionales',
        'horario_disponibilidad',
        
        'cedula',
        'tabulado',
        'confidencialidad',
        'recibo_pago',
        'certificacion_bancaria',

        'user_created_at',
        'user_updated_at'
    ];
}
