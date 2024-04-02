<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\user;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;


new #[Layout('layouts.auth.app')] class extends Component
{
  use WithPagination;
  public ?int $paginate_quantity = 10;

  public function with(): array
{
    $rows = User::query()
            ->where('sponsor_id', user()->id)
            ->paginate($this->paginate_quantity)
            ->through(function ($row) {
                $row->current_level = $row?->current_upgrade?->package?->level ?? 'N/A';
                return $row;
            })
            ->withQueryString();
    return [
        'headers' => [
            ['index' => 'id', 'label' => '#'],
            ['index' => 'name', 'label' => 'Name'],
            ['index' => 'current_level', 'label' => 'Level'],
        ],
        'rows' => $rows,
        'type' => 'data', 
    ];
}

}; ?>

<div>
    <section class="is-hero-bar p-0">
        <h1 class="title"> Downlines </h1>
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