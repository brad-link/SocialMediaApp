<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Contracts\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content;
    public $images = [];
    public function render()
    {
        return view('livewire.create-post');
    }

    public function savePost()
    {
        $this->validate([
            'content' => 'required|min:3',
            'images.*' => 'nullable|image|max:1024',
        ]);

        $newPost = new Post;
        $newPost->content = $this->content;
        //$newPost->Photos()->save($image);
        $newPost->user_id = auth()->user()->id;


        $newPost->save();
            if ($this->images) {
                foreach ($this->images as $image) {
                    $imagePath = $image->store('photos', 'public');
                    $image = new Image;
                    $image->imgpath = $imagePath;
                    $image->imageable_type = 'post';
                    $image->imageable_id = $newPost->id;
                    $image->save();
                    $newPost->images()->save($image);
                }
        }

        $this->reset(['content', 'images']);
        $this->dispatch('post-created'); 
        session()->flash('success', 'New Post Created');
        
    }
}
