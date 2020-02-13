<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Walkin_Reservation_Tbl extends Model
{
    protected $table = 'walkin_reservation_tbl';

    protected $fillable = [
        'walkin_id',
        'customer_name',
        'email',
        'contact_num',
        'room_id',
        'check_in',
        'check_out',
        'reservation_status',
        'date'
    ];

    public static function AddRoomWalkin($data){

        DB::table('walkin_reservation_tbl')
            ->insert([
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'contact_num' => $data['contact_num'],
                'room_id' => $data['room_id'],
                'no_of_persons' => $data['no_of_persons'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'total_price' => $data['total_price'],
                'reservation_status' => 0
            ]);
    }

    public static function ConfirmInitial($id,$price){

        DB::table('walkin_reservation_tbl')
            ->where('walkin_id',$id)
            ->update([
                'reservation_status' => 1,
                'amount_paid' => $price
            ]);
    }

    public static function AdditionalAmenity($id,$total){

        DB::table('walkin_reservation_tbl')
            ->where('walkin_id',$id)
            ->update([
                'total_price' => $total
            ]);

        }

     public static function CompletePayment($id,$price){

        DB::table('walkin_reservation_tbl')
            ->where('walkin_id',$id)
            ->update([
                'reservation_status' => 2,
                'amount_paid' => $price
            ]);
        }
}
