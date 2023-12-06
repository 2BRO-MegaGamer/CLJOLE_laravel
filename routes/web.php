<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\inRoomController;
use App\Http\Controllers\Profile;
use App\Models\ChatInfo;
use Database\Factories\ChatInfoFactory;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HomeController;
use App\Http\Controllers\Auth\SeeprofileController;
use App\Http\Controllers\message\Message_panelController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\MeetingRoomController;
use App\Http\Controllers\UserStatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/monsieur', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('logout', [LoginController::class, 'logout']);


Route::middleware('auth')->group(function () {
    Route::get('/seeprofile',[SeeprofileController::class , 'seeprofile']);
    Route::post('/seeprofile',[SeeprofileController::class , 'UserName_bio_img_change']);





    Route::post('/get_member_profile_and_detail',[Profile::class , 'get_members_profile_info_with_peer_id']);



    

    ////////////////Friends/////////////////
    Route::get('/findFriends',[FriendsController::class,'Find_friend']);

    Route::post('/findFriends',[FriendsController::class,'add_friend_send']);

    Route::post('/get_info',[FriendsController::class,'get_req_friends']);

    ##############request##############
    Route::get('/remove_Frined_send_req',[FriendsController::class,'reject_detect_send']);
    Route::get('/Frined_get_req',[FriendsController::class,'detect_get']);
    ##############request##############

    ##############Message##############
    Route::post('/get_messages',[Message_panelController::class,'get_message_panel']);
    Route::post('/send_message',[Message_panelController::class,'send_text_message']);
    Route::post('/all_message_seen',[Message_panelController::class,'all_message_seen']);
    Route::post('/update_sec_chat',[Message_panelController::class,'update_sec_chat']);
    Route::post('/get_specific_message',[Message_panelController::class,'get_specific_message']);
    Route::post('/remove_my_message',[Message_panelController::class,'remove_my_message']);
    Route::post('/get_friends_statuse',[Message_panelController::class,'get_friends_statuse']);

    ##############Message##############
    ////////////////Friends/////////////////
    ////////////////MeetingRoom/////////////////
    Route::prefix('/mR')->group(function () {
        Route::get('/create',[MeetingRoomController::class,'create_page']);
        Route::post('/create_room',[MeetingRoomController::class,'create_room']);
        Route::get('/Room/{RoomID}',[MeetingRoomController::class,'genarate_room']);
        Route::post('/Room/{RoomID}',[MeetingRoomController::class,'genarate_room']);
        Route::get('/joinTo/{RoomID}',[MeetingRoomController::class,'joinTo_page']);




        Route::post('/get_members_peer_id',[MeetingRoomController::class,'get_members_peer_id']);
        Route::post('/member_disconnect',[MeetingRoomController::class,'member_disconnect']);





        /////////////////////////inROOOM/////////////////////////


        Route::post('/members_cannot_make_connection_to_member',[inRoomController::class,'members_cannot_make_connection_to_member']);


        /////////////////////////inROOOM/////////////////////////



    });
    ////////////////MeetingRoom/////////////////



});






Auth::routes();

