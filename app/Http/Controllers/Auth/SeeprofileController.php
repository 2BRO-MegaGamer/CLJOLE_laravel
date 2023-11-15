<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Profile;
use App\Models\Profile_img_bio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SeeprofileController extends Controller
{

    public function seeprofile(){

        return view('auth.seeprofile');
    }
    public function UserName_bio_img_change(Request $request)
    {


        $user_tabel=['firstName','lastName','UserName'];
        $difference = $this->get_diff_req($request);

        foreach ($difference as $Kdiff => $Vdiff) {
            if (in_array($Kdiff,$user_tabel)) {
                if ($Kdiff == "UserName") {

                    $hashtag = (new RegisterController)->hashtag_generator($difference[$Kdiff]);

                    User::where('id',auth()->id())
                        ->update([
                            'UserName' => $difference[$Kdiff],
                            'hashtag' => $hashtag
                        ]);
                }else{
                    User::where('id',auth()->id())
                    ->update([$Kdiff => $difference[$Kdiff]]);
                }
            }else{
                if ($Kdiff != "prof_Img") {
                    Profile_img_bio::where('user_id',auth()->id())
                    ->update([$Kdiff => $difference[$Kdiff]]);
                }else{
                    $size = $request->file('prof_Img')->getSize();
                    $name = auth()->id() . "_" . auth()->user()->UserName ."_"  . date("Y-m-d") . "_" . date("H-i-s") .".png";
                    $all_Storage_Uploaded_images = Storage::disk('public')->allFiles('imgs/uploads/');
                    for ($i=0; $i < count($all_Storage_Uploaded_images); $i++) { 
                        $analysis_files_name = explode('imgs/uploads/',$all_Storage_Uploaded_images[$i])[1];
                        $analysis_files_user_id = explode("_", $analysis_files_name);
                        if ($analysis_files_user_id[0] == auth()->id()) {
                            Storage::delete('public/'.$all_Storage_Uploaded_images[$i]);
                        }
                    }
                    if (($request->file('prof_Img')->storeAs('public/imgs/uploads/', $name)) != false) {
                        Profile_img_bio::where('user_id',auth()->id())
                        ->update([
                            'prof_Img_name' => $name,
                            'prof_Img_size' => $size,
                            'path' => ('public/imgs/uploads/'. $name),
                            'type' => 'png',
                        ]);
                    }
                }
            }
        }
        User::where('id',auth()->id())
            ->touch();

        Profile_img_bio::where('user_id',auth()->id())
            ->touch();
        return redirect()->back();



    }
    public function get_diff_req($request){
        $img_data = null;
        if ($request->file()) {
            $img_data = $request->file();
        }
        $profile = (Profile_img_bio::where('user_id',auth()->id())->get())[0];
        $names = auth()->user();
        $old_data = [
            'UserName' => $names->UserName,
            'firstName' => $names->firstName,
            'lastName' => $names->lastName,
            'prof_Img' => $profile->prof_Img,
            'prof_Bio' => $profile->prof_Bio,
            'prof_Color' => $profile->prof_Color
        ];
        $new_data = [
            'UserName' => $request->newUsername,
            'firstName' => $request->newFirstname,
            'lastName' => $request->newLastname,
            'prof_Img' => $img_data,
            'prof_Bio' => $request->newBio,
            'prof_Color' =>$request->Color

        ];
        $difference=[];
        foreach ($old_data as $Kold=>$Vold) {
            if ($old_data[$Kold] != $new_data[$Kold]) {
                $difference[$Kold] = $new_data[$Kold];
            }
        }

        return $difference;
    }

















    protected $table = 'profile_img_bios';
}
