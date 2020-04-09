<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.product.index')->with('title_page', 'Danh sách sản phẩm')
                                            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::where('publish', 1)->get();
        $providers = Provider::where('publish', 1)->get();
        return view('backend.product.create')->with('title_page', 'Thêm sản phẩm')
                                            ->with('categories', $categories)
                                            ->with('providers', $providers);
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
            'name' => 'required',
            'category_id' => 'required',
        ]);

        if($request->images){
            $images = null;
            foreach (json_decode($request->images) as $key => $image) {
               if($key > 0){
                    $images .= ','.str_replace(url('/'), '', $image);
               }else{
                    $images = str_replace(url('/'), '', $image);
               } 
            } 
        }

        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'price' => $request->price,
            'discount' => $request->discount,
            'product_category_id' => $request->category_id,
            'provider_id' => $request->provider_id,
            'short_desc' => $request->short_desc,
            'desc' => $request->desc,
            'image' => str_replace(url('/'), '', $request->image),
            'images' => $images,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_keyword,
            'meta_keyword' => $request->meta_desc,
        ]);
        
        Session::flash('success', 'Thêm sản phẩm thành công.');

        if($request->close) {
            return redirect()->route('product.index');
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
        $product = Product::findOrFail($id);
        $categories = ProductCategory::where('publish', 1)->get();
        $providers = Provider::where('publish', 1)->get();
        return view('backend.product.edit')->with('title_page', 'Cập nhật sản phẩm')
                                            ->with('product', $product)
                                            ->with('categories', $categories)
                                            ->with('providers', $providers);
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
        ]); 

        if($request->images){
            $images = null;
            foreach (json_decode($request->images) as $key => $image) {
               if($key > 0){
                    $images .= ','.str_replace(url('/'), '', $image);
               }else{
                    $images = str_replace(url('/'), '', $image);
               } 
            } 
        }

        $product = Product::findOrFail($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->product_category_id = $request->category_id;
        $product->provider_id = $request->provider_id;
        $product->short_desc = $request->short_desc;
        $product->desc = $request->desc;
        $product->image = $request->image;
        $product->images = $images;
        $product->publish = $request->publish;
        $product->highlight = $request->highlight;
        $product->meta_title = $request->meta_title;
        $product->meta_desc = $request->meta_keyword;
        $product->meta_keyword = $request->meta_desc;
        $product->updated_at = Carbon::now();

        $product->save();
        Session::flash('success', 'Cập nhật sản phẩm thành công.');
        
        if($request->close) {
            return redirect()->route('product.index');
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
        $status = Product::findOrFail(request()->id);
        if(request()->type == 'publish') {
            if(request()->value == 0){
                $status->publish = 1;
            } else {
                $status->publish = 0;
            }
        } else if(request()->type == 'highlight') {
            if(request()->value == 0){
                $status->highlight = 1;
            } else {
                $status->highlight = 0;
            }
        } else if(request()->type == 'sort_order') {
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
        if(request()->id) {
            $product = Product::findOrFail(request()->id);
            $product->delete();
        } else if(request()->ids) {
            $ids = explode(',', request()->ids);
            // dd($ids);
            foreach ($ids as $id) {
                if($id != null) {
                    $product = Product::findOrFail($id);
                    $product->delete();
                }
            }
        }

        // return response('ok', 200);
    }

    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $products = Product::orderBy('created_at', 'desc')->where('id', 'like', request()->keyword . '%')->paginate(12);
        } else {
            $products = Product::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->paginate(12);
        }
        return view('backend.product.index')->with('title_page', 'Danh sách sản phẩm')
                                            ->with('products', $products);

    }
}
