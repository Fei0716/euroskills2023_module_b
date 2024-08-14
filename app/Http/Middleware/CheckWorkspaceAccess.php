<?php

namespace App\Http\Middleware;

use App\Models\Workspace;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckWorkspaceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check whether the user is redirecting to his workspace
        $workspaces = Workspace::where([
            'user_id' => Auth::user()->id,
        ])->pluck('id')->toArray();

        if($request->is('workspace/*')){
            //get the workspace id
            $workspace_id = is_string($request->workspace) ? $request->workspace : $request->workspace->id;
            if(!in_array($workspace_id , $workspaces)){
                return abort(404);
            }
        }
        return $next($request);
    }
}
