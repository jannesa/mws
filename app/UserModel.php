<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class UserModel extends Model
{
    // ACHTUNG:
    // das ist das Datenbank-Model für die User - User.php ist für die Authentifizierung (login) -> default

    protected $table = 'users';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'email';


    // Ein User gehört zu einem Abo
    public function user()
    {
        return $this->belongsTo('App\Abo', 'abo_id');
    }


    // ein User kann mehrere Events haben
    public function event(){

        return $this->hasMany('App\Event');

    }



}

