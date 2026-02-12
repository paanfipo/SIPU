<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo File
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos 
 */
class File extends Model
{
    protected $table = 'files';

     /**
     * Los atributos que son asignables en masa.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @var array
     */
    protected $fillable = [
        'file_1',
        'file_2',
        'file_3',
        'cronograma_id',
        'user_id', 
        'user_created_at',
        'user_updated_at'
    ];

    /**
     * Usuario creador del recurso
     * 
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function usuario_creacion(){
        return $this->hasOne('App\User','id','user_created_at');
    }

    /**
     * Usuario modificador del recurso
     * 
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return Collection<User>
    */
    public function usuario_modificacion(){
        return $this->hasOne('App\User','id','user_updated_at');
    }

    /**
     * Cronograma asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<Cronograma>
     */
    public function cronograma()
    {
        return $this->belongsTo('App\Cronograma','cronograma_id');
    
    }

    /**
     * Usuario asociado al emprendimiento
     * 
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return Collection<User>
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
