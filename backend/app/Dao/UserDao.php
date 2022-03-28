<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;

class UserDao implements UserDaoInterface
{
    public function search($request)
    {
        $data = User::where('name', 'ILIKE', '%' . $request->searchInfo . '%')
            ->orWhere('email', 'ILIKE', '%' . $request->searchInfo . '%')
            ->orWhere('phone', 'ILIKE', '%' . $request->searchInfo . '%')
            ->orderBy('id')
            ->paginate(5)
            ->setpath('');
        $data->appends(array('searchInfo' => $request->searchInfo));
        return $data;
    }

    public function getAllUser()
    {
        $data = User::orderBy('id')->paginate(5);
        return $data;
    }

    public function getUserById($id)
    {
        $data = User::find($id);
        return $data;
    }

    public function insert($insertData)
    {
        User::create($insertData);
    }

    public function update($updateData)
    {
        User::whereId($updateData['id'])->update($updateData);
    }

    public function delete($id)
    {
        User::whereId($id)->delete();
    }
}
