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
        $this->user_id = !empty($request->input('user_id')) ? $request->input('user_id') : null;//内容
        // 登録処理
        $this->save();
    }

    //tasks.user_id と users.idを紐づけ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}