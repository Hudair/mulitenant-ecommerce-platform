<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use Str;
use App\Models\Userplanmeta;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Category::where('user_id',Auth::id())->where('type','city')->latest()->paginate(20);
        return view('seller.shipping.location.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('seller.shipping.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan=user_limit();
        
        $count=Category::where('user_id',Auth::id())->where('type','city')->count();
        $limit=$plan['location_limit'];
        if($limit <= $count){
           $msg='Maximum Location Exceeded Please Update Your Plan';
           $error['errors']['error']=$msg;
           return response()->json($error,401);
           
        }  

       $validatedData = $request->validate([
        'title' => 'required|max:50',
       ]);
       $post = new Category;
       $post->name=$request->title;
       $post->user_id =Auth::id();
       $post->slug=Str::slug($request->title);
       $post->type="city";
       $post->save();

       return response()->json(['Location Created Successfully']);
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info=Category::where('user_id',Auth::id())->findorFail($id);
        return view('seller.shipping.location.edit',compact('info'));
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
       $validatedData = $request->validate([
        'title' => 'required|max:50',
       ]);
       $post = Category::where('user_id',Auth::id())->findorFail($id);
       $post->name=$request->title;
       $post->save();

       return response()->json(['Location Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $auth_id=Auth::id();
        if ($request->method=='delete') {
           foreach ($request->ids as $key => $id) {
               $post = Category::where('user_id',$auth_id)->findorFail($id);
               $post->delete();
           }
        }

        return response()->json(['Success']);
    }
}
