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

    # model events / observer
    // creating: Call Before Create Record.
    // created: Call After Created Record.
    // updating: Call Before Update Record.
    // updated: Class After Updated Record.
    // deleting: Call Before Delete Record.
    // deleted: Call After Deleted Record.
    // retrieved: Call Retrieve Data from Database.
    // saving: Call Before Creating or Updating Record.
    // saved: Call After Created or Updated Record.
    // restoring: Call Before Restore Record.
    // restored: Call After Restore Record.
    // replicating: Call on replicate Record.
    
}
