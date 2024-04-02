<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
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
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form wire:submit="confirmPassword">
        <!-- Password -->
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                  <input class="form-control valid"  
                    wire:model="password"
                          id="password"
                          type="password"
                          name="password"
                          required autocomplete="current-password"
                          />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
              </div>


        </div>

        <div class="form-group mt-3">
            <button type="submit" class="button button-contactForm boxed-btn">Confirm</button>
          </div>
    </form>
            </div>
          </div>
        </div>
    </section>
</div>
