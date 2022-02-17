<?php

namespace App\Survey\Repositories;

interface UserRepository
{
    function getByEmail($email);

    function create($input);
}
