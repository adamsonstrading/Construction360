<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Display a listing of incoming contact queries.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        
        $dbQuery = ContactQuery::orderBy('created_at', 'desc');
        
        if ($status && in_array($status, ['new', 'reviewed', 'archived'])) {
            $dbQuery->where('status', $status);
        }

        $queries = $dbQuery->paginate(15);

        return view('admin.queries', compact('queries', 'status'));
    }

    /**
     * Update the status of a specific inquiry.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,reviewed,archived',
        ]);

        $query = ContactQuery::findOrFail($id);
        $query->status = $validated['status'];
        $query->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Query status updated successfully.',
                'status' => $query->status,
            ]);
        }

        return redirect()->back()->with('success', 'Query status updated successfully.');
    }
}
