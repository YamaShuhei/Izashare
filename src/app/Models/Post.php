<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    
    //ユーザーアソシエーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //commentsアソシエーション
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //csvインポート用
    public function csvHeader(): array
    {
        return [
            'id',
            'user_id',
            'title',
            'description',
            'created_at',
            'updated_at',
        ];
    }

    public function getCsvData(): \Illuminate\Support\Collection
    {
        $data = DB::table('posts')->get();
        return $data;
    }
    public function insertRow($row): array
    {
        return [
            $row->id,
            $row->user_id,
            $row->title,
            $row->description,
            $row->created_at,
            $row->updated_at,
        ];
    }

}
