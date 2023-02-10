<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ResultLabel extends Component
{
    public $restaurant;
    public $genres;
    public $date;
    public $time;
    public $counts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($restaurant, $genres, $date, $time, $counts)
    {
        $this->restaurant = $restaurant;
        $this->genres = $genres;
        $this->date = $date;
        $this->time = $time;
        $this->counts = $counts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.result-label');
    }
}
