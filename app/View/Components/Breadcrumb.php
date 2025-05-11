<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Array item breadcrumb yang berisi title dan url
     *
     * @var array
     */
    public $items;

    /**
     * Menentukan apakah tombol kembali ditampilkan
     * 
     * @var bool
     */
    public $showBackButton;
    public $backUrl;
    public $backText;

    /**
     * Create a new component instance.
     * 
     * @param  array  $items
     * @return void
     */
    public function __construct($items = [], $showBackButton = false, $backUrl = null, $backText = 'Kembali')
    {
        // ! hell nah fuck documentation nanti aja dah
        $this->items = $items;
        $this->showBackButton = $showBackButton;
        $this->backUrl = $backUrl;
        $this->backText = $backText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.breadcrumb');
    }
}
