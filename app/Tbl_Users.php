<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionInterface;
use DB;


class Tbl_Users extends Model
{
    protected $table = 'tbl_users';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'contact_num',
        'username',
        'password', 
        'user_type'
        
    ];

    public static function AddUser($data){

        DB::table('tbl_users')
            ->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'contact_num' => $data['contact_num'],
                'username' => $data['username'],
                'password' => $data['password']
            ]);
    }

    public static function EditProfile($data){

        DB::table('tbl_users')
            ->where('user_id',$data['user_id'])
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'contact_num' => $data['contact_num'],
                'username' => $data['username']
            ]);
    }

    public static function ChangePassword($password,$user_id){

        DB::table('tbl_users')
            ->where('user_id',$user_id)
            ->update([
                'password' => $password
            ]);
    }

    public static function ChangeUserStatus($user_id,$status){
        DB::table('tbl_users')
            ->where('user_id',$user_id)
            ->update([
                'user_status' => $status
            ]);
    }
}
