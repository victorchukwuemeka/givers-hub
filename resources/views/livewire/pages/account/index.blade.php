<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('layouts.auth.app')] class extends Component
{
  public $affiliates=0;
  public $upgrades=0;
  public $income=0;

  public function mount()
  {
    $this->affiliates = user()->affiliates;
    $this->upgrades = user()->upgrades;
    $this->income = user()->income;
  }

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Dashboard </h1>
    </section>

  <section class="section main-section">
    <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3> Affiliates </h3>
              <h1> {{ $affiliates }} </h1>
            </div>
            <span class="icon widget-icon text-dark-500">
              <i class="mdi mdi-account-multiple mdi-48px"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3> Upgrades </h3>
              <h1> {{amount_format($upgrades) }} </h1>
            </div>
            <span class="icon widget-icon text-blue-500">
                <i class="mdi mdi-finance mdi-48px"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h3> Income </h3>
              <h1> {{amount_format($income) }} </h1>
            </div>
            <span class="icon widget-icon text-green-500">
              <i class="mdi mdi-call-received mdi-48px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
   
    <div class="notification blue">
      <div class="flex flex-col flex-row items-center justify-between space-y-3 md:space-y-0">
        <div class="flex ">
           <span class="flex mt-3"> <x-icon name="users" class="h-5 w-5" /></span>
            <x-clipboard text="{{route('sponsor-register',['sponsor_id'=>user()->id])}}" class="ml-5  p-0" />
        </div>
      </div>
    </div>
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon">
            <x-icon name="clipboard-document-list" class="h-5 w-5" />
              </span>
              Transactions
              </p>
      </header>
      <div class="card-content">
        <livewire:profile.transactions />
      </div>
    </div>
  </section>
</div>