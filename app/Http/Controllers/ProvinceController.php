<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $province=Province::all();
       if($province->count()>0)
       {
        return response()->json([
            'message'=>'Province Details',
            'data'=>$province,
            'status'=>'success',
        ]);

       }
       else{
        return response()->json([
            'message'=>'Province Details Not Found',
            'status'=>'error',
        ]);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validator=Validator::make($request->all(),[
            'name'=>['required','unique:provinces,name','max:20'],

        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $province=new Province();
        $province->name=$request->name;
        $province->save();
        if($province)
        {
            return response()->json([
                'message'=>'Province Added Successfully',
                'data'=>$province,
                'status'=>'success'
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'Internal Server Error',
                'data'=>$province,
                'status'=>'error'
            ],200);
            
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
        $province=Province::find($id);
        if($province)
        {
            return response()->json([
                'message'=>'Province Details',
                'data'=>$province,
                'status'=>'success'

            ]);
        }
        else{
            return response()->json([
                'message'=>'Province Details Not Found',
                'status'=>'error',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        $validator=Validator::make($request->all(),[
            'name'=>['required','unique:provinces,name','max:20'],

        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $province=Province::find($id);
        if($province)
        {
            $province->name=$request->name;
            $province->save();
            return response()->json([
                'message'=>'Province Updated Successfully',
                'data'=>$province,
                'status'=>'success'
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'Province Not Found',
                'status'=>'error'
            ],404);
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
        $province=Province::find($id);
        if($province)
        {
            $province->delete();
            return response()->json([
                'message'=>'Province Deleted Successfully',
                'status'=>'success'
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'Province Not Found',
                'status'=>'error'
            ],404);
        }
    }
}
