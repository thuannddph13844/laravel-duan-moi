<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ct_size extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_size';
    protected $fillable = ['id_sanpham','id_size'];
    public function loadListCtSize(){
        $query = DB::table($this->table)->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }
    public function saveNewCt_Size($param){
        $data = array_merge($param['cols']);
        $res=DB::table($this->table)->insertGetId($data);
        return $res;
    }
}
