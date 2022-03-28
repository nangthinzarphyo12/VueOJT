<?php

namespace App\Services;

use App\Models\User;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{   
    protected $userDao;
    
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function search($request)
    {
        return $this->userDao->search($request);
    }

    public function getAllUser()
    {
        return $this->userDao->getAllUser();
    }

    public function getUserById($id)
    {
        $data = $this->userDao->getUserById($id);
        return $data;
    }

    public function insert($request)
    {
        $encrypted = Hash::make($request->password);
        $insertData = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$encrypted,
            'phone'=>$request->phone,
        ];
        // $insertData['role'] = ($request->role == 0) ?  "admin" :  "member";
        $insertData['role'] = ($request->role == 0) ?  "member" :  "admin";
        return $this->userDao->insert($insertData);
    }

    public function update($request)
    {
        $updateData = [
            'id'=>$request->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ];
        // $updateData['role'] = ($request->role == 0) ?  "admin" :  "member";
        $updateData['role'] = ($request->role == 0) ?  "member" :  "admin";
        return $this->userDao->update($updateData);
    }

    public function updatePassword($request)
    {
        $encrypted = Hash::make($request->password);
        $updateData = [
            'id'=>$request->id,
            'password'=>$encrypted
        ];
        return $this->userDao->update($updateData);
    }

    public function delete($id)
    {
        return $this->userDao->delete($id);
    }

}