<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateRangePicker extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $idDateFrom,
        public string $idDateTo,
        public string $format = 'dd-mm-yyyy'
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.date-range-picker');
    }
}
