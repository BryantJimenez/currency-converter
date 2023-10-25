<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalForm extends Component
{
    public $modal, $size='', $form, $method, $title, $validate, $close, $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modal, $size, $form, $method, $title, $validate, $close, $button)
    {
        $this->size=$size;
        $this->form=$form;
        $this->modal=$modal;
        $this->title=$title;
        $this->close=$close;
        $this->method=$method;
        $this->button=$button;
        $this->validate=$validate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal-form');
    }
}
