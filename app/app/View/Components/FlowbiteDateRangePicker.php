<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FlowbiteDateRangePicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        string $idDateFrom,
        string $idDateTo,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.flowbite-daterangepicker');
    }
}
