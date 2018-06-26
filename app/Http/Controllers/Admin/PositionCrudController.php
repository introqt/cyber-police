<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use App\Models\Position;

class PositionCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel(Position::class);
        $this->crud->setRoute(config('backback.base.route_prefix') . '/admin/positions');
        $this->crud->setEntityNameStrings('Должность', 'Должности');

        $this->crud->setColumns('position');
        $this->crud->addColumn([
            'name' => 'position',
            'label' => 'Должность'
        ]);
        $this->crud->addField([
            'name' => 'position',
            'label' => 'Должность'
        ]);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
