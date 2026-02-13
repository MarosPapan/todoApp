@extends("layouts.default")

@section("style") <!-- style specific for this page, e.g.: --> @endsection

@section("content")
<section class="min-h-screen bg-gray-50 dark:bg-gray-900 py-10">
  <div class="mx-auto w-full max-w-2xl px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
      Add Task
    </h1>

    <form action="{{ route('task.add.post') }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
      @csrf

      {{-- Task name --}}
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
          Name of the task <span class="text-red-600">*</span>
        </label>
        <input
          type="text"
          id="name"
          name="name"
          value="{{ old('name') }}"
          required
          placeholder="e.g. Buy groceries"
          class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white/90 dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-500 px-3 py-2"
        />
        @error('name')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      
    {{-- Date & time (native picker) --}}
      <div>
        <label for="due_at" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
          Time <span class="text-red-600">*</span>
        </label>
        <input
          type="datetime-local"
          id="due_at"
          name="due_at"
          value="{{ old('due_at') }}"
          required
          class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white/90 dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-500 px-3 py-2"
        />
        <p class="mt-1 text-xs text-gray-500">
          Vyber dátum a čas (lokálny čas tvojho prehliadača).
        </p>
        @error('due_at')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>


      {{-- Description --}}
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
          Description
        </label>
        <textarea
          id="description"
          name="description"
          rows="4"
          placeholder="Optional details…"
          class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white/90 dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-500 px-3 py-2"
        >{{ old('description') }}</textarea>
        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Actions --}}
      @if(session()->has("success"))
        <div class="p-4 mb-4 text-sm text-fg-success rounded-base bg-success-soft" role="alert">
            <span class="font-medium">{{ session()->get("success") }}</span> 
        </div> 
    @endif
                
    @if(session()->has("error")) 
        <div class="p-4 mb-4 text-sm text-fg-danger-strong rounded-base bg-danger-soft" role="alert"> 
            <span class="font-medium">{{ session()->get("error") }}</span> 
        </div>
    @endif
      <div class="flex items-center justify-end gap-3">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
          Cancel
        </a>
        <button type="submit"
          class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          Save Task
        </button>
      </div>
    </form>
  </div>
</section>
@endsection 

