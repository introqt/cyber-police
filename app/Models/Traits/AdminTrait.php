<?php

namespace App\Models\Traits;

trait AdminTrait
{
    private $_output = [];

    /**
     * @param array $array
     */
    public function generateCollumn(array $array)
    {
        foreach ($array as $item) {
            $this->_output[] = [
                'name' => $item,
                'label' => trans("columns.{$item}"),
            ];
        }

        $this->crud->addColumns($this->_output);
    }
}