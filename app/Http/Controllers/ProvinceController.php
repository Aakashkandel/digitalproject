<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index()
    {
        try {
            $province = Province::all();
            if ($province->count() > 0) {
                return response()->json([
                    'message' => 'Province Details',
                    'data' => $province,
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'Province Details Not Found',
                    'status' => 'error',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'unique:provinces,name', 'max:20'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $province = new Province();
            $province->name = $request->name;
            $province->save();

            return response()->json([
                'message' => 'Province Added Successfully',
                'data' => $province,
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $province = Province::find($id);
            if ($province) {
                return response()->json([
                    'message' => 'Province Details',
                    'data' => $province,
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'message' => 'Province Details Not Found',
                    'status' => 'error',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'unique:provinces,name', 'max:20'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $province = Province::find($id);
            if ($province) {
                $province->name = $request->name;
                $province->save();
                return response()->json([
                    'message' => 'Province Updated Successfully',
                    'data' => $province,
                    'status' => 'success',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Province Not Found',
                    'status' => 'error',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $province = Province::find($id);
            if ($province) {
                $province->delete();
                return response()->json([
                    'message' => 'Province Deleted Successfully',
                    'status' => 'success',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Province Not Found',
                    'status' => 'error',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'error',
            ], 500);
        }
    }
}
