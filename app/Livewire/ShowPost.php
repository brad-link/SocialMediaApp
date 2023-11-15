<?php

namespace App\Livewire;

use App\Models\Post;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;
    public $no_of_likes;

    public $showComments = false;

    #[On('liked', 'deleted', 'edited')] 
    public function refreshPost()
    {
        $this->render();
    }

    public function viewComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function like()
    {
    
        if($this->post->likes()->where('user_id', Auth::id())->exists()){
        $this->post->likes()->where('user_id', auth()->id())->delete();
        } else{
            $this->post->likes()->create([
                'user_id' => Auth::id()
                ]);
        }
        $this->dispatch('liked');
    }
    
    public function render()
    {
        $this->no_of_likes = $this->post->likes()->get()->count();
        return view('livewire.show-post');
    }
}
