@props(['cols' => 1, 'gap' => 4])

@php
    // Simple responsive mapping. 
    // If cols is 3, it goes 1 -> 2 -> 3 across breakpoints.
    $colsClass = match((int)$cols) {
        1 => 'grid-cols-1',
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        4 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4',
        5 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5',
        6 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6',
        12 => 'grid-cols-12',
        default => 'grid-cols-1',
    };
@endphp

<div {{ $attributes->merge(['class' => "grid $colsClass gap-$gap"]) }}>
    {{ $slot }}
</div>