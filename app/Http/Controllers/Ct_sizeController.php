<?php

namespace App\Http\Controllers;

use App\Models\Ct_size;
use App\Models\Sanpham;
use App\Models\Size;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Ct_sizeController extends Controller
{
    //
    private $v;
    public function __construct(){
        $this->v =[];
    }
    public function listCtSize(){
        $size = new Ct_size();
        $this->v['listsize']= $size->loadListCtSize();
       
        return view('ct_size.index',$this->v);
    }
    public function addCtSize(UserRequest $request){  
        // $method_route = 'route_BackEnd_User_Add';
        if ($request->isMethod('post')){;
            $params = [];
            $params['cols'] = $request->post();
            //dd ($request->post());
            unset($params['cols']['_token']);
            // dd ( $params['cols']);
            $modelTest = new Ct_size(); 
            $res = $modelTest->saveNewCt_Size($params);
            if($res == null){
                return redirect()->route('$method_router');
            } elseif($res > 0){
                Session::flash('success','them moi thanh cong');
                return redirect('/Chi_tiet_size');
            } else{
                Session::flash('error','loi!');
                return redirect()->route('$method_route');
            }
        }
        return view('ct_size.add',$this->v);
    }

}
