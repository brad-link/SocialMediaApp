<div>
    <form wire:submit.prevent="addComment">
        <div class="form-group">
            <input type="text" wire:model.defer="content" class="form-control"></input>
            @error("content")
            <span class="invalid">{{"no content to post"}}</span>
            @enderror
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>
