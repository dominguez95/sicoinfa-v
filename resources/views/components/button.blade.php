@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button'
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-md focus:ring-indigo-500',
        'secondary' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white shadow-md focus:ring-red-500',
        'success' => 'bg-green-500 hover:bg-green-600 text-white shadow-md focus:ring-green-500',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white shadow-md focus:ring-yellow-500',
        'info'    => 'bg-blue-500 hover:bg-blue-600 text-white shadow-md focus:ring-blue-500',
        'dark'    => 'bg-gray-800 hover:bg-gray-900 text-white shadow-md focus:ring-gray-500',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>