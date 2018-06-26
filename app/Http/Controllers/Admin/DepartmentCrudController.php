<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use App\Models\Department;


class DepartmentCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel(Department::class);
        $this->crud->setRoute(config('backback.base.route_prefix') . '/admin/departments');
        $this->crud->setEntityNameStrings('Отдел', 'Отделы');

        $this->crud->setColumns('name');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Название отдела',
            'limit' => 200
        ]);
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Название отдела'
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
