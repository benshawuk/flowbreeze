<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="dark:text-white p-6">
    <div>
        <div class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white mb-4">
            Delete Account
        </div>
        <div class="flex items-center text-gray-900 text-sm dark:text-gray-400 mb-4">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to
            retain.
        </div>
        <button
            class='mt-1 mb-2 w-auto text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 h-10'
            x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Delete account
        </button>
        <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="deleteUser">
                <div class="p-12">
                    <div class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white mt-2">
                        Are you sure you want to delete your account?
                    </div>
                    <div class="flex items-center text-gray-900 text-sm dark:text-gray-400 pb-6 mt-2">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" wire:model="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="••••••••" required autofocus>
                        </div>
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <div>
                            <button
                                class='mt-1 mr-2 w-auto text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 h-10'>
                                Delete account
                            </button>
                            <button type="button"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                x-on:click="$dispatch('close')">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>
    </div>
</div>