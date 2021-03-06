<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $params = $request['params'];
        $params = json_decode($params, 1);
        $grade = $params['inputGrade'];
        return DB::table('records')
            ->where('grade', 'like', "%$grade%")
            ->paginate($limit=10);

//        return Record::paginate($limit = 10);

    }

    public function majors() {
        $res = Record::select('major')->distinct()->get()->toArray();
        $majors = array();
        foreach ($res as $v) {
            $majors[] = $v['major'];
        }
        return response()->json($majors);
    }
    public function degrees() {
        $res = Record::select('degree')->distinct()->get()->toArray();
        $degree = array();
        foreach ($res as $v) {
            $degree[] = $v['degree'];
        }
        return response()->json($degree);
    }
    public function grades() {
        $res = Record::select('grade')->distinct()->get()->toArray();
        $grades = array();
        foreach ($res as $v) {
            $grades[] = $v['grade'];
        }
        return response()->json($grades);
    }

    public function byInput(Request $request)
    {

        $params = $request['params'];
        $params = json_decode($params, 1);

        $major = array_key_exists('inputMajor', $params) ? $params['inputMajor'] : null;
        $degree = array_key_exists('inputDegree', $params) ? $params['inputDegree'] : null;
        $grade = array_key_exists('inputGrade', $params) ? $params['inputGrade'] : null;
        $gender = array_key_exists('inputGender', $params) ? $params['inputGender'] : null;

        $ageFrom = array_key_exists('inputAgeFrom', $params) ? $params['inputAgeFrom'] : null;
        $ageTo = array_key_exists('inputAgeTo', $params) ? $params['inputAgeTo'] : null;



//        DB::enableQueryLog();

        $res = Record::where('id','>',0);
        if ($major) $res = $res->where('major', 'like', "%$major%");
        if ($degree) $res = $res->where('degree', 'like', "%$degree%");
        if ($grade) $res = $res->where('grade', 'like', "%$grade%");
        if ($gender) $res = $res->where('gender', '=', "$gender");
        if ($ageFrom or $ageTo) $res = $res->ageBetween($ageFrom, $ageTo);

        return $res->paginate($limit=10);

//        $res = DB::table('records');
//        if ($major) $res = $res->where('major', 'like', "%$major%");
//        if ($degree) $res = $res->where('degree', 'like', "%$degree%");
//        if ($grade) $res = $res->where('grade', 'like', "%$grade%");
//        if ($gender) $res = $res->where('gender', '=', "$gender");
//        return $res->paginate($limit=10);



//        var_dump(DB::getQueryLog());exit;

    }

    public function chartGender(Request $request) {
        $res = Record::selectRaw('count(*) as y, gender as name');
        $res = $res->groupBy('gender');
        return $res->get()->toJson();
    }
    public function chartMajor(Request $request) {
        $res = Record::selectRaw('count(*) as y, major as name');
        $res = $res->groupBy('major');
        return $res->get()->toJson();
    }
    public function chartAge(Request $request) {
        $res = DB::select('select count(*) as y, year(NOW()) - substr(id_card,7,4) as name from records group by (year(NOW()) - substr(id_card,7,4)) ');

        return response()->json($res);
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
