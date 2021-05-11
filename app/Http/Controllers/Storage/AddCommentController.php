<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddCommentController extends Controller{
    use SharedMethodStorage;

    public function __invoke(Request $request){
        $fileHashName = $request['file_hash_name'];
        $commentString = $request['comment'];

        /* Validation */
        $validation = Validator::make($request->all(), $this->validationRule);
        if($validation->fails())
            return ['status' => 0, 'errors' => $validation->errors()->first()];

        try{
            $file = Files::getFileByHashName($fileHashName);
            $comment = new Comment();
            $comment->add($file, $commentString);
            return ['status' => 1, 'url' => $request->header('referer')];
        }
        catch (\Exception $exception) {
            return ['status' => 0, 'errors' => 'Ошибка на сервере'];
        }
    }

    private $validationRule = [
        'comment' => 'bail|required',
        'file_hash_name' => 'bail|required',
    ];

}
