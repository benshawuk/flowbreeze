<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<div class="dark:text-white p-6">
    <div>
        <form wire:submit.prevent="updatePassword" class="space-y-4">
            <div class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
                Update Password
            </div>
            <div class="flex items-center text-gray-900 text-sm dark:text-gray-400 pb-2">
                Ensure your account is using a long, random password to stay secure.
            </div>
            <div>
                <label for="update_password_current_password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current password</label>
                <input type="password" wire:model="current_password" name="current_password" id="update_password_current_password"
                    placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>
            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div>
                <label for="update_password_password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
                <input type="password" wire:model="password" name="password" id="update_password_password"
                    placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="pb-4">
                <label for="update_password_password_confirmation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm new password
                </label>
                <input type="password" wire:model="password_confirmation" name="password_confirmation"
                    id="update_password_password_confirmation" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required autocomplete="new-password">
            </div>
            @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="relative pb-4">
                <button
                    class='mt-1 mb-1 w-auto text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 h-10'>
                    Save
                </button>
                <x-action-message class="text-green-500 absolute" on="password-updated">
                    &nbsp;Password updated!
                </x-action-message>
            </div>
        </form>
    </div>
</div>
