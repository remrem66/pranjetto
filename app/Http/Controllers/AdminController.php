<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room_Tbl;
use App\Amenity_Tbl;
use App\Sales_Tbl;
use App\Online_Reservation_Tbl;
use App\Walkin_Reservation_Tbl;
use App\Room_Mainpage_Tbl;
use App\Gallery_Tbl;
use App\Tbl_Users;
use \App\Mail\CancelMail;
use DB;
use Auth;
use Redirect;
date_default_timezone_set("Asia/Manila");

class AdminController extends Controller
{
    public function login(){

        return view('admin.login');
    }

    public function AdminLogout(){

        session()->flush();
        Auth::logout();

        return redirect()->intended('administrator');
    }

    public function AdminVerification(Request $request){

        $username = $request['username'];
        $password = $request['password'];

        $tbl_users = DB::table('tbl_users')
                        ->select('*')
                        ->where('username',$username)
                        ->where('password',$password)
                        ->where('user_type',0)
                        ->first();

        if($tbl_users == false || $tbl_users->username != $username || $tbl_users->password != $password){
            $data['message'] = "Invalid username or password";
            return view('admin.login',  ['message'=> $data['message']]);
        }
        else{

            $request->session()->put('user_id', $tbl_users->user_id); 
            $request->session()->put('name', $tbl_users->name);
            $request->session()->put('username', $tbl_users->username);    
            $request->session()->put('logged', true);
            return redirect()->route('AdminDashboard');
        }
    }

    public function AdminDashboard(){
        $noPayment = Online_Reservation_Tbl::where('reservation_status', 0)->get()->count();
        $initialPayment = Online_Reservation_Tbl::where('reservation_status', 1)->get()->count();
        $completeBalance = Online_Reservation_Tbl::where('reservation_status', 2)->get()->count();
        $checkedIn = Online_Reservation_Tbl::where('reservation_status', 3)->get()->count();
        $checkedOut = Online_Reservation_Tbl::where('reservation_status', 4)->get()->count();
        $cancelled = Online_Reservation_Tbl::where('reservation_status', 5)->get()->count();
        $expired = Online_Reservation_Tbl::where('reservation_status', 6)->get()->count();

        return view('admin.dashboard', compact('noPayment', 'initialPayment', 'completeBalance', 'checkedIn', 'checkedOut', 'cancelled', 'expired'));
    }

    public function AddRoomView(){

        return view('admin.AddRoom');
    }

    public function AddRoom(Request $request){

        $request->validate([
            'category' => 'required|unique:room_tbl,category',
            'capacity' => 'required',
            '24hr_price' => 'required',
            'description' => 'required',
            'slot' => 'required',
            'main_pic' => 'required'
        ]);

        $image = $request->file('main_pic');
        $image_name = $image->getClientOriginalName();
        $image->move('images', $image_name);

        $data = [
            
            'category' =>$request['category'],
            'capacity' => $request['capacity'],
            '24hr_price' => $request['24hr_price'],
            'description' => $request['description'],
            'slot' => $request['slot'],
            'main_pic' => $image_name
        ];

        Room_Tbl::AddRoom($data);

        $notification = array(
            'message' => 'Room added successfully', 
            'alert-type' => 'success'
        );

        return redirect()->intended('AddRoom')->with($notification);
    }

    public function EditRoomView(){

        $data = DB::table('room_tbl')
                ->select('*')
                ->get();

        return view('admin.EditRooms',compact('data'));
    }

    public function ViewRooms(){

        $data = DB::table('room_tbl')
                ->select('*')
                ->get();

        return view('admin.ViewRooms',compact('data'));
    }

    public function RoomStatusView(){

        $data = DB::table('room_tbl')
                ->select('*')
                ->get();

        return view('admin.RoomStatus',compact('data'));
    }

    public function RoomSlotView(){

        $data = DB::table('room_tbl')
                ->select('*')
                ->get();

        return view('admin.RoomSlot',compact('data'));
    }

    public function ChangeRoomStatus(Request $request){

        Room_Tbl::ChangeRoomStatus($request->status,$request->room_id);

    }

    public function GetRoomInfo(Request $request){

        $data = DB::table('room_tbl')
                ->select('*')
                ->where('room_id',$request->room_id)
                ->first();
        
        return response()->json($data);
    }

    public function EditRoom(Request $request){

        if(empty($request['main_pic'])){

            $pic = DB::table('room_tbl')
                    ->select('main_pic')
                    ->where('room_id',$request['room_id'])
                    ->get();

            foreach($pic as $pics){
                $image = $pics->main_pic;
            }

            $data = [
                'room_id' => $request['room_id'],
                'floor' => $request['floor'],
                'category' => $request['category'],
                'capacity' => $request['capacity'],
                '24hr_price' => $request['24hr_price'],
                'description' => $request['description'],
                'main_pic' => $image
            ];
    
            Room_Tbl::EditRoom($data);

        }
        else{

            $image = $request->file('main_pic');
            $image_name = $image->getClientOriginalName();
            $image->move('images', $image_name);

            $data = [
                'room_id' => $request['room_id'],
                'floor' => $request['floor'],
                'category' => $request['category'],
                'capacity' => $request['capacity'],
                '24hr_price' => $request['24hr_price'],
                'description' => $request['description'],
                'main_pic' => $image_name
            ];

            Room_Tbl::EditRoom($data);

        }
        
    }

    public function UploadPictures(Request $request){

        $pictures = array();

        for($x = 1; $x < 5; $x++){
            $image = "pic".$x;
            $picture = $request->file($image);
            $image_name = $picture->getClientOriginalName();
            $picture->move('images', $image_name);
            array_push($pictures,$image_name);
        }
        
        $pictures = implode(",",$pictures);

        Room_Tbl::UploadPictures($pictures,$request['picroom_id']);

    }

    public function OnlineReservations($id){

        if ($id == 'all' ) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 0) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 0)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 1) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 1)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 2) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 2)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 3) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 3)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 4) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 4)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } elseif ($id == 5) {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 5)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        } else {
            $data = DB::table('online_reservation_tbl')
                ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                ->where('online_reservation_tbl.reservation_status', 6)
                ->select('room_tbl.category','online_reservation_tbl.*','tbl_users.name')
                ->get();
        }
       
        
        return view('admin.OnlineReservations',compact('data'));
    }

    public function ConfirmInitial(Request $request){

        $reservation_id = $request->reservation_id;
        $price = $request->price * 0.5;

        Online_Reservation_Tbl::ConfirmInitial($reservation_id,$price);

        $description = "Initial payment of customer ".$request->name;

        $sales = [
            'sales_amount' => $price,
            'description' => $description
        ];

        Sales_Tbl::AddSales($sales);
    }

    public function CompletePayment(Request $request){
        
        
        $reservation_id = $request->reservation_id;
        $price = $request->price;

        $data = DB::table('online_reservation_tbl')
                    ->where('reservation_id',$reservation_id)
                    ->select('total_price','amount_paid','quantity','room_id')
                    ->first();
       
        if($request->discount == 1){

            $price = ($data->total_price * 0.9) - $data->amount_paid;
        }

        
        Room_Tbl::IncreaseSlot($data->room_id,$data->quantity);
        Online_Reservation_Tbl::CompletePayment($reservation_id,$data->total_price);

        $description = "Payment of balance of customer ".$request->name;

        $sales = [
            'sales_amount' => $price,
            'description' => $description
        ];

        Sales_Tbl::AddSales($sales);
    }

    public function CompletePaymentWalkin(Request $request){
        
        
        $walkin_id = $request->walkin_id;
        $price = $request->price;

        $data = DB::table('walkin_reservation_tbl')
                    ->where('walkin_id',$walkin_id)
                    ->select('total_price','amount_paid','quantity','room_id')
                    ->first();
                    
        if($request->discount == 1){

            
            
            $price = ($data->total_price * 0.9) - $data->amount_paid;
        }

        Room_Tbl::IncreaseSlot($data->room_id,$data->quantity);
        Walkin_Reservation_Tbl::CompletePayment($walkin_id,$price);

        $description = "Payment of balance of customer ".$request->name;

        $sales = [
            'sales_amount' => $price,
            'description' => $description
        ];

        Sales_Tbl::AddSales($sales);
    }

    public function SalesReports(){

        $data = DB::table('sales_tbl')
                ->select('*')
                ->get();

        return view('admin.SalesReport',compact('data'));
    }

    public function MainpageSetting(){

        $data = DB::table('room_mainpage_tbl')
                ->select('*')
                ->get();

        return view('admin.RoomMainpageSetting',compact('data'));
    }

    public function UploadPicturesForMainpage(Request $request){

        $image = $request->file('picture');
        $image_name = $image->getClientOriginalName();
        $image->move('images', $image_name);

        $data = [
            'picture' => $image_name,
            'id' => $request->id
        ];

        Room_Mainpage_Tbl::AddPictures($data);
    }

    public function UserEdit(){

        $data = DB::table('tbl_users')
                ->where('user_type',1)
                ->select('*')
                ->get();
        
        return view('admin.EditUser',compact('data'));
    }

    public function ChangeUserStatus(Request $request){


        Tbl_Users::ChangeUserStatus($request->user_id,$request->status);
    }

    public function ViewUsers(){

        $data = DB::table('tbl_users')
                ->where('user_type',1)
                ->select('*')
                ->get();

        return view('admin.ViewUsers',compact('data'));
    }

    public function CancelReservation(Request $request){

    

        $data = DB::table('online_reservation_tbl')
                    ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                    ->select('online_reservation_tbl.*','tbl_users.name','tbl_users.email')
                    ->where('online_reservation_tbl.reservation_id',$request->reservation_id)
                    ->first();

        $details = [
            'date' => date("F d, Y",strtotime($data->check_in)),
            'total_bill' => $data->total_price,
            'amount_paid' => $data->amount_paid,
            'customer' => $data->name,
            'reference_number' => $data->reservation_code
        ];

        $reservation_id = $request->reservation_id;

        
        \Mail::to($data->email)->send(new CancelMail($details));
        Online_Reservation_Tbl::CancelReservation($reservation_id);
    }

    public function CancelReservationWalkin(Request $request){


        $data = DB::table('walkin_reservation_tbl')
                    ->select('*')
                    ->where('walkin_id',$request->walkin_id)
                    ->first();

        $details = [
            'date' => date("F d, Y",strtotime($data->check_in)),
            'total_bill' => $data->total_price,
            'amount_paid' => $data->amount_paid,
            'customer' => $data->customer_name,
            'reference_number' => $data->reservation_code
        ];

        $walkin_id = $request->walkin_id;

        
        \Mail::to($data->email)->send(new CancelMail($details));
        Walkin_Reservation_Tbl::CancelReservation($walkin_id);
    }

    public function AddAmenitiesView(){

        return view('admin.AddAmenities');
    }

    public function AddAmenity(Request $request){

        $image = $request->file('pic');
        $image_name = $image->getClientOriginalName();
        $image->move('images', $image_name);

        $data = [
            'amenity_name' => $request['amenity_name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'image' => $image_name
        ];

        Amenity_Tbl::AddAmenity($data);

        $notification = array(
            'message' => 'Amenity added successfully', 
            'alert-type' => 'success'
        );

        return redirect()->intended('AddAmenities')->with($notification);
    }

    public function DeleteRoom(Request $request){

        Room_Tbl::DeleteRoom($request->room_id);
    }

    public function GetAmenityInfo(Request $request){

        $data = DB::table('amenity_tbl')
                ->select('*')
                ->where('amenity_id',$request->amenity_id)
                ->first();
        
        return response()->json($data);
    }

    public function EditAmenity(Request $request){

        if(empty($request['picture'])){

            $pic = DB::table('amenity_tbl')
                    ->select('image')
                    ->where('amenity_id',$request['amenity_id'])
                    ->get();

            foreach($pic as $pics){
                $image = $pics->image;
            }

            $data = [
                'amenity_id' => $request['amenity_id'],
                'amenity_name' => $request['amenity_name'],
                'price' => $request['price'],
                'description' => $request['description'],
                'image' => $image
            ];
    
            Amenity_Tbl::EditAmenity($data);

        }
        else{

            $image = $request->file('picture');
            $image_name = $image->getClientOriginalName();
            $image->move('images', $image_name);

            $data = [
                'amenity_id' => $request['amenity_id'],
                'amenity_name' => $request['amenity_name'],
                'price' => $request['price'],
                'description' => $request['description'],
                'image' => $image_name
            ];
    
            Amenity_Tbl::EditAmenity($data);

        }
        
    }

    public function EditAmenityView(){

        $data = DB::table('amenity_tbl')
                ->select('*')
                ->get();

        return view('admin.EditAmenity',compact('data'));
    }

    public function DeleteAmenity(Request $request){

        Amenity_Tbl::DeleteAmenity($request->amenity_id);
    }

    public function AmenityStatusView(){
        $data = DB::table('amenity_tbl')
                ->select('*')
                ->get();

        return view('admin.AmenityStatus',compact('data'));
    }

    public function ChangeAmenityStatus(Request $request){

        Amenity_Tbl::ChangeAmenityStatus($request->amenity_id,$request->status);
    }

    public function ViewAmenities(){
        $data = DB::table('amenity_tbl')
                ->select('*')
                ->get();

        return view('admin.ViewAmenities',compact('data'));
    }

    public function getSales($trigger = 0)
    {
        $data = [];
        // DB::table('sales_tbl')
        //         ->select('*')
        //         ->get();

        $getStartAndEndDate = function ($week, $year) {
            $dto = new \DateTime();
            $dto->setISODate($year, $week);
            $s = $dto->format('Y-m-d');
            $dto->modify('+6 days');
            $e = $dto->format('Y-m-d');
            return $s . ' - ' . $e;
        };

        //$week_array = $getStartAndEndDate(4,2020);

        $generate_sort = function ($isWeek = true) use ($getStartAndEndDate){
            $m = Sales_Tbl::all();
            $cursor = -1;
            $total_ = 0;
            $new_m = [];
            $iteration = 0;
            foreach ($m as $d) {
                $week_number = \Carbon\Carbon::parse($d['date'])->isoFormat($isWeek ? 'W' : 'M');

                if (count($m) === 1) {

                    $cursor = $week_number;
                    $total_ = $d['sales_amount'];
                    $new_m[] = [
                        'date' => ($isWeek ? 'Week ' : 'Month ') . $cursor,
                        'sales_amount' => number_format($total_, 2, '.', ','),
                        'description' => $getStartAndEndDate($cursor, \Carbon\Carbon::now()->year),
                    ];
                    break;
                }

                if ($cursor < 0) {
                    $cursor = $week_number;
                    $total_ = $d['sales_amount'];
                } else if ($cursor === $week_number) {
                    $total_ += $d['sales_amount'];
                } else if ($cursor !== $week_number) {

                    $new_m[] = [
                        'date' => ($isWeek ? 'Week ' : 'Month ') . $cursor,
                        'sales_amount' => number_format($total_, 2, '.', ','),
                        'description' => $getStartAndEndDate($cursor, \Carbon\Carbon::now()->year),
                    ];

                    $cursor = $week_number;
                    $total_ = $d['sales_amount'];
                }

                if ($iteration === (count($m) - 1)) {
                    $new_m[] = [
                        'date' => ($isWeek ? 'Week ' : 'Month ') . $cursor,
                        'sales_amount' => number_format($total_, 2, '.', ','),
                        'description' => $getStartAndEndDate($cursor, \Carbon\Carbon::now()->year),
                    ];
                }

                $iteration++;
            }
            return $new_m;
        };

        switch ($trigger) {
            case 0:
                $data = Sales_Tbl::all()->toJSON();
                break;
            case 1:
                $data = $generate_sort();
            break;
            case 2:
                $data = $generate_sort(false);
            break;
            default:
                break;
        }

        return $data;
    }

    public function WalkInView(){

        $data = DB::table('room_tbl')
                ->where('status',1)
                ->where('slot','>',0)
                ->select('*')
                ->get();

        return view('admin.AddWalkIn',compact('data'));
    }

    public function disableddates(Request $request){

        $room_id = $request->room_id;

        $data = DB::table('online_reservation_tbl')
                ->where('room_id',$room_id)
                ->where('reservation_status','!=',2)
                ->select('check_in','check_out')
                ->get();
        
        $data1 = DB::table('walkin_reservation_tbl')
                ->where('room_id',$room_id)
                ->where('reservation_status','!=',2)
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
        foreach ($data1 as $result1){
            
            $diff = abs(strtotime($result1->check_out) - strtotime($result1->check_in));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days > 1){
                
                $date = $result1->check_in;
                array_push($arrayDates,$date);
                while(0 == 0){

                    if($date == $result1->check_out){
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
                array_push($arrayDates,$result1->check_in);
            }
        }
        
        
        return $arrayDates;
    }

    public function disabledcheckoutdates(Request $request){

        $room_id = $request->room_id;
        $checkin = date("Y-m-d",strtotime($request->check_in));

        $data = DB::table('online_reservation_tbl')
                ->where('room_id',$room_id)
                ->where('reservation_status','!=',2)
                ->select('check_in','check_out')
                ->get();
        
        $data1 = DB::table('walkin_reservation_tbl')
                ->where('room_id',$room_id)
                ->where('reservation_status','!=',2)
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

        foreach ($data1 as $result1){
            
            $diff = abs(strtotime($result1->check_out) - strtotime($result1->check_in));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days > 1){
                
                $date = $result1->check_in;
                array_push($arrayDates,$date);
                while(0 == 0){

                    if($date == $result1->check_out){
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
                array_push($arrayDates,$result1->check_in);
            }
        }

        array_push($arrayDates,$checkin);
        
        return $arrayDates;
    }


    public function changeenddate(Request $request){

        if(empty($request->extra_person) || $request->extra_person == 0){

            $end_date = date("Y-m-d",strtotime($request->end_date));
            $start_date = date("Y-m-d",strtotime($request->start_date));

            $diff = abs(strtotime($end_date) - strtotime($start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $prc = $request->fix_price;

            $price = $prc * $days;

        }
        else{

            $end_date = date("Y-m-d",strtotime($request->end_date));
            $start_date = date("Y-m-d",strtotime($request->start_date));

            $diff = abs(strtotime($end_date) - strtotime($start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            
            $prc = $request->fix_price;
            
            $price = $prc * $days;

        
            $extra_person = $request->extra_person;

            

            $price_setting = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->get();
        
        
            foreach($price_setting as $setprice){
            
                $dta = $setprice->price;
            }

            $extra = $extra_person * $dta;

            $price = $price + $extra;

        }
        
        return $price;

        
    }

    public function getextrapersonprice(Request $request){

        if(empty($request->end_date)){

            $extra_person = $request->extra_person;
            $price = $request->fix_price;

            $data = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->get();
        
        
            foreach($data as $result){
            
                $dta = $result->price;
            }

            $extra = $extra_person * $dta;

            $price = $price + $extra;

            
        }
        else{

            $end_date = date("Y-m-d",strtotime($request->end_date));
            $start_date = date("Y-m-d",strtotime($request->start_date));

            $diff = abs(strtotime($end_date) - strtotime($start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            
            $prc = $request->fix_price;
            
            $price = $prc * $days;

            $price = $price * $request->quantity;

            

            $extra_person = $request->extra_person;


            $price_setting = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->get();
        
        
            foreach($price_setting as $setprice){
            
                $dta = $setprice->price;
            }

            $extra = $extra_person * $dta;
            

            $price = $price + $extra;

        }
        
        return $price;
        
    }

    public function AddRoomWalkIn(Request $request){

        $reservation_code = $this->IDGenerator();

        if(empty($request['extra_mattress'])){
            $mattress = 0;
        }
        else{
            $mattress = $request['extra_mattress']; 
        }
        $data = [
            'customer_name' => $request['customer_name'],
            'email' => $request['email_address'],
            'contact_num' => $request['contact_num'],
            'room_id' => $request['room_id'],
            'reservation_code' => $reservation_code,
            'quantity' => $request['quantity'],
            'extra_mattress' => $mattress,
            'no_of_persons' => $request['number_of_persons'],
            'check_in' => date("Y-m-d",strtotime($request['check_in'])),
            'check_out' => date("Y-m-d",strtotime($request['check_out'])),
            'total_price' => $request['tot_price'],
            'reservation_status' => 0
        ];

        Room_Tbl::DeductSlot($request['room_id'],$request['quantity']);
        Walkin_Reservation_Tbl::AddRoomWalkIn($data);
    }

    public function IDGenerator(){

        $numbers = '0123456789';
        $letters = 'abcdefghijklmnopqrstuvwxyz';

        $id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 3);

        return $id;
    }

    public function AddAdditional(Request $request){

        $total = $request->total_price + $request->amenity;

        Online_Reservation_Tbl::AdditionalAmenity($request->reservation_id,$total);
    }

    public function AddAdditionalwalkin(Request $request){

        $total = $request->total_price + $request->amenity;

        Walkin_Reservation_Tbl::AdditionalAmenity($request->walkin_id,$total);
    }

    public function CheckTotalBalance(Request $request){

        $data = DB::table('online_reservation_tbl')
                    ->where('reservation_id',$request->reservation_id)
                    ->select('total_price','amount_paid')
                    ->first();

        if($request->test == 1){
            $price = ($data->total_price * 0.9) - $data->amount_paid;
        }
        else{
            $price = $data->total_price - $data->amount_paid;
        }
        
        return $price;
            
    }

    public function CheckTotalBalanceWalkin(Request $request){

        $data = DB::table('walkin_reservation_tbl')
                    ->where('walkin_id',$request->walkin_id)
                    ->select('total_price','amount_paid')
                    ->first();

        if($request->test == 1){
            $price = ($data->total_price * 0.9) - $data->amount_paid;
        }
        else{
            $price = $data->total_price - $data->amount_paid;
        }
        
        return $price;
            
    }

    public function WalkInReservations(){

        $data = DB::table('walkin_reservation_tbl')
                    ->join('room_tbl','room_tbl.room_id','=','walkin_reservation_tbl.room_id')
                    ->select('room_tbl.category','walkin_reservation_tbl.*')
                    ->where('walkin_reservation_tbl.reservation_status','!=',2)
                    ->get();
        
        return view('admin.WalkinReservations',compact('data'));

    }

    public function ConfirmInitialWalkin(Request $request){

        $walkin_id = $request->walkin_id;
        $price = $request->price * 0.5;

        Walkin_Reservation_Tbl::ConfirmInitial($walkin_id,$price);

        $description = "Initial payment of customer ".$request->name;

        $sales = [
            'sales_amount' => $price,
            'description' => $description
        ];

        Sales_Tbl::AddSales($sales);
    }

    public function UploadedReceipts(){

        $data = DB::table('online_reservation_tbl')
                    ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                    ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                    ->select('room_tbl.room_name','online_reservation_tbl.*','tbl_users.name')
                    ->where('online_reservation_tbl.reservation_status',0)
                    ->get();
        
        return view('admin.UploadedReceipts',compact('data'));
    }
    
    public function Reschedule(){

        $data = DB::table('online_reservation_tbl')
                    ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                    ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                    ->select('room_tbl.room_name','online_reservation_tbl.*','tbl_users.name')
                    ->where('online_reservation_tbl.reservation_status','!=',2)
                    ->get();

        $data1 = DB::table('walkin_reservation_tbl')
                    ->join('room_tbl','room_tbl.room_id','=','walkin_reservation_tbl.room_id')
                    ->select('room_tbl.room_name','walkin_reservation_tbl.*')
                    ->where('walkin_reservation_tbl.reservation_status','!=',2)
                    ->get();
        
        return view('admin.Reschedule',compact('data','data1'));
    }

    public function changeprcwithqty(Request $request){

        if(empty($request->extra_person) || $request->extra_person == 0){

            $end_date = date("Y-m-d",strtotime($request->end_date));
            $start_date = date("Y-m-d",strtotime($request->start_date));

            $diff = abs(strtotime($end_date) - strtotime($start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $prc = $request->fix_price;

            $price = $prc * $days;

            $price = $price * $request->quantity;

        }
        else{

            $end_date = date("Y-m-d",strtotime($request->end_date));
            $start_date = date("Y-m-d",strtotime($request->start_date));

            $diff = abs(strtotime($end_date) - strtotime($start_date));

            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            
            $prc = $request->fix_price;
            
            $price = $prc * $days;

        
            $extra_person = $request->extra_person;

            

            $price_setting = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->get();
        
        
            foreach($price_setting as $setprice){
            
                $dta = $setprice->price;
            }

            $price = $price * $request->quantity;

            $extra = $extra_person * $dta;

            $price = $price + $extra;

        }
        
        return $price;
    }

    public function OnlineChangeSched(Request $request){

        $price = DB::table('room_tbl')
                    ->where('room_id',$request->room_id)
                    ->select('twentyfourhr_price')
                    ->first();

        $details = DB::table('online_reservation_tbl')
                    ->where('reservation_id',$request->reservation_id)
                    ->select('quantity','extra_mattress')
                    ->first();
        
        $end_date = date("Y-m-d",strtotime($request->check_out));
        $start_date = date("Y-m-d",strtotime($request->check_in));
        $diff = abs(strtotime($end_date) - strtotime($start_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        $prc = $price->twentyfourhr_price;
        
        $price = $prc * $days;
        $price = $price * $details->quantity;

        if($details->extra_mattress > 0){

            $price_setting = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->first();
        
            $xtra = $price_setting->price;
            $extra = $xtra * $details->extra_mattress;
        }
        else{
            $extra = 0;
        }
    
        $price = $price + $extra;

        $change = [
            'reservation_id' => $request->reservation_id,
            'total_price' => $price,
            'check_in' => $start_date,
            'check_out' => $end_date
        ];
        
        Online_Reservation_Tbl::ChangeSched($change);
        
    }

    public function WalkinChangeSched(Request $request){
        
        
        $price = DB::table('room_tbl')
                    ->where('room_id',$request->room_id)
                    ->select('twentyfourhr_price')
                    ->first();

        $details = DB::table('walkin_reservation_tbl')
                    ->where('walkin_id',$request->walkin_id)
                    ->select('quantity','extra_mattress')
                    ->first();
        
        
        $end_date = date("Y-m-d",strtotime($request->check_out));
        $start_date = date("Y-m-d",strtotime($request->check_in));
        $diff = abs(strtotime($end_date) - strtotime($start_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        $prc = $price->twentyfourhr_price;
        
        $price = $prc * $days;
        $price = $price * $details->quantity;

        if($details->extra_mattress > 0){

            $price_setting = DB::table('settings_tbl')
                    ->where('setting_id',1)
                    ->select('price')
                    ->first();
        
            $xtra = $price_setting->price;
            $extra = $xtra * $details->extra_mattress;
        }
        else{
            $extra = 0;
        }
    
        $price = $price + $extra;

        $change = [
            'walkin_id' => $request->walkin_id,
            'total_price' => $price,
            'check_in' => $start_date,
            'check_out' => $end_date
        ];
        
        Walkin_Reservation_Tbl::ChangeSched($change);
        
    }

    public function OnlineStatusChange(Request $request){

        Online_Reservation_Tbl::StatusChange($request->reservation_id,$request->status);
    }

    public function GalleryManagement(){

        $data = DB::table('gallery_tbl')
                ->select('*')
                ->get();

        return view('admin.ViewGallery',compact('data'));
    }

    public function Uploadtogallery(Request $request){

        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image->move('gallery', $image_name);

        Gallery_Tbl::AddImage($image_name);

    }

    public function Deletetogallery(Request $request){

        Gallery_Tbl::DeleteImage($request->gallery_id);
    }

    public function IncreaseSlot(Request $request){

        Room_Tbl::IncreaseSlot($request->room_id,$request->slot);
    }

    public function DecreaseSlot(Request $request){

        Room_Tbl::DeductSlot($request->room_id,$request->slot);
    }

    public function ManualSlot(Request $request){

        Room_Tbl::ManualSlot($request->room_id,$request->slot);
    }

}
