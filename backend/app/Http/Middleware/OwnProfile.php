<?php

namespace App\Http\Middleware;

use App\Contracts\Services\UserServiceInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class OwnProfile

{
    protected $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        if (Auth::user()->role == 'member') {
            $data = $this->userService->getUserById($request->id);
            if (Auth::user()->id == $data->id) {
                return $next($request);
            } else {
                return response(view('404'));
            }
        } else if (Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            return redirect('login');
        }
    }
}
