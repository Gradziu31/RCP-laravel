<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'user',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function parent(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
