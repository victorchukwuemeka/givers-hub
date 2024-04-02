<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Upgrade;
use App\Models\MatchedHistory;
use TallStackUi\Traits\Interactions; 
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;


new #[Layout('layouts.auth.app')] class extends Component
{
    use WithPagination, Interactions;
  public ?int $paginate_quantity = 10;

  public $next_upgrade = null;
  public $pay_modal=false;
  #[Rule('required')]
  public $txn_id;
  public $sponsor_upgrade;
  public $sponsor_payment_method;
  public $sponsor_account_number;
  public $sponsor_amount;

  public function mount()
  {
    $this->next_upgrade = user()->next_upgrade;
  }

  public function upgrade()
  {
    // update user by creating upgrade
    DB::beginTransaction();
    try {
    $sponsor = user()->sponsor;
    if (!$sponsor) {
        $this->dialog()->error('You don\'t have a sponsor')->send();
        return;
    }
    if (!$sponsor?->current_upgrade?->package?->level) {
        $this->dialog()->error('Your sponsor don\'t have a package')->send();
        return;
    }
    if ($sponsor?->current_upgrade?->package?->level < $this->next_upgrade->level) {
        // sponsor has not upgraded to higher level than user
        $this->dialog()->error('Your sponsor have not upgraded to your next level or higher')->send();
        return;
    }
  
    // check if sponsor has wallet
    if (!$sponsor?->wallet?->account_number) {
        $this->dialog()->error("Your sponsor don't have a receiving address setup yet, contact them to provide address for receiving upgrade")->send();
        return;
    }
    $upgrade = new Upgrade;
    $upgrade->user_id = user()->id;
    $upgrade->package_id = $this->next_upgrade->id;
    $upgrade->amount = $this->next_upgrade->amount;
    $upgrade->expected = $this->next_upgrade->expected;
    $upgrade->status =  status_name('PENDING');
    if ($upgrade->save()) {
    // create MatchedHistory by creating upgrade
      $matched_history = new MatchedHistory;
      $matched_history->sender_user_id = user()->id;
      $matched_history->receiver_user_id = user()->sponsor_id;
      $matched_history->amount = $upgrade->amount;
      $matched_history->upgrade_id = $upgrade->id;
      $matched_history->status =  status_name('PENDING');
      $matched_history->account_number = $sponsor->wallet->account_number;
      $matched_history->payment_method = $sponsor->wallet->payment_method;
      $matched_history->save();
    }
    DB::commit();
    $this->next_upgrade = user()->next_upgrade;
    $this->dialog()->success('Congratulations ! You have successfully upgraded.')->send();
    } catch (\Exception $ex) {
      DB::rollBack();
      $this->dialog()->error('Something went wrong:'.$ex->getMessage())->send();

    }
  }

  public function pay(Upgrade $upgrade)
  {
    $this->pay_modal = true;
    $this->sponsor_upgrade = $upgrade;
    $this->sponsor_payment_method = $upgrade?->matched_history?->payment_method;
    $this->sponsor_account_number = $upgrade?->matched_history?->account_number;
    $this->sponsor_amount = $upgrade?->matched_history?->amount;
  }

  public function payUpgrade()
  {
    try {

      if ($this->sponsor_upgrade&&$this->sponsor_upgrade?->status == status_name('PENDING')) {
      $this->validate([
        'txn_id' => 'required',
      ]);
      $matched_history = MatchedHistory::find($this->sponsor_upgrade?->matched_history?->id);
      if (!$matched_history) {
        $this->pay_modal = false;
        $this->dialog()->error('Something went wrong, Match not found')->send();
        return;
      }
      $this->sponsor_upgrade->status = status_name('PAID');
      $this->sponsor_upgrade->save();

      $matched_history->txn_id = $this->txn_id;
      $matched_history->status = status_name('PAID');
      $matched_history->date_paid = now();
      $matched_history->save();
      $this->pay_modal = false;
      $this->dialog()->success('Congratulations ! You have successfully paid your upline, wait for their confirmation')->send();
      return;
      }else{
        $this->pay_modal = false;
        $this->dialog()->error('Upgrade is not pending for payment')->send();
        return;
      }
      
    } catch (\Exception $ex) {
      $this->dialog()->error('Something went wrong:'.$ex->getMessage())->send();
      $this->pay_modal = false;
      return;
    }
  
    
   
  }

  public function with(): array
  {
      $rows = Upgrade::query()
              ->where('user_id', user()->id)
              ->paginate($this->paginate_quantity)
              ->through(function ($row) {
                  $row->package_name = $row->package->name;
                  $row->package_level = $row->package->level;
                  $row->expected_income = $row->expected*$row->amount;
                  $row->received_income = $row->received*$row->amount;
                  return $row;
              })
              ->withQueryString();
      return [
          'headers' => [
              ['index' => 'id', 'label' => '#'],
              ['index' => 'package_name', 'label' => 'Package'],
              ['index' => 'package_level', 'label' => 'Level'],
              ['index' => 'amount', 'label' => 'Amount'],
              ['index' => 'expected_income', 'label' => 'Expected Income'],
              ['index' => 'received_income', 'label' => 'Received Income'],
              ['index' => 'status', 'label' => 'Status'],
              ['index' => 'created_at', 'label' => 'Date'],
              ['index' => 'action'],
          ],
          'rows' => $rows,
          'type' => 'data', 
      ];
  }

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Upgrades </h1>
    </section>

  <section class="section main-section">

    @if (user()->must_upgrade&&$next_upgrade)
    <div class="notification blue">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div>
            <span class="icon"><i class="mdi mdi-buffer"></i></span>
            <b>{{$next_upgrade->name}}</b>
          </div>
          <a href="javascript:;" wire:click="upgrade" class="button green">
            <span class="icon"><i class="mdi mdi-credit-card-outline"></i></span>
            <span>Upgrade</span>
          </a>
        </div>
      </div>  
    @endif
    


    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
              <span class="icon">
                <x-icon name="arrow-up-right" class="h-5 w-5" />
            </span>
              My Upgrades
            </p>
    </header>
      <div class="card-content">
        <x-table :$headers :$rows id="messages" paginate simple-pagination >
            @interact('column_action', $row) 
            @if ($row->status==status_name('PENDING'))
            <x-button color="green"
                      position="left"
                      icon="banknotes"
                      wire:click="pay('{{ $row->id }}')" >
            Pay Upline
            </x-button>
            @endif
            @endinteract
        
        </x-table>
      </div>
    </div>
  </section>

  <x-modal title="Pay Upline" wire="pay_modal">
    <form wire:submit="payUpgrade">

      <div class="mt-3">
        <x-input label="Payment Method" icon="building-office" readonly value="{{ $sponsor_payment_method }}" />
      </div>

      <div class="mt-3">
        <x-input label="Pay To This Address" icon="wallet" readonly value="{{ $sponsor_account_number }}" />
      </div>

     <div class="mt-3">
      <x-input label="Amount To Pay" icon="banknotes" readonly value="{{ amount_format($sponsor_amount) }}" />
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
  </x-modal>

</div>