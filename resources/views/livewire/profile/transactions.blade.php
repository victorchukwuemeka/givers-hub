<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\MatchedHistory;
use Livewire\WithPagination;

new class extends Component
{
  use WithPagination;
  public ?int $paginate_quantity = 10;

  public function with(): array
  {
      $rows = MatchedHistory::query()
              ->where('sender_user_id', user()->id)
              ->orWhere('receiver_user_id', user()->id)
              ->paginate($this->paginate_quantity)
              ->through(function ($row) {
                  $row->sender = user()->id == $row->sender_user_id ? 'You' : $row->sender->name;
                  $row->receiver = user()->id == $row->receiver_user_id ? 'You' : $row->receiver->name;
                  return $row;;
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
          ],
          'rows' => $rows,
          'type' => 'data', 
      ];
  }
}; ?>

<x-table :$headers :$rows id="messages" paginate simple-pagination >
</x-table>