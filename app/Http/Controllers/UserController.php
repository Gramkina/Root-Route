<?php

namespace App\Http\Controllers;

use App\Mail\InviteMail;
use App\Models\AuthData;
use App\Models\Invites;
use App\Models\UserData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{

    protected $indexUsersCount = 10;

    public function index($page = 1){
        $pageCount = ceil(UserData::count()/$this->indexUsersCount);
        if($pageCount < $page)
            abort(404);
        $users = UserData::skip(($page-1)*$this->indexUsersCount)->take($this->indexUsersCount)->get();
        return view('users', ['users' => $users, 'pageCount' => $pageCount, 'page' => $page]);
    }

    public function create(){
        return view('user_add');
    }

    public function store(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'bail|required|alpha|between:2,30',
            'surname' => 'bail|required|alpha|between:2,30',
            'patronymic' => 'bail|nullable|alpha|between:2,30',
            'department' => 'bail|required|between:2,50',
            'position' => 'bail|required|between:2,50',
            'email' => 'bail|required|email|unique:user_data,email',
        ]);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()];
        try{
            DB::transaction(function () use($data){
                $userData = new UserData();
                $userData->add($data['name'], $data['surname'], $data['patronymic'], $data['department'], $data['position'], $data['email'], $data['role']);
                $invite = new Invites();
                $invite->add($userData);
                Mail::to($data['email'])->queue((new InviteMail($invite->code))->onQueue('email'));
            });
            return ['status' => 1, 'message' => trans('addUser.success_user')];
        }
        catch(Exception $exception){
            return ['status' => 0, 'errors' => ['Error' => trans('addUser.unknown_error')]];
        }
    }

    public function show($id){
        $userData = UserData::where(['id' => $id])->firstOrFail();
        return view('userProfile', ['userData' => $userData]);
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

    public function registrationIndex(Invites $inviteCode){
        return view('registration', ['invite' => $inviteCode]);
    }

    public function registration(Request $request){
        $data = $request->all();

        $validation = Validator::make($data, [
            'invite' => 'bail|required|uuid|exists:invites,code',
            'login' => 'bail|required|between:6,20|alpha_num|unique:auth_data,login',
            'password' => 'bail|required|between:10,30|alpha_num|same:password_again',
        ]);

        if($validation->fails()){
            return ['status' => 0, 'errors' => $validation->errors()];
        }
        try {
            DB::transaction(function() use ($data) {
                $invite = Invites::where(['code' => $data['invite'], 'status' => 0])->firstOrFail();
                $invite->deactivate();
                /** @var UserData $userData */
                $userData = $invite->userData()->sole();
                $authData = new AuthData();
                $authData->add($data['login'], $data['password'], $userData->role);
                $userData->setAuthData($authData);
                Auth::login($authData);
            });
            return ['status' => 1, 'url' => route('navigation.home')];
        }
        catch (Exception $exception){
            return ['status' => 0, 'errors' => ['Ошибка на сервере']];
        }
    }
}
