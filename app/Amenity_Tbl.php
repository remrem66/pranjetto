<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Amenity_Tbl extends Model
{
    protected $table = 'amenity_tbl';

    protected $fillable = [
        'amenity_name',
        'description',
        'image',
        'pictures',
        'status'
        
    ];

    public static function AddAmenity($data){
        DB::table('amenity_tbl')
            ->insert([
                'amenity_name' => $data['amenity_name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'image' => $data['image']
            ]);
    }

    public static function EditAmenity($data){
        DB::table('amenity_tbl')
            ->where('amenity_id',$data['amenity_id'])
            ->update([
                'amenity_name' => $data['amenity_name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'image' => $data['image']
            ]);
    }

    public static function DeleteAmenity($amenity_id){
        DB::table('amenity_tbl')
            ->where('amenity_id',$amenity_id)
            ->delete();
    }

    public static function ChangeAmenityStatus($amenity_id,$status){

        DB::table('amenity_tbl')
            ->where('amenity_id',$amenity_id)
            ->update([
                'status' => $status
            ]);
    }
}
