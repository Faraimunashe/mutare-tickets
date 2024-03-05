<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $issues = Issue::orderBy('created_at', 'desc')->paginate(10);
        if(isset($request->status))
        {
            $issues = Issue::where('status', $request->status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }


        $artisans = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_id', 2)
            ->get();

        return view('admin.issues', [
            'issues' => $issues,
            'artisans' => $artisans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $issue = Issue::find($id);
        $threads = Thread::where('issue_id', $issue->id)->get();

        return view('admin.show-issue', [
            'issue'=> $issue,
            'threads'=> $threads
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
