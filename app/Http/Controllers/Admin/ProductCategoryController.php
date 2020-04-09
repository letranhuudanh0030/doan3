<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::orderBy('created_at', 'desc')->get();
        return view('backend.product_category.index')->with('title_page', 'Danh mục sản phẩm')
                                                    ->with('categories', $categories);
    }

    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $categories = ProductCategory::orderBy('created_at', 'desc')->where('id', 'like','%' . request()->keyword . '%')->get();
        } else {
            $categories = ProductCategory::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->get();
        }
        return view('backend.product_category.index')->with('title_page', 'Danh mục sản phẩm')
                                                    ->with('categories', $categories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::where('publish', 1)->get();
        return view('backend.product_category.create')->with('title_page', 'Thêm danh mục sản phẩm')
                                                    ->with('categories', $categories);
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

        ProductCategory::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'parent_id' => $request->parent_id,
            'image' => str_replace(url('/'),'',$request->cate_image),
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
            'meta_keyword' => $request->meta_keyword,
            'publish' => $request->publish,
            'highlight' => $request->highlight
        ]);

        Session::flash('success', 'Thêm danh mục sản phẩm thành công.');

        if($request->close) {
            return redirect()->route('product_category.index');
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
        $category = ProductCategory::findOrFail($id);
        $categories = ProductCategory::where('publish', 1)->get();
        return view('backend.product_category.edit')->with('title_page', 'Cập nhật danh mục sản phẩm')
                                                    ->with('category', $category)
                                                    ->with('categories', $categories);
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
        $category = ProductCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->image = str_replace(url('/'),'',$request->cate_image);
        $category->meta_title = $request->meta_title;
        $category->meta_desc = $request->meta_desc;
        $category->meta_keyword = $request->meta_keyword;
        $category->publish = $request->publish;
        $category->highlight = $request->highlight;
        $category->updated_at = Carbon::now();
        $category->save();

        Session::flash('success', 'Cập nhật danh mục sản phẩm thành công.');

        return redirect()->route('product_category.index');
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
        $status = ProductCategory::findOrFail(request()->id);
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
            if(request()->value != null) {
                $status->sort_order = request()->value;
            }
        }
        $status->save();
        return response($status, 200);
    }

    public function remove()
    {
        // dd(request()->all());
        $category = ProductCategory::findOrFail(request()->id);
        $category->product()->delete();
        $category->delete();
        
    }
}
