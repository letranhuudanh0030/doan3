<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_categories = ArticleCategory::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.article_category.index')->with('title_page', 'Danh sách danh mục bài viết')
                                                    ->with('categories', $article_categories);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::where('publish', 1)->get();
        return view('backend.article_category.create')->with('title_page', 'Thêm danh mục bài viết')
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

        ArticleCategory::create([
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
        
        Session::flash('success', 'Thêm mới danh mục bài viết thành công.');

        if($request->close){
            return redirect()->route('article_category.index');
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
        $articleCategory = ArticleCategory::findOrFail($id);
        $categories = ArticleCategory::where('publish', 1)->get();
        return view('backend.article_category.edit')->with('title_page', 'Cập nhật danh mục bài viết')
                                                    ->with('articleCategory', $articleCategory)
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required'
        ]);

        $articleCategory = ArticleCategory::findOrFail($id);
        $articleCategory->name = $request->name;
        $articleCategory->slug = str_slug($request->name);
        $articleCategory->parent_id = $request->parent_id;
        $articleCategory->image = str_replace(url('/'),'',$request->cate_image);
        $articleCategory->meta_title = $request->meta_title;
        $articleCategory->meta_desc = $request->meta_desc;
        $articleCategory->meta_keyword = $request->meta_keyword;
        $articleCategory->publish = $request->publish;
        $articleCategory->highlight = $request->highlight;
        $articleCategory->updated_at = Carbon::now();

        $articleCategory->save();

        Session::flash('success', 'Cập nhật danh mục bài viết thành công.');

        if($request->close){
            return redirect()->route('article_category.index');
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
        $status = ArticleCategory::findOrFail(request()->id);
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
        $category = ArticleCategory::findOrFail(request()->id);
        $category->article()->delete();
        $category->delete();
        
    }

    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $article_categories = ArticleCategory::orderBy('created_at', 'desc')->where('id', 'like', request()->keyword . '%')->paginate(12);
        } else {
            $article_categories = ArticleCategory::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->paginate(12);
        }
        return view('backend.article_category.index')->with('title_page', 'Danh sách danh mục bài viết')
                                                    ->with('categories', $article_categories);

    }
}
