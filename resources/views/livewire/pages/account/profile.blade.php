<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('layouts.auth.app')] class extends Component
{

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Profile </h1>
    </section>

  <section class="section main-section">
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 mb-6">

      <div class="card">
        <div class="card-content">
         @livewire('profile.update-profile-information-form')
        </div>
      </div>

      <div class="card">
        <div class="card-content">
        @livewire('profile.update-password-form')
        </div>
      </div>
     
    </div>
  
  </section>
</div>