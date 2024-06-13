<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloodgroups = BloodGroup::all();
        if ($bloodgroups->count() == 0) {
            return response()->json([
                'message' => 'No Blood Group Found',
                'status' => 'error'
            ], 404);
        }
        else {
            return response()->json([
                'message' => 'Blood Group List',
                'data' => $bloodgroups,
                'status' => 'success'
                
            ], 200);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:blood_groups,name', 'max:3'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bloodgroup = new BloodGroup();
        $bloodgroup->name = $request->name;
        $bloodgroup->save();
        if ($bloodgroup) {
            return response()->json([
                'message' => 'Blood Group Added Successfully',
                'data' => $bloodgroup,
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
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
        $bloodgroup = BloodGroup::find($id);
        if ($bloodgroup) {
            return response()->json([
                'message' => 'BloodGroup Details',
                'data' => $bloodgroup,
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'BloodGroup Not Found',
                'status' => 'error'
            ], 404);
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
        $bloodgroup = BloodGroup::find($id);
        if ($bloodgroup) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:blood_groups,name', 'max:3'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $bloodgroup->name = $request->name;
            $bloodgroup->save();
            return response()->json([
                'message' => 'Blood Group Updated Successfully',
                'data' => $bloodgroup,
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Blood Group Not Found',
                'status' => 'error'
            ], 404);
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
        $bloodgroup = BloodGroup::find($id);
        if ($bloodgroup) {
            $bloodgroup->delete();
            return response()->json([
                'message' => 'Blood Group Deleted Successfully',
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Blood Group Not Found',
                'status' => 'error'
            ], 404);
        }
    }
}
