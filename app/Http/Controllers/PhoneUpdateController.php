<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PhoneUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $count = 20;//访问一次，更新20条记录
        $res = Record::select('id','phone')->whereNull('phone_province')->whereNotNull('phone')->limit($count)->get();
        $res = $res->toArray();
        $ko = 2;
        foreach ($res as $v) {
            $mobile = $v['phone'];
            if ($mobile) {
                if ($ko == 1) {
                    $data = $this->taobao($mobile);
                } else {
                    $data = $this->tenpay($mobile);
                }

                if ($data) {
                    Record::where('id', $v['id'])
                        ->update(
                            [
                                'phone_province' => $data['province'],
                                'phone_city' => $data['city'],
                                'phone_supplier' => $data['supplier']
                            ]
                        );
                }
            }
        }
        exit;

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


    private function taobao($mobile = 0)
    {//淘宝接口
        $url = "http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=" . $mobile . "&t=" . time();  //根据淘宝的数据库调用返回值
        $content = file_get_contents($url);
        $data['province'] = substr($content, "56", "4");  //截取字符串
        $data['supplier'] = substr($content, "81", "4");
        return '{"province":"' . $data['province'] . '","supplier":"' . $data['supplier'] . '"}';
    }

    private function tenpay($mobile = 0)
    {//财付通接口
        $doc = new \DOMDocument();
        $xmlurl = 'http://life.tenpay.com/cgi-bin/mobile/MobileQueryAttribution.cgi?chgmobile=' . $mobile . '&f.xml';
        $doc->load($xmlurl); //读取xml文件
        $xmls = $doc->getElementsByTagName("root"); //取得root标签的对象数组
        foreach ($xmls as $xml) {
            $province = $xml->getElementsByTagName("province"); //省份
            $data['province'] = $this->delspace($province->item(0)->nodeValue); //省份
            $city = $xml->getElementsByTagName("city");
            $data['city'] = $this->delspace($city->item(0)->nodeValue); //城市
            $supplier = $xml->getElementsByTagName("supplier");
            $data['supplier'] = $this->delspace($supplier->item(0)->nodeValue); //联通 移动 电信
        }
        return $data;
        return json_encode($data);
    }

//过滤空格回车
    private function delspace($pcon)
    {
        $pcon = preg_replace("/ /", "", $pcon);
        $pcon = preg_replace("/ /", "", $pcon);
        $pcon = preg_replace("/　/", "", $pcon);
        $pcon = preg_replace("/rn/", "", $pcon);
        $pcon = str_replace(chr(13), "", $pcon);
        $pcon = str_replace(chr(10), "", $pcon);
        $pcon = str_replace(chr(9), "", $pcon);
        return $pcon;
    }
}
