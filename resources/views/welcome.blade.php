@extends("layouts.default")

@section("style") 
<!-- style specific for this page, e.g.: --> 
@endsection 
@section("content") 
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8"> 
    @if(session()->has("success"))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm" role="alert">
            <span class="font-medium">{{ session()->get("success") }}</span> 
        </div> 
    @endif
                
    @if(session()->has("error")) 
        <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm" role="alert"> 
            <span class="font-medium">{{ session()->get("error") }}</span> 
        </div>
    @endif
    
<section class="min-h-screen bg-gray-50 dark:bg-gray-900 py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
            Task List
        </h1>

        {{-- Flash message --}}
        @if(session('status'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($tasks as $task)
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white dark:bg-gray-800 rounded-lg shadow px-4 py-3 border border-gray-200 dark:border-gray-700">

                {{-- Task info --}}
                <div class="flex flex-col">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $task->name }}
                    </span>

                    <span class="text-sm text-gray-500 dark:text-gray-300">
                        Due: {{ \Carbon\Carbon::parse($task->due_at)->format('d.m.Y H:i') }}
                    </span>
                </div>

                {{-- Actions --}}
                <div class="mt-3 sm:mt-0 flex items-center gap-3">

                    {{-- Completed toggle --}}
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button 
                            type="submit" 
                            class="h-6 w-6 flex items-center justify-center rounded-full border text-green-600 border-green-500 hover:bg-green-100 dark:hover:bg-green-900">
                            @if($task->completed)
                                ✓
                            @endif
                        </button>
                    </form>

                    {{-- Edit --}}
                    <a href="{{route('task.edit', $task->id)}}"
                       class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-semibold">
                       Edit
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('task.delete', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            class="text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300 text-sm font-semibold">
                            Delete
                        </button>
                    </form>

                </div>
            </div>

            @empty
                <p class="text-gray-600 dark:text-gray-300 text-center text-lg">
                    No tasks yet. Create one!
                </p>
            @endforelse


        </div>

    </div>
</section>

</div> 
@endsection