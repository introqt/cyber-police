<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\WorkerCrudRequest as StoreRequest;
use App\Http\Requests\WorkerCrudRequest as UpdateRequest;
use App\Models\Worker;

class WorkerCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel(Worker::class);
        $this->crud->setRoute(config('backback.base.route_prefix') . '/admin/workers');
        $this->crud->setEntityNameStrings('Сотрудник', 'Сотрудники');

        // Columns
        $this->crud->addColumn([
            'name' => 'surname',
            'label' => 'Фамилия',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Имя',
        ]);
        $this->crud->addColumn([
            // 1-n relationship
            'label' => "Звание", // Table column heading
            'type' => "select",
            'name' => 'position_id', // the column that contains the ID of that connected entity;
            'entity' => 'position', // the method that defines the relationship in your Model
            'attribute' => "position", // foreign key attribute that is shown to user
            'model' => "App\Models\Position", // foreign key model
        ]);
        $this->crud->addColumn([
            // 1-n relationship
            'label' => "Отдел", // Table column heading
            'type' => "select",
            'name' => 'department_id', // the column that contains the ID of that connected entity;
            'entity' => 'department', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Department", // foreign key model
        ]);
        $this->crud->addColumn([
            'name' => 'salary',
            'label' => 'Зарплата',
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Создан',
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'label' => 'Изменен',
        ]);

        // Fields
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Имя'
        ]);
        $this->crud->addField([
            'name' => 'surname',
            'label' => 'Фамилия'
        ]);
        $this->crud->addField([
            'name' => 'salary',
            'label' => 'Зарплата',
            'type' => 'number',
        ]);
        $this->crud->addField([
            'name' => 'surname',
            'label' => 'Фамилия'
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'position_id',
            'entity' => 'position',
            'label' => 'Звание',
            'attribute' => 'position',
            'model' => 'App\Models\Position'
        ]);
        $this->crud->addField([
            'type' => 'select',
            'name' => 'department_id',
            'entity' => 'department',
            'label' => 'Отдел',
            'attribute' => 'name',
            'model' => 'App\Models\Department'
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