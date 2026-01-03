@props(['label' => null, 'error' => null])

<div class="w-full">
    @if($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    
    <input type="file" {{ $attributes->merge(['class' => 'w-full cursor-pointer rounded-lg border border-gray-300 bg-transparent outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:px-5 file:text-gray-700 file:hover:bg-gray-100 focus:border-indigo-500 active:border-indigo-500 disabled:cursor-not-allowed disabled:bg-gray-50 dark:border-gray-800 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:file:hover:bg-gray-800']) }}>
    
    @if($error)
        <p class="text-sm text-red-600 mt-1">{{ $error }}</p>
    @endif
</div>