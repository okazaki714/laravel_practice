<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Authファサードを使用する場合

class TaskController extends Controller
{
    //ダッシュボード表示用メソッド
    public function dashboard()
    {
        // status が 2 以下のタスクだけ取得
        $tasks = Task::where('status', '<=', 2)->get();
        $loginUserId = auth()->id();

        return view('dashboard', compact('tasks', 'loginUserId'));
    }

    public function index()
    {
        $loginUserId = auth()->id();

        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks', 'loginUserId'));
    }

     public function show($id)
    {
        // 指定IDの記事を取得。見つからなければ404エラー
        $task = Task::findOrFail($id);

        // ビューに記事データを渡して表示
        return view('admin.tasks.show', compact('task'));
    }
    
    public function create()
    {
    return view('admin.tasks.input');
    }

     public function store(Request $request)
    {
        // バリデーション
        $validator = $this->validateTask($request);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            // リダイレクト先を admin.posts.create ルートに変更
            return redirect(route('admin.tasks.create')) 
                ->withErrors($validator) // エラーメッセージをセッションに保存
                ->withInput(); // 直前に入力されたデータをセッションに保存
        }

        // Postモデルのカスタムメソッドを使ってデータを保存
        $task = new Task();
        // $request オブジェクトを直接 savePost メソッドに渡す
        $task->saveTask($request); 
        
        // Post::Create([]);

        // /admin/posts にリダイレクトする（既に定義済みの記事一覧ページなどへ）
        // 成功メッセージをセッションにフラッシュデータとして保存
        return redirect(route('admin.tasks.index'))->with('success', 'タスクが正常に投稿されました。');
    }

     public function edit($id)
    {
        // 指定IDの記事を取得。見つからなければ404エラー
        $task = Task::findOrFail($id);
        
        // 新規作成時と同じビュー ('posts.create') を再利用し、記事データを渡す
        return view('admin.tasks.input', compact('task'));
    } 

    public function update(Request $request, $id)
    {
        // バリデーション (新規作成時と同じ validateTask メソッドを再利用)
        $validator = $this->validateTask($request);

        // バリデーションに失敗した場合
        if ($validator->fails()) {
            // 編集フォームのルートにリダイレクト
            return redirect(route('admin.tasks.edit', $id))
                ->withErrors($validator) // エラーメッセージをセッションに保存
                ->withInput(); // 直前に入力されたデータをセッションに保存
        }

        // 更新対象の記事を取得
        $task = Task::findOrFail($id);

        // Postモデルのカスタムメソッドを使ってデータを更新
        // savePost メソッドは、既存のインスタンスに対して呼び出すことで更新処理を行う
        $task->saveTask($request);

        // 記事一覧ページへリダイレクトし、成功メッセージを表示
        return redirect(route('admin.tasks.index'))->with('success', '記事が正常に更新されました。');
    }

        public function destroy($id)
    {
        // 削除対象の記事を取得。見つからなければ404エラー
        $task = Task::findOrFail($id);

        // 論理削除を実行
        $task->delete(); // SoftDeletesトレイトを使用していれば、deleted_atカラムが更新される

        // 記事一覧ページへリダイレクトし、成功メッセージを表示
        return redirect(route('admin.tasks.index'))->with('success', '記事が正常に削除されました。');
    }
    
    protected function validateTask(Request $request)
    {
        $rules = [
            'title' => 'required|max:100',
            'content' => 'required|max:1000',
            'user_id'  => 'required' ,
            'deadline_at' => 'required|date_format:Y-m-d\TH:i', // HTMLのdatetime-local形式に対応
            'support_at' => 'nullable|date_format:Y-m-d\TH:i', // HTMLのdatetime-local形式に対応
        ];

        $messages = [
            'title.required' => ':attributeは必須項目です。',
            'title.max' => ':attributeは:max文字以内で入力してください。',
            'content.required' => ':attributeは必須項目です。',
            'content.max' => ':attributeは:max文字以内で入力してください。',
            'user_id.required' => ':attributeは必須項目です。',
            'deadline_at.required' => ':attributeは必須項目です。',
            'deadline_at.date_format' => ':attributeは正しい日時形式で入力してください。',
            'support_at.date_format' => ':attributeは正しい日時形式で入力してください。',
        ];

        $attributes = [   //attrbuteはlalavelの機能の一つ。（便利な変数みたいな感じ）ここでは複数形で書かれているが、上のように中のものを単数として呼び出せる
            'title' => 'タイトル',
            'content' => '内容',
            'user_id' => '担当者',
            'deadline_at' => '対応期限',
            'support_at' => '対応日時',
        ];

        return Validator::make($request->all(), $rules, $messages, $attributes);
    }
}