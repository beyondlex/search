<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
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

    public function upload() {
        $fileName = Input::file('file')->getClientOriginalName();
        $fileName = md5($fileName).'.'.Input::file('file')->getClientOriginalExtension();
        $path = Input::file('file')->move(public_path().'/uploads/', $fileName );


        return response()->json(['res'=>$path->getPathname()]);
    }

    public function import(Request $request) {
        exit;
        $path = $request->input('path');
        set_time_limit(600);

//        Excel::filter('chunk')->selectSheetsByIndex(0)->load($path)->noHeading()->chunk(1000, function($result){
//            $data = $result->toArray();
//            unset($data[0]);
//            if ($data) {
//                foreach ($data as $k=>$v) {
//                    $in[] = array(
//                        'user_name'=>$v[0],
//                        'sno'=>$v[1],
//                        'gender'=>$v[2],
//                        'id_card'=>$v[3],
//                        'birthday'=>$v[4],
//                        'nation'=>$v[5],
//                        'grade'=>$v[6],
//                        'degree'=>$v[7],
//                        'major'=>$v[8],
//                        'phone'=>$v[9],
//                        'learn_center'=>$v[10],
//                        'roll_status'=>$v[11],
//                        'account_status'=>$v[12],
//                        'roll_filled'=>$v[13],
//                        'graduation_filled'=>$v[14],
//                        'degree_filled'=>$v[15],
//                        'fee'=>$v[16],
//                        'fee_ed'=>$v[17],
//                        'fee_status'=>$v[18],
//                        'teaching_way'=>$v[19],
//                        'ordered'=>$v[20],
//                    );
////                    $in[] = array(
////                        'user_name'=>$v[0],
////                        'sno'=>$v[1],
////                        'gender'=>$v[2],
////                        'id_card'=>$v[3],
////                        'class_name'=>$v[4],
////                        'grade'=>$v[5],
////                        'major'=>$v[6],
////                        'school'=>$v[7],
////                        'site'=>$v[8],
////                        'degree'=>$v[9],
////                        'course_name'=>$v[10],
////                        'note'=>$v[11],
////                        'ordered'=>$v[12],
////                    );
//                }
//                DB::table('t1')->insert($in);
//            }
//        });
//        exit;

        Excel::selectSheetsByIndex(0)->load($path, function($reader){
            $data = $reader->noHeading()->toArray();
            unset($data[0]);
            if ($data) {
                foreach ($data as $k=>$v) {
                    $in[] = array(
                        'user_name'=>$v[0],
                        'sno'=>$v[1],
                        'gender'=>$v[2],
                        'id_card'=>$v[3],
                        'birthday'=>$v[4],
                        'nation'=>$v[5],
                        'grade'=>$v[6],
                        'degree'=>$v[7],
                        'major'=>$v[8],
                        'phone'=>$v[9],
                        'learn_center'=>$v[10],
                        'roll_status'=>$v[11],
                        'account_status'=>$v[12],
                        'roll_filled'=>$v[13],
                        'graduation_filled'=>$v[14],
                        'degree_filled'=>$v[15],
                        'fee'=>$v[16],
                        'fee_ed'=>$v[17],
                        'fee_status'=>$v[18],
                        'teaching_way'=>$v[19],
                        'ordered'=>$v[20],
                    );
//                    $in[] = array(
//                        'user_name'=>$v[0],
//                        'sno'=>$v[1],
//                        'gender'=>$v[2],
//                        'id_card'=>$v[3],
//                        'class_name'=>$v[4],
//                        'grade'=>$v[5],
//                        'major'=>$v[6],
//                        'school'=>$v[7],
//                        'site'=>$v[8],
//                        'degree'=>$v[9],
//                        'course_name'=>$v[10],
//                        'note'=>$v[11],
//                        'ordered'=>$v[12],
//                    );
                }
                DB::table('t1')->insert($in);
            }
//            DB::table('t2')->insert($reader->toArray());
        });
        exit;
        Excel::filter('chunk')->selectSheetsByIndex(0)->load($path)->chunk(500, function($results){

//            DB::enableQueryLog();
//            $results = $results->slice(1);

            foreach ($results->toArray() as $v){
                print_r($v);
            };

//            DB::table('t2')->insert($results->toArray());
//            exit;
//            foreach ($results as $k=>$v) {
////                $data = $v->toArray();//->values()
//
//                $in[] = array(
//                    'user_name'=>$v[0],
//                    'sno'=>$v[1],
//                    'gender'=>$v[2],
//                    'id_card'=>$v[3],
//                    'class_name'=>$v[4],
//                    'grade'=>$v[5],
//                    'major'=>$v[6],
//                    'school'=>$v[7],
//                    'site'=>$v[8],
//                    'degree'=>$v[9],
//                    'course_name'=>$v[10],
//                    'note'=>$v[11],
//                    'ordered'=>$v[12],
//                );
//
////                //t3
////                $in[] = array(
////                    'degree'=>$v[1],
////                    'major'=>$v[2],
////                    'admit'=>$v[3],
////                    'user_name'=>$v[4],
////                    'sno'=>$v[5],
////                    'phone'=>$v[6],
////                    'id_card'=>$v[8],
////                    'gender'=>$v[9],
////                    'grade'=>$v[10],
////                    'ordered'=>$v[11],
////                );
//
//
//
//            }
//            var_dump($in);

//            DB::table('t2')->insert($in);


        });

//        var_dump(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
