<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function promotions()
    {
        return $this->hasMany('App\Promotion', 'type_id');
    }
}
