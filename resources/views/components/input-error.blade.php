@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-700 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-100 dark:bg-red-200 border-l-4 border-red-600 dark:border-red-700 font-bold p-3">{{ $message }}</li>
        @endforeach
    </ul>
@endif
