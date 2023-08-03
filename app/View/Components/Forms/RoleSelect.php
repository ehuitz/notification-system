<?php

namespace App\View\Components\Forms;

use App\Models\Role;
use Illuminate\View\Component;

class RoleSelect extends Component
{
    public $label, $identifier, $name, $val;

    public function __construct($label, $identifier, $name, $val) {
        $this->label = $label;
        $this->identifier = $identifier;
        $this->name = $name;
        $this->val = $val;
    }

    public function render()
    {
        return view('components.forms.role-select', [
            "roles" => Role::all(),
            "label" => $this->label,
            "id" => $this->identifier,
            "name" => $this->name,
            "val" => $this->val ?? ''
        ]);
    }
}
