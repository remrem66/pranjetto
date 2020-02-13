<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Gallery_Tbl extends Model
{
    protected $table = 'gallery_tbl';

    protected $fillable = [
        'gallery_id',
        'image',
        'date' 
    ];

    public static function AddImage($image){

        DB::table('gallery_tbl')
            ->insert([
                'image' => $image
            ]);
    }

    public static function DeleteImage($id){

        DB::table('gallery_tbl')
            ->where('gallery_id',$id)
            ->delete();
    }
}
