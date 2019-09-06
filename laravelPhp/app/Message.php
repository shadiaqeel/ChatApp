<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $guarded =[];

    public function fromContact(Type $var = null)
    {
return $this->hasOne(User::class ,'id','from');
    }
}
