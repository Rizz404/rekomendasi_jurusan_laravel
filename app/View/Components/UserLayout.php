<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// ! kalo lupa gw ingetin
// ! jangan sekali-kali hapus class component UserLayout dan AdminLayout
// ! karena view nya bukan di folder component, nantinya bakal crash
class UserLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.user');
    }
}
