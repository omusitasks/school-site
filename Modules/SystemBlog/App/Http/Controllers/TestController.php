<?php

namespace Modules\SystemBlog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Helpers\DbHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller{
    public function index()
    {
        $BlogInfo = DB::table('par_blogs')->get();
        return response()->json($BlogInfo);
    }

    public function show($id)
    {
        $BlogInfo = DB::table('par_blogs')->find($id);

        if (!$BlogInfo) {
            return response()->json(['message' => 'Blog record not found'], 404);
        }

        return response()->json($BlogInfo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:par_blogs|max:255',
            'description' => 'nullable|max:250',
            'code' => 'nullable|max:150',
            'currency_symbol' => 'nullable|max:150',
            // store method parameters
            // timestamp fields
            'created_by' => 'required|max:255',
            'created_on' => now(), // Manually set the created_on timestamp
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $BlogInfoId = DB::table('par_blogs')->insertGetId([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'code' => $request->input('code'),
            "currency_symbol" => $request->input('currency_symbol'),

            // store method parameters
            // timestamp fields
            'created_by'  => $request->input('created_by'),
            'created_on' => now(), // Manually set the created_on timestamp
        ]);

        // Audit trail logic for creation
        $auditTrailData = [
            'table_name' => 'par_blogs',
            'table_action' => 'insert',
            'current_tabledata' => json_encode($BlogInfoId),
            'user_id' => $BlogInfoId, // Assuming 'id' is the Currency's ID field
        ];

        DbHelper::auditTrail(
            $auditTrailData['table_name'],
            $auditTrailData['table_action'],
            null, // No previous data for a new record
            $auditTrailData['current_tabledata'],
            $auditTrailData['user_id']
        );

        return response()->json([
            'message' => 'Blog record created successfully',
            'data' => $BlogInfoId
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $BlogInfo = DB::table('par_blogs')->find($id);

        if (!$BlogInfo) {
            return response()->json(['message' => 'Blog record not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:par_blogs,name,' . $id,
            'description' => 'nullable|max:250',
            'code' => 'nullable|max:150',
            'currency_symbol' => 'nullable|max:150',
            // store method parameters
            // timestamp fields
            'updated_by' => 'nullable|max:255',
            'updated_on' => now(), // Manually set the created_on timestamp
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $previousData = (array)$BlogInfo;

        DB::table('par_blogs')->where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'code' => $request->input('code'),
            "currency_symbol" => $request->input('currency_symbol'),
            // store method parameters
            // timestamp fields
            'updated_by' => $request->input('updated_by'),
            'updated_on' => now(), // Manually set the created_on timestamp
        ]);

        // Audit trail logic for update
        $updatedBlogInfo = DB::table('par_blogs')->find($id);

        $auditTrailData = [
            'table_name' => 'par_blogs',
            'table_action' => 'update',
            'prev_tabledata' => json_encode($previousData),
            'current_tabledata' => json_encode($updatedBlogInfo),
            'user_id' => $id,
        ];

        DbHelper::auditTrail(
            $auditTrailData['table_name'],
            $auditTrailData['table_action'],
            $auditTrailData['prev_tabledata'],
            $auditTrailData['current_tabledata'],
            $auditTrailData['user_id']
        );

        return response()->json([
            'message' => 'Blog record updated successfully',
            'data' => $updatedBlogInfo
        ], 200);
    }

    public function destroy($id)
    {
        $BlogInfo = DB::table('par_blogs')->find($id);

        if (!$BlogInfo) {
            return response()->json(['message' => 'Blog record not found'], 404);
        }

        // Audit trail logic for deletion
        $previousData = (array)$BlogInfo;

        $auditTrailData = [
            'table_name' => 'par_blogs',
            'table_action' => 'delete',
            'prev_tabledata' => json_encode($previousData),
            'current_tabledata' => null,
            'user_id' => $id,
        ];

        DbHelper::auditTrail(
            $auditTrailData['table_name'],
            $auditTrailData['table_action'],
            $auditTrailData['prev_tabledata'],
            $auditTrailData['current_tabledata'],
            $auditTrailData['user_id']
        );

        DB::table('par_blogs')->where('id', $id)->delete();

        return response()->json(['message' => 'Blog record deleted successfully'], 200);
    }
}























































