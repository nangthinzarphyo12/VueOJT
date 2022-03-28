<?php
namespace App\Contracts\Dao;

interface UserDaoInterface{

    public function search(Request $request);
    
    public function getAllUser();

    public function insert(Request $insertData);

    public function getUserById($id);

    public function update(Request $updateData);

    public function delete($id);
    
}
?>