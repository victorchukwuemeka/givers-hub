<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

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

    <section class="contact-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <h2 class="contact-title">Forgot Password</h2>
            </div>
            <div class="col-lg-6">

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="email">Email</label>
                <input wire:model="email" id="email" type="email" required autofocus class="form-control valid">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
            </div>
        </div>
    
        <div class="form-group mt-3">
            <button type="submit" class="button button-contactForm boxed-btn">Email Password Reset Link</button>
          </div>
    </form>
            </div>
          </div>
        </div>
    </section>
</div>
