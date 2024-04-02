<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Message;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;


new #[Layout('layouts.auth.app')] class extends Component
{
  use WithPagination;
  public ?int $paginate_quantity = 10;

  public function with(): array
{
    $rows = Message::query()
            ->where('user_id', user()->id)
            ->paginate($this->paginate_quantity)
            ->withQueryString();
    return [
        'headers' => [
            ['index' => 'id', 'label' => '#'],
            ['index' => 'message', 'label' => 'Message']
        ],
        'rows' => $rows,
        'type' => 'data', 
    ];
}

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Messages </h1>
    </section>

  <section class="section main-section">
    
    <div class="card has-table">
      <div class="card-content">

        <x-table :$headers :$rows id="messages" paginate simple-pagination >
       </x-table>
      
      </div>
    </div>
  </section>
</div>