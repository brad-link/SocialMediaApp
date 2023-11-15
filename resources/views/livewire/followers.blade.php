<div>
    @foreach ($followers as $user)
    <div class="card followers">
        <div class="card-body">
            <img src="{{ asset('storage/' . $user->image->imgpath) }}" alt="Image Alt Text" width="50"
                height="50">
                <h3 class="ml-3">{{ $user->name }}</h3>
        </div>
</div>
@endforeach
</div>
