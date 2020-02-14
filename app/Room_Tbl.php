<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;


class Room_Tbl extends Model
{
    protected $table = 'room_tbl';

    protected $fillable = [
        'room_num',
        'floor',
        'room_name',
        'category',
        'capacity', 
        '12hr_price',
        '24hr_price',
        'description',
        'main_pic',
        'pictures',
        'status'
        
    ];

    public static function AddRoom($data){

        DB::table('room_tbl')
            ->insert([
                'floor' => $data['floor'],
                'room_name' => $data['room_name'],
                'category' =>$data['category'],
                'capacity' => $data['capacity'],
                'twentyfourhr_price' => $data['24hr_price'],
                'description' => $data['description'],
                'slot' => $data['slot'],
                'main_pic' => $data['main_pic']
            ]);
    }

    public static function ChangeRoomStatus($status,$room_id){
        DB::table('room_tbl')
            ->where('room_id',$room_id)
            ->update([
                'status' => $status
            ]);
    }

    public static function EditRoom($data){
        DB::table('room_tbl')
            ->where('room_id',$data['room_id'])
            ->update([
                
                'floor' => $data['floor'],
                'room_name' => $data['room_name'],
                'category' => $data['category'],
                'capacity' => $data['capacity'],
                'slot' => $data['slot'],
                'twentyfourhr_price' => $data['24hr_price'],
                'description' => $data['description'],
                'main_pic' => $data['main_pic']
            ]);
    }

    public static function UploadPictures($pictures,$room_id){

        DB::table('room_tbl')
            ->where('room_id',$room_id)
            ->update([
                'pictures' => $pictures,
            ]);
    }

    public static function DeleteRoom($room_id){

        DB::table('room_tbl')
            ->where('room_id',$room_id)
            ->delete();
    }

    public static function DeductSlot($id,$quantity){

        DB::table('room_tbl')
            ->where('room_id',$id)
            ->decrement('slot',$quantity);
    }

    public static function IncreaseSlot($id,$quantity){

        DB::table('room_tbl')
            ->where('room_id',$id)
            ->increment('slot',$quantity);
    }
}
