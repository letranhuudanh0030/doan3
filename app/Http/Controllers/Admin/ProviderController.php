<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.provider.index')->with('title_page', 'Danh sách nhà cung cấp')
                                            ->with('providers', $providers);
    }

    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $providers = Provider::orderBy('created_at', 'desc')->where('id', 'like', request()->keyword . '%')->paginate(12);
        } else {
            $providers = Provider::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->paginate(12);
        }
        return view('backend.provider.index')->with('title_page', 'Danh sách nhà cung cấp')
                                            ->with('providers', $providers);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.provider.create')->with('title_page', 'Thêm nhà cung cấp');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Provider::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'image' => str_replace(url('/'), '', $request->provider_image),
            'publish' => $request->publish,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc
        ]);

        Session::flash('success', 'Thêm nhà cung cấp thành công.');

        if($request->close){
            return redirect()->route('provider.index');
        }else{
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
        $provider = Provider::findOrFail($id);
        return view('backend.provider.edit')->with('title_page', 'Cập nhật nhà cung cấp')
                                            ->with('provider', $provider);
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

        $provider = Provider::findorFail($id);
        $provider->name = $request->name;
        $provider->slug = str_slug($request->name);
        $provider->image = str_replace(url('/'), '', $request->provider_image);
        $provider->publish = $request->publish;
        $provider->meta_title = $request->meta_title;
        $provider->meta_keyword = $request->meta_keyword;
        $provider->meta_desc = $request->meta_desc;
        $provider->updated_at = Carbon::now();

        $provider->save();

        Session::flash('success', 'Cập nhật nhà cung cấp thành công.');

        if($request->close){
            return redirect()->route('provider.index');
        }else{
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
        $status = Provider::findOrFail(request()->id);
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
        $provider = Provider::findOrFail(request()->id);
        $provider->delete();
        
    }
}
