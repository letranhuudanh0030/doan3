<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SlideShow;
use Illuminate\Support\Facades\Session;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshows = SlideShow::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.slideshow.index')->with('title_page', 'Danh sách slide show')
                                            ->with('slideshows', $slideshows);
    }


    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $slideshows = SlideShow::orderBy('created_at', 'desc')->where('id', 'like', request()->keyword . '%')->paginate(12);
        } else {
            $slideshows = SlideShow::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->paginate(12);
        }
        return view('backend.slideshow.index')->with('title_page', 'Danh sách slide show')
                                            ->with('slideshows', $slideshows);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slideshow.create')->with('title_page', 'Thêm slide show mới');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required'
        ]);

        SlideShow::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'image' => str_replace(url('/'), '', $request->image),
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,
            'publish' => $request->publish
        ]);

        Session::flash('success', 'Thêm mới slide show thành công.');

        if($request->close){
            return redirect()->route('slideshow.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slideshow = SlideShow::findOrFail($id);
        return view('backend.slideshow.edit')->with('title_page', 'Cập nhật slide show')
                                            ->with('slideshow', $slideshow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $slideshow = SlideShow::findOrFail($id);
        $slideshow->name = $request->name;
        $slideshow->slug = str_slug($request->name);
        $slideshow->image = str_replace(url('/'), '', $request->image);
        $slideshow->meta_title = $request->meta_title;
        $slideshow->meta_keyword = $request->meta_keyword;
        $slideshow->meta_desc = $request->meta_desc;
        $slideshow->publish = $request->publish;
        $slideshow->save();

        Session::flash('success', 'Cập nhật slide show thành công.');

        if($request->close){
            return redirect()->route('slideshow.index');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus()
    {
        // dd(request()->id);
        $status = SlideShow::findOrFail(request()->id);
        if(request()->type == 'publish') {
            if(request()->value == 0){
                $status->publish = 1;
            } else {
                $status->publish = 0;
            }
        }else if(request()->type == 'sort_order') {
            // dd(request()->value);
            // if(request()->value != null) {
                $status->sort_order = request()->value;
            // }
        }
        $status->save();
        return response($status, 200);
    }

    public function remove()
    {
        // dd(request()->all());
        $provider = SlideShow::findOrFail(request()->id);
        $provider->delete();
        
    }
}
