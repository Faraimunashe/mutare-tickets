<?php

namespace App\Http\Controllers\User;

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
        $issues = Issue::where("user_id", Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        if(isset($request->status))
        {
            $issues = Issue::where("user_id", Auth::id())
            ->where('status', $request->status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }
        return view('user.issues', [
            'issues' => $issues
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create-issue');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['required','string'],
            'description' => ['required','string'],
            'coordinates' => ['required','string']
        ]);
        try{
            $coordinates = explode(',', $request->coordinates);

            $lat = $coordinates[0];
            $long = $coordinates[1];

            $issue = new Issue();
            $issue->title = $request->title;
            $issue->description = $request->description;
            $issue->user_id = Auth::id();
            $issue->lat = $lat;
            $issue->long = $long;
            $issue->save();

            return redirect()->back()->with('success','Faulty/issue was reported successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $issue = Issue::find($id);
        $threads = Thread::where('issue_id', $issue->id)->get();
        return view('user.show-issue', [
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
