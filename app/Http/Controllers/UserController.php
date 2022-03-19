<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new BaseApi)->index('/user');
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

        // handle jika request API nya gagal
        // diblade nanti bisa ditambahkan toast alert
        if ($response->failed()) {
            // $response->json agar response dari API bisa di akses sebagai array
            $errors = $response->json('data');

            foreach ($errors as $key => $msg) {
                $messages = "$key : $msg";
            }

            return redirect()->route('user.index')->with('error', $messages);
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = (new BaseApi)->detail('/user', $id);
        return view('user.edit', ['user' => $response]);
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
        $payload = [
            'firstName' => $request->input('first_name'),
            'lastName' => $request->input('last_name'),
        ];

        $response = (new BaseApi)->update('/user', $id, $payload);
        if ($response->failed()) {
            // $response->json agar response dari API bisa di akses sebagai array
            $errors = $response->json('data');
            foreach ($errors as $key => $msg) {
                $messages = "$key : $msg";
            }

            return redirect()->route('user.index')->with('error', $messages);
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = (new BaseApi)->delete('/user', $id);

        if ($response->failed()) {
            // $response->json agar response dari API bisa di akses sebagai array
            $errors = $response->json('data');
            foreach ($errors as $key => $msg) {
                $messages = "$key : $msg";
            }

            return redirect()->route('user.index')->with('error', $messages);
        }

    return redirect()->route('user.index')->with('successDelete', 'Data berhasil dihapus');
    }
}
