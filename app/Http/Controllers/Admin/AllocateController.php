<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allocated;
use Illuminate\Http\Request;

class AllocateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'issue_id' => ['required','integer'],
            'artisan_id' => ['required','integer'],
        ]);

        try{
            $allocated = Allocated::where('issue_id', $request->issue_id)->first();
            if(!is_null($allocated)){
                $allocated->user_id = $request->artisan_id;
                $allocated->save();
            }else{
                $allocated = new Allocated();
                $allocated->user_id = $request->artisan_id;
                $allocated->issue_id = $request->issue_id;
                $allocated->save();
            }

            return redirect()->back()->with('success','Faulty/issue was successfully allocated to an artisan');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
