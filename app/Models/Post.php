<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' ,
        'comment' ,
        'user_id',
    ];
    //リレーション設定（１つの投稿に対して１人のユーザであることを意味する）belongsToのsは忘れずに実装すること‼️
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    //投稿視点から見て、「いろんなユーザーにいいねされてるな〜、さいこ〜」
    public function likers(){
        return $this->belongsToMany(User::class, 'likes');
    } 
    //この投稿はこのユーザーによって「いいね」されていますか？
    public function isLikedBy(User $user)
    {
        return $this->likers()->where('user_id', $user->id)->exists();
    }
}
