<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Support;
use TallStackUi\Traits\Interactions; 
use Livewire\Attributes\Rule;


new #[Layout('layouts.auth.app')] class extends Component
{
    use WithPagination, Interactions;
  public ?int $paginate_quantity = 10;


  #[Rule('required')]
  public $subject;
  #[Rule('required')]
  public $message;

  public function send()
  {
    $this->validate();

    $support = new Support;
    $support->user_id = user()->id;
    $support->subject = $this->subject;
    $support->message = $this->message;
    $support->status =  status_name('PENDING');
    $support->save();
    $this->dialog()->success('Support Message Sent Successfully!')->send();
    $this->message = null;
    $this->subject = null;
  }

  public function with(): array
  {
      $rows = Support::query()
              ->where('user_id', user()->id)
              ->paginate($this->paginate_quantity)
              ->withQueryString();
      return [
          'headers' => [
              ['index' => 'id', 'label' => '#'],
              ['index' => 'subject', 'label' => 'Subject'],
              ['index' => 'message', 'label' => 'Message'],
              ['index' => 'response', 'label' => 'Response'],
              ['index' => 'status', 'label' => 'Status'],
              ['index' => 'created_at', 'label' => 'Date'],
          ],
          'rows' => $rows,
          'type' => 'data', 
      ];
  }

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Support </h1>
    </section>

  <section class="section main-section">

    <div class="card-content">
      <form wire:submit="send">
        <div class="field">
          <x-input label="Subject" wire:model="subject" />
        </div>
        <div class="field">
          <x-textarea label="Message" wire:model="message" />
        </div>
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



    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
              <span class="icon">
                <x-icon name="arrow-up-right" class="h-5 w-5" />
            </span>
              Support Requests
            </p>
    </header>
      <div class="card-content">
        <x-table :$headers :$rows id="messages" paginate simple-pagination >
        </x-table>
      </div>
    </div>
  </section>
</div>