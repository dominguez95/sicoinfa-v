@props(['disabled' => false, 'label' => null, 'error' => null, 'prepend' => null, 'append' => null])

<div class="w-full">
    @if ($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative flex rounded-lg shadow-sm">
        @if (isset($prepend))
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <span class="text-gray-500 dark:text-gray-400 sm:text-sm">{{ $prepend }}</span>
            </div>
        @endif

        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' =>
                'h-11 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-2.5 text-sm text-gray-800 dark:text-gray-200 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-500/30 focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-50 dark:disabled:bg-gray-800 disabled:opacity-50 transition-colors duration-200 ease-in-out ' .
                ($error
                    ? 'border-red-500 dark:border-red-600 focus:border-red-500 dark:focus:border-red-500 focus:ring-red-500/20 dark:focus:ring-red-500/30 '
                    : '') .
                (isset($prepend) ? 'pl-11 ' : 'px-4 ') .
                (isset($append) ? 'pr-11 ' : ''),
        ]) !!}>

        @if (isset($append))
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                <span class="text-gray-500 dark:text-gray-400 sm:text-sm">{{ $append }}</span>
            </div>
        @endif
    </div>

    @if ($error)
        <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $error }}</p>
    @endif
</div>
