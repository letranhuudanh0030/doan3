<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.article.index')->with('title_page', 'Danh sách bài viết')
                                            ->with('articles', $articles);
    }

    public function search()
    {
        // dd(is_numeric(request()->keyword));
        if(is_numeric(request()->keyword)){
            $articles = Article::orderBy('created_at', 'desc')->where('id', 'like', request()->keyword . '%')->paginate(12);
        } else {
            $articles = Article::orderBy('created_at', 'desc')->where('slug', 'like', '%' . str_slug(request()->keyword) . '%')->paginate(12);
        }
        return view('backend.article.index')->with('title_page', 'Danh sách bài viết')
                                            ->with('articles', $articles);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::where('publish', 1)->get();
        return view('backend.article.create')->with('title_page', 'Thêm mói bài viết')
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
            'name' => 'required',
            'category_id' => 'required'
        ]);

        Article::Create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'article_category_id' => $request->category_id,
            'image' => str_replace(url('/'),'',$request->image),
            'short_desc' => $request->short_desc,
            'content' => $request->desc,
            'publish' => $request->publish,
            'highlight' => $request->highlight,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,

        ]);

        Session::flash('success', 'Thêm mới bài viết thành công.');

        if($request->close){
            return redirect()->route('article.index');
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
        $article = Article::findOrFail($id);
        $categories = ArticleCategory::where('publish', 1)->get();
        return view('backend.article.edit')->with('title_page', 'Cập nhật bài viết')
                                            ->with('categories', $categories)
                                            ->with('article', $article);
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
            'name' => 'required',
            'category_id' => 'required'
        ]);
        
        $article = Article::findOrFail($id);
   
        $article->name = $request->name;
        $article->slug = str_slug($request->name);
        $article->article_category_id = $request->category_id;
        $article->image = str_replace(url('/'),'',$request->image);
        $article->short_desc = $request->short_desc;
        $article->content = $request->desc;
        $article->publish = $request->publish;
        $article->highlight = $request->highlight;
        $article->meta_title = $request->meta_title;
        $article->meta_keyword = $request->meta_keyword;
        $article->meta_desc = $request->meta_desc;

        $article->save();


        Session::flash('success', 'Cập nhật bài viết thành công.');

        if($request->close){
            return redirect()->route('article.index');
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
        $status = Article::findOrFail(request()->id);
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
            $product = Article::findOrFail(request()->id);
            $product->delete();
        } else if(request()->ids) {
            $ids = explode(',', request()->ids);
            // dd($ids);
            foreach ($ids as $id) {
                if($id != null) {
                    $product = Article::findOrFail($id);
                    $product->delete();
                }
            }
        }

        // return response('ok', 200);
    }
}
