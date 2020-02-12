<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Room_Mainpage_Tbl extends Model
{
    protected $table = 'room_mainpage_tbl';

    protected $fillable = [
        'id',
        'category',
        'picture'
        
    ];

    public static function AddPictures($data){

        DB::table('room_mainpage_tbl')
            ->where('id',$data['id'])
            ->update([
                'picture' => $data['picture']
            ]);
    }


}
