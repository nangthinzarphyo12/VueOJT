<?php
namespace App\Contracts\Dao;

interface PostDaoInterface{

    public function search(Request $request);
    
    public function getAllPost();

    public function insert(Request $insertData);

    public function getPostById($id);

    public function update(Request $updateData);

    public function delete($id);

    public function insertComment(Request $request);

}
?>