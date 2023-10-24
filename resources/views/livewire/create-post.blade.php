<div class="new-post col-6">
    <form wire:submit="savePost">
        <input type="text" wire:model="content">
        <input type="file" wire:model="photos">
        <button type="submit">submit</button>
    </form>
</div>