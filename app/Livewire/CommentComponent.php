<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentComponent extends Component
{

    use AuthorizesRequests;

    public $postID;

    public $post;

    public $content;
    public $comment;

    public $comments;

    public $editing;

    #[On('comment-added', 'comment-deleted', 'updated')]
    public function refreshComments()
    {
        $this->render();
    }

    public $showComments = false;

    public function viewComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function mount($id)
    {
        // $this->comment = Comment::findorfail($id);
        $this->postID = Post::findorfail($id);
        $this->comments = Comment::with('likes')->where('post_id', $this->postID->id)->get();
    }

    public function render()
    {
        //$this->comments = Comment::with('likes')->where('post_id', $this->postID)->get();
        return view('livewire.comment', ['comments' => $this->comments]);
    }

    public function addComment()
    {
        $this->validate([
            'content' => 'required',
        ]);

        $newComment = new Comment;
        $newComment->post_id = $this->postID->id;
        $newComment->content = $this->content;
        $newComment->user_id = auth()->user()->id;
        $newComment->likes = 0;
        $newComment->save();
        $this->reset(('content'));
        $this->comments = Comment::with('likes')->where('post_id', $this->postID->id)->get();
        $this->dispatch('comment-added')->self();
    }

    public function deleteComment($commentID)
    {
        $this->comment = Comment::findorfail($commentID);
        $this->comment->delete();
        $this->comments = Comment::with('likes')->where('post_id', $this->postID->id)->get();
        $this->dispatch('comment-deleted')->self();
    }

    public function like($commentID)
    {
        $this->comment = Comment::findorfail($commentID);
        $this->comment = Comment::findorfail($commentID);
        if($this->comment->likes()->where('user_id', Auth::id())->exists()){
        $this->comment->likes()->where('user_id', auth()->id())->delete();
        } else{
            $this->comment->likes()->create([
                'user_id' => Auth::id()
                ]);
        }
    }

    public function editComment($commentID)
    {
        
        $comment = Comment::findorfail($commentID);
        if($comment)
        {
            $this->editing = $commentID;
            $this->content = $comment->content;
        }
        
    }
    

    public function saveComment()
    {

        $this->validate([
            'content' => 'required',
        ]);

        $comment = Comment::findorfail($this->editing);
        if($comment){
            $comment->content = $this->content;
            $comment->save();
        }

        $this->comments = Comment::with('likes')->where('post_id', $this->postID->id)->get();
        $this->reset(['content', 'editing']);
        $this->dispatch('updated')->self();
    }
}
