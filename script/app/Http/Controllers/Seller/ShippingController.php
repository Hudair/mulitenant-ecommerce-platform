<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Categoryrelation;
use Auth;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Category::where('type','method')->where('user_id',Auth::id())->paginate(20);
         return view('seller.shipping.method.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.shipping.method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'title' => 'required|max:50',
        'price' => 'required|max:50',
        'locations' => 'required',
       
       ]);

       $post = new Category;
       $post->name=$request->title;
       $post->user_id =Auth::id();
       $post->slug=$request->price;
       $post->type="method";
       $post->save();

       $arr=[];
       foreach ($request->locations as $key => $row) {
           $data['category_id']=$post->id;
           $data['relation_id']=$row;
           array_push($arr, $data);
       }
       Categoryrelation::insert($arr);

       return response()->json(['Method Created Successfully']);

    }

    public function show($id)
    {
       $info=Category::where('user_id',Auth::id())->with('child_relation')->findorFail($id);
       return response()->json($info->child_relation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
      $info=Category::where('user_id',Auth::id())->with('parent_relation')->findorFail($id);
      $data=[];

      foreach ($info->parent_relation as $key => $row) {
          array_push($data, $row->relation_id);
      }

      return view('seller.shipping.method.edit',compact('info','data'));
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
        'price' => 'required|max:50',
        'locations' => 'required',
       
       ]);

       $post = Category::where('user_id',Auth::id())->findorFail($id);
       $post->name=$request->title;
       $post->slug=$request->price;
       $post->save();

       $arr=[];
       foreach ($request->locations as $key => $row) {
           $data['category_id']=$post->id;
           $data['relation_id']=$row;
           array_push($arr, $data);
       }
       Categoryrelation::where('category_id',$id)->delete();
       Categoryrelation::insert($arr);

       return response()->json(['Method Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

        return response()->json(['Shipping Method Deleted']);
    }
}
