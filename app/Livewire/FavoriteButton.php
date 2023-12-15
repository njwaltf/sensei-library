<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;

class FavoriteButton extends Component
{
    public $bookId;
    public $isFavorite;

    protected $listeners = ['favoriteStatusUpdated'];

    public function mount($bookId)
    {
        $this->bookId = $bookId;
        $this->isFavorite = $this->checkFavoriteStatus();
    }

    public function toggleFavorite()
    {
        if ($this->isFavorite) {
            // Remove from favorites
            Favorite::where('user_id', auth()->id())
                ->where('book_id', $this->bookId)
                ->delete();
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => auth()->id(),
                'book_id' => $this->bookId,
            ]);
        }

        // Update favorite status
        $this->isFavorite = $this->checkFavoriteStatus();

        // Emit event to update other components if needed
        $this->dispatch('favoriteStatusUpdated', $this->isFavorite);
    }

    private function checkFavoriteStatus()
    {
        return Favorite::where('user_id', auth()->id())
            ->where('book_id', $this->bookId)
            ->exists();
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}
