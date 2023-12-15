<!-- resources/views/livewire/favorite-button.blade.php -->

<button wire:click="toggleFavorite" class="btn btn-outline-danger btn-circle {{ $isFavorite ? 'active' : '' }}"
    wire:key="{{ $bookId }}">
    <i class="ti ti-heart"></i>
</button>
