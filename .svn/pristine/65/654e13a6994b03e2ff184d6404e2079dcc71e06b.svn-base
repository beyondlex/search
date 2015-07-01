<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($n=1)
    {
        //

        require_once '/vendor/fzaninotto/faker/src/autoload.php';
        $faker = \Faker\Factory::create();

        $data = array();
        for($i=0;$i<$n;$i++) {
            $arr['name'] = $faker->firstName.$faker->lastName;
            $arr['gender'] = $faker->randomElement(array('F', 'M'));
            $arr['age'] = $faker->numberBetween(3, 90);
            $arr['address'] = $faker->address;
            $arr['email'] = $faker->email;
            $data[] = $arr;
        }

        DB::table('members')->insert($data);



    }

    public function createRel() {

    }

    public function import() {
        $path = 'C:/Filename.xls';
        Excel::selectSheetsByIndex(0)->load($path, function($reader){
            DB::table('members')->insert($reader->toArray());
        });
    }

    public function export() {
        $data = Member::all();

        Excel::create('Filename', function($excel) use($data) {

            $excel->sheet('Sheetname', function($sheet) use($data) {

                $sheet->fromArray($data);

            });

        })->download('xls');
    }

    public function mergeStudents() {
        $sql1 = "
            insert into students
            (user_name, gender, id_card, birthday, phone)
            select user_name, gender, id_card, birthday, phone from t1
        ";
        $sql2 = "
            insert into students
            (user_name, gender, id_card)
            select user_name, gender, id_card from t2
        ";
        $sql3 = "
            insert into students
            (user_name, gender, id_card, phone)
            select user_name, gender, id_card, phone from t3
        ";

        $major = "
            insert into majors
            (name, type)
            select major, 'B' from t2
            UNION
            select major, 'C' from t3
            UNION
            select major, 'A' from t1
        ";

        $learncenter = "
            insert into learncenters (name)
            select distinct(learn_center) from t1
        ";

        $records1 = "
            insert into records
            (user_name, sno, gender, phone, id_card, grade, degree, major,  record_type
             )
            select user_name, sno, gender, phone, id_card, grade, degree, major, 'A' from t1
        ";
        $records2 = "
            insert into records
            (user_name, sno, gender, id_card, grade, degree, major, course_name, class_name, record_type
             )
            select user_name, sno, gender, id_card, grade, degree, major, course_name, class_name, 'B' from t2
        ";
        $records3 = "
            insert into records
            (user_name, sno, gender, id_card, grade, degree, major, record_type
             )
            select user_name, sno, gender, id_card, grade, degree, major, 'C' from t3
        ";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
