<button
    disabled
    x-cloak
    x-show="isLoading"
    type="button"
    id="{{ $id ?? 'loading-button' }}"
    {{ $attributes->class([
        'py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 inline-flex items-center justify-center h-10',
        'w-full' => !$attributes->has('class') || !collect(explode(' ', $attributes->get('class')))->contains(fn($class) => str_starts_with($class, 'w-')),
    ]) }}
>
    <x-spinner />
    <span>{{ $slot }}</span>
</button>
