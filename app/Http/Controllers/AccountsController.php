<?php

namespace App\Http\Controllers;

use App\Models\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller{

    protected $indexAuthDataCount = 10;

    public function index($page = 1){
        $pageCount = ceil(AuthData::count()/$this->indexAuthDataCount);
        if($pageCount < $page)
            abort(404);
        $accounts = AuthData::skip(($page-1)*$this->indexAuthDataCount)->take($this->indexAuthDataCount)->get();
        return view('accounts', ['accounts' => $accounts, 'pageCount' => $pageCount, 'page' => $page]);
    }

    public function create(){

    }

    public function store(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'login' => 'bail|required|unique:auth_data,login|alpha_num|between:6,20',
            'password' => 'bail|required|alpha_num|between:10,30',
        ]);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()];
        try{
            $authData = new AuthData();
            $authData->add($data['login'], $data['password'], $data['role']);
            return ['status' => 1, 'message' => trans('addUser.success_admin')];
        }
        catch(Exception $exception){
            return ['status' => 0, 'errors' => ['Error' => trans('addUser.unknown_error')]];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
