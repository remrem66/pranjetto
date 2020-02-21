<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class addons_tbl extends Model
{
    protected $table = 'addons_tbl';

    protected $fillable = [
        'addon_id',
        'amenity_id',
        'quantity',
        'reservation_id'
        
    ];

    public static function AddOns($reservation_id,$amenity_id,$quantity){

        DB::table('addons_tbl')
        ->insert([
            'amenity_id' => $amenity_id,
            'reservation_id' => $reservation_id,
            'quantity' => $quantity
        ]);
    }
}
