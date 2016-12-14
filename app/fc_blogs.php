<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fc_blogs extends Model {

    public function comments()
    {
        return $this->hasMany(fc_comment::class, 'blog_id');
    }
}
