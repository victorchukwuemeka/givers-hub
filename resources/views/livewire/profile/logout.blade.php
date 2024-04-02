<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/login', navigate: false);
    }
}; ?>

<a class="navbar-item" wire:click="logout">
    <span class="icon">
      <i class="mdi mdi-logout"></i>
    </span>
    <span>Log Out</span>
  </a>