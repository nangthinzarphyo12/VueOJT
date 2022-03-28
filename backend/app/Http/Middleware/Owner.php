<?php

namespace App\Http\Middleware;

use App\Contracts\Services\PostServiceInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class Owner
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;

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
            $data = $this->postService->getPostById($request->id);
            if (Auth::user()->id == $data->created_by) {
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
