<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Reservation extends Component
{
    public $id;
    public $restaurantid;
    public $datetime;
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $restaurantid, $datetime, $count)
    {
        $this->id = $id;
        $this->restaurantid = $restaurantid;
        $this->datetime = $datetime;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.reservation');
    }
}
