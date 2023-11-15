<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class AddComment extends Component
{

    public $post;

    public $content;

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.add-comment');
    }

    public function addComment()
    {
        $this->validate([
            'content' => 'required',
        ]);

        $newComment = new Comment;
        $newComment->post_id = $this->post->id;
        $newComment->content = $this->content;
        $newComment->user_id = auth()->user()->id;
        $newComment->likes = 0;
        $newComment->save();
        $this->reset(('content'));
        $this->dispatch('comment-added');
    }
}
