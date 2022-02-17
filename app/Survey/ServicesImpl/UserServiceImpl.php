<?php

namespace App\Survey\ServicesImpl;

use App\Survey\Repositories\UserRepository;
use App\Survey\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    private $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    function login(Request $request)
    {
        $input = $request->only('email', 'password');

        $user = $this->repo->getByEmail($input['email']);

        if (empty($user) || !Hash::check($input['password'], $user->password)) {
            return [
                'status' => false,
                'code' => 422,
                'msg' => 'Invalid email or password!',
                'data' => [],
            ];
        }

        return [
            'status' => true,
            'data' => [
                'token' => $user->createToken('app')->plainTextToken,
            ],
            'msg' => 'Success',
            'code' => 200,
        ];
    }

    function register(Request $request)
    {
        $input = $request->only('email', 'password', 'name');
        return $this->repo->create($input);
    }
}
