<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'configuration';
    protected $fillable = ['name','value'];

    public static function store($name,$value){
        $result=self::getValue($name);
        if(is_null($result)){
            DB::table('configuration')->insert([
                'name' => $name,
                'value' => $value
            ]);
        }else{
            self::updateValue($name,$value);
        }
    }

    public static function updateValue($name,$value){
        DB::table('configuration')
            ->where('name',$name)
            ->update(['value'=>$value]);
    }

    public static function getValue($name){
        $row=DB::table('configuration')->where('name',$name)->first();
        if($row)
            return $row->value;
        else
            return '';
    }

}
