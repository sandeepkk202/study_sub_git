<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    # For another DB Conection
    // protected $connection = 'sql';

    # For specific table 
    // protected $table = 'users';

    # For specific id 
    // protected $primaryKey = 'stu_id';

    # For specific primaryKey type (non integer) 
    // protected $keyType = 'string';

    # if Don't want autoincrement primaryKey  
    // public $incrementing  = false;

    # another propertis
    // public $timestamps = false;
    // const CREATED_AT = 'creation_date'
    // const UPDATED_AT = 'updation_date'


    // protected $fillable = ['name', 'email', 'city', 'marks'];

    #  Query Scopes:
    // public function scopeActive($query)
    // {
    //     return $query->where('active', 1);
    // }
    // $activeStudent = Student::active()->get();

    # Accessors and Mutators
}
