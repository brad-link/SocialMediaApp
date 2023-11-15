<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    @if($user->image)
                    <img src="{{ asset('storage/' . $user->image->imgpath) }}" class="card-img-top" alt="user-img">
                    @endif
                    @if(auth()->user()->id == $user->id)
                    <form wire:submit="updatePP">
                        <input  type="file" id="profile-picture" class="form-control-file" wire:model="photo">
                        <button type="submit">update Picture</button>
                    </form>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p>Followers:<br /> {{ $followerCount }}</p>
                            </li>
                            <li class="list-group-item">
                                <p>Following:<br /> {{ $followingCount }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if(auth()->user()->id == $user->id)
                <livewire:create-post />
                @endif
                @foreach($user->posts as $post)
                <livewire:show-post :post="$post" :key="$post->id" />
                @endforeach
            </div>
        </div>
    </div>
</div>