<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['search'];
    

    public function setSearch($value) {
        $this->syncInput('search', $value);
    }

    public function updatedSearch($value) {
          $this->search = $value;
          $this->gotoPage(1);
    }
}
