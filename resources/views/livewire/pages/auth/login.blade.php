<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;


new #[Layout('layouts.auth.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $redirect = Auth::user()->hasRole(['admin']) ? '/admin/dashboard' : RouteServiceProvider::HOME;

        $this->redirect(
            session('url.intended', $redirect),
            navigate: false
        );
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="contact-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <h2 class="contact-title">Login</h2>
            </div>
            <div class="col-lg-6">
            <form wire:submit="login" class="form-contact contact_form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input wire:model="form.email" id="email" type="email" required autofocus autocomplete="username" class="form-control valid">
                      <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="password">Password</label>
                      <input class="form-control valid" wire:model="form.password" id="password" class="block mt-1 w-full"
                        type="password"
                        required autocomplete="password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

                        <span>
                           
                              <label for="">Forgot your password?  <a class=" text-secondry" href="{{ route('password.request') }}">Reset</a> </label>
                          </span>
                    </div>

                

                  </div>

                  <div class="col-md-12">
                        <label for="remember" class="inline-flex items-center">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                  </div>

                 

                </div>
                <div class="form-group mt-3">
                  <button type="submit" class="button button-contactForm boxed-btn">Login</button>
                </div>
              </form>

              <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                Don't have an account? Register
            </a>

            </div>
           
          </div>
        </div>
      </section>

</div>
