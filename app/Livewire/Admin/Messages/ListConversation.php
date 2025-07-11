<?php

namespace App\Livewire\Admin\Messages;

use Livewire\Component;

class ListConversation extends Component
{
    public string $layout = 'components.layouts.app';
    public function render()
    {
        return view('livewire.admin.messages.list-conversation');
    }
}
