<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function show(){
      
       $Students = [];

    //    $Students = Student::all();

    //    $Students = Student::where('city','kotkapura')->orderBy('email')->get();
    
        // Student::chunk(2, function($Students){
        //     echo  'chunk of data <br>';
        //     foreach($Students as $stu){
        //         echo $stu->name;
        //         echo '<br>';
        //     }
        // });
        
        
       $Students[] = Student::find(3);

    //    $Students = Student::where('city','mwx')->first();

    //    $Students = Student::firstwhere('city','mwx');

    //    $Students = Student::where('city','=','mwx')->firstOr(function(){
    //        echo "Note exist";
    //    });

    //    $Students = Student::firstOrCreate(
    //        ['name'=>'demo'],
    //        ['email'=>'demo@gmail.com','city'=>'demcity','marks'=>35]
    //    );

    //    $Students = Student::firstOrNew(
    //        ['name'=>'acer'],
    //        ['email'=>'acer@gmail.com','city'=>'demcity','marks'=>35]
    //    );
    //    $Students->save();

        // $Students = Student::where('city','mwx')->count();
        // $Students = Student::where('city','demcity')->min('marks');
        // $Students = Student::where('city','demcity')->max('marks');
        // $Students = Student::where('city','demcity')->sum('marks');

    # insert query
    // $Students = new Student;
    // $Students->name = 'jack';
    // $Students->email = 'jack@gmail.com';
    // $Students->marks = 37;
    // $Students->city = 'kkp';
    // $Students->save();

    // $Students = Student::create([
    //     'name'=> 'richar',
    //     'email' => 'richar@gmail.com',
    //     'marks' => 30,
    //     'city'=> 'mwx'
    // ]);

    # update query
    // $Students = Student::find(9);
    // $Students->name = 'back';
    // $Students->email = 'back@gmail.com';
    // $Students->marks = 37;
    // $Students->city = 'kkp';
    // $Students->save();

    // $Students = Student::where('name','richar')->update([
    //     'name'=> 'richar',
    //     'email' => 'richar@gmail.com',
    //     'marks' => 40,
    //     'city'=> 'mwx'
    // ]);

    //    $Students = Student::updateOrCreate(
    //        ['name'=>'jassi'],
    //        ['email'=>'jassi@gmail.com','city'=>'patiala','marks'=>46]
    //    );

    # delete query
    // $Students = Student::find(9);
    // $Students->delete();
    // $Students = Student::destroy(9);
    // $Students = Student::where('name','richar')->detele();

    # drops all rows from the table 
    // Student::truncate();

        // dd($Students);
        // var_dump($Students);
        return view("modelData.show", ['students'=>$Students]);


    

   }
}
