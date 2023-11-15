<div class="my-4">
    <form wire:submit="savePost">
        <div class="card new-post">
            <div class="form-group">
                <textarea class="form-control" wire:model="content" placeholder="add new post"></textarea>
            </div>
            <div class="form-group d-flex new-post-buttons">
                <div class="flex-fill" style="width: 70%;">
                    <input  type="file" class="form-control-file" multiple wire:model="images">
                </div>
                <div class="flex-fill">
                    <button class="new-post-submit btn btn-primary btn-block" type="submit" wire:loading.attr="disabled">submit</button>
                </div>
            </div>
        </div>
    </form>
</div>