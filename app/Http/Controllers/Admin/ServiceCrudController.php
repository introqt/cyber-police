<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\ServiceCrudRequest as StoreRequest;
use App\Http\Requests\ServiceCrudRequest as UpdateRequest;
use App\Models\Service;

class ServiceCrudController extends CrudController
{
    // метод настройки для быстрой настройки CRUD
    public function setup()
    {
        // указываем для какой модели (она же таблица в бд) делаем CRUD
        $this->crud->setModel(Service::class);
        // определяем URL где будет распологаться этот CRUD
        $this->crud->setRoute(config('backback.base.route_prefix') . '/admin/services');
        // определяем как называется наша сущность для CRUD'a в единственном и множественном числе
        $this->crud->setEntityNameStrings('Услуга', 'Услугу');

        // ============================||
        // Добавляем колонки в таблицу:
        // ============================||
        // колонка - наименование услуги
        $this->crud->addColumn([
            'name' => 'service',
            'label' => 'Наименование услуги',
        ]);
        // колонка цены услуги
        $this->crud->addColumn([
            // как называется столбец в базе данных
            'name' => 'price',
            // надпись над этим столбцом в таблице услуг
            'label' => 'Цена услуги',
            // тип ячейки - число
            'type' => 'number',
            // "суффикс" после числа, в нашем случае - валюта
            'suffix' => ' ₴'
        ]);
        // столбец с датой создания
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Создана',
        ]);
        // столбец с датой изменения
        $this->crud->addColumn([
            'name' => 'updated_at',
            'label' => 'Изменен',
        ]);

        // =======================================||
        // Поля ввода на странице Добавить/Удалить||
        // =======================================||

        // добавляем поле вводя для названия услуги
        $this->crud->addField([
            // столбец в бд
            'name' => 'service',
            // подпись
            'label' => 'Наименование услуги'
        ]);
        $this->crud->addField([
            // тип поля - только цифрвы
            'type' => 'number',
            // столбец в бд в котором надо записать или перезаписать инфу
            'name' => 'price',
            // подпись поля
            'label' => 'Цена услуги'
        ]);
    }

    // метод для сохранения сущности
    // принимает Объект запроса в котором происходит валидация
    // введенных пользователем данных
    // например проверка на то, цена является числом больше 0
    public function store(StoreRequest $request)
    {
        // наследуется от родительского CrudController
        // из пакета Backpack for Laravel
        return parent::storeCrud($request);
    }
    // тоже самое для обновления
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}
