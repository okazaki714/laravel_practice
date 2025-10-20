<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Post extends Model
{
    //論理削除済みのデータを取得対象から除外
    use SoftDeletes;

    public function savePost(Request $request)
    {
        // $request オブジェクトから直接データを取得し、モデルのプロパティに割り当てる
        $this->title = $request->input('title');
        $this->body = $request->input('body');
        
        // published_at は nullable なので、空文字列の場合には null を設定
        $this->published_at = !empty($request->input('published_at')) ? $request->input('published_at') : null;

        // 登録処理
        $this->save();
    }
}
