@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-lilac-100 focus:ring focus:ring-lilac-200 focus:ring-opacity-50 w-full p-2']) !!}></textarea>