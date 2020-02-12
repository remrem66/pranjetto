<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;

class Sales_Tbl extends Model
{
    protected $table = 'sales_tbl';

    protected $fillable = [
        'sales_id',
        'sales_amount',
        'description'
    ];

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime:M-d-Y'
    ];
    
    public static function AddSales($data){

        DB::table('sales_tbl')
            ->insert([
                'sales_amount' => $data['sales_amount'],
                'description' => $data['description']
            ]);
    }
}
