<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class CardUser extends Component
{
    public $user, $route, $permission, $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $route, $permission, $title)
    {
        $this->user=User::where('slug', $user)->firstOrFail();
        $this->route=$route;
        $this->title=$title;
        $this->permission=$permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card-user');
    }
}
