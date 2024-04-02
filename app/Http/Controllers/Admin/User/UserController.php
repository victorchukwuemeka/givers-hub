<?php

namespace App\Http\Controllers\Admin\User;

use AmiCrud\AmiCrud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends AmiCrud
{

    public function __construct(User $model){
        $this->model = $model;
        $this->crud_name = 'Users';
        $this->main_route = 'admin.users';
        $this->page_layout = 'layouts.admin.app';
       
        $this->formable  = [
            'name' => [],
             'email' => [
                'type'=>'email',
             ],
            'photo' => [
                'type'=>'file',
                 'validate_create' => 'nullable',
                 'validate_update' => 'nullable',
                 'export_field' => false,
            ],

            'user_roles' => [
                'type'=>'checkbox',
                'col'=> '12',
                 'validate_create' => 'nullable',
                 'validate_update' => 'nullable',
                 'form_field_name' => 'Roles',
                 'select_items' => all_roles(),
                 'display_field' => false,
                 'export_field' => false,
                 'fillable' => false,
            ],

            'password' => [
                'form_field_name' => "Password (For new account and password reset)",
                'type'=>'text_password',
                //  'validate_create' => 'nullable',
                 'validate_update' => 'nullable',
                 'display_field' => false,
                 'export_field' => false,
                 'fillable'=>false,
            ],
        ];

    }


       /**
     * called when model added
     */
    public function created(Request $request, $model) : void
    {
            // sync roles
            if ($request->has('user_roles')) {
                if ($request->get('user_roles')) {
                    $model->syncRoles($request->user_roles);
                }
            }
    }

     /**
     * called when model updated
     */
    public function updated(Request $request, $model): void
    {
         // sync roles
         if ($request->filled('user_roles')&&is_array($request->user_roles)) {
            $model->syncRoles($request->user_roles);
        }else{
            // if no roles for user on update then we sync with null
            $model->syncRoles([]);
        }
        // end sync 
    }



    public function modify_edit_model() : mixed {
        $this->modified_model->user_roles =  $this->modified_model->roles ? $this->modified_model->roles->pluck('id')->toArray() : [];

        return $this->modified_model;
    }



      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : mixed
    {

        if ($request->filled('id')&&!$this->edit_model())
        {
            return null;
        }elseif (!$request->filled('id')&&!$this->add_model()) {
            return null;
        }

         // verify url signature
         $verificationResponse = $this->verify_sign_url($request);
        if ($verificationResponse !== null) {
            return $verificationResponse;
        }

        $validator = Validator::make($request->all(), [
            'id' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $reload=true;
        if($request->has('id') && !empty($request->get('id'))){
            $formsValidate = $this->form_update_validation();
            $reload=false;
        }else{
            $formsValidate = $this->form_create_validation();
        }
        $request->validate($formsValidate, $this->form_validation_messages());
        // $validated = array_filter($request->only($this->fillable()));
        $validated = ($request->only($this->fillable()));
        $validated['id'] = $request->get('id')??null;

        foreach($request->all($this->fillable()) as $req => $value){
            if (!in_array($req,$this->form_multi_select_value())) {continue;}
                if (is_array($request->get($req))) {
                    $multi_select_value='';
                    foreach ($request->get($req) as $k => $v) {
                        $multi_select_value.=$v.', ';
                    }
                    $multi_select_value = rtrim($multi_select_value, ', ');
                    $validated[$req] = (string) $multi_select_value;
                }else{
                    $validated[$req] = null;
                }
        }
        foreach($request->all($this->fillable()) as $req => $value){
            if (empty($request->file($req)) || !$request->file($req) instanceof UploadedFile ) {continue;}
            $validated[$req] = amicrud_gallery_file_upload($request->file($req),$this->crud_name());
        }

        $model = $this->model()->where('id', $validated['id'])->first();
        $createed = false;

        if($request->filled('password')){
            $request->validate([
               'password' => 'required|string|min:6',
           ]);
              $validated['password'] = Hash::make($request->password);
         }

        if ($model) {
            foreach ($validated as $key => $value) {
                $model->{$key} = $value;
            }

            // on update
            if ($createed = $model->save()) {
                $this->updated($request,$model);
            }

        }else{
           $modelCreate = $this->model;
           foreach ($validated as $key => $value) {
            $modelCreate->{$key} = $value;
           }
           // on create
            if ($createed = $modelCreate->save()) {
                $this->created($request,$modelCreate);
            }

        }
         if($createed){
            if ($this->list_target()&&$this->list_target_route()) {
            return response()->json([
                'status'=>'success', 'message' =>  ('Data Saved Successfully'),
                'list_target_route' => amicrud_sign_url(route($this->list_target_route())),
                'list_target' => $this->list_target()
            ]);
            }
        return response()->json(['status'=>'success', 'message' =>  ('Data Saved Successfully'),'reload'=>$reload]);
         }
        return response()->json(['status'=>'error', 'message' => ('Could not create.')]);
    }


}