<?php

namespace App\Http\Controllers;

use App\Models\Ct_size;
use App\Models\Sanpham as ModelsSanpham;
use Illuminate\Http\Request;
use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Models\Size;
use App\Models\color;

use Illuminate\Support\Facades\DB;

class Client extends Controller
{
    //
    private $v;
    public function __construct(){
        $this->v =[];       
    }
    public function viewCL(){
        $sanpham = new Sanpham();
        $listdm = new Danhmuc();
        $this->v['listsp'] = $sanpham->loadListSanpham();
        $this->v['listdm'] = $listdm->LoadDanhmuc();
        return view('client.index',$this->v);
    }
    public function detailsp($id){
        $this->v['item'] = Sanpham::find($id);
        $listdm = new Size();
        $this->v['listsize'] = $listdm->loadListSize();
        $listSz = new Sanpham();
        $this->v['listSz'] = $listSz->loadSize($id);
        // $listcl = new Color();
        // $this->v['listcl'] = $listcl->loadColor($id);
        return view('client.product-details',$this->v);
    }
    public function viewCart(){
        return view('client.cart',$this->v);
    }
}
