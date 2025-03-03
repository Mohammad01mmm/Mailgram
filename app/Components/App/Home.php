<?php

namespace App\Components\App;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $selectedUser;
    public $selectedUserId;
    public $user;
    public $messageText;
    public $messages = [];
    public $users;

    protected $listeners = ['messageSent' => 'loadMessages'];

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $this->selectedUserId);
        })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->selectedUserId)->where('receiver_id', auth()->id());
            })
            ->latest() // اطمینان از اینکه جدیدترین پیام‌ها بارگذاری شوند
            ->get();
    }

    public function sendMessage()
    {
        if (!$this->messageText) {
            return;
        }

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedUserId,
            'message' => $this->messageText,
        ]);
        // broadcast(new MessageSent($message))->toOthers();

        // $this->messages->push($message);
        // $this->messageText = '';

        $this->dispatch('messageSent');
        $this->reset('messageText');
    }
    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);

        if (!$this->selectedUser) {
            return;
        }

        $this->selectedUserId = $userId;
        $this->loadMessages();
        $this->dispatch('urlChange', [
            'url' => route('app.home', ['user' => $this->selectedUser->email]),
        ]);
    }
    public function mount($user = null)
    {
        if (User::where('email', $user)->first() != null) {
            if ($user != null) {
                $this->user = $user;
                $this->selectedUser = User::where('email', $user)->first();
                $this->selectedUserId = $this->selectedUser->id;
            }
        }
        $this->loadMessages();
    }
    public function loadUsers()
    {
        $this->users = User::where('email', '!=', auth()->user()->email)
            ->whereHas('messages', function ($query) {
                $query->where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id());
            })
            ->get();
    }

    public function render()
    {
        $this->loadUsers();
        return view('front.pages.app.home')->layout('front.master');
    }
}
