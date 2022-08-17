<?php

namespace App\Http\Controllers;

use App\Http\Requests\danh_mucRequest;
use App\Models\Danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class DanhmucController extends Controller
{
    //
    private $v;
    public function __construct(){
        $this->v =[];
    }
    public function listDanhmuc(){
        $danhhmuc = new Danhmuc();
        $this->v['listdm'] = $danhhmuc->LoadDanhmuc();
        return view('danhmuc.danhmuc',$this->v);
    }
    public function add(danh_mucRequest $request)
    {

        $this->v['_title'] = "Thêm danh mục";
        $method_route = 'route_BackEnd_danh_mucs_Add';
        if ($request->isMethod('POST')) {
            $param = [];
            $param['cols'] = $request->post();
            unset($param['cols']['_token']);

            $modelAdd = new Danhmuc();
            $res = $modelAdd->saveNew($param);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới Danh mục thành công');
                return redirect()->route($method_route);
            } else {
                Session::flash('error', 'Thêm mới danh mục thất bại');
                return redirect()->route($method_route);
            }
        }
        return view("danhmuc.add", $this->v);
    }


    public function detail($id)
    {
        $this->v['_title'] = "Cập nhật danh mục";
        $item = new Danhmuc();
        $objItem = $item->loadOne($id);
        // dd($objItem);
        $this->v['objItem'] = $objItem;
        return view("danhmuc.update", $this->v);
    }
    public function update($id, Request $request)
    {
        $method_route = "route_BackEnd_danh_mucs_Detail";
        $route_danhmuc = 'route_BackEnd_danh_mucs';
        $params = [];
        $params['cols'] = $request->post();
        unset($params['cols']['_token']);
        $detail = new Danhmuc();

        $objDetail = $detail->loadOne($id);

        $params['cols']['cate_id'] = $id;

        $res = $detail->saveUpdate($params);
        dd($res);

        if ($res == null) {
            return redirect()->route($method_route, ['cate_id' => $id]);

        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật bản ghi ' . $objDetail->cate_id . ' thành công');
            return redirect()->route($route_danhmuc);
        } else {
            Session::flash('error', 'Cập nhật bản ghi ' . $objDetail->cate_id . ' thất bại');
            return redirect()->route($method_route, ['cate_id' => $id]);
        }
    }
    public function delete($id)
    {
        $data = Danhmuc::find($id);
        $data->delete();
        //        dd($data);
        return redirect()->route('route_BackEnd_danh_mucs');
    }
}
