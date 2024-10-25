<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <nav class="bg-white border-gray-200 px-6 py-2.5 dark:bg-gray-800">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center">
                <a href="/" wire:navigate class="flex mr-6">
                    <x-application-logo />
                    <span
                        class="ml-4 self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbreeze</span>
                </a>
            </div>

            <div class="flex justify-between items-center lg:order-2">
                <button type="button"
                    class="p-2 mr-1 text-gray-500 rounded-lg hover:text-black dark:text-gray-400 dark:hover:text-white flex items-center mx-3 text-sm bg-white dark:bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Open user menu</span>
                    <span class="mr-4">{{ auth()->user()->name }}</span>
                    <x-avatar>
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->name,
                        strpos(auth()->user()->name, ' ') + 1, 1)) }}
                    </x-avatar>
                </button>
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
                <!-- Dropdown menu -->
                <div class="hidden z-50 my-4 rounded-xl w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name
                            }}</span>
                        <span class="block text-sm  text-blue-500 truncate">{{ auth()->user()->email
                            }}</span>
                    </div>
                    <ul class="mb-1.5 py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                        <li>
                            <a href="/profile"
                                wire:navigate
                                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                        </li>
                        <li wire:click="logout">
                            <span
                                class="block py-2 px-4 rounded-sm text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">Sign
                                out
                            </span>
                        </li>
                    </ul>
                </div>
                <button type="button" id="toggleMobileMenuButton" data-collapse-toggle="toggleMobileMenu"
                    class="items-center p-2 text-gray-500 rounded-lg md:ml-2 lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                    <span class="sr-only">Open menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <nav id="toggleMobileMenu"
        class="hidden bg-white border-b border-gray-200 shadow-sm dark:bg-gray-900 lg:block dark:border-gray-800 m-1">
        <div class="px-0 lg:px-6">
            <div class="flex items-center">
                <ul class="flex flex-col mt-0 w-full text-sm font-medium lg:flex-row">
                    <x-nav-item name="Dashboard" href="/dashboard" :isActive="request()->is('dashboard')" />
                    <x-nav-item name="Profile" href="/profile" :isActive="request()->is('profile')" />
                    <x-nav-item name="Another" href="/another" :isActive="request()->is('another')" />
                </ul>
                <span class="fixed left-0 bottom-0 h-0.5 w-full bg-primary-500 transition-none" style="transform: translateX(0%);"></span>
            </div>
        </div>
    </nav>

    <nav class="bg-gray-100 dark:bg-gray-700 p-6 mt-4 -mb-6">
        <div class="text-lg font-semibold leading-none text-gray-900 dark:text-white"
            x-data="{ show: false }" x-init="show = true" x-bind:class="{ 'opacity-100': show }">
            <span class="ml-6">{{ ucfirst(request()->route()->getName()) }}</span>
        </div>
    </nav>
</div>

<script>
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

});
</script>
