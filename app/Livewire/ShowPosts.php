<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // public $posts;

    #[On('post-created')] 
    public function refreshPosts()
{
    $this->render();
}
    public function render()
    {
        // $this->posts = Post::orderBy('created_at', 'desc')->get();
        return view('livewire.show-posts', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public function changePage($page)
    {
        $this->page = $page;
    }
}
