<div>
    <button wire:click="$toggle('showComments')" class="text-button"
    style="margin-right: 10px; border: 1px solid black; padding: 4px; border-radius: 3px;">
    {{$showComments ? 'hide comments' : 'Show Comments'}}
    </button>

@if ($showComments)
    <div class="container-fluid">
        @foreach($comments as $comment)
        @if($editing && $editing === $comment->id)
        <form wire:submit.prevent="saveComment">
           <div class="form-group">
              <textarea wire:model="content" class="form-control"></textarea>
              @error("content")
              <span class="text-danger">{{"error"}}</span>
              @enderror
           </div>
           <button type="submit" class=btn btn-primary>Update</button>
        </form>
        @else
        <div class="card comment">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->user->name }}</h5>
                <p class="card-text">{{ $comment->content }}</p>
                <button wire:click="like({{$comment->id}})">Like</button>
                @if (auth()->check() && auth()->user()->id === $comment->user_id)
                <button wire:click="editComment({{ $comment->id }})">Edit</button>
                <button wire:click="deleteComment({{ $comment->id }})">Delete</button>
                @endif
            </div>
        </div>
        @endif
        @endforeach
        @if (!$editing)
        <form wire:submit.prevent="addComment">
            <div class="form-group">
                <input type="text" wire:model.defer="content" class="form-control"></input>
                @error("content")
                <span class="invalid">{{"no content to post"}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @endif
    </div>
    @endif
</div>
    