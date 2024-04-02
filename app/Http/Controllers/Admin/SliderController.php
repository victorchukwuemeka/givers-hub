<?php

namespace App\Http\Controllers\Admin;

use AmiCrud\AmiCrud;
use App\Models\Slider;

class SliderController extends AmiCrud
{
    public function __construct(Slider $model){
        $this->model = $model;
        $this->crud_name = 'Sliders';
        $this->main_route = 'admin.sliders';
        $this->page_layout = 'layouts.admin.app';
        
       
        $this->formable  = [
              'text_1' => [ 
                'validate_create' => 'nullable|string',
                'validate_update' => 'nullable|string',
              ],
              'text_2' => [ 
                'validate_create' => 'nullable|string',
                'validate_update' => 'nullable|string',
              ],
              'image' => [
                'type' => 'file',
                'validate_update' => 'nullable',
                'export_field' => false,
               ],
        ];
    }

}
