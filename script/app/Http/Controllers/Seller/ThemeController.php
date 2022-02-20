<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Template;
use App\Domain;
use Cache;
class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Template::latest()->paginate(20);
        $active_theme=Domain::where('user_id',Auth::id())->first();
        return view('seller.store.theme',compact('posts','active_theme'));
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

        $domain_id=Auth::user()->domain_id;
        Domain::where('id',$domain_id)->update(['template_id'=>$id]);
       
        Cache::forget(get_host());
       \Session::flash('success', 'Theme activated successfully');
        return back();
    }

    
}
