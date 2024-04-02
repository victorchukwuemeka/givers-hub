<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Upgrade;
use App\Models\MatchedHistory;
use TallStackUi\Traits\Interactions; 
use Illuminate\Support\Facades\DB;


new #[Layout('layouts.auth.app')] class extends Component
{
    use WithPagination, Interactions;

  public ?int $paginate_quantity = 10;

  public $approve_modal=false;
  public $matched_history;
  public $sponsor_payment_method;
  public $sponsor_account_number;
  public $sponsor_amount;

  public function approve(MatchedHistory $matched_history)
  {
    $this->approve_modal = true;
    $this->matched_history = $matched_history;
    $this->sponsor_payment_method = $matched_history->payment_method;
    $this->sponsor_account_number = $matched_history->account_number;
    $this->sponsor_amount = $matched_history->amount;
  }

  public function approveUpgrade()
  {
    DB::beginTransaction();
    try {

      if ($this->matched_history&&$this->matched_history->status == status_name('PAID')) {

      $upgrade = Upgrade::find($this->matched_history?->upgrade?->id);
      if (!$upgrade) {
        $this->approve_modal = false;
        $this->dialog()->error('Something went wrong, Upgrade not found')->send();
        return;
      }
      // upgrade the downline
      $upgrade->status = status_name('COMPLETED');
      $upgrade->save();
      // update matched history
      $this->matched_history->status = status_name('COMPLETED');
      $this->matched_history->save();
      $this->approve_modal = false;
      // update the upgrade for receiver received +1
      $upgrade_receiver = Upgrade::where('package_id',$upgrade->package_id)->where('user_id', $this->matched_history->receiver_user_id)->first();
      if ($upgrade_receiver) {
        if (is_null($upgrade_receiver->received)) {
        $upgrade_receiver->received = 0;
        }
        $upgrade_receiver->received++;
        $upgrade_receiver->save();
      }
      DB::commit();
      $this->dialog()->success('Upgrade has been approved!')->send();
      return;
      }else{
        $this->approve_modal = false;
        $this->dialog()->error('Match is not pending for payment')->send();
        return;
      }
      
    } catch (\Exception $ex) {
      DB::rollBack();
      $this->dialog()->error('Something went wrong:'.$ex->getMessage())->send();
      $this->approve_modal = false;
      return;
    }
  }



  public function declineUpgrade()
  {
    try {

      if ($this->matched_history&&$this->matched_history->status == status_name('PAID')) {
        $this->matched_history->status = status_name('DECLINED');
        $this->matched_history->save();
        $this->approve_modal = false;
      $this->dialog()->success('Upgrade has been declined!')->send();
      return;
      }else{
        $this->approve_modal = false;
        $this->dialog()->error('Match is not pending for payment')->send();
        return;
      }
      
    } catch (\Exception $ex) {
      $this->dialog()->error('Something went wrong:'.$ex->getMessage())->send();
      $this->approve_modal = false;
      return;
    }
  }

  public function with(): array
  {
      $rows = MatchedHistory::query()
              ->where('receiver_user_id', user()->id)
              ->paginate($this->paginate_quantity)
              ->through(function ($row) {
                  $row->sender = user()->id == $row->sender_user_id ? 'You' : $row->sender->name;
                  $row->receiver = user()->id == $row->receiver_user_id ? 'You' : $row->receiver->name;
                  return $row;
              })
              ->withQueryString();
      return [
        'headers' => [
              ['index' => 'id', 'label' => '#'],
              ['index' => 'sender', 'label' => 'Sender'],
              ['index' => 'receiver', 'label' => 'Receiver'],
              ['index' => 'amount', 'label' => 'Amount'],
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
        <h1 class="title"> Approve Downlines Upgrade </h1>
    </section>

  <section class="section main-section">

    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
              <span class="icon">
                <x-icon name="arrow-up-right" class="h-5 w-5" />
            </span>
              Downlines Upgrade
            </p>
    </header>
      <div class="card-content">
        <x-table :$headers :$rows id="messages" paginate simple-pagination >
            @interact('column_action', $row) 
            @if ($row->status==status_name('PAID'))
            <x-button color="primary"
                      position="left"
                      icon="banknotes"
                      wire:click="approve('{{ $row->id }}')" >
           Approve/Decline Payment
            </x-button>
            @endif
            @endinteract
        
        </x-table>
      </div>
    </div>
  </section>

  <x-modal title="Pay Upline" wire="approve_modal">
    <form >

      <div class="mt-3">
        <x-input label="Payment Method" icon="building-office" readonly value="{{ $sponsor_payment_method }}" />
      </div>

      <div class="mt-3">
        <x-input label="Address Paid To" icon="wallet" readonly value="{{ $sponsor_account_number }}" />
      </div>

     <div class="mt-3">
      <x-input label="Amount Paid" icon="banknotes" readonly value="{{ amount_format($sponsor_amount) }}" />
     </div>

      <div class="mt-3">
        <x-input label="Transaction ID" icon="document-text" readonly value="{{ amount_format($sponsor_amount) }}" />
      </div>
      
      <hr>
      <div class="field grouped mt-3">
        <div class="control">
          <button type="button" class="button green" wire:click="approveUpgrade">
           Approve Payment
          </button>

          <button type="button" class="button red" wire:click="declineUpgrade">
            Decline Payment
           </button>
        </div>
      </div>
    </form>
  </x-modal>

</div>