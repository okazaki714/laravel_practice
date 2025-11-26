

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- ここからタスク表示領域 --}}
                    @if ($tasks->isNotEmpty())
                        <ul>
                            @foreach ($tasks as $val)
                                @if ($loginUserId == $val->user_id && $val->status <= 2)
                                    <li>{{ $val->deadline_at }} - {{ $val->title }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p>現在、該当するタスクはありません。</p>
                    @endif
                    
                    {{-- ここまでタスク表示領域 --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
