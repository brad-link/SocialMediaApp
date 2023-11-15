<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowCommentSection extends Component
{
    public $post;
    public $comments;

    #[On('comment-added', 'comment-deleted')]
    public function refreshComments()
    {
        $this->render();
    }

    public function mount($id){
        $this->post = Post::findOrFail($id);
        $this->comments = $this->post->comments;
    }
    public function render()
    {

        return view('livewire.show-comment-section', [
            'comments' => $this->comments,
        ]);
    }
}
