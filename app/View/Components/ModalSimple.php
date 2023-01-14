<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalSimple extends Component
{
    protected $modal, $form, $method, $title, $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modal, $form, $method, $title, $button)
    {
        $this->form=$form;
        $this->modal=$modal;
        $this->title=$title;
        $this->method=$method;
        $this->button=$button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $form=$this->form;
        $modal=$this->modal;
        $title=$this->title;
        $method=$this->method;
        $button=$this->button;
        return view('components.modal-simple', compact('form', 'modal', 'title', 'method', 'button'));
    }
}
