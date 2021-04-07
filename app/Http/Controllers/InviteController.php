<?php

namespace App\Http\Controllers;

use App\Models\Invites;
use Illuminate\Http\Request;

class InviteController extends Controller{

    protected $indexInvitesCount = 10;

    public function index($page = 1){
        $pageCount = ceil(Invites::count()/$this->indexInvitesCount);
        if($pageCount < $page)
            abort(404);
        $invites = Invites::skip(($page-1)*$this->indexInvitesCount)->take($this->indexInvitesCount)->get();;
        return view('invites', ['invites' => $invites, 'pageCount' => $pageCount, 'page' => $page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function show(Invites $invites){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function edit(Invites $invites){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invites $invites){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invites  $invites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invites $invites){
        $invites->delete();
    }
}
