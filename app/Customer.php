<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    //Fillable example
    //protected $fillable=['name','email','active'];

    //Guarded example
    protected $guarded =[]; //As we validate every field it;s convinient to use guarded

    protected $attributes = [
        'active'=>1
    ];

    public function getActiveAttribute($attribute){
        // return [                    //this whole thing is refactored by the line-25 which calls a function activeOptions()
        //     0=>'Inactive',
        //     1=>'Active',
        // ][$attribute];
        return $this->activeOptions()[$attribute];
    }

    public function scopeActive($query){
        return $query->where('active',1);
    }

    public function scopeInactive($query){
        return $query->where('active',0);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function activeOptions(){
        return [
            1=>'Active',
            0=>'Inactive',
        ];
    }
}
