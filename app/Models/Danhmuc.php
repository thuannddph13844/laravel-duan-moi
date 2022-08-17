<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Danhmuc extends Model
{
    use HasFactory;
    protected $table = "danh_mucs";
    protected $fillable = ['cate_id','name_cate'];
    public function LoadDanhmuc($params = []){
        $query = DB::table($this->table)->select($this->fillable);
        // dd($query);
        $lists = $query->paginate(10);
        return $lists;
    }
    public function saveNew($param = []){
        $data = $param['cols'];
        $respon= DB::table($this->table) -> insertGetId($data);

        return $respon;
    }
    public function loadOne($id, $param = null){
        $query = DB::table($this->table)
            ->where('cate_id','=',$id);
        $one =$query->first();
        return $one;
    }
    public function saveUpdate($param){
        if (empty($param['cols']['id'])){
            Session::flash('error', 'Không xác định bản ghi cần cập nhật');
            return null;
        }
        $dataupdate=[];
        foreach ($param['cols'] as $col => $val){
            if($col == 'id') continue;
            if (in_array($col,$this->fillable)){
                $dataupdate[$col] = (strlen($val)==0)?  null:$val;
            }
        }
        $res = DB::table($this->table)
            ->where('cate_id', $param['cols']['id'])
            ->update($dataupdate);
        return $res;
    }
}
