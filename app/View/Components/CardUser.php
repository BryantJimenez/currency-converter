<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class CardUser extends Component
{
    protected $user, $route, $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $route, $permission)
    {
        $this->user=$user;
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
        $route=$this->route;
        $permission=$this->permission;
        $user=User::with(['roles'])->where('slug', $this->user)->firstOrFail();
        return view('components.card-user', compact('user', 'route', 'permission'));
    }
}
