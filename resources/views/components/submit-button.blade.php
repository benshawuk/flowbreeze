<button
    x-show="!isLoading"
    type="submit"
    id="{{ $id ?? 'submit-button' }}"
    {{ $attributes->class([
        'text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 h-10',
        'w-full' => !$attributes->has('class') || !collect(explode(' ', $attributes->get('class')))->contains(fn($class) => str_starts_with($class, 'w-')),
    ]) }}
>
    <span>{{ $slot }}</span>
</button>
