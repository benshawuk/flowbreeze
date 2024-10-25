<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<div class="dark:text-white p-6" x-data="{ isLoading: false }" x-init="
    $watch('isLoading', value => {
        if (!value && $refs.name) { $refs.name.focus(); }
    });
    document.addEventListener('livewire:navigated', () => {
        if ($refs.name) { $refs.name.focus(); }
    });
">
    <div>
        <form wire:submit.prevent="updateProfileInformation">
            <div class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white mt-2">
                Profile information
            </div>
            <div class="flex items-center text-gray-900 text-sm dark:text-gray-400 pb-6 mt-2">
                Update your account's profile information and email address.
            </div>
            <div class="space-y-4 md:space-y-6">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Full Name</label>
                    <input type="text" wire:model="name" name="name" id="name" x-ref="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John Smith" required autofocus autocomplete="name">
                </div>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" wire:model="email" name="email" id="email" x-ref="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="email@company.com" required autocomplete="username">
                </div>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div>
                    <button class='mt-1 w-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 h-10'>
                        Save
                    </button>
                    <x-action-message class="mt-2 text-green-500" on="profile-updated">
                        &nbsp;Profile updated!
                    </x-action-message>
                </div>
            </div>
        </form>
    </div>
</div>
