<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = ['id','size'];
    public function loadListSize(){
        $query = DB::table($this->table)->select($this->fillable);
        $lists = $query->paginate(100);
        return $lists;
    }
    public function saveNewSize($param){
        $data = array_merge($param['cols']);
        $res=DB::table($this->table)->insertGetId($data);
        return $res;
    }
}
