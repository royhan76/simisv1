<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select2 extends Component
{
    public $label;
    public $name;
    public $class;

    public function __construct($label = null, $name = null, $class = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.select2');
    }
}
