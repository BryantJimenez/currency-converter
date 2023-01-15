<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class CardUser extends Component
{
    public $user, $route, $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $route, $permission)
    {
        $this->user=User::with(['roles'])->where('slug', $user)->firstOrFail();
        $this->route=$route;
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
