<?php

namespace App\Http\Controllers;

use App\Article;
use App\Info;
use App\Product;
use App\ProductCategory;
use App\Provider;
use App\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    
    public function index()
    {
        // Slideshow
        $slides = DataQuery::getSlide();

        // Category Product
        $PcategoriesAll = DataQuery::getProductCategory(); 
        $Pcategories = DataQuery::getProductCategory()->where('parent_id', 0);

        // Product All
        $product_all = null;
        foreach ($Pcategories as $cateRoot) {
            foreach ($PcategoriesAll->where('parent_id', $cateRoot->id) as $cateParent) {
                foreach ($PcategoriesAll->where('parent_id', $cateParent->id) as $cateSub) {
                    foreach ($cateSub->product->where('highlight', 1) as $product) {
                        $product_all[] = $product;
                    }
                }
            }
        }

        // Article
        $articles = DataQuery::getArticle()->where('highlight', 1);

        // Provider
        $providers = DataQuery::getProvider();

        
        return view('frontend.home')->with('Pcategories', $Pcategories)
                                    ->with('PcategoriesAll', $PcategoriesAll)
                                    ->with('slides', $slides)
                                    ->with('product_all', $product_all)
                                    ->with('articles', $articles)
                                    ->with('providers', $providers);
    }

    public function shop()
    {
        $category = DataQuery::getSingleCategory();
        $categories = DataQuery::getProductCategory();
        $categoryRoot = DataQuery::getProductCategory()->where('parent_id', 0)->first();
        $products = [];

        // Provider
        $providers = DataQuery::getProvider();
        
        if($category->product->count() > 0){
            $products = $category->product;
        } else {
            foreach ($categories->where('parent_id', $category->id) as $cate) {
                if($categories->where('parent_id', $category->id)->count() > 0){
                    if($categories->where('parent_id', $cate->id)->count() > 0){
                        foreach ($categories->where('parent_id', $cate->id) as $item) {
                            foreach ($item->product as $product) {
                                $products[] = $product;
                            }
                        }
                    } else {
                        foreach ($cate->product as $product) {
                            $products[] = $product;
                        }
                    }
                }
            }
        }

        $products = DataQuery::setPaginate($products, 12);
        
        return view('frontend.shop')->with('providers', $providers)
        ->with('products', $products)
        ->with('categories', $categories)
        ->with('category', $category)
        ->with('categoryRoot', $categoryRoot);
    }

    public function single()
    {
        $product = DataQuery::getSingleProduct();
        $providers = DataQuery::getProvider();
        return view('frontend.single')->with('product', $product)
                                    ->with('providers', $providers);
    }

    public function new()
    {
        $articles = DataQuery::getArticle();
        $articles = DataQuery::setPaginate($articles, 12);

        $providers = DataQuery::getProvider();
        return view('frontend.news')->with('articles', $articles)
                                    ->with('providers', $providers);
    }

    public function singleNew()
    {
        $article = DataQuery::getSingleArticle();
        $providers = DataQuery::getProvider();
        
        // dd($providers);
        return view('frontend.new_single')->with('article', $article)
                                        ->with('providers', $providers);
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function contact()
    {
        $providers = DataQuery::getProvider();
        $info = DataQuery::getInfo();
        return view('frontend.contact')->with('providers', $providers)
                                        ->with('info', $info);
    }

    public function sendMail()
    {
        $user = $this->validate(request(), [
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'content' => ''
        ]);
        $info = Info::first();

        Mail::send('emails.contact.contact-form', ['user' => $user, 'info' => $info], function ($m) use ($user, $info) {
            $m->from('hdpro1997@zohomail.com');

            $m->to('hdpro1997@zohomail.com')->cc($info->email)->subject('Contact Form');
        });

        Session::flash('success', 'Gửi mail thành công.');

        return redirect()->back();
    }

    public function search()
    {
        if(request()->get('query')){
            $products = Product::where('slug', 'like', '%' . str_slug(request()->get('query')) . '%')->paginate(12);
            return response($products, 200);
        } else {
            $products = Product::where('slug', 'like', '%' . str_slug(request()->search) . '%')->paginate(12);
        }


        $categories = ProductCategory::where('publish', 1)->get();
        $categoryRoot = DataQuery::getProductCategory()->where('parent_id', 0)->first();
        $providers = DataQuery::getProvider();

        return view('frontend.shop')
                        ->with('providers', $providers)
                        ->with('categories', $categories)
                        ->with('products', $products)
                        ->with('categoryRoot', $categoryRoot);
    }
    
}

class DataQuery{
    public static function getSingleProduct()
    {
        return Product::where('publish', 1)->where('slug', request()->slug)->first();
    }

    public static function getSingleCategory()
    {
        return ProductCategory::where('slug', request()->slug)->where('publish', 1)->first();
    }

    public static function getSingleArticle()
    {
        return Article::where('slug', request()->slug)->where('publish', 1)->first();
    }

    public static function getProvider()
    {
        return Provider::orderBy('sort_order', 'desc')->where('publish', 1)->get();
    }

    public static function getSlide()
    {
        return SlideShow::orderBy('sort_order', 'desc')->where('publish', 1)->get();
    }

    public static function getProductCategory()
    {
        return ProductCategory::where('publish', 1)->get(); 
    }

    public static function getArticle()
    {
        return Article::orderBy('sort_order', 'desc')->where('publish', 1)->get();
    }

    public static function getInfo()
    {
        return Info::first();
    }

    public static function setPaginate($items, $number)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($items);
        $perPage = $number;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $items = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $items->setPath(request()->url);
        return $items;
    }

    
}

