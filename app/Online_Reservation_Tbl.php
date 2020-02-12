<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Online_Reservation_Tbl extends Model
{
    protected $table = 'online_reservation_tbl';

    protected $fillable = [
        'reservation_id',
        'user_id',
        'room_id',
        'no_of_persons',
        'check_in', 
        'check_out',
        'total_price',
        'amount_paid',
        'status',
        'date'
        
    ];

    public static function NewOnlineRoomReservation($data){

        DB::table('online_reservation_tbl')
            ->insert([
                'user_id' => $data['user_id'],
                'room_id' => $data['room_id'],
                'no_of_persons' => $data['no_of_persons'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'total_price' => $data['total_price']
            ]);
    }

    public static function ConfirmInitial($id,$price){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$id)
            ->update([
                'reservation_status' => 1,
                'amount_paid' => $price
            ]);
    }

    public static function CompletePayment($id,$price){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$id)
            ->update([
                'reservation_status' => 2,
                'amount_paid' => $price
            ]);
    }

    public static function CancelReservation($reservation_id){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$reservation_id)
            ->delete();
    }
}
