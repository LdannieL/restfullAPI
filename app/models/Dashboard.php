<?php
 
class Dashboard extends Eloquent {
 
    protected $table = 'dashboard';

    public function user(){
        return $this->belongsTo('App\models\User');
    }
 
}