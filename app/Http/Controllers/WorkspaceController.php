<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workspaces = Workspace::where('user_id' , Auth::user()->id)->get();
        return view('workspace.index')->with([
            'workspaces' => $workspaces,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workspace.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string' , 'max:100', function($attribute,$value,$fail) use ($request){
                    //get user id
                $user_id = Auth::user()->id;
                $workspaceExists = Workspace::where([
                    'title' => $request->title,
                    'user_id' => $user_id,
                ])->exists();

                if($workspaceExists){
                    $fail("The title has already been taken");
                }
            }],
        ]);


        //store in the database
        $w = new Workspace();
        $w->title = $validated['title'];
        $w->description = $request->description;
        $w->user_id = Auth::user()->id;
        $w->save();

        return to_route("workspace.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        //check whether there's a billing quota set for the workspace
        $workspace->cost  = 0;
        foreach($workspace->tokens as $key => $t){
            foreach($t->service_usages as $su){
                $workspace->cost += ($su->usage_duration / 1000) * $su->service->cost_per_second;
            }
        }
        if($workspace->billing_quota_limit){
//            If a quota is set, the costs and the maximum of the current calendar month are shown.
//            Also, the number of remaining days in the current billing cycle is shown so users know
//              when it will reset.
            $workspace->remaining_days = Carbon::now()->diff(Carbon::now()->endOfMonth())->d;
        }
        return view('workspace.show')->with([
            'workspace' => $workspace,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace)
    {
        return view('workspace.edit')->with([
            'workspace' => $workspace,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workspace $workspace)
    {
        $validated = $request->validate([
            'title' => ['required', 'string' , 'max:100'],
        ]);
        //store in the database
        $workspace->title = $validated['title'];
        $workspace->description = $request->description;
        $workspace->user_id = Auth::user()->id;
        $workspace->save();

        return to_route("workspace.index");
    }
    public function updateQuota(Workspace $workspace, Request $request){
        $workspace->billing_quota_limit = $request->limit;
        $workspace->save();

        return to_route("workspace.show", $workspace);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->billing_quota_limit = null;
        $workspace->save();

        return to_route("workspace.show", $workspace);
    }


    public function showBill(Workspace $workspace){
        return view('workspace.bill')->with([
            'workspace' => $workspace,
        ]);
    }
}
