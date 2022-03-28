<?php
namespace App\Contracts\Services;

interface UserServiceInterface{

    public function search(Request $request);

    public function getAllUser();

    public function insert(Request $request);

    public function getUserById($id);

    public function update(Request $request);

    public function updatePassword(Request $request);

    public function delete($id);

}
?>