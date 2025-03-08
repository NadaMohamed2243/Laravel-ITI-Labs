@props(['type' => 'primary', 'href' => '#', 'method' => 'GET'])

@php
    $classes = [
        'primary' => 'bg-blue-400 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded',
        'secondary' => 'bg-gray-500 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded',
        'danger' => 'bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded',
    ];
@endphp

@if ($method === 'DELETE')
    <form action="{{ $href }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="{{ $classes[$type] ?? $classes['primary'] }} cursor-pointer" {{--
            onclick="return confirm('Are you sure you want to delete this?');" --}}>
            {{ $slot }}
        </button>
    </form>
@else
    <a href="{{ $href }}" class="{{ $classes[$type] ?? $classes['primary'] }}">
        {{ $slot }}
    </a>
@endif
