<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room_Tbl;
use App\Amenity_Tbl;
use App\Sales_Tbl;
use App\Online_Reservation_Tbl;
use App\Room_Mainpage_Tbl;
use App\Tbl_Users;
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

        return view('admin.dashboard');
    }

    public function AddRoomView(){

        return view('admin.AddRoom');
    }

    public function AddRoom(Request $request){

        $image = $request->file('main_pic');
        $image_name = $image->getClientOriginalName();
        $image->move('images', $image_name);

        $data = [
            'room_num' => $request['room_num'],
            'floor' => $request['floor'],
            'room_name' => $request['room_name'],
            'category' =>$request['category'],
            'capacity' => $request['capacity'],
            '24hr_price' => $request['24hr_price'],
            'description' => $request['description'],
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
                'room_num' => $request['room_num'],
                'floor' => $request['floor'],
                'room_name' => $request['room_name'],
                'category' => $request['category'],
                'capacity' => $request['capacity'],
                '12hr_price' => $request['12hr_price'],
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
                'room_num' => $request['room_num'],
                'floor' => $request['floor'],
                'room_name' => $request['room_name'],
                'category' => $request['category'],
                'capacity' => $request['capacity'],
                '12hr_price' => $request['12hr_price'],
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

    public function OnlineReservations(){

        $data = DB::table('online_reservation_tbl')
                    ->join('tbl_users','online_reservation_tbl.user_id','=','tbl_users.user_id')
                    ->join('room_tbl','room_tbl.room_id','=','online_reservation_tbl.room_id')
                    ->select('room_tbl.room_name','room_tbl.room_num','online_reservation_tbl.*','tbl_users.name')
                    ->where('online_reservation_tbl.reservation_status','!=',2)
                    ->get();
        
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

        Online_Reservation_Tbl::CompletePayment($reservation_id,$price);

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

        $reservation_id = $request->reservation_id;

        Online_Reservation_Tbl::CancelReservation($reservation_id);
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

}
