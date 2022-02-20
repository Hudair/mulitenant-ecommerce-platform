<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Categorymeta;
use Auth;
use Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Category::where('user_id',Auth::id())->where('type','category')->with('preview')->latest()->paginate(20);
        return view('seller.category.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $limit=user_limit();
         $posts_count=\App\Category::where('user_id',Auth::id())->where('type','category')->count();
         if ($limit['category_limit'] <= $posts_count) {
        
         $error['errors']['error']='Maximum category limit exceeded';
         return response()->json($error,401);
        }

         if ($limit['storage'] <= str_replace(',', '', folderSize('uploads/'.Auth::id()))) {
         \Session::flash('error', 'Maximum storage limit exceeded');
         $error['errors']['error']='Maximum storage limit exceeded';
         return response()->json($error,401);
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'file' => 'image|max:500',
        ]);

        $slug=Str::slug($request->name);
        
        $user_id=Auth::id();

        $category= new Category;
        $category->name=$request->name;
        $category->slug=$slug;
        if ($request->p_id) {
           $category->p_id=$request->p_id;
        }
       
        $category->featured=$request->featured;
        $category->menu_status=$request->menu_status;
        $category->user_id=$user_id;
        $category->save();

        if($request->file){

            $fileName = time().'.'.$request->file->extension();  
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;

            $meta= new Categorymeta;
            $meta->category_id =$category->id;
            $meta->type="preview";
            $meta->content=$name;
            $meta->save();

        }

        return response()->json(['Category Created']);
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
        $info= Category::where('user_id',Auth::id())->findOrFail($id);
        return view('seller.category.edit',compact('info'));
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'file' => 'image|max:500',
        ]);
        $user_id=Auth::id();

        $category= Category::where('user_id',$user_id)->with('preview')->findOrFail($id);
        $category->name=$request->name;
       
        if ($request->p_id) {
           $category->p_id=$request->p_id;
        }
        else{
            $category->p_id=null;
        }
       
        $category->featured=$request->featured;
        $category->menu_status=$request->menu_status;
        $category->save();

        if($request->file){
            $limit=user_limit();
            if ($limit['storage'] <= str_replace(',', '', folderSize('uploads/'.Auth::id()))) {
               \Session::flash('error', 'Maximum storage limit exceeded');
               $error['errors']['error']='Maximum storage limit exceeded';
               return response()->json($error,401);
            }

            if(!empty($category->preview)){
                if(file_exists($category->preview->content)){
                    unlink($category->preview->content);
                }
            }

            $fileName = time().'.'.$request->file->extension();  
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;
            $meta =  Categorymeta::where('category_id',$category->id)->where('type','preview')->first();
            if (empty($meta)){
              $meta= new Categorymeta;  
            }
            
            $meta->category_id =$category->id;
            $meta->type="preview";
            $meta->content=$name;
            $meta->save();

        }

        return response()->json(['Category Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->type=='delete') {
            foreach ($request->ids as $key => $row) {
                $id=base64_decode($row);
                $category= Category::where('user_id',Auth::id())->where('id',$id)->with('preview')->first();
                if (!empty($category->preview)) {
                    if (!empty($category->preview->content)) {
                        if (file_exists($category->preview->content)) {
                            unlink($category->preview->content);
                        }
                    }
                }
                $category->delete();
            }
        }

        return response()->json(['Category Deleted']);
    }
}
