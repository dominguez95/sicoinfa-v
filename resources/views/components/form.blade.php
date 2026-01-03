@props(['action', 'method' => 'POST', 'enctype' => null])

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $enctype ? 'enctype='.$enctype : '' }} {{ $attributes->merge(['class' => '']) }}>
    @csrf
    @if(!in_array($method, ['GET', 'POST']))
        @method($method)
    @endif

    {{ $slot }}
</form>