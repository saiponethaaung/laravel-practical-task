<?php

namespace App\Survey\Repositories;

interface SurveyRepository
{
    public function getOne($id);

    public function getAll();

    public function create($input);

    public function addAnswer($id, $input);
}
