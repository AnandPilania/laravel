<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "univeristy_content";
    protected $primaryKey = 'id';
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'universityId',
        'Transportation',
       
        'postoffice',
        'medicalservices',
        'Telecommunications',
        'SurvivalGuide',
    ];

    
}
