<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Date extends Component
{
    public $label;
    public $name;
    public $value;

    public function __construct($label = null, $name = null, $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.date');
    }
}
