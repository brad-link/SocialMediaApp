<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $user;
    public $followerCount;
    public $followingCount;

    #[Rule('image|max:2048')] // 1MB Max
    public $photo;



    public function mount($id)
    {
        $this->user = User::findorfail($id);
        $this->followerCount = User::find($this->user->id)->followers()->count();
        $this->followingCount = User::find($this->user->id)->following()->count();

    }

    public function updatePP()
    {
        

        if ($this->photo) {
            if ($this->user->image) {
                $this->user->image->delete();
            }
            $profilePicture = new Image;
            $path = $this->photo->store('photos', 'public');
            $profilePicture->imgpath = $path;
            $profilePicture->imageable_type = 'User';
            $profilePicture->imageable_id = Auth::user()->id;
            $profilePicture->save();
            Auth::user()->Image()->save($profilePicture);
            $this->user = Auth::user();
            // $profilePicture->imageable_type = 'User';
            // $profilePicture->imageable_id = Auth::user()->id;
            // $profilePicture->save();
            // Auth::user()->Image()->save($profilePicture);
            // $this->user = Auth::user();

            // $this->user->Image()->create([
            //      'imgpath' => $path,
            //      'imageable_id' => $this->user->id,
            //      'imageable_type'=>"User",
            //  ]);

            //  $this->user = $this->user->fresh();

            // $this->user = Auth::user();
        }

    }


    public function render()
    {
        return view('livewire.profile');
    }
}
