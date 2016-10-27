<?php namespace App\Http\Middleware;

// First copy this file into your middleware directoy
use Closure;

class CheckRole
{

    protected $redirectPath = '/';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.

        $user = \Auth::user();
        if (!$user) {
            return redirect($this->redirectPath);
        }
        if ($user->hasRole($roles) || !$roles) {
//            dd($user);
            return $next($request);
        }
        return redirect($this->redirectPath)->withErrors(["Permission" => "You don't have permission to access."]);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}