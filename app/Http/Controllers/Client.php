<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $newcart = Session('cart');
        $this->v['newcart'] = $newcart;
//        dd($newcart);
        return view('client.cart',$this->v);
    }
    public function addtocart(Request $request ,$id){
        $router = "index";
        $itemCart = new Sanpham();
        $item = $itemCart->loadOne($id);
        if ($item != null){
            $oldcart = Session('cart') ? Session('cart'):null;
            $newcart = new Cart($oldcart);
            $newcart ->addCart($item,$id);
            $request ->session()->put('cart', $newcart);
            $this->v['newcart'] = $newcart;

        }

        return redirect()->route($router)->with(['success' => 'Them vao gio hang thanh cong']);

    }
}
