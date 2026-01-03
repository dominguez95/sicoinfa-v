@props(['disabled' => false, 'label' => null, 'error' => null, 'prepend' => null, 'append' => null])

<div class="w-full">
    @if($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    
    <div class="relative flex rounded-lg shadow-sm">
        @if(isset($prepend))
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <span class="text-gray-500 sm:text-sm">{{ $prepend }}</span>
            </div>
        @endif

        <input {{ $disabled ? 'disabled' : '' }} 
            {!! $attributes->merge([
                'class' => 'h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-50 transition-colors duration-200 ease-in-out ' . 
                ($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/20 ' : '') .
                (isset($prepend) ? 'pl-11 ' : 'px-4 ') .
                (isset($append) ? 'pr-11 ' : '')
            ]) !!}>

        @if(isset($append))
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                <span class="text-gray-500 sm:text-sm">{{ $append }}</span>
            </div>
        @endif
    </div>
    
    @if($error)
        <p class="text-sm text-red-600 mt-1">{{ $error }}</p>
    @endif
</div>