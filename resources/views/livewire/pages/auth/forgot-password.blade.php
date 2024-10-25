<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';
    public $isLoading = false;

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        sleep(0.5);

        try {
            $this->validate([
            'email' => ['required', 'string', 'email'],
            ]);
        } finally {
            $this->isLoading = false;
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <form x-data="{ isLoading: $wire.entangle('isLoading') }" wire:submit.prevent="sendPasswordResetLink" @submit="isLoading = true">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="/" wire:navigate class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <x-application-logo />
                    Flowbreeze
                </a>
                <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                    <h1 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Forgot your password?
                    </h1>
                    <p class="font-light text-gray-500 dark:text-gray-400">Don't fret! Just type in your email and we will send you a code to reset your password!</p>
                    <div class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="#">
                        <div class="mb-1">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" wire:model="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required autofocus>
                        </div>
                        <span class="min-h-[2rem]">
                            @if(session('status'))
                                <span class="block text-green-500 text-sm">{{ session('status') }}</span>
                            @elseif($errors->has('email'))
                                <span class="block text-red-500 text-sm">{{ $errors->first('email') }}</span>
                            @else
                                <span class="invisible block text-sm">Placeholder</span>
                            @endif
                        </span>
                        <div>
                            <x-submit-button>
                                Reset Password
                            </x-submit-button>
                            <x-loading-button>
                                Resetting password...
                            </x-loading-button>
                        </div>
                    </div>
                </div>
            </div>
          </section>
    </form>
</div>
