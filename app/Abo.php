<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abo extends Model
{

    protected $table = 'abo';
    protected $keyType = 'integer';
    protected $primaryKey = 'abo_id';


    public function user()
    {
        // ein Abo kann von mehrere Users genutzt werden

        return $this->hasMany('App\UserModel');
    }



}
