<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Wallet;
use Livewire\Attributes\Rule;
use TallStackUi\Traits\Interactions; 


new #[Layout('layouts.auth.app')] class extends Component
{
  use Interactions;
#[Rule('required')]
public $account_number;
#[Rule('required')]
public $payment_method;
public $wallet;

public function mount()
{
  $this->wallet = user()->wallet;
  $this->account_number = $this->wallet?->account_number;
  $this->payment_method = $this->wallet?->payment_method;
}

public function save()
{
  $this->validate();
  if ($this->wallet) {
    $this->wallet->update([
      'account_number' => $this->account_number,
      'payment_method' => $this->payment_method,
  ]);
  $this->dialog()->success('Wallet Updated!')->send();
  }else{
    $wallet = new Wallet;
    $wallet->user_id = user()->id;
    $wallet->payment_method = $this->payment_method;
    $wallet->account_number = $this->account_number;
    $wallet->save();
    $this->wallet = $wallet;
    $this->dialog()->success('Wallet Created!')->send();
  }
 
}

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Wallet </h1>
    </section>

  <section class="section main-section">
    
    <div class="card has-table ">
      <div class="card-content">
      <form wire:submit="save">
        <div class="field">
          <x-select.styled :options="['USDT','BTC','ETH']" label="Payment Method" icon="banknotes" value="{{ $payment_method }}" wire:model="payment_method" />
        </div>

        <x-input label="Address" icon="wallet" wire:model="account_number" value="{{ $account_number }}" />
        <hr>
        <div class="field grouped">
          <div class="control">
            <button type="submit" class="button green">
              Save
            </button>
          </div>
        </div>
      </form>
      
      </div>
    </div>
  </section>
</div>