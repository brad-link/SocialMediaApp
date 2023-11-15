<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Following extends Component
{
    public $following;
    public $notFollowing;

    #[On('follow')]
    public function refresh()
    {
        $this->render();
    }

    public function toggleFollow($userID){
        if(Auth::user()->following->contains($userID)){
            Auth::user()->following()->detach($userID);
            Log::info('User unfollowed: ' . $userID);
        } else {
            Auth::user()->following()->attach($userID);
            Log::info('User followed: ' . $userID);
        }
        $this->dispatch('follow');

    }

    public function render()
    {
        $this->following = Auth::user()->following;
        $this->notFollowing = User::whereNotIn('id', Auth::user()->following->pluck('id'))->get();
        return view('livewire.following');
    }
}
