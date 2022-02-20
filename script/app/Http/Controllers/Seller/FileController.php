<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use App\Term;
use Auth;
class FileController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|max:255',
        ]);
        $info=Term::where('user_id',Auth::id())->findorFail($request->term);

        $file= new File;
        $file->term_id = $request->term;
        $file->url = $request->url;
        $file->save();

        return response()->json(['File Created Successfully']);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|max:255',
        ]);
        $info=Term::where('user_id',Auth::id())->findorFail($request->term);
        $id=$request->id;
        $file= File::find($id);
        $file->term_id = $request->term;
        $file->url = $request->url;
        $file->save();

        return response()->json(['File Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $requesr)
    {
        $id=base64_decode($requesr->a_id);
        File::destroy($id);
        return response()->json('File Removed');
    }
}
