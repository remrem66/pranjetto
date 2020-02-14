<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room_Tbl;
use App\Tbl_Users;
use App\Online_Reservation_Tbl;
use DB;
use Auth;
use Redirect;
date_default_timezone_set("Asia/Manila");
use \App\Mail\SendMail;

class HomeController extends Controller
{
    
    public function __construct()
    {
        
    }

   
    public function Topaz()
    {
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Topaz')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Topaz')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        
        $name = "Topaz Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Emerald()
    {
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Emerald')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Emerald')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }

        $name = "Emerald Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Turquoise()
    {
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Turquoise')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Turquoise')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }

        $name = "Turquoise Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Garnet()
    {   
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Garnet')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Garnet')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }

        $name = "Garnet Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Jade()
    {

        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Jade')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Jade')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        
        $name = "Jade Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Pearl()
    {
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Pearl')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Pearl')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        

        $name = "Pearl Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function Sapphire()
    {
        if(!empty(session('check_in')) || !empty('check_out')){
            $end_date = date("Y-m-d",strtotime(session('check_in')));
            $start_date = date("Y-m-d",strtotime(session('check_out')));

            $arrayDates = [];

            $diff = abs(strtotime($end_date) - strtotime($start_date));
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                if($days > 1){

                    $date = $start_date;
                    array_push($arrayDates,$date);
                    while(0 == 0)
                        if($date == $end_date){
                            array_pop($arrayDates);
                            break;
                        }
                        else{
                            $date = date("Y-m-d",strtotime($date . "+1 days"));
                            array_push($arrayDates,$date);
                        }
                    }
                
                else{
                    array_push($arrayDates,$start_date);
                }

                $getid = DB::table('online_reservation_tbl')
                    ->whereIn('check_in',$arrayDates)
                    ->where('reservation_status','!=',2)
                    ->select('room_id')
                    ->get();

                $ids = [];
            
                foreach($getid as $id){
                    array_push($ids,$id->room_id);
                }
            
            
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->whereNotIn('room_id',$ids)
                    ->where('category','Sapphire')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        else{
            $data = DB::table('room_tbl')
                    ->select('*')
                    ->where('category','Sapphire')
                    ->where('slot','>',0)
                    ->where('status',1)
                    ->get();
        }
        

        $name = "Sapphire Room";

        return view('mainpage.rooms',compact('data','name'));
    }

    public function RoomPreview($room_id){

        $data = DB::table('room_tbl')
                ->select('*')
                ->where('room_id',$room_id)
                ->first();
        
        $pictures = explode(",",$data->pictures);

        

        return view('mainpage.roompreview',compact('data','pictures'));

    }

    public function Index(){

        return view('mainpage.index');
    }

    public function About(){

        return view('mainpage.about');
    }

    public function login(){

        return view('mainpage.login');

    }

    public function register(){

        return view('mainpage.register');

    }

    public function UserAuthentication (Request $request){

        $request->validate([
            'password' => 'required|min:8',
            
        ]);

        if($request['password'] != $request['confirm_pass']){
            $data['message'] = "Password and Confirm Password did not match!";
            return view('mainpage.register', ['message'=> $data['message']]);
        }
        else{
            $data = DB::table('tbl_users')
                    ->select('username')
                    ->get();
            
            $flag = 0;

            foreach($data as $result){
                if($result->username == $request['username']){
                    $flag = $flag + 1;
                }
            }

            if($flag != 0){
                $data['message'] = "Username already exist.";
                return view('mainpage.register', ['message'=> $data['message']]);
            }
            else{
                $name = $request['fname']." ".$request['lname'];
                $user = [
                    'name' => $name,
                    'contact_num' => $request['contact_num'],
                    'email' => $request['email'],
                    'username' => $request['username'],
                    'password' => $request['password']
                ];

                Tbl_Users::AddUser($user);

                $data['message'] = "User successfully created.";
                return view('mainpage.login', ['message'=> $data['message']]);
            }
        }

    }

    public function AuthenticateUser(Request $request){

        $username = $request['username'];
        $password = $request['password'];

        $tbl_users = Tbl_Users::select('*')
                        ->where('username',$username)
                        ->where('password',$password)
                        ->first();

        if($tbl_users == false || $tbl_users->username != $username || $tbl_users->password != $password ){
            $data['message'] = "Invalid username or password";
            return view('mainpage.login',  ['message'=> $data['message']]);
        }
        else{
            if($tbl_users->user_status == 0){
                $data['message'] = "User disabled. Please contact administrator";
                return view('mainpage.login',  ['message'=> $data['message']]);
            }
            else{
                $request->session()->put('user_id', $tbl_users->user_id); 
                $request->session()->put('name', $tbl_users->name);
                $request->session()->put('email', $tbl_users->email);
                $request->session()->put('contact_num', $tbl_users->contact_num);    
                $request->session()->put('user_type', $tbl_users->user_type);
                $request->session()->put('logged', true);

                return redirect()->intended('index');
            }
        }

    }

    public function logout(){

        session()->flush();
        Auth::logout();
        
        return redirect()->intended('home');
    }

    public function EditProfileView(){

        $data = DB::table('tbl_users')
                ->select('*')
                ->where('user_id',session('user_id'))
                ->first();

        return view('mainpage.editprofile',compact('data'));
    }

    public function ProfileEdit(Request $request){

       $data = [
           'name' => $request['name'],
           'username' => $request['username'],
           'contact_num' => $request['contact_num'],
           'email' => $request['email'],
           'user_id' => $request['user_id']
       ];

       Tbl_Users::EditProfile($data);

    
       return redirect()->intended('editprofile');
    }

    public function ChangePassword(){

        return view('mainpage/changepassword');
    }

    public function ChangePass(Request $request){

        $data = DB::table('tbl_users')
                ->select('*')
                ->where('user_id',session('user_id'))
                ->get();

        foreach($data as $result){
            $old_pass = $result->password;
        }

        if($request['old_pass'] != $old_pass){
            $data['message'] = "Incorrect Old Password";
            return view('mainpage.changepassword',  ['message'=> $data['message']]);
        }
        else{
            if($request['new_pass'] != $request['confirm_pass']){
                $data['message'] = "Password and Confirm Password did not match";
                return view('mainpage.changepassword',  ['message'=> $data['message']]);
            }
            else{
                Tbl_Users::ChangePassword($request['new_pass'],session('user_id'));

                $data['message'] = "Password successfully changed";
                return view('mainpage.changepassword',  ['message'=> $data['message']]);
            }
        }
    }

    public function disablecheckin(Request $request){

        $data = DB::table('online_reservation_tbl')
                ->where('room_id',$request->room_id)
                ->select('check_in','check_out')
                ->get();
        
        $arrayDates = array();

        foreach ($data as $result){
            
            $diff = abs(strtotime($result->check_out) - strtotime($result->check_in));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days > 1){
                
                $date = $result->check_in;
                array_push($arrayDates,$date);
                while(0 == 0){

                    if($date == $result->check_out){
                        array_pop($arrayDates);
                        break;
                    }
                    else{
                        $date = date("Y-m-d",strtotime($date . "+1 days"));
                        array_push($arrayDates,$date);
                    }
                }
            }
            else{
                array_push($arrayDates,$result->check_in);
            }
        }

        if(empty($arrayDates)){

            return 0;
        }
        else{
            return $arrayDates;
        }
        
    }

    public function disableforcheckout(Request $request){

        $room_id = $request->room_id;
        $checkin = $request->check_in;

        $data = DB::table('online_reservation_tbl')
                ->where('room_id',$room_id)
                ->select('check_in','check_out')
                ->get();
        
        $arrayDates = array();

        foreach ($data as $result){
            
            $diff = abs(strtotime($result->check_out) - strtotime($result->check_in));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days > 1){
                
                $date = $result->check_in;
                array_push($arrayDates,$date);
                while(0 == 0){

                    if($date == $result->check_out){
                        array_pop($arrayDates);
                        break;
                    }
                    else{
                        $date = date("Y-m-d",strtotime($date . "+1 days"));
                        array_push($arrayDates,$date);
                    }
                }
            }
            else{
                array_push($arrayDates,$result->check_in);
            }
        }
        
        array_push($arrayDates,$checkin);
        return $arrayDates;
    }

    public function GetRoomTotalPrice(Request $request){

        if(empty($request->start_date)){

            $price = $request->fix_price;
            
        }
        else{

            if(empty($request->extra_mattress) || $request->extra_mattress == 0){
    
                
                $diff = abs(strtotime($request->end_date) - strtotime($request->start_date));
    
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    
                $prc = $request->fix_price;
    
                $price = $prc * $days;

                $price = $price * $request->quantity;
    
            }
            else{
                $diff = abs(strtotime($request->end_date) - strtotime($request->start_date));
    
                $years = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                
                $prc = $request->fix_price;
                
                $price = $prc * $days;
    
                $category = $request->category;
                $extra_mattress = $request->extra_mattress;

                $price_setting = DB::table('settings_tbl')
                        ->where('setting_id',1)
                        ->select('price')
                        ->get();
                
            
                foreach($price_setting as $setprice){
                
                    $dta = $setprice->price;
                }

                $price = $price * $request->quantity;

                $extra = $extra_mattress * $dta;
                
                
                $price = $price + $extra;

                
            }
        }

        
        return $price;

    }

    public function NewOnlineRoomReservation(Request $request){

        $accnt = DB::table('bank_accounts_tbl')
                    ->select('*')
                    ->get();
        
        $details =[[]];
        $x = 0;

        foreach($accnt as $account){

            $details[$x]['bank_name'] = $account->bank_name;
            $details[$x]['account_num'] = $account->account_num;
        }

        $details[0]['total_price'] = $request->total_price;

        if(empty($request->extra_mattress)){
            $mattress = 0;
        }
        else{
            $mattress = $request->extra_mattress;
        }

        $email = $request->email;

        $reservation_code = $this->IDGenerator();

        $data = [
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'no_of_persons' => $request->persons,
            'quantity' => $request->quantity,
            'extra_mattress' => $mattress,
            'reservation_code' => $reservation_code,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $request->total_price
        ];

        $check = DB::table('online_reservation_tbl')
                    ->where('room_id',$request->room_id)
                    ->where('check_in',$request->check_in)
                    ->where('reservation_status',0)
                    ->select('room_id','check_in')
                    ->get();

        if(count($check) > 0){
            return 1;
        }
        else{
            $request->session()->put('more', true);

            Room_Tbl::DeductSlot($request->room_id,$request->quantity);
            Online_Reservation_Tbl::NewOnlineRoomReservation($data);
            \Mail::to($email)->send(new SendMail($details));
        }
        
    }

    public function AllRooms(Request $request){

        $end_date = date("Y-m-d",strtotime($request['end']));
        $start_date = date("Y-m-d",strtotime($request['start']));

        $arrayDates = [];

        $diff = abs(strtotime($end_date) - strtotime($start_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            if($days > 1){

                $date = $start_date;
                array_push($arrayDates,$date);
                while(0 == 0)
                    if($date == $end_date){
                        array_pop($arrayDates);
                        break;
                    }
                    else{
                        $date = date("Y-m-d",strtotime($date . "+1 days"));
                        array_push($arrayDates,$date);
                    }
                }
            
            else{
                array_push($arrayDates,$start_date);
            }
            
            $getid = DB::table('online_reservation_tbl')
                ->whereIn('check_in',$arrayDates)
                ->where('reservation_status','!=',2)
                ->select('room_id')
                ->get();

            $ids = [];
    
            foreach($getid as $id){
                array_push($ids,$id->room_id);
            }

        $data = DB::table('room_tbl')
                ->whereNotIn('room_id',$ids)
                ->where('status',1)
                ->where('slot','>',0)
                ->select('*')
                ->get();

        
        $available = [
            'Topaz' => 0,
            'Emerald' => 0,
            'Turquoise' => 0,
            'Garnet' => 0,
            'Jade' => 0,
            'Pearl' => 0,
            'Sapphire' => 0
        ];

        $categories = DB::table('room_mainpage_tbl')
                    ->select('*')
                    ->get();

        foreach($data as $result){
            if($result->category == "Topaz"){
                $available['Topaz'] = $available['Topaz'] + 1;
            }
            if($result->category == "Emerald"){
                $available['Emerald'] = $available['Emerald'] + 1;
            }
            if($result->category == "Turquoise"){
                $available['Turquoise'] = $available['Turquoise'] + 1;
            }
            if($result->category == "Garnet"){
                $available['Garnet'] = $available['Garnet'] + 1;
            }
            if($result->category == "Jade"){
                $available['Jade'] = $available['Jade'] + 1;
            }
            if($result->category == "Pearl"){
                $available['Pearl'] = $available['Pearl'] + 1;
            }
            if($result->category == "Sapphire"){
                $available['Sapphire'] = $available['Sapphire'] + 1;
            }
        }

        $request->session()->put('check_in', $request['start']); 
        $request->session()->put('check_out', $request['end']);

        
        
       return view('mainpage.AllRooms',compact('available','categories'));
    }

    public function MoreRooms(Request $request){

        $end_date = date("Y-m-d",strtotime(session('check_out')));
        $start_date = date("Y-m-d",strtotime(session('check_in')));

        $arrayDates = [];

        $diff = abs(strtotime($end_date) - strtotime($start_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            if($days > 1){

                $date = $start_date;
                array_push($arrayDates,$date);
                while(0 == 0)
                    if($date == $end_date){
                        array_pop($arrayDates);
                        break;
                    }
                    else{
                        $date = date("Y-m-d",strtotime($date . "+1 days"));
                        array_push($arrayDates,$date);
                    }
                }
            
            else{
                array_push($arrayDates,$start_date);
            }
            
            $getid = DB::table('online_reservation_tbl')
                ->whereIn('check_in',$arrayDates)
                ->where('reservation_status','!=',2)
                ->select('room_id')
                ->get();

            $ids = [];
    
            foreach($getid as $id){
                array_push($ids,$id->room_id);
            }

        $data = DB::table('room_tbl')
                ->whereNotIn('room_id',$ids)
                ->where('status',1)
                ->where('slot','>',0)
                ->select('*')
                ->get();

        
        $available = [
            'Topaz' => 0,
            'Emerald' => 0,
            'Turquoise' => 0,
            'Garnet' => 0,
            'Jade' => 0,
            'Pearl' => 0,
            'Sapphire' => 0
        ];

        $categories = DB::table('room_mainpage_tbl')
                    ->select('*')
                    ->get();

        foreach($data as $result){
            if($result->category == "Topaz"){
                $available['Topaz'] = $available['Topaz'] + 1;
            }
            if($result->category == "Emerald"){
                $available['Emerald'] = $available['Emerald'] + 1;
            }
            if($result->category == "Turquoise"){
                $available['Turquoise'] = $available['Turquoise'] + 1;
            }
            if($result->category == "Garnet"){
                $available['Garnet'] = $available['Garnet'] + 1;
            }
            if($result->category == "Jade"){
                $available['Jade'] = $available['Jade'] + 1;
            }
            if($result->category == "Pearl"){
                $available['Pearl'] = $available['Pearl'] + 1;
            }
            if($result->category == "Sapphire"){
                $available['Sapphire'] = $available['Sapphire'] + 1;
            }
        }

    
        
       return view('mainpage.AllRooms',compact('available','categories'));
    }

    public function viewReservations()
    {
        $userId = session('user_id');
        $userReservations = Online_Reservation_Tbl::where('user_id', $userId)->where('reservation_status',0)->get();
        foreach ($userReservations as $key => $value) {
            $value->room_details = Room_Tbl::where('room_id', $value->room_id)->first();
            $value->user_details = Tbl_Users::where('user_id', $value->user_id)->first();
        }

        return view('mainpage.reservationpreview', compact('userReservations'));
    }

    public function viewReservationDetails($id)
    {
        $userId = session('user_id');
        $data = Online_Reservation_Tbl::where('reservation_id', $id)->first();
        $data->room_details = Room_Tbl::where('room_id', $data->room_id)->first();
        $data->user_details = Tbl_Users::where('user_id', $data->user_id)->first();
        
        return view('mainpage.reservationdetailsview', compact('data'));
    }

    public function reservationUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            

            $data = Online_Reservation_Tbl::where('reservation_id', $request->reservation_id)->first();

            DB::table('online_reservation_tbl')
            ->where('reservation_id',$request->reservation_id)
            ->update([
                'receipt_image' => $name
            ]);
            $data->room_details = Room_Tbl::where('room_id', $data->room_id)->first();
            $data->user_details = Tbl_Users::where('user_id', $data->user_id)->first();
        
            return back()->with('success','Image Upload successfully');
        }
    }

    public function Addoneday(Request $request){

        $arrayDates = [];

        $now = date("Y-m-d");
        

        $diff = abs(strtotime($request->start) - strtotime($now));
    
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        
        if($days >= 1){
            $date = $now;
            array_push($arrayDates,$date);
            while(0 == 0){

                if($date == $request->start){
                    array_pop($arrayDates);
                    break;
                }
                else{
                    $date = date("Y-m-d",strtotime($date . "+1 days"));
                    array_push($arrayDates,$date);
                }
            }
        }
        
        array_push($arrayDates,$request->start);
        
        return $arrayDates;
    }

    public function CheckAvailability(Request $request){

        $end_date = date("Y-m-d",strtotime($request['end']));
        $start_date = date("Y-m-d",strtotime($request['start']));

        $arrayDates = [];

        $diff = abs(strtotime($end_date) - strtotime($start_date));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            if($days > 1){

                $date = $start_date;
                array_push($arrayDates,$date);
                while(0 == 0)
                    if($date == $end_date){
                        array_pop($arrayDates);
                        break;
                    }
                    else{
                        $date = date("Y-m-d",strtotime($date . "+1 days"));
                        array_push($arrayDates,$date);
                    }
                }
            
            else{
                array_push($arrayDates,$start_date);
            }
            
            $getid = DB::table('online_reservation_tbl')
                ->whereIn('check_in',$arrayDates)
                ->where('reservation_status','!=',2)
                ->select('room_id')
                ->get();

            $ids = [];
    
            foreach($getid as $id){
                array_push($ids,$id->room_id);
            }

            $data = DB::table('room_tbl')
                    ->whereNotIn('room_id',$ids)
                    ->select('*')
                    ->get();
            

            return view('mainpage.AllRooms',compact('data'));
        }

        public function NewOnlineRoomReservationPaypal(Request $request){

            $accnt = DB::table('bank_accounts_tbl')
                    ->select('*')
                    ->get();
        
        $details =[[]];
        $x = 0;

        foreach($accnt as $account){

            $details[$x]['bank_name'] = $account->bank_name;
            $details[$x]['account_num'] = $account->account_num;
        }

        $details[0]['total_price'] = $request->total_price;

        if(empty($request->extra_mattress)){
            $mattress = 0;
        }
        else{
            $mattress = $request->extra_mattress;
        }
        
        $email = $request->email;

        $reservation_code = $this->IDGenerator();

        $data = [
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'no_of_persons' => $request->persons,
            'quantity' => $request->quantity,
            'extra_mattress' => $mattress,
            'reservation_code' => $reservation_code,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $request->total_price
        ];
        $check = DB::table('online_reservation_tbl')
                    ->where('room_id',$request->room_id)
                    ->where('check_in',$request->check_in)
                    ->where('reservation_status',0)
                    ->select('room_id','check_in')
                    ->get();

        if(count($check) > 0){
            return 1;
        }
        else{
            Room_Tbl::DeductSlot($request->room_id,$request->quantity);
            Online_Reservation_Tbl::NewOnlineRoomReservation($data);
        }
                    
    
    }

    public function Amenities(){

        $data = DB::table('amenity_tbl')
                ->where('status',1)
                ->select('*')
                ->get();
        
        return view('mainpage.amenities',compact('data'));
    }

    public function GenerateBloodBagID(){

        $bloodbag_id = $this->IDGenerator();

        
    }

    public function IDGenerator(){

        $numbers = '0123456789';
        $letters = 'abcdefghijklmnopqrstuvwxyz';

        $id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 3);

        return $id;
    }

    public function galleryview(){

        $data = DB::table('gallery_tbl')
                ->select('*')
                ->get();

        return view('mainpage.gallery',compact('data'));
    }
    
}
