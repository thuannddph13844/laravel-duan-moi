<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Sanpham;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;

class SizeController extends Controller
{
    //
    private $v;
    public function __construct(){
        $this->v =[];
    }
    public function listSize(){
        $size = new Size();
        $this->v['listsize']= $size->loadListSize();
        $sanpham = new Sanpham();
        $this->v['listsp']= $sanpham->loadListSanpham();
        return view('size.size',$this->v);
    }
    public function addSize(UserRequest $request){  
        // $method_route = 'route_BackEnd_User_Add';
        if ($request->isMethod('post')){;
            $params = [];
            $params['cols'] = $request->post();
            //dd ($request->post());
            unset($params['cols']['_token']);
            // dd ( $params['cols']);
            $modelTest = new Size();
            $res = $modelTest->saveNewSize($params);
            if($res == null){
                return redirect()->route('$method_router');
            } elseif($res > 0){
                Session::flash('success','them moi thanh cong');
                return redirect('/size');
            } else{
                Session::flash('error','loi!');
                return redirect()->route('$method_route');
            }
        }
        return view('size.add',$this->v);
    }
}
