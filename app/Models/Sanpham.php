<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = "san_phams";
    protected $fillable = ['id','name','price','mo_ta','so_luong','id_danhmuc','hinh'];
    public function loadListSanpham(){
        $query = DB::table($this->table)->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }
    public function saveNewSp($param){
        $data = array_merge($param['cols']);

        $res=DB::table($this->table)->insertGetId($data);
        return $res;
    }
    public function loadOne($id, $param = null){
        $query = DB::table($this->table)->where('id','=',$id);
        $obj = $query->first();
        return $obj;
    }
    public function saveUpdate($params){
        if(empty($params['cols']['id'])){
            Session::flash('error'.'khong xac dinh ban ghi cap nhat');
            return null;
        }
        $dataUpdate = [];
        foreach($params['cols'] as $colName => $val){
            if($colName == 'id') continue;
            if(in_array($colName,$this->fillable)){
                $dataUpdate[$colName] = (strlen($val) == 0) ? null:$val;
            }
        }
        $res = DB::table($this->table)->where('id',$params['cols']['id'])->update($dataUpdate);
        return $res;
    }
    public function loadSize($id){
        $users = DB::table('san_phams')
        ->join('chi_tiet_size',  'chi_tiet_size.id_sanpham', '=', 'san_phams.id')
        ->join('sizes', 'sizes.id', '=', 'chi_tiet_size.id_size')->select()
        ->where('san_phams.id', '=', $id)
        ->get();
        return $users;
    }
}
