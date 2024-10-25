<!-- resources/views/components/nav-item.blade.php -->
@props(['name', 'href', 'isActive' => false])

<li class="relative group inline-block">
    <a href="{{ $href }}" wire:navigate
        class="block py-3 px-4 {{ $isActive ? 'text-blue-500' : 'text-gray-500 dark:text-gray-400' }} transition-all duration-100 ease-in-out hover:text-black dark:hover:text-white">
        {{ $name }}
    </a>
    <span
        class="absolute left-1/2 bottom-0 h-0.5 w-4/5 bg-primary-500 transition-all duration-100 ease-in-out group-hover:scale-x-100 {{ $isActive ? 'scale-x-100' : 'scale-x-0' }} transform -translate-x-1/2 hidden md:block"></span>
</li>
