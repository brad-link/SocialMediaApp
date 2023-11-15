<div>
    <h1>{{ $title }}</h1>
    @if($title === 'following')
    @foreach ($following as $user)
    <div class="card following">
        <div class="card-body">
            <img src="{{ asset('storage/' . $user->image->imgpath) }}" alt="Image Alt Text" width="50"
                height="50">
                <h3 class="ml-3">{{ $user->name }}</h3>
                <button wire:click="toggleFollow({{$user->id}})" class="btn follow-button">
                    unfollow
                </button>
        </div>
    </div>
    @endforeach
    <h1>suggested users</h1>
    @foreach ($notFollowing as $user)
    <div class="card not-following">
        <div class="card-body">
            <img src="{{ asset('storage/' . $user->image->imgpath) }}" alt="Image Alt Text" width="50"
                height="50">
                <h3 class="ml-3">{{ $user->name }}</h3>
                <button wire:click="toggleFollow({{$user->id}})" class="btn follow-button">
                    follow
                </button>
        </div>
    </div>
    @endforeach
    @else
    @foreach ($followers as $user)
    <div class="card followers">
        <div class="card-body">
            <img src="{{ asset('storage/' . $user->image->imgpath) }}" alt="Image Alt Text" width="50"
                height="50">
                <h3 class="ml-3">{{ $user->name }}</h3>
        </div>
</div>
@endforeach
@endif
</div>
