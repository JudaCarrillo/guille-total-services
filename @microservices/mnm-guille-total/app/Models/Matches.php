<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';
    protected $fillable = [
        'match_id',
        'rival',
        'rival_confederation',
        'peru_score',
        'rival_score',
        'peru_awarded_score',
        'rival_awarded_score',
        'result',
        'shootout_result',
        'awarded_result',
        'tournament_name',
        'tournament_type',
        'official',
        'stadium',
        'city',
        'country',
        'elevation',
        'peru_condition',
        'coach',
        'coach_nationality',
        'date',
        'porcentaje_gana',
        'porcentaje_empate',
        'porcentaje_pierde',
        'evento'
    ];
    protected $primaryKey='id';
    protected $hidden=[
        'created_at','updated_at','deleted_at'
    ];
};