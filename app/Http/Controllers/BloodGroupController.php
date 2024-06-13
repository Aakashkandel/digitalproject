<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodGroupController extends Controller
{
    public function index()
    {
        try {
            $bloodgroups = BloodGroup::all();
            if ($bloodgroups->count() == 0) {
                return response()->json([
                    'message' => 'No Blood Group Found',
                    'status' => 'error'
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Blood Group List',
                    'data' => $bloodgroups,
                    'status' => 'success'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:blood_groups,name', 'max:3'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $bloodgroup = new BloodGroup();
            $bloodgroup->name = $request->name;
            $bloodgroup->save();

            return response()->json([
                'message' => 'Blood Group Added Successfully',
                'data' => $bloodgroup,
                'status' => 'success'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error'
            ], 500);
        }
    }
}
