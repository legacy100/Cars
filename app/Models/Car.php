<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;


class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    //protected $hidden = ['updated_at'];

    //protected $visible = ['name', 'founded', 'description'];

    // public function boot(){
    //     Paginator::useBootstrap();
    // }

    //Define a has many relationship
    public function carModels(){
        return $this->hasMany(CarModel::class);
    }

    //Define a hasmanythrough relationship
    public function engines(){
        return $this->hasManyThrough(
            Engine::class, 
            CarModel::class, 
            'car_id',//Foreign key on carModel table 
            'model_id' //Foreign key on Engine Table
        );
    }

    //Define a has one through relationship
    public function productionDate(){
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }

    //Define a belongs to many relationship
    public function products(){
        return $this->belongsToMany(Products::class);
    }

}
