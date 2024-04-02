<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Activation;
use TallStackUi\Traits\Interactions; 
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;


new #[Layout('layouts.auth.app')] class extends Component
{
    use Interactions;
  
  public $pending_activation = false;

  public function mount()
  {
    $this->pending_activation = Activation::where('user_id', user()->id)->where('status','!=', status_name('COMPLETED'))->first();
  }

  #[Rule('numeric')]
  public $txn_id;

  public function activate()
  {
    // update user by creating upgrade
    DB::beginTransaction();
    try {
      $this->validate();
      $activation = new Activation;
      $activation->user_id = user()->id;
      $activation->txn_id = $this->txn_id;
      $activation->amount = settings('activation_amount');
      $activation->payment_method = settings('payment_method');
      $activation->account_number = settings('account_number');
      $activation->date_paid = now();
      $activation->status =  status_name('PENDING');
      $activation->save();
      DB::commit();
    $this->dialog()->success('Congratulations ! You have successfully submitted your activation for approval.')->send();
    sleep(2);
    return redirect()->route('dashboard');
    } catch (\Exception $ex) {
      DB::rollBack();
      $this->dialog()->error('Something went wrong:'.$ex->getMessage())->send();

    }
  }

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Account Activation </h1>
    </section>

  <section class="section main-section">
    @if (user()->must_activate && !$pending_activation)

    <form wire:submit="activate">

      <div class="mt-3">
        <x-input label="Payment Method" icon="building-office" readonly value="{{ settings('payment_method') }}" />
      </div>

      <div class="mt-3">
        <x-input label="Pay To This Address" icon="wallet" readonly value="{{ settings('account_number') }}" />
      </div>

     <div class="mt-3">
      <x-input label="Amount To Pay" icon="banknotes" readonly value="{{ settings('activation_amount') }}" />
     </div>

      <div class="mt-3">
        <x-input label="Transaction ID" icon="document-text" wire:model="txn_id" placeholder="Enter the payment transaction id here."  />
      </div>
      
      <hr>
      <div class="field grouped mt-3">
        <div class="control">
          <button type="submit" class="button green">
            Submit Payment For Approval
          </button>
        </div>
      </div>
    </form>

    @else

    @if ($pending_activation)
      <x-alert color="orange">
        Your Activation is Pending Approval.
      </x-alert>
    @else
    <x-alert color="orange">
      Account Has Already Been Activated !!!
    </x-alert>
    @endif
    
    @endif
  </section>

</div>