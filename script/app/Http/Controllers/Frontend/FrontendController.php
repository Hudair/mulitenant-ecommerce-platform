<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;
use App\Category;
use App\Attribute;
use App\Getway;
use App\Models\Review;
use Cache;
use Session;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Useroption;
use URL;
use App\Option;
use App\Plan;
use Auth;
class FrontendController extends Controller
{

    public $cats;
    public $attrs;

    public function index(Request $request)
    {

         $url=$request->getHost();
         $url=str_replace('www.','',$url);
        
        if (url('/') == env('APP_URL') || $url == 'localhost') {
           $seo=Option::where('key','seo')->first();
        $seo=json_decode($seo->value);

       JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
       JsonLdMulti::setDescription($seo->description ?? null);
       JsonLdMulti::addImage(asset('uploads/logo.png'));

       SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
       SEOMeta::setDescription($seo->description ?? null);
       SEOMeta::addKeyword($seo->tags ?? null);

       SEOTools::setTitle($seo->title ?? env('APP_NAME'));
       SEOTools::setDescription($seo->description ?? null);
       SEOTools::setCanonical($seo->canonical ?? url('/'));
       SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
       SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
       SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
       SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
       SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));


      $latest_gallery=Category::where('type','gallery')->with('preview')->where('is_admin',1)->latest()->take(15)->get();
      $features=Category::where('type','features')->with('preview','excerpt')->where('is_admin',1)->latest()->get(); 
      
      $testimonials=Category::where('type','testimonial')->with('excerpt')->where('is_admin',1)->latest()->get(); 

      $brands=Category::where('type','brand')->with('preview')->where('is_admin',1)->latest()->get(); 

      $plans=Plan::where('status',1)->get();
      $header=Option::where('key','header')->first();
      $header=json_decode($header->value ?? '');

      $about_1=Option::where('key','about_1')->first();
      $about_1=json_decode($about_1->value ?? '');
       
      $about_2=Option::where('key','about_2')->first();
      $about_2=json_decode($about_2->value ?? '');

      $about_3=Option::where('key','about_3')->first();
      $about_3=json_decode($about_3->value ?? '');

      $ecom_features=Option::where('key','ecom_features')->first();
      $ecom_features=json_decode($ecom_features->value ?? '');

      $counter_area=Option::where('key','counter_area')->first();
      $counter_area=json_decode($counter_area->value ?? '');

      return view('welcome',compact('latest_gallery','plans','features','header','about_1','about_3','about_2','testimonials','brands','ecom_features','counter_area'));
        }
      
        if($url==env('APP_PROTOCOLESS_URL')){
          return redirect('/check');
        }

    	 if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
       }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
       }
       JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
       JsonLdMulti::setDescription($seo->description ?? null);
       JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

       SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
       SEOMeta::setDescription($seo->description ?? null);
       SEOMeta::addKeyword($seo->tags ?? null);

       SEOTools::setTitle($seo->title ?? env('APP_NAME'));
       SEOTools::setDescription($seo->description ?? null);
       SEOTools::setCanonical($seo->canonical ?? url('/'));
       SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
       SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
       SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
       SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
       SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

    	 return view(base_view().'.index');
    }

    public function page()
    {
      $id=request()->route()->parameter('id');
      $info=Term::where('user_id',domain_info('user_id'))->where('type','page')->with('excerpt','content')->findorFail($id);
      JsonLdMulti::setTitle($info->title ?? env('APP_NAME'));
      JsonLdMulti::setDescription($info->excerpt->value ?? null);
      JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

      SEOMeta::setTitle($info->title ?? env('APP_NAME'));
      SEOMeta::setDescription($info->excerpt->value ?? null);
     
      SEOTools::setTitle($info->title ?? env('APP_NAME'));
      SEOTools::setDescription($info->excerpt->value ?? null);
      SEOTools::setCanonical(url('/'));
      SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
      SEOTools::twitter()->setTitle($info->title ?? env('APP_NAME'));
      SEOTools::twitter()->setSite($info->title ?? null);
      SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));



      return view(base_view().'.page',compact('info'));
    }

    public function sitemap(){
      if(!file_exists('uploads/'.domain_info('user_id').'/sitemap.xml')){
        abort(404);
      }
      return response(file_get_contents('uploads/'.domain_info('user_id').'/sitemap.xml'), 200, [
        'Content-Type' => 'application/xml'
      ]);
    }


    public function shop(Request $request)
    {
       if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
       }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
       }
       if(!empty($seo)){
         JsonLdMulti::setTitle('Shop - '.$seo->title ?? env('APP_NAME'));
         JsonLdMulti::setDescription($seo->description ?? null);
         JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

         SEOMeta::setTitle('Shop - '.$seo->title ?? env('APP_NAME'));
         SEOMeta::setDescription($seo->description ?? null);
         SEOMeta::addKeyword($seo->tags ?? null);

         SEOTools::setTitle('Shop - '.$seo->title ?? env('APP_NAME'));
         SEOTools::setDescription($seo->description ?? null);
         SEOTools::setCanonical($seo->canonical ?? url('/'));
         SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
         SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
         SEOTools::twitter()->setTitle('Shop - '.$seo->title ?? env('APP_NAME'));
         SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
         SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));
       }     


      $src=$request->src ?? null;
    	return view(base_view().'.shop',compact('src'));
    }

    public function cart(){
       \Cart::setGlobalTax(tax());
        if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
       }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
       }
       if(!empty($seo)){
        JsonLdMulti::setTitle('Cart - '.$seo->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

        SEOMeta::setTitle('Cart - '.$seo->title ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('Cart - '.$seo->title ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
        SEOTools::twitter()->setTitle('Cart - '.$seo->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));
       }
       
      return view(base_view().'.cart');
    }

    public function wishlist(){
       if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
       }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
       }
       if(!empty($seo)){
        JsonLdMulti::setTitle('Wishlist - '.$seo->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

        SEOMeta::setTitle('Wishlist - '.$seo->title ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('Wishlist - '.$seo->title ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
        SEOTools::twitter()->setTitle('Wishlist - '.$seo->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));
       }
       
     
      return view(base_view().'.wishlist');
    }

    public function thanks(){
       if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
       }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
       }
        if(!empty($seo)){
       JsonLdMulti::setTitle('Thank you - '.$seo->title ?? env('APP_NAME'));
       JsonLdMulti::setDescription($seo->description ?? null);
       JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

       SEOMeta::setTitle('Thank you - '.$seo->title ?? env('APP_NAME'));
       SEOMeta::setDescription($seo->description ?? null);
       SEOMeta::addKeyword($seo->tags ?? null);

       SEOTools::setTitle('Thank you - '.$seo->title ?? env('APP_NAME'));
       SEOTools::setDescription($seo->description ?? null);
       SEOTools::setCanonical($seo->canonical ?? url('/'));
       SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
       SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
       SEOTools::twitter()->setTitle('Thank you - '.$seo->title ?? env('APP_NAME'));
       SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
       SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));
       }
      return view(base_view().'.thanks');
    }
    public function make_local(Request $request){
        
         Session::put('locale',$request->lang);
        \App::setlocale($request->lang);

        return redirect('/');
    }  

    public function checkout(){
      if(Auth::check() == true){
        Auth::logout();
      }
       \Cart::setGlobalTax(tax());


        if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
        }
       else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
        }
         if(!empty($seo)){
       JsonLdMulti::setTitle('Checkout - '.$seo->title ?? env('APP_NAME'));
       JsonLdMulti::setDescription($seo->description ?? null);
       JsonLdMulti::addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));

       SEOMeta::setTitle('Checkout - '.$seo->title ?? env('APP_NAME'));
       SEOMeta::setDescription($seo->description ?? null);
       SEOMeta::addKeyword($seo->tags ?? null);

       SEOTools::setTitle('Checkout - '.$seo->title ?? env('APP_NAME'));
       SEOTools::setDescription($seo->description ?? null);
       SEOTools::setCanonical($seo->canonical ?? url('/'));
       SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
       SEOTools::opengraph()->addProperty('image', asset('uploads/'.domain_info('user_id').'/logo.png'));
       SEOTools::twitter()->setTitle('Checkout - '.$seo->title ?? env('APP_NAME'));
       SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
       SEOTools::jsonLd()->addImage(asset('uploads/'.domain_info('user_id').'/logo.png'));
       }

      $shop_type=domain_info('shop_type');
      $user_id=domain_info('user_id');
      if($shop_type==1){
        $locations= Category::where('user_id',$user_id)->where('type','city')->with('child_relation')->get();
      }
      else{
        $locations=[];
      }
      
     
      $getways=  Getway::where('user_id',$user_id)->where('status',1)->get();

      
      return view(base_view().'.checkout',compact('locations','getways'));
    }

    public function wishlist_remove(){
      $id=request()->route()->parameter('id');
    } 

    public function detail($slug,$id)
    {
      $id=request()->route()->parameter('id');
      $user_id=domain_info('user_id');


      $info=Term::where('user_id',$user_id)->where('type','product')->where('status',1)->with('affiliate','medias','content','categories','brands','seo','price','options','stock')->findorFail($id);
      $next = Term::where('user_id',$user_id)->where('type','product')->where('status',1)->where('id', '>', $id)->first();
      $previous = Term::where('user_id',$user_id)->where('type','product')->where('status',1)->where('id', '<', $id)->first();

     $variations = collect($info->attributes)->groupBy(function($q){
      return $q->attribute->name;
     });

    
    
     $content=json_decode($info->content->value);
     $seo=json_decode($info->seo->value ?? '');

     SEOMeta::setTitle($seo->meta_title ?? $info->title);
     SEOMeta::setDescription($seo->meta_description ?? $content->excerpt ?? null);
     SEOMeta::addMeta('article:published_time', $info->updated_at->format('Y-m-d'), 'property');
     SEOMeta::addKeyword([$seo->meta_keyword ?? null ]);

     OpenGraph::setDescription($seo->meta_description ?? $content->excerpt ?? null);
     OpenGraph::setTitle($seo->meta_title ?? $info->title);
     OpenGraph::addProperty('type', 'product');
      
     foreach($info->medias as $row){
      OpenGraph::addImage(asset($row->url));
      JsonLdMulti::addImage(asset($row->url));
      JsonLd::addImage(asset($row->url));
     }  
     
    
     JsonLd::setTitle($seo->meta_title ?? $info->title);
     JsonLd::setDescription($seo->meta_description ?? $content->excerpt ?? null);
     JsonLd::setType('Product');
    
     JsonLdMulti::setTitle($seo->meta_title ?? $info->title);
     JsonLdMulti::setDescription($seo->meta_description ?? $content->excerpt ?? null);
     JsonLdMulti::setType('Product');

     

     return view(base_view().'.details',compact('info','next','previous','variations','content'));
    }

    public function category($id)
    {
    	$id=request()->route()->parameter('id');
      $user_id=domain_info('user_id');
      $info=Category::where('user_id',$user_id)->where('type','category')->with('preview')->findorFail($id);

      if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
      }
      else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
      }

      JsonLdMulti::setTitle($info->name ?? env('APP_NAME'));
      JsonLdMulti::setDescription($seo->description ?? null);
      JsonLdMulti::addImage(asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));

      SEOMeta::setTitle($info->name ?? env('APP_NAME'));
      SEOMeta::setDescription($seo->description ?? null);
      SEOMeta::addKeyword($seo->tags ?? null);

      SEOTools::setTitle($info->name ?? env('APP_NAME'));
      SEOTools::setDescription($seo->description ?? null);
      SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
      SEOTools::opengraph()->addProperty('image', asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));
      SEOTools::twitter()->setTitle($info->name ?? env('APP_NAME'));
      SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
      SEOTools::jsonLd()->addImage(asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));



      return view(base_view().'.shop',compact('info'));
    }


    public function home_page_products(Request $request)
    {
      if($request->latest_product){
        if($request->latest_product == 1){
          $data['get_latest_products']= $this->get_latest_products();
        }
        else{
          $data['get_latest_products']= $this->get_latest_products($request->latest_product);
        }
      }

      if($request->random_product){
        if ($request->random_product == 1) {
           $data['get_random_products']= $this->get_random_products();
        }
        else{
           $data['get_random_products']= $this->get_random_products($request->random_product);
        }
         
      }
      if($request->get_offerable_products){
        if ($request->get_offerable_products == 1) {
           $data['get_offerable_products']= $this->get_offerable_products();
        }
        else{
           $data['get_offerable_products']= $this->get_offerable_products($request->random_product);
        }
         
      }

      if($request->trending_products){
        if($request->trending_products == 1){
          $data['get_trending_products'] = $this->get_trending_products();
        }
        else{
          $data['get_trending_products'] = $this->get_trending_products($request->trending_products);
        }
           
      }

      if($request->best_selling_product){
        if($request->best_selling_product == 1){
         $data['get_best_selling_product']= $this->get_best_selling_product();
        }
        else{
          $data['get_best_selling_product']= $this->get_best_selling_product($request->best_selling_product);
        }
      }

      if($request->sliders){
        $data['sliders'] = $this->get_slider();
      }

      if($request->menu_category){
        $data['get_menu_category'] = $this->get_menu_category();
      }

      if($request->bump_adds){
        $data['bump_adds']=$this->get_bump_adds();
      }

      if($request->banner_adds){
        $data['banner_adds']=$this->get_banner_adds();
      } 

      if($request->featured_category){
        $data['featured_category']=$this->get_featured_category();
      }   

      if($request->featured_brand){
        $data['featured_brand']=$this->get_featured_brand();
      }

      if($request->category_with_product){
        $data['category_with_product']=$this->get_category_with_product();
      } 

      if($request->brand_with_product){
        $data['brand_with_product']=$this->get_brand_with_product();
      }   
      
      
      
      
      return response()->json($data);

    }

    public  function get_slider(){
       $user_id=domain_info('user_id');
     return  Category::where('type','slider')->with('excerpt')->where('user_id',$user_id)->latest()->get()->map(function($q){
         $data['slider']=asset($q->name);
         $data['url']=$q->slug;
         $data['meta']=json_decode($q->excerpt->content ?? '');

        return $data;
       });
    }

    public function get_menu_category(){
       $user_id=domain_info('user_id');
      return $data=Category::where('type','category')->where('user_id',$user_id)->where('menu_status',1)->get()->map(function($q){
        $data['id']=$q->id;
        $data['name']=$q->name;
        $data['slug']=$q->slug;
        return $data;
      });
    }


    public function brand($id)
    {
      $id=request()->route()->parameter('id');
      $user_id=domain_info('user_id');
      $info=Category::where('user_id',$user_id)->where('type','brand')->with('preview')->findorFail($id);

      if(Cache::has(domain_info('user_id').'seo')){
        $seo=json_decode(Cache::get(domain_info('user_id').'seo'));
      }
      else{
        $data=Useroption::where('user_id',domain_info('user_id'))->where('key','seo')->first();
        $seo=json_decode($data->value ?? '');
      }

      JsonLdMulti::setTitle($info->name ?? env('APP_NAME'));
      JsonLdMulti::setDescription($seo->description ?? null);
      JsonLdMulti::addImage(asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));

      SEOMeta::setTitle($info->name ?? env('APP_NAME'));
      SEOMeta::setDescription($seo->description ?? null);
      SEOMeta::addKeyword($seo->tags ?? null);

      SEOTools::setTitle($info->name ?? env('APP_NAME'));
      SEOTools::setDescription($seo->description ?? null);
      SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
      SEOTools::opengraph()->addProperty('image', asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));
      SEOTools::twitter()->setTitle($info->name ?? env('APP_NAME'));
      SEOTools::twitter()->setSite($info->name ?? null);
      SEOTools::jsonLd()->addImage(asset($info->preview->content ?? 'uploads/'.domain_info('user_id').'/logo.png'));

      return view(base_view().'.shop',compact('info'));
      
    }

    public function get_featured_attributes()
    {
      $user_id=domain_info('user_id');
      $posts=Category::where('user_id',$user_id)->where('type','parent_attribute')->where('featured',1)->with('featured_child_with_post_count_attribute')->get();

      return $posts;
    }

    public function get_ralated_product_with_latest_post(Request $request){
    	$user_id=domain_info('user_id');

    	$this->cats=$request->categories ?? [];
    	$avg=Review::where('term_id',$request->term)->avg('rating');
    	$ratting_count=Review::where('term_id',$request->term)->count();
    	$avg=(int)$avg;
    	$related=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->whereHas('post_categories',function($q){
            $q->whereIn('category_id',$this->cats);
        })->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->latest()->take(20)->get();

    	 $get_latest_products=  $this->get_latest_products();
    	 $data['get_latest_products']=$get_latest_products;
    	 $data['get_related_products']=$related;
    	 $data['ratting_count']=$ratting_count;
    	 $data['ratting_avg']=$avg;

    	 return response()->json($data);
    }

    public function get_reviews($id){
    	$user_id=domain_info('user_id');
    	$id=request()->route()->parameter('id');
    	$reviews=Review::where('term_id',$id)->where('user_id',$user_id)->latest()->paginate(12);
    	$data=[];
    	foreach($reviews as $review){
    		$dta['rating']=$review->rating;
    		$dta['name']=$review->name;
    		$dta['comment']=$review->comment;
    		$dta['created_at']=$review->created_at->diffForHumans();
    		array_push($data,$dta);
    	}
    	$revi['data']=$data;
    	$revi['links']=$reviews;
    	
    	return response()->json($revi);
    }


    public function get_ralated_products(Request $request)
    {
      $user_id=domain_info('user_id');

      $this->cats=$request->cats;

      $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->whereHas('post_categories',function($q){
        $q->whereIn('category_id',$this->cats);
      })->with('preview','attributes','category','price','options','stock','affiliate')->latest()->paginate(30);

      return response()->json($posts);
    }

    public function product_search(Request $request)
    {
      $user_id=domain_info('user_id');
      $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->where('title','LIKE','%'.$request->src.'%')->with('preview','attributes','category','price','options','stock','affiliate')->latest()->paginate(30);
      return response()->json($posts);
    }

    public function get_featured_category()
    {
      $user_id=domain_info('user_id');
      $posts=Category::where('user_id',$user_id)->where('type','category')->with('preview')->where('featured',1)->latest()->get()->map(function($q){
        $data['id']=$q->id;
        $data['name']=$q->name;
        $data['slug']=$q->slug;
        $data['type']=$q->type;
        $data['preview']=asset($q->preview->content ?? 'uploads/default.png');
        return $data;
      });

      return $posts;
    }

    public function get_featured_brand()
    {
      $user_id=domain_info('user_id');
      $posts=Category::where('user_id',$user_id)->where('type','brand')->with('preview')->where('featured',1)->latest()->get()->map(function($q){
        $data['id']=$q->id;
        $data['name']=$q->name;
        $data['slug']=$q->slug;
        $data['type']=$q->type;
        $data['preview']=asset($q->preview->content ?? 'uploads/default.png');
        return $data;
      });
      return $posts;
    }

    public function get_category()
    {
      $user_id=domain_info('user_id');
     return $posts=Category::where('user_id',$user_id)->where('type','category')->withCount('posts')->latest()->get();

      
    }

    public function get_brand()
    {
      $user_id=domain_info('user_id');
      return $posts=Category::where('user_id',$user_id)->where('type','brand')->withCount('posts')->latest()->get();

      
    }

    public function get_products(Request $request)
    {
      $user_id=domain_info('user_id');
      $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->latest()->paginate(30);
       return response()->json($posts);
    }
    public function get_offerable_products($limit=20)
    {
      $user_id=domain_info('user_id');
      $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->with('preview','attributes','category','price','options','stock','affiliate')->whereHas('price',function($q){
        return $q->where('ending_date','>=',date('Y-m-d'))->where('starting_date','<=',date('Y-m-d'));
      })->withCount('reviews')->inRandomOrder()->take(20)->get();
       return $posts;
    }


    public function get_latest_products($limit=20)
    {
       $user_id=domain_info('user_id');
       $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->latest()->take($limit)->get();
       return $posts;

    } 

    public function max_price(){
      $user_id=domain_info('user_id');
     return Attribute::where('user_id',$user_id)->max('price');
     
    }

    public function min_price(){
      $user_id=domain_info('user_id');
     return Attribute::where('user_id',$user_id)->min('price');
     
    }

    public function get_bump_adds(){
      $user_id=domain_info('user_id');
      return Category::where('user_id',$user_id)->where('type','offer_ads')->latest()->get()->map(function($q){
        $data['image']=asset($q->name);
        $data['url']=$q->slug;
        return $data;
      });
     
    }
    public function get_banner_adds(){
      $user_id=domain_info('user_id');
      return Category::where('user_id',$user_id)->where('type','banner_ads')->get()->map(function($q){
        $data['image']=asset($q->name);
        $data['url']=$q->slug;
        return $data;
      });
    }


    public function get_shop_attributes(){
      $data['categories']=$this->get_category();
      $data['brands']=$this->get_brand();
      $data['attributes']=$this->get_featured_attributes();
      return $data;
    }


    public function get_shop_products(Request $request)
    {
     
        if($request->order=='DESC' || $request->order=='ASC'){
          $order=$request->order;
        }
        else{
          $order='DESC';
        }
        if($request->order=='bast_sell'){
          $featured=2;
        }
        elseif($request->order=='trending'){
          $featured=1;
        }
        else{
          $featured=0;
        }

       $user_id=domain_info('user_id');
       $this->attrs = $request->attrs ?? [];
       $this->cats=$request->categories ?? [];

       $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews');

       if(!empty($request->term)){
        $data= $posts->where('title','LIKE','%'.$request->term.'%');
       }

       if(count($this->attrs) > 0){
        $data= $posts->whereHas('attributes_relation',function($q){
             return $q->whereIn('variation_id',$this->attrs);
           });
       }

       if(!empty($request->min_price)){
         $min_price=$request->min_price;
        $data=$posts->whereHas('price',function($q) use ($min_price){
          return $q->where('price','>=',$min_price);
        }); 

       }

       if(!empty($request->max_price)){
        $max_price=$request->max_price;
        $data=$posts->whereHas('price',function($q) use ($max_price){
         return $q->where('price','<=',$max_price);
       }); 
      }

       if(count($this->cats) > 0){
        $data= $posts->whereHas('post_categories',function($q){
             return $q->whereIn('category_id',$this->cats);
           });
       }

       if($featured != 0){
        $data= $posts->orderBy('featured','DESC');
       }
       else{
        $data= $posts->orderBy('id',$order);
       }

       $data= $data ?? $posts;
       $data=$data->paginate($request->limit ?? 18);
       return response()->json($data);    
              
    }

    public function get_random_products($limit=20)
    {
       $limit=request()->route()->parameter('limit') ?? 20;
       $user_id=domain_info('user_id');
       $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->inRandomOrder()->take($limit)->get();
       return $posts;
    }

    public function get_trending_products($limit=20)
    {
       $user_id=domain_info('user_id');
       $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->where('featured',1)->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->latest()->take($limit)->get();
       return $posts;
    }

    public function get_best_selling_product($limit=20)
    {
       $user_id=domain_info('user_id');
       $posts=Term::where('user_id',$user_id)->where('status',1)->where('type','product')->where('featured',2)->with('preview','attributes','category','price','options','stock','affiliate')->withCount('reviews')->latest()->take($limit)->get();
       return $posts;
    }

    public function get_category_with_product($limit=10)
    {
      $limit=request()->route()->parameter('limit');
      $user_id=domain_info('user_id');
      $posts=Category::where('user_id',$user_id)->where('type','category')->with('take_20_product')->take($limit)->get();

      return $posts;
    }

    public function get_brand_with_product($limit=10)
    {

      $limit=request()->route()->parameter('limit');

      $user_id=domain_info('user_id');
      $posts=Category::where('user_id',$user_id)->where('type','brand')->with('take_20_product')->take($limit)->get();

      return $posts;
    }
}
