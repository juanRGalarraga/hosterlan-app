<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MinimalInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $type,
        public string $name = '',
        public string $value = '',
        public string $label = '',
        public string $labelIcon  = "",
        public string $placeholder = "",
    ) {
        if(empty($name)){
            $this->name = $id;
        }

        if(empty(trim($type))) {
            $this->type = 'text';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.minimal-input');
    }
}
