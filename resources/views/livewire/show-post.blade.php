<div class="card my-4">
    <div class="card-header d-flex align-items-center justify-content-between">
    <a href="{{route('profile.view', ['id' => $post->user->id])}}"
        class=" profile-button d-flex align-items-center">
        @if($post->user->image)
        <img src="{{ asset('storage/' . $post->user->image->imgpath) }}" alt="Image Alt Text" width="50" height="50">
        @endif
        {{ $post->user->name }}
    </a>
    @if(auth()->user()->id == $post->user->id)
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Edit</a>
            <a class="dropdown-item" href="#">Delete</a>
        </div>
    </div>
    @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="post-content col-11">
                @if($post->content)
                <p class="card-text">{{ $post->content}}</p>
                @endif
                @if($post->images)
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($post->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->imgpath) }}" class="post-image" alt="Image {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @endif
            </div>
                <button wire:click="like col-1" class="like-button">{{$no_of_likes}} Like</button>

        </div>
        <livewire:comment-component :id="$post->id" />
    </div>
</div>