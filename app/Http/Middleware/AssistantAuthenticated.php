<?php

namespace Ignite\Http\Middleware;

use Closure;
use Ignite\User;

class AssistantAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAssistant()) {
            
            if( (strpos($request->path(), 'edit' ) !== false && strpos( $request->path(), 'asi/users/' ) !== false) || $request->route()->getName() == 'users.destroy') {
                $id = $request->route('user');
                $user = User::find($id);
                if (!$user->isAdmin()){
                    return $next($request);
                } else
                    abort(404, 'Pagina no encontrada');
            } else
                return $next($request);

        }else if(auth()->check()){
            return redirect('/' . strtolower(auth()->user()->userType->id));
        }

        return redirect('/login');
    }
}
