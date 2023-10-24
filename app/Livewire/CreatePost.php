<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content;
    public $images;
    public function render()
    {
        return view('livewire.create-post');
    }

    public function savePost(){
        $this->validate([
            'content' => 'required|min:3',
            'photos.*' => 'nullable|image|max:1024',
        ]);

        $newPost = new Post;
        $newPost->title = $this->title;
        $newPost->content = $this->content;
        //$newPost->Photos()->save($image);
        $newPost->user_id = auth()->user()->id;

        $newPost->save();
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $image = new Image;
                $imagePath = $photo->store('photos', 'public');
                $image->imgpath = $imagePath;
                $image->photosable_type = 'post';
                $image->photosable_id = $newPost->id;
                $image->save();
                $newPost->Photos()->save($image);
            }
        }

        $this->reset(['title', 'content', 'photos']);
        $this->emit('$refresh');
        $this->emitUp('postAdded');
    }
}
