@props(['disabled' => false, 'label' => null, 'options' => [], 'placeholder' => 'Select an option', 'error' => null])

<div class="w-full">
    @if($label)
        <label class="mb-1.5 block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    <div class="relative z-20 bg-transparent">
        <select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'relative z-20 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none py-2.5 px-4 h-11 text-sm text-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors duration-200 ease-in-out ' . ($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/20' : '')]) }}>
            @if($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif
            
            @foreach($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
            
            {{ $slot }}
        </select>
        
        <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2 text-gray-500">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""/>
            </svg>
        </span>
    </div>
    
    @if($error)
        <p class="text-sm text-red-600 mt-1">{{ $error }}</p>
    @endif
</div>