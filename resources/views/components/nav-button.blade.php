@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pb-0.5 border-2 border-purple-600 text-purple-600 uppercase hover:bg-purple-600 hover:text-white text-sm font-bold transition duration-150 ease-in-out rounded-full transform hover:scale-110'
            : 'inline-flex items-center px-4 pb-0.5 border-2 border-purple-600 text-purple-600 uppercase hover:bg-purple-600 hover:text-white text-sm font-bold transition duration-150 ease-in-out rounded-full transform hover:scale-110';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
