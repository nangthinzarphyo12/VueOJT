<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->userService->getAllUser();
        // return view('users.index', ['users' => $data])
        //     ->with('i', (request()->input('page', 1) - 1) * 5)
        //     ->with(['searchInfo' => '']);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|confirmed|min:8|max:255',
        //     'password_confirmation' => 'required|min:8|max:255',
        //     'phone' => 'max:255',
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
            'phone' => 'max:255',
        ]);

        if ($validator->fails()) {  
            return response()->json($validator->messages(), 400);
        }

        $data = $this->userService->insert($request);
        // return redirect()->route('users.list')
        //     ->with('success', 'User created successfully.');
        return response()->json('User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $commentsInfo = User::with('comments')->where('id', $id)->first();
        // $comments = $commentsInfo->comments;
        $data = $this->userService->getUserById($id);
        return response()->json($data);
        // return view('users.detail', ['user' => $data, 'comments' => $comments])
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('users.edit', ['user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|max:255|unique:users,email,' . $request->id,
        // ]);
        logger($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
        ]);
        if ($validator->fails()) {  
            return response()->json($validator->messages(), 400);
        }

        $data = $this->userService->update($request);
        // return redirect()->route('users.detail', $request->id)
        //     ->with('success', 'User updated successfully');
        return response()->json('User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->userService->delete($id);
        // return redirect()->route('users.list')
        //     ->with('success', 'User deleted successfully');
        return response()->json('Post deleted.');
    }

    public function showProfile($id)
    {
        $data = $this->userService->getUserById($id);
        return view('auth.profileDetail', ['user' => $data]);
    }

    public function passwordEdit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('auth.passwordEdit', ['user' => $data]);
    }

    public function profileEdit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('auth.profileEdit', ['user' => $data]);
    }

    public function profileUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
        ]);

        $data = $this->userService->update($request);
        return redirect()->route('auth.profileDetail', $request->id)
            ->with('success', 'Profile updated successfully');
    }

    public function passwordUpdate(Request $request, User $user)
    {
        logger('controller p update');
        logger( $request);
        $request->validate([
            'password' => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
        ]);
        $data = $this->userService->updatePassword($request);
        // return redirect()->route('auth.profileDetail', $request->id)
        //     ->with('success', 'Password updated successfully');
        return response()->json($data);
    }

    public function search(Request $request)
    {
        $data = $this->userService->search($request);

        // return view('users.index', ['users' => $data])
        //     ->with('i', (request()->input('page', 1) - 1) * 5)
        //     ->with(['searchInfo' => $request->searchInfo]);
        return response()->json($data);
    }

    public function getUserByEmail(Request $request){
        $user = User::where('email',$request->email)->first();
        return response()->json($user);
    }
}
