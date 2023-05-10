<?php

namespace App\Repositories;

use App\Interfaces\PeopleInterface;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeopleRepository implements PeopleInterface
{
    public function listPeople(Request $request)
    {
        $limit  = $request->limit ? $request->limit : 20;
        $page   = $request->page && $request->page > 0 ? $request->page : 1;
        $offset = ($page - 1) * $limit;

        $posts = People::get()->slice($offset, $limit);

        $response['code']    = 200;
        $response['status']  = true;
        $response['message'] = 'Success';
        $response['data']    = $posts->toArray();

        return $response;
    }

    public function savePeople(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama'       => ['required'],
        ]);

        if ($validate->fails()) {
            $response['code']    = 422;
            $response['status']  = false;
            $response['data']    = [];
            $response['message'] = 'Failed';
            $response['error']   = $validate->errors();

            return response()->json($response, 422);
        }

        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(10, 10)
            . mt_rand(10, 10)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $code = str_shuffle($pin);

        DB::beginTransaction();
        try {
            $data = People::create([
                'kode'          => $code,
                'nama'          => $request->nama,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)) ?? null,
                'created_by'    => 'admin',
            ]);

            // created data history
            $response['code']    = 200;
            $response['status']  = true;
            $response['message'] = 'Success';
            $response['error']   = [];
            $response['data']    = $data;
            DB::commit();
        } catch (\Throwable $th) {
            $response['code']    = 500;
            $response['status']  = true;
            $response['message'] = 'Failed';
            $response['error']   = $th->getMessage();
            $response['data']    = [];
            DB::rollBack();
        }

        return $response;
    }

    public function updatePeople(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama'       => ['required'],
        ]);

        if ($validate->fails()) {
            $response['code']    = 422;
            $response['status']  = false;
            $response['data']    = [];
            $response['message'] = 'Failed';
            $response['error']   = $validate->errors();

            return response()->json($response, 422);
        }

        DB::beginTransaction();
        try {
            $data = People::where('id', $id)->update([
                'nama'          => $request->nama,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)) ?? null,
            ]);

            // created data history
            $response['code']    = 200;
            $response['status']  = true;
            $response['message'] = 'Success';
            $response['error']   = [];
            $response['data']    = $data;
            DB::commit();
        } catch (\Throwable $th) {
            $response['code']    = 500;
            $response['status']  = true;
            $response['message'] = 'Failed';
            $response['error']   = $th->getMessage();
            $response['data']    = [];
            DB::rollBack();
        }

        return $response;
    }

    public function deletePeople($id)
    {
        DB::beginTransaction();
        try {
            People::where('id', $id)->delete();

            // created data history
            $response['code']    = 200;
            $response['status']  = true;
            $response['message'] = 'Success';
            $response['error']   = [];
            $response['data']    = [];
            DB::commit();
        } catch (\Throwable $th) {
            $response['code']    = 500;
            $response['status']  = true;
            $response['message'] = 'Failed';
            $response['error']   = $th->getMessage();
            $response['data']    = [];
            DB::rollBack();
        }

        return $response;
    }

    public function showPeople($id)
    {
        $people = People::where('id', $id)->first();
        if (empty($people)) {
            $response['code']    = 404;
            $response['status']  = true;
            $response['message'] = 'Failed';
            $response['data']    = new \stdClass();
        }

        $response['code']    = 200;
        $response['status']  = true;
        $response['message'] = 'Success';
        $response['data']    = $people->toArray() ?? [];

        return $response;
    }

    public function findPeople($name)
    {
        $people = People::where('nama', 'LIKE', "%{$name}%")->get();

        $response['code']    = 200;
        $response['status']  = true;
        $response['message'] = 'Success';
        $response['data']    = $people ?? [];

        return $response;
    }
}
