<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Task extends Model
{

    use SoftDeletes;

    

    public function saveTask(Request $request)
    {
        // $request オブジェクトから直接データを取得し、モデルのプロパティに割り当てる
        $this->title = !empty($request->input('title')) ? $request->input('title') : null;
        $this->content = !empty($request->input('content')) ? $request->input('content') : null;//内容
        $this->deadline_at = !empty($request->input('deadline_at')) ? $request->input('deadline_at') : null;//対応期限
        $this->support_at = !empty($request->input('support_at')) ? $request->input('support_at') : null;//対応日時
        $this->priority = !empty($request->input('priority')) ? $request->input('priority') : null;//優先度
        $this->status = !empty($request->input('status')) ? $request->input('status') : null;//ステータス
        /*$this->updated_at = $request->input('updated_at');//更新日時
        // published_at は nullable なので、空文字列の場合には null を設定
        $this->published_at = !empty($request->input('published_at')) ? $request->input('published_at') : null;
*/
        // 登録処理
        $this->save();
    }

}