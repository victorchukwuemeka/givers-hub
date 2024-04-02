<?php

namespace App\Http\Controllers\Admin\User;

use AmiCrud\AmiCrud;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends AmiCrud
{

    public function __construct(Permission $model){
        $this->model = $model;
        $this->crud_name = 'Permissions';
        $this->main_route = 'admin.permissions';
        $this->page_layout = 'layouts.admin.app';
 
        
       
        $this->formable  = [
            'name' => [
                   'col'=> '6',
                   'validate_create' => ['required','unique:permissions'],
                   'display_field' => false,
             ],
             'display_name' => [
                'col'=> '6',
              ],
              'description' => [
                'type'=>'textarea',
                'col'=> '12',
                 'validate_create' => 'nullable',
                 'validate_update' => 'nullable',
              ],
        ];

    }

}
