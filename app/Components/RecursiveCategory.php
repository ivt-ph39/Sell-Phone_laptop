<?php

namespace App\Components;

use App\Model\Category;

class  RecursiveCategory
{
    private $data;

    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function recursiveCategory($parent, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value->parent_id['id'] == $id) {
                if (!empty($parent) && $parent == $value->id) {
                    $this->htmlSelect .= "<option selected value = \" $value->id \" >" . $text . $value->name . "</option>";
                } else {
                    $this->htmlSelect .= "<option value = \" $value->id \" >" . $text . $value->name . "</option>";
                }
                $this->recursiveCategory($parent, $value->id, $text . "--- ");
            }
        }
        return $this->htmlSelect;
    }
}