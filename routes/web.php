<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mainpage.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/administrator', 'AdminController@login')->name('administrator');
Route::post('/AdminVerification', 'AdminController@AdminVerification')->name('AdminVerification');
Route::get('/AdminDashboard', 'AdminController@AdminDashboard')->name('AdminDashboard');
Route::get('/ViewRooms', 'AdminController@ViewRooms')->name('ViewRooms');
Route::get('/ChangeRoomStatus', 'AdminController@ChangeRoomStatus')->name('ChangeRoomStatus');
Route::get('/ChangeAmenityStatus', 'AdminController@ChangeAmenityStatus')->name('ChangeAmenityStatus');
Route::get('/GetRoomInfo', 'AdminController@GetRoomInfo')->name('GetRoomInfo');
Route::get('/GetAmenityInfo', 'AdminController@GetAmenityInfo')->name('GetAmenityInfo');
Route::post('/EditAmenity', 'AdminController@EditAmenity')->name('EditAmenity');
Route::get('/AdminLogout', 'AdminController@AdminLogout')->name('AdminLogout');
Route::get('/AddRoom', 'AdminController@AddRoomView')->name('AddRoomView');
Route::get('/EditRoom', 'AdminController@EditRoomView')->name('EditRoomView');
Route::get('/RoomStatus', 'AdminController@RoomStatusView')->name('RoomStatusView');
Route::get('/AmenityStatusView', 'AdminController@AmenityStatusView')->name('AmenityStatusView');
Route::get('/OnlineReservations', 'AdminController@OnlineReservations')->name('OnlineReservations');
Route::post('/PostRoom', 'AdminController@AddRoom')->name('AddRoom');
Route::post('/EditRoom', 'AdminController@EditRoom')->name('EditRoom');
Route::post('/UploadPictures', 'AdminController@UploadPictures')->name('UploadPictures');
Route::get('/ConfirmInitial', 'AdminController@ConfirmInitial')->name('ConfirmInitial');
Route::get('/ConfirmInitialWalkin', 'AdminController@ConfirmInitialWalkin')->name('ConfirmInitialWalkin');
Route::get('/CompletePayment', 'AdminController@CompletePayment')->name('CompletePayment');
Route::get('/CompletePaymentWalkin', 'AdminController@CompletePaymentWalkin')->name('CompletePaymentWalkin');
Route::get('/AddAdditional', 'AdminController@AddAdditional')->name('AddAdditional');
Route::get('/AddAdditionalwalkin', 'AdminController@AddAdditionalwalkin')->name('AddAdditionalwalkin');
Route::get('/CheckTotalBalance', 'AdminController@CheckTotalBalance')->name('CheckTotalBalance');
Route::get('/CheckTotalBalanceWalkin', 'AdminController@CheckTotalBalanceWalkin')->name('CheckTotalBalanceWalkin');
Route::get('/WalkInReservations', 'AdminController@WalkInReservations')->name('WalkInReservations');
Route::get('/UploadedReceipts', 'AdminController@UploadedReceipts')->name('UploadedReceipts');

Route::get('/SalesReports', 'AdminController@SalesReports')->name('SalesReports');
Route::get('/getSales/{trigger}', 'AdminController@getSales');

Route::get('/MainpageSetting', 'AdminController@MainpageSetting')->name('MainpageSetting');
Route::post('/UploadPicturesForMainpage', 'AdminController@UploadPicturesForMainpage')->name('UploadPicturesForMainpage');
Route::get('/UserEdit', 'AdminController@UserEdit')->name('UserEdit');
Route::get('/ChangeUserStatus', 'AdminController@ChangeUserStatus')->name('ChangeUserStatus');
Route::get('/ViewUsers', 'AdminController@ViewUsers')->name('ViewUsers');
Route::get('/ViewAmenities', 'AdminController@ViewAmenities')->name('ViewAmenities');
Route::get('/CancelReservation', 'AdminController@CancelReservation')->name('CancelReservation');
Route::get('/CancelReservationWalkin', 'AdminController@CancelReservationWalkin')->name('CancelReservationWalkin');
Route::get('/AddAmenities', 'AdminController@AddAmenitiesView')->name('AddAmenitiesView');
Route::post('/AddAmenity', 'AdminController@AddAmenity')->name('AddAmenity');
Route::get('/DeleteRoom', 'AdminController@DeleteRoom')->name('DeleteRoom');
Route::get('/DeleteAmenity', 'AdminController@DeleteAmenity')->name('DeleteAmenity');
Route::get('/EditAmenityView', 'AdminController@EditAmenityView')->name('EditAmenityView');
Route::get('/WalkInView', 'AdminController@WalkInView')->name('WalkInView');
Route::get('/disableddates', 'AdminController@disableddates')->name('disableddates');
Route::get('/disabledcheckoutdates', 'AdminController@disabledcheckoutdates')->name('disabledcheckoutdates');
Route::get('/changeenddate', 'AdminController@changeenddate')->name('changeenddate');
Route::get('/getextrapersonprice', 'AdminController@getextrapersonprice')->name('getextrapersonprice');
Route::post('/AddRoomWalkIn', 'AdminController@AddRoomWalkIn')->name('AddRoomWalkIn');
Route::post('/Uploadtogallery', 'AdminController@Uploadtogallery')->name('Uploadtogallery');
Route::get('/Reschedule', 'AdminController@Reschedule')->name('Reschedule');
Route::get('/OnlineChangeSched', 'AdminController@OnlineChangeSched')->name('OnlineChangeSched');
Route::get('/WalkinChangeSched', 'AdminController@WalkinChangeSched')->name('WalkinChangeSched');
Route::get('/changeprcwithqty', 'AdminController@changeprcwithqty')->name('changeprcwithqty');
Route::get('/OnlineStatusChange', 'AdminController@OnlineStatusChange')->name('OnlineStatusChange');
Route::get('/GalleryManagement', 'AdminController@GalleryManagement')->name('GalleryManagement');
Route::get('/Deletetogallery', 'AdminController@Deletetogallery')->name('Deletetogallery');
Route::get('/IncreaseSlot', 'AdminController@IncreaseSlot')->name('IncreaseSlot');
Route::get('/DecreaseSlot', 'AdminController@DecreaseSlot')->name('DecreaseSlot');
Route::get('/ManualSlot', 'AdminController@ManualSlot')->name('ManualSlot');
Route::get('/RoomSlotView', 'AdminController@RoomSlotView')->name('RoomSlotView');


Route::get('/Topaz', 'HomeController@Topaz')->name('Topaz');
Route::get('/Emerald', 'HomeController@Emerald')->name('Emerald');
Route::get('/Turquoise', 'HomeController@Turquoise')->name('Turquoise');
Route::get('/Garnet', 'HomeController@Garnet')->name('Garnet');
Route::get('/Jade', 'HomeController@Jade')->name('Jade');
Route::get('/Pearl', 'HomeController@Pearl')->name('Pearl');
Route::get('/Sapphire', 'HomeController@Sapphire')->name('Sapphire');
Route::get('/RoomPreview/{room_id}', 'HomeController@RoomPreview')->name('RoomPreview');
Route::get('/index', 'HomeController@Index')->name('index');
Route::get('/about', 'HomeController@About')->name('about');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/register', 'HomeController@register')->name('register');
Route::post('/UserAuthentication', 'HomeController@UserAuthentication')->name('UserAuthentication');
Route::post('/AuthenticateUser', 'HomeController@AuthenticateUser')->name('AuthenticateUser');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/editprofile', 'HomeController@EditProfileView')->name('editprofileview');
Route::post('/ProfileEdit', 'HomeController@ProfileEdit')->name('ProfileEdit');
Route::get('/changepassword', 'HomeController@ChangePassword')->name('changepasswordview');
Route::post('/ChangePass', 'HomeController@ChangePass')->name('ChangePass');
Route::get('/disablecheckin', 'HomeController@disablecheckin')->name('disablecheckin');
Route::get('/disableforcheckout', 'HomeController@disableforcheckout')->name('disableforcheckout');
Route::get('/GetRoomTotalPrice', 'HomeController@GetRoomTotalPrice')->name('GetRoomTotalPrice');
Route::get('/NewOnlineRoomReservation', 'HomeController@NewOnlineRoomReservation')->name('NewOnlineRoomReservation');
Route::post('/CheckAvailability', 'HomeController@CheckAvailability')->name('CheckAvailability');
Route::post('/AllRooms', 'HomeController@AllRooms')->name('AllRooms');
Route::get('/Addoneday', 'HomeController@Addoneday')->name('Addoneday');
Route::get('/Amenities', 'HomeController@Amenities')->name('Amenities');
Route::get('/NewOnlineRoomReservationPaypal', 'HomeController@NewOnlineRoomReservationPaypal')->name('NewOnlineRoomReservationPaypal');
Route::get('/reservation', 'HomeController@viewReservations')->name('reservations');
Route::get('/galleryview', 'HomeController@galleryview')->name('galleryview');
Route::get('/MoreRooms', 'HomeController@MoreRooms')->name('MoreRooms');
Route::get('/viewReservationDetails/{id}', 'HomeController@viewReservationDetails')->name('viewReservationDetails');
Route::post('/reservationUpload', 'HomeController@reservationUpload')->name('reservationUpload');





//caching settings or configs
Route::get('/cc', function() {
    \Artisan::call('config:clear', []);
    \Artisan::call('config:cache', []);
    echo 'cached';
});
