<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Color extends Model
{
    use HasFactory;
    protected $table = 'mau_sacs';
    protected $fillable = ['id','mau_sac','id_sanpham'];
    public function loadListSize(){
        $query = DB::table($this->table)->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }
    // public function loadColor($id){
    //     $color = DB::table('san_phams')
    //     ->join('chi_tiet_color',  'chi_tiet_color.id_sanpham', '=', 'san_phams.id')
    //     ->join('mau_sacs', 'mau_sacs.id', '=', 'chi_tiet_color.id_color')->select()
    //     ->where('san_phams.id', '=', $id)
    //     ->get();
    //     return $color;
    // }
}
