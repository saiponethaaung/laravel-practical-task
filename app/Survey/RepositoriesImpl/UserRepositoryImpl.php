<?php

namespace App\Survey\RepositoriesImpl;

use DB;

use App\Models\User;
use App\Survey\Repositories\UserRepository;

class UserRepositoryImpl implements UserRepository
{
    function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    function create($input)
    {
        $res = [
            'status' => true,
            'msg' => 'Success',
            'code' => 201,
            'data' => [],
        ];

        DB::beginTransaction();

        try {
            $res['data'] = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $res['status'] = 'false';
            $res['code'] = 422;
            $res['msg'] = 'Failed to create user!';

            if (config('app.debug')) {
                $res['error']['msg'] = $e->getMessage();
                $res['error']['stack'] = $e->getTrace();
            }

            return $res;
        }

        DB::commit();
        return $res;
    }
}
