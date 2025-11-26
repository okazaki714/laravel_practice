<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            タスク詳細（ID: {{ $task->id }}）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">{{ $task->title }}</h3>
                    <div class="mt-4">
                        <strong>内容:</strong>
                        <p class="mt-2 whitespace-pre-line">{!! nl2br(e($task->content)) !!}</p>
                    </div>
                    <div><label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">担当者：</label>{!! nl2br(e($task->user->name)) !!}</div>
                    <p class="mb-2">対応期限: {{ $task->deadline_at ? (new \Carbon\Carbon($task->deadline_at ))->format('Y-m-d H:i:s') : '未定' }}</p>                  
                    <div><label for="support_at" class="block text-gray-700 text-sm font-bold mb-2">対応日時：{{ $task->support_at ? (new \Carbon\Carbon($task->support_at ))->format('Y-m-d H:i:s') : '未定' }}</label></div>
                    <div><label for="priority" class="block text-gray-700 text-sm font-bold mb-2">優先度：</label>{{ config('const.task.priority')[$task->priority] ?? '不明' }}</div>
                    <div><label for="status" class="block text-gray-700 text-sm font-bold mb-2">ステータス：</label>{{ config('const.task.status')[$task->status] ?? '不明' }}</div>
                    <div><label for="created_at" class="block text-gray-700 text-sm font-bold mb-2">作成日時：{{ $task->created_at ? (new \Carbon\Carbon($task->created_at ))->format('Y-m-d H:i:s') : '未定' }}</label></div>
                    <div><label for="updated_at" class="block text-gray-700 text-sm font-bold mb-2">更新日時：{{ $task->updated_at ? (new \Carbon\Carbon($task->updated_at ))->format('Y-m-d H:i:s') : '未定' }}</label></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>