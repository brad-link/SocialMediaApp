<div>
    <div class="col-md-6 offset-md-3 my-4">
        <livewire:create-post />
        @foreach ($posts as $post)
        <livewire:show-post :post="$post" :key="$post->id"/>
        @endforeach
    </div>
    <div class="col-md-6 offset-md-5 my-4">
        {{ $posts->links() }}
    </div>
</div>