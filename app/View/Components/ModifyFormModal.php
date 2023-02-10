<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModifyFormModal extends Component
{
    public $id;
    public $restaurant;
    public $reservationdate;
    public $reservationtime;
    public $reservationcount;
    public $representativefamilyname;
    public $representativelastname;
    public $representativetel;
    public $representativemail;
    public $alert;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $restaurant, $reservationdate, $reservationtime, $reservationcount, $representativefamilyname, $representativelastname, $representativetel, $representativemail, $alert)
    {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->reservationdate = $reservationdate;
        $this->reservationtime = $reservationtime;
        $this->reservationcount = $reservationcount;
        $this->representativefamilyname = $representativefamilyname;
        $this->representativelastname = $representativelastname;
        $this->representativetel = $representativetel;
        $this->representativemail = $representativemail;
        $this->alert = $alert;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modify-form-modal');
    }
}
