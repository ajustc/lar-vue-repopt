<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PeopleInterface
{
    public function listPeople(Request $request);
    public function savePeople(Request $request);
    public function updatePeople(Request $request, $id);
    public function deletePeople($id);
    public function showPeople($id);
    public function findPeople($name);
}