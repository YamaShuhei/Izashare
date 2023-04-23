<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

    //csvインポート・エクスポート
    public function csvHeader(): array
    {
        return [
            'id',
            'user_id',
            'title',
            'description',
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
        ];
    }

}
