<?php
namespace App\Contracts\Services;

interface PostServiceInterface{

    public function search(Request $request);
    
    public function getAllPost();

    public function insert(Request $request);

    public function getPostById($id);

    public function update(Request $request);

    public function delete($id);

    public function insertComment(Request $request);
    
}
?>