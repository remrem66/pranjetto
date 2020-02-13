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
                'quantity' => $data['quantity'],
                'extra_mattress' => $data['extra_mattress'],
                'reservation_code' => $data['reservation_code'],
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
                'amount_paid' => $price,
                'total_price' => $price
            ]);
    }

    public static function CancelReservation($reservation_id){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$reservation_id)
            ->delete();
    }

    public static function AdditionalAmenity($id,$total){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$id)
            ->update([
                'total_price' => $total
            ]);

    }

    public static function ChangeSched($data){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$data['reservation_id'])
            ->update([
                'total_price' => $data['total_price'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out']
            ]);
    }

    public static function StatusChange($id,$status){

        DB::table('online_reservation_tbl')
            ->where('reservation_id',$id)
            ->update([
                'reservation_status' => $status
            ]);
    }
}
