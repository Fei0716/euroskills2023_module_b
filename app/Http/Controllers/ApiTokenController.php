<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
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
    public function create(Workspace $workspace)
    {
        return view('token.create')->with([
            'workspace' => $workspace
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Workspace $workspace , Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|max:100'
        ]);

        $token = Hash::make($validated['name']);

        $t = new ApiToken();
        $t->name = $validated['name'];
        $t->token = $token;
        $t->workspace_id = $workspace->id;
        $t->save();

        return back()->with([
            'success' => 'New Token: '. $token,
        ]);
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
    public function destroy(Workspace $workspace, ApiToken $token)
    {
        //revoke the token
        $token->deleted_at = now();
        $token->save();

        return to_route("workspace.show" , $workspace);
    }
}
