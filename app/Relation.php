<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
    
    protected $fillable=['people_a','people_b','relation_type'];
}
