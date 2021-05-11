<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;

class CommentsIndexController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request, Files $file){
        $comments = $file->getComments()->get();
        return view('storage.comments', ['file' => $file, 'comments' => $comments]);
    }
}
