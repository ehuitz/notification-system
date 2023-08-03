<?php

namespace App\View\Components\Forms;

use App\Models\Permission;
use Illuminate\View\Component;

class PermissionSelect extends Component
{
    public $label, $identifier, $name, $val;

    public function __construct($label, $identifier, $name, $val) {
        $this->label = $label;
        $this->identifier = $identifier;
        $this->name = $name ?? $this->identifier;
        $this->val = $val;
    }

    public function render()
    {
        return view('components.forms.permission-select', [
            "permissions" => Permission::all(),
            "label" => $this->label,
            "id" => $this->identifier,
            "name" => $this->name ?? $this->identifier,
            "val" => $this->val ?? ''
        ]);
    }
}
