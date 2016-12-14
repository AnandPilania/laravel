<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fc_comment extends Model {
    protected $fillable = [
        'user_id',
        'comments',
    ];

    public static function getFillableAttributes()
    {
        return [
            'user_id',
            'comments',
        ];
    }

    public function blog()
    {
        return $this->belongTo(fc_blogs::class);
    }
}
