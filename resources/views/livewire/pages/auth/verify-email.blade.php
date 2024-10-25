<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{

    public string $email = '';
    public bool $isLoading = false;

    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        sleep(1);

        // Validate the email input
        $this->validate([
            'email' => 'required|email',
        ]);

        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'Verification link sent');

        $this->isLoading = false;
    }

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
    <form x-data="{ isLoading: $wire.entangle('isLoading') }" wire:submit.prevent="sendVerification" @submit="isLoading = true">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="/" wire:navigate
                    class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <x-application-logo />
                    Flowbreeze
                </a>
                <div
                    class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                    <h1
                        class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white mb-4">
                        Verify your email
                    </h1>
                    <p class="font-light text-gray-500 dark:text-gray-400 mb-6">
                        Thanks for signing up!
                    </p>
                    <p class="font-light text-gray-500 dark:text-gray-400 mb-3">
                        Before getting started, could you verify your email address by clicking on the link we just
                        emailed to you?
                    </p>
                    <p class="font-light text-gray-500 dark:text-gray-400">
                        If you didn't receive the email, we will gladly send you another.
                    </p>
                    <div class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="#">
                        <div class="mb-1">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" wire:model="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required autofocus>
                        </div>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <span class="min-h-[2rem]">
                            @if(session('status'))
                            <span class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to the email address you provided during
                                registration.') }}
                            </span>
                            @endif
                        </span>
                        <div class="flex justify-between">
                            <div class="flex gap-2">
                                <x-submit-button wire:click="sendVerification" class="w-auto">
                                    Resend verification email
                                </x-submit-button>
                                <x-loading-button>
                                    Resending email...
                                </x-loading-button>
                            </div>
                            <button type="button"
                                wire:click="logout"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                x-on:click="$dispatch('close')">
                                Log out
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>