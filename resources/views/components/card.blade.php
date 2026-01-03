@props(['title' => null])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-white/[0.03]']) }}>
    @if ($title)
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                {{ $title }}
            </h3>
            {{ $header_action ?? '' }}
        </div>
    @elseif (isset($header))
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            {{ $header }}
        </div>
    @endif
    
    <div class="p-4 sm:p-6">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50/50 rounded-b-2xl dark:border-gray-800 dark:bg-white/[0.03]">
            {{ $footer }}
        </div>
    @endif
</div>