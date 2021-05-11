<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string comment
 * @property UserData user
 */

class Comment extends Model{
    use HasFactory;

    protected $table = 'comments';

    /**
     * @param Files $file
     * @param string $comment
     * @param Comment $answer
     */
    public function add($file, $comment, $answer = null){
        $this->comment = $comment;
        $this->getFile()->associate($file);
        $this->getUserData()->associate(UserData::getUserDataCurrentUser());
        if($answer)
            $this->getAnswerComment()->associate($answer);
        $this->save();
    }

    public function getUserData(){
        return $this->belongsTo(UserData::class, 'user', 'id');
    }
    public function getFile(){
        return $this->belongsTo(Files::class, 'file', 'id');
    }
    public function getAnswerComment(){
        return $this->belongsTo(Comment::class, 'answer', 'id');
    }
}
