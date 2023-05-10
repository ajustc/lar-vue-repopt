<?php

namespace App\Http\Controllers;

use App\Repositories\PeopleRepository;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    protected $peopleRepository;
    public function __construct(PeopleRepository $peopleRepository)
    {
        $this->peopleRepository = $peopleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->peopleRepository->listPeople($request);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->peopleRepository->savePeople($request);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->peopleRepository->showPeople($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->peopleRepository->updatePeople($request, $id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->peopleRepository->deletePeople($id);
        return response()->json($data);
    }

    /**
     * Find the specified name from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function find($name)
    {
        $data = $this->peopleRepository->findPeople($name);
        return response()->json($data);
    }
}
