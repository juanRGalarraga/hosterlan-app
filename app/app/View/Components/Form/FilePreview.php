<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilePreview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $filename,
        public string $label = '',
        public string $previewSrc = '',
        public string $imgClassName = '',
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.file-preview');
    }
}
