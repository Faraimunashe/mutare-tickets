<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $issues = Issue::join('allocateds', 'allocateds.issue_id', '=', 'issues.id')
        ->select('issues.id', 'issues.title', 'issues.description', 'issues.status', 'issues.long', 'issues.lat', 'issues.created_at', 'issues.user_id')
        ->where('allocateds.user_id', Auth::id())
        ->orderBy('issues.created_at', 'desc')
        ->paginate(10);
        if(isset($request->status))
        {
            $issues = Issue::join('allocateds', 'allocateds.issue_id', '=', 'issues.id')
            ->select('issues.id', 'issues.title', 'issues.description', 'issues.status', 'issues.long', 'issues.lat', 'issues.created_at', 'issues.user_id')
            ->where('allocateds.user_id', Auth::id())
            ->where('issues.status', $request->status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        return view('artisan.issues', [
            'issues' => $issues
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

        return view('artisan.show-issue', [
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
