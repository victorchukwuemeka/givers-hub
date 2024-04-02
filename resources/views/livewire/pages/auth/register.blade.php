<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $sponsor_name = '';


    #[URL]
    public string $sponsor_id;
    /**
     * Handle an incoming registration request.
     */

    public function mount(){
        if ($this->sponsor_id) {
            $this->sponsor_name = User::find($this->sponsor_id)?->name;
        }
    }

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed'],
            // 'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($this->sponsor_id) {
            $validated['sponsor_id'] = $this->sponsor_id;
        }

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: false);
    }
}; ?>

<div>
 <section class="contact-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="contact-title">Login</h2>
        </div>
        <div class="col-lg-8">

        <form wire:submit="register" class="form-contact contact_form">
            <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input wire:model="name" id="name" type="text" required autofocus autocomplete="name" class="form-control valid">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input wire:model="email" id="email" type="email" required autofocus  class="form-control valid">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                      <input class="form-control valid" wire:model="password" id="password" 
                        type="password"
                        required autocomplete="password" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                      <input class="form-control valid" wire:model="password_confirmation" id="password_confirmation" 
                        type="password"
                        required autocomplete="password_confirmation" />
                    </div>
                  </div>

              @if (isset($sponsor_id))
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Sponsor [{{ $sponsor_name}}]</label>
                  <input value="{{ $sponsor_id }}" wire:model="sponsor_id" id="sponsor_id" readonly autocomplete="sponsor_id" class="form-control valid">
                  <x-input-error :messages="$errors->get('sponsor_id')" class="mt-2 text-danger" />
                </div>
              </div>
              @endif
        </div>
      

        <div class="form-group mt-3">
            <button type="submit" class="button button-contactForm boxed-btn">Register</button>
          </div>
    </form>

    <label for=""> Already have an account?   <a class=" text-secondry" href="{{ route('login') }}">Login</a> </label>

        </div>
      </div>
    </div>
 </section>
</div>

