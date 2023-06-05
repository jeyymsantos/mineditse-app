<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InfoController extends Controller
{
    public function index()
    {

        $info = Info::all()->first();
        Session::put('logo', $info->logo);
        Session::put('name', $info->name);

        return view('welcome', [
            'info' => $info,
        ]);
    }

    public function ViewSettings(){
        $info = Info::all()->first();
        return view('admin.settings', [
            'info' => $info,
        ]); 
    }

    public function ViewFeedbacks(){
        $feedback = Feedback::orderBy('id', 'DESC')->get();
        return view('admin.feedback', [
            'feedbacks' => $feedback,
        ]); 
    }

    public function SaveSettings(Request $req)
    {
        $info = Info::find(1);
        $info->name = $req->name;
        $info->short_quote = $req->short_quote;
        $info->long_quote = $req->long_quote;
        $info->short_description = $req->short_description;
        $info->long_description = $req->long_description;
        $info->address = $req->address;
        $info->contact = $req->contact;
        $info->email = $req->email;
        $info->contact_hours = $req->contact_hours;
        $info->service_quote = $req->service_quote;
        $info->service_1_name = $req->service_1_name;
        $info->service_1_quote = $req->service_1_quote;
        $info->service_2_name = $req->service_2_name;
        $info->service_2_quote = $req->service_2_quote;
        $info->service_3_name = $req->service_3_name;
        $info->fb_link = $req->fb_link;
        $info->live_title = $req->live_title;
        $info->live_link = $req->live_link;

        // MAIN LOGO
        if ($req->hasFile('logo')) {
            $destination_path = '/images/defaults';
            $image_name = "logo";

            $req->file('logo')->storeAs($destination_path, $image_name);
            $info->logo = '/storage/images/defaults/' . $image_name;
        }

        // MAIN BANNER PHOTO
        if ($req->hasFile('main_banner')) {
            $destination_path = '/images/defaults';
            $image_name = "main_banner";

            $req->file('main_banner')->storeAs($destination_path, $image_name);
            $info->main_banner_photo = '/storage/images/defaults/' . $image_name;
        }

        // SECONDARY PHOTO
        if ($req->hasFile('secondary_banner')) {
            $destination_path = '/images/defaults';
            $image_name = "secondary";

            $req->file('secondary_banner')->storeAs($destination_path, $image_name);
            $info->secondary_banner_photo = '/storage/images/defaults/' . $image_name;
        }

        // service 1 img
        if ($req->hasFile('service_1_img')) {
            $destination_path = '/images/defaults';
            $image_name = "service_1";

            $req->file('service_1_img')->storeAs($destination_path, $image_name);
            $info->service_1_img = '/storage/images/defaults/' . $image_name;
        }

        // service 2 img
        if ($req->hasFile('service_2_img')) {
            $destination_path = '/images/defaults';
            $image_name = "service_2";

            $req->file('service_2_img')->storeAs($destination_path, $image_name);
            $info->service_2_img = '/storage/images/defaults/' . $image_name;
        }

        // service 3 img
        if ($req->hasFile('service_3_img')) {
            $destination_path = '/images/defaults';
            $image_name = "service_3";

            $req->file('service_3_img')->storeAs($destination_path, $image_name);
            $info->service_3_img = '/storage/images/defaults/' . $image_name;
        }


        $info->save();
        Session::put('logo', $info->logo);
        Session::put('name', $info->name);

        return redirect('/admin/settings')->with('successfull', 'Your settings has been successfully updated!');
    }
}
