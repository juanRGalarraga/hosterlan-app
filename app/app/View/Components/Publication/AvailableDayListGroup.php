<?php

namespace App\View\Components\Publication;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class AvailableDayListGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        Collection $daysAvailables,
        bool $isDisabled = false
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.publication.available-day-list-group');
    }
}
