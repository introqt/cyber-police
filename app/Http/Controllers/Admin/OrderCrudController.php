<?php

namespace App\Http\Controllers\Admin;

use App\Models\Traits\AdminTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use App\Models\Order;

class OrderCrudController extends CrudController
{
    use AdminTrait;

    private $_fields = ['client_id', 'service_id', 'worker_id'];

    public function setup()
    {
        $this->crud->setModel(Order::class);
        $this->crud->setRoute(config('backback.base.route_prefix') . '/admin/orders');
        $this->crud->setEntityNameStrings('Заказ', 'Заказы');

        $this->crud->allowAccess(['show','edit','delete']);
        // Айди клиента, но показываем его имя по этому айди
        // с помощью отношения 1 к 1
        $this->crud->addColumns([
            [
                'label' => 'Клиент',
                'type' => 'select',
                'name' => 'client_id',
                'entity' => 'client',
                'attribute' => 'email',
                'model' => 'App\Models\Client'
            ],
            [
                'label' => 'Услуга',
                'type' => 'select',
                'name' => 'service_id',
                'entity' => 'service',
                'attribute' => 'service',
                'model' => 'App\Models\Service'
            ],
            [
                // run a function on the CRUD model and show its return value
                'name' => "worker_id",
                'label' => "Работник", // Table column heading
                'type' => "model_function",
                'function_name' => 'getWorkerLink', // the method in your Model
                // 'limit' => 100, // Limit the number of characters shown
            ],
//            [
//                'label' => 'Работник',
//                'type' => 'select',
//                'name' => 'worker_id',
//                'entity' => 'worker',
//                'attribute' => 'surname',
//                'model' => 'App\Models\Worker'
//            ]
        ]);

        $this->generateCollumn(['created_at', 'updated_at']);

        // =======================
        $this->crud->addField([
            'label' => 'Клиент',
            'type' => 'select',
            'name' => 'client_id',
            'entity' => 'client',
            'attribute' => 'email',
            'model' => 'App\Models\Client',
        ]);
        $this->crud->addField([
            'label' => 'Услуга',
            'type' => 'select',
            'name' => 'service_id',
            'entity' => 'service',
            'attribute' => 'service',
            'model' => 'App\Models\Service'
        ]);
        // айди работника
        $this->crud->addField([
            'label' => 'Работник',
            'type' => 'select',
            'name' => 'worker_id',
            'entity' => 'worker',
            'attribute' => 'surname',
            'model' => 'App\Models\Worker'
        ]);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        $this->crud->hasAccessOrFail('update');

        // fallback to global request instance
        if (is_null($request)) {
            $request = \Request::instance();
        }

        // replace empty values with NULL, so that it will work with MySQL strict mode on
        foreach ($request->input() as $key => $value) {
            if (empty($value) && $value !== '0') {
                $request->request->set($key, null);
            }
        }

        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $request->except('save_action', '_token', '_method'));
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction($item->getKey());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->crud->hasAccessOrFail('update');

        $model = $this->crud->getEntry($id);
        // get the info for that entry
        $this->data['entry'] = $model;
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        foreach ($this->_fields as $field) {
            $this->data['fields'][$field]['value'] = $model->{$field};
        }

        $this->data['title'] = trans('backpack::crud.edit') . ' ' . $this->crud->entity_name;

        $this->data['id'] = $id;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }
}

