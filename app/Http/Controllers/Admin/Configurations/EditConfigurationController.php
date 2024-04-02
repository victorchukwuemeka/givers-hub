<?php
namespace App\Http\Controllers\Admin\Configurations;

use AmiCrud\AmiCrud;
use App\Models\Configurations\Configuration;

class EditConfigurationController extends AmiCrud
{

    public function __construct(Configuration $model){
        $this->model = $model;
        $this->crud_name = 'Edit Configuration';
        $this->main_route = 'admin.configurations.edit-configurations';
        $this->page_layout = 'layouts.admin.app';
        
       
        $this->formable  = [
            'option_key' => [
                    'validate_create' => ['required', 'unique:configurations'],
                    'validation_messages' => [
                        'required' => 'The name field is required',
                    ],
                    'form_field_name' => 'name',
                    'display_field' =>  'name',
                    'export_field' => 'name',
             ],
            'input_type' => [
                   'type'=>'select',
                   'col'=> '3',
                    'select_items' => [
                                    'text'=>'text', 
                                    'number' => 'number',
                                    'textarea'=>'textarea',
                                    'select'=>'select',
                                    'file'=>'file', 
                                    'color'=>'color', 
                                    'textarea_summernote'=>'textarea_summernote', 
                                
                                ],
            ],
             'sort' => [
                    'type'=>'number',
                    'col'=> '3',
                    'validate_create' => 'nullable',
                    'validate_update' => 'nullable',
            ]
        ];

    }
     
}