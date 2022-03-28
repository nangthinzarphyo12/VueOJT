<?php

namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostDao implements PostDaoInterface
{
    public function search($request)
    {
        $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
        ->select('*', 'posts.id as id')
        ->where('title', 'ILIKE', '%' . $request->searchInfo . '%')
        ->orWhere('description', 'ILIKE', '%' . $request->searchInfo . '%')
        ->orWhere('name', 'ILIKE', '%' . $request->searchInfo . '%')
        ->orderBy('posts.updated_at', 'DESC')
        ->paginate(5);
        // if (Auth::check()) {
        //     $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
        //                 ->select('*', 'posts.id as id')
        //                 ->where('title', 'LIKE', '%' . $request->searchInfo . '%')
        //                 ->orWhere('description', 'LIKE', '%' . $request->searchInfo . '%')
        //                 ->orWhere('name', 'LIKE', '%' . $request->searchInfo . '%')
        //                 ->orderBy('posts.updated_at', 'DESC')
        //                 ->paginate(5)
        //                 ->setpath('');
        //     $data->appends(array('searchInfo' => $request->searchInfo));
        // } else {
        //     $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
        //                 ->select('*', 'posts.id as id')
        //                 ->where([
        //                     ['public_flag', '=', 1],
        //                     ['title', 'ILIKE', '%' . $request->searchInfo . '%'],
        //                 ])
        //                 ->orWhere([
        //                     ['public_flag', '=', 1],
        //                     ['description', 'ILIKE', '%' . $request->searchInfo . '%'],
        //                 ])
        //                 ->orWhere([
        //                     ['public_flag', '=', 1],
        //                     ['name', 'ILIKE', '%' . $request->searchInfo . '%'],
        //                 ])
        //                 ->orderBy('posts.updated_at', 'DESC')
        //                 ->paginate(5);
        //     //$data->appends(array('searchInfo' => $request->searchInfo));
        // }
        return $data;
    }

    public function getAllPost()
    {
        $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
                            ->select('*', 'posts.id as id')
                            ->orderBy('posts.updated_at', 'DESC')
                            ->paginate(5);
        // if (Auth::check()) {
        //         $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
        //                     ->select('*', 'posts.id as id')
        //                     ->orderBy('posts.updated_at', 'DESC')
        //                     ->paginate(5);
        // } else {
        //         $data = Post::leftJoin('users', 'users.id', 'posts.created_by')
        //                     ->select('*', 'posts.id as id')
        //                     ->where('public_flag', '=', 1)
        //                     ->orderBy('posts.updated_at', 'DESC')
        //                     ->paginate(5);
        // }
        return $data;
    }

    public function insert($insertData)
    {
        Post::create($insertData);
    }

    public function getPostById($id)
    {
        $data = Post::find($id);
        return $data;
    }

    public function update($updateData)
    {
        Post::whereId($updateData['id'])->update($updateData);
    }

    public function delete($id)
    {
        Post::whereId($id)->delete();
    }

    public function insertComment($request)
    {
        Comment::create($request->except('_token'));
    }
}
