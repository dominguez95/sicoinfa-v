@props(['headers' => []])

<div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-dark">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-100 dark:divide-gray-800']) }}>
            <thead class="bg-gray-50 dark:bg-gray-900">
                @if (!empty($headers))
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col" class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                @else
                    {{ $head ?? '' }}
                @endif
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>