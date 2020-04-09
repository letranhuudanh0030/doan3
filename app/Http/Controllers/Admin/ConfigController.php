<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{
    public function index()
    {
        $website = Info::first();
        return view('backend.config.website')->with('title_page', 'Cấu hình chung')
                                            ->with('website', $website);
                                            
    }

    public function postConfig()
    {
        // dd(request()->all());
        $website = Info::first();
        $website->name = request()->name;
        $website->meta_title = request()->meta_title;
        $website->meta_keyword = request()->meta_keyword;
        $website->meta_desc = request()->meta_desc;
        $website->logo = str_replace(url('/'), '', request()->image);
        $website->favicon = str_replace(url('/'), '', request()->favicon);
        $website->email = request()->email;
        $website->phone = request()->phone;
        $website->address = request()->address;
        $website->social = request()->social;
        $website->map = request()->map;
        $website->video = request()->video;
        $website->updated_at = Carbon::now();
        $website->save();

        Session::flash('success', 'Cập nhật thông tin website thành công.');

        return redirect()->back();
    }
}
