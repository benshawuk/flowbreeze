<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="border-2 border-dashed border-gray-300 rounded-xl dark:border-gray-600 h-96">
            <div class="dark:text-white p-6">
                <p>You're logged in, {{ ucfirst(explode(' ', auth()->user()->name)[0]) }}!
                </p>
            </div>
        </div>
        <div class="border-2 border-dashed border-gray-300 rounded-xl dark:border-gray-600 h-96"></div>
    </div>
</x-app-layout>
