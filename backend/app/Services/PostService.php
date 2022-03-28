<?php

namespace App\Services;

use App\Models\Post;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;
use Illuminate\Support\Facades\Auth;

class PostService implements PostServiceInterface
{   
    protected $postDao;
    
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    public function search($request)
    {
        return $this->postDao->search($request);
    }

    public function getAllPost()
    {
        
        return $this->postDao->getAllPost();
    }

    public function insert($request)
    {      
        $insertData = [
            'title'=>$request->title,
            'description'=>$request->description,
            // 'created_by'=>Auth::user()->id
            'created_by'=>$request->created_by
        ];
        $insertData['public_flag'] = ($request->public_flag == null) ?  0 :  1;
        return $this->postDao->insert($insertData);
    }

    public function getPostById($id)
    {
        return $this->postDao->getPostById($id);
    }

    public function update($request)
    {
        $updateData = [
            'id'=>$request->id,
            'title'=>$request->title,
            'description'=>$request->description,
            'public_flag'=>$request->public_flag,
            'updated_by'=>$request->updated_by
        ];
        //$updateData['public_flag'] = ($request->public_flag == null) ?  0 :  1;
        return $this->postDao->update($updateData);
    }

    public function delete($id)
    {
        return $this->postDao->delete($id);
    }

    public function insertComment($request)
    {    
        $request['user_id'] = Auth::user()->id;
        return $this->postDao->insertComment($request);
    }

}