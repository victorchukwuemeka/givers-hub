<?php

namespace App\Http\Controllers\Admin\User;

use AmiCrud\AmiCrud;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class RoleController extends AmiCrud
{

    public function __construct(Role $model){
        $this->model = $model;
        $this->crud_name = 'Roles';
        $this->main_route = 'admin.roles';
        $this->page_layout = 'layouts.admin.app';

       
        $this->formable  = [
            'name' => [
                   'col'=> '6',
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

              'role_permissions' => [
                'type'=>'checkbox',
                'col'=> '12',
                 'validate_create' => 'nullable',
                 'validate_update' => 'nullable',
                 'select_items' => all_permissions(),
                 'display_field' => false,
                 'fillable' => false,
              ],
        ];

    }

    public function modify_edit_model() : mixed {
        $this->modified_model->role_permissions =  $this->modified_model->permissions ? $this->modified_model->permissions->pluck('id')->toArray() : [];

        return $this->modified_model;
    }



       /**
     * called when model added
     */
    public function created(Request $request, $model) : void
    {
             // sync permissions
             if ($request->has('role_permissions')) {
                if ($permissions=$request->get('role_permissions')) {
                    $model->syncPermissions($permissions);
                }
            }
            // end sync permissions
    }

     /**
     * called when model updated
     */
    public function updated(Request $request, $model): void
    {
          // sync permissions
          if (isset($request->role_permissions)) {
            if ($permissions=$request->role_permissions) {
                $model->syncPermissions($permissions);
            }
        }else{
            // if no roles for user on update then we sync with null
            $model->syncPermissions([]);
        }
        // end sync roles
    }

    
}
