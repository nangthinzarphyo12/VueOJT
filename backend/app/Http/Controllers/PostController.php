<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPost;
use App\Exports\ExportPost;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->postService->getAllPost();
        // return view('posts.index', ['posts' => $data])
        //     ->with('i', (request()->input('page', 1) - 1) * 5)
        //     ->with(['searchInfo' => '']);
        return response()->json($data);
    }

    public function get_my_token(){
        $token_me = Session::token();
        return $token_me;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Auth::check());
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }

        $data = $this->postService->insert($request);
        // return redirect()->route('postList')
        //     ->with('success', 'Post created successfully.');
        return response()->json('Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Post::with('comments.user')->where('id', $id)->first();
        $commentDetails = $detail->comments;
        $data = $this->postService->getPostById($id);
        // return view('posts.detail', ['post' => $data, 'commentDetails' => $commentDetails]);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->postService->getPostById($id);
        //return view('posts.edit', ['post' => $data]);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), 400);
        }
        $data = $this->postService->update($request);
        // return redirect()->route('posts.detail', $request->id)
        //     ->with('success', 'Post updated successfully');
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $data = $this->postService->delete($id);
        // return redirect()->route('postList')
        //     ->with('success', 'Post deleted successfully');
        return response()->json('Post deleted.');
    }

    public function search(Request $request)
    {
        $data = $this->postService->search($request);
        // return view('posts.index', ['posts' => $data])
        //     ->with(['searchInfo' => $request->searchInfo]);
        
        //$data = Post::all();
        // logger("------search------");
        // logger($data);
        return response()->json($data);
    }

    public function commentStore(Request $request, $postId)
    {
        $request->validate([
            'comment_text' => 'required|max:255',
        ]);
        $request['post_id'] = $postId;
        $data = $this->postService->insertComment($request);
        return redirect()->route('posts.detail', $request->post_id)
            ->with('success', 'Comment has been posted.');
    }

    public function exportCsv(Request $request){
        logger('form export csv controller');
         Excel::download(new ExportPost, 'posts.xlsx');
        return $data;
        // return response()->json('Post export complete.');
    }

    public function importCsv(Request $request){
        logger('form import csv controller');
        logger($request);
        $import = Excel::import(new ImportPost, $request->file('file')->store('files'));
        //return redirect()->back();
        return response()->json('Post import complete.');
    }

}
