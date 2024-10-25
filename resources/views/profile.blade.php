<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-2">
        <div class="border border-gray-300 rounded-xl dark:border-gray-600 overflow-hidden">
            <livewire:profile.update-profile-information-form />
        </div>
        <div class="border border-gray-300 rounded-xl dark:border-gray-600 overflow-hidden">
            <livewire:profile.update-password-form />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div class="border border-gray-300 rounded-xl dark:border-gray-600 overflow-hidden">
            <livewire:profile.delete-user-form />
        </div>
    </div>
</x-app-layout>