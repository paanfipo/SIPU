<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;


/**
 * Modelo Permiso
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Permisos
 */

class Permiso extends Permission
{
     /**
     * modulo asociado al permiso
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Modulo>
     */

    public function modulo()
    {
        return $this->belongsTo('App\Modulo');
    }
}
