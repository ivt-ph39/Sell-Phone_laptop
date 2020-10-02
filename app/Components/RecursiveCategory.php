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
    public function recursiveCategory($parent_id, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value->c_parent['id'] == $id) {
                if (!empty($parent_id) && $parent_id == $value->id) {
                    $this->htmlSelect .= "<option selected value = \" $value->id \" >" . $text . $value->c_name . "</option>";
                } else {
                    $this->htmlSelect .= "<option value = \" $value->id \" >" . $text . $value->c_name . "</option>";
                }
                $this->recursiveCategory($parent_id, $value->id, $text . "--- ");
            }
        }
        return $this->htmlSelect;
    }
}