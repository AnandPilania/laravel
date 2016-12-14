<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ExchangeStudent extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "exchangestudents";
    protected $primaryKey = 'id';
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'user_id',
        'homeUniversityID',
        'program',
        'term_from',
        'term_to',
        'buddy',
        'matriculationYear',
        'hostUniversityID',
        'exchangeTerm',
		'type',

    ];

    protected $dates = [
        'term_from',
        'term_to',
    ];

    public function homeUniversity()
    {
        return $this->belongsTo('App\University','homeUniversityID');

    }

    public function hostUniversity()
    {
        return $this->belongsTo('App\University','hostUniversityID');
    }

	 public function userData()
    {
        return $this->belongsTo('App\User','user_id');
    }

	public function userType()
    {
        return $this->belongsTo('App\UserType','type');

    }
}
