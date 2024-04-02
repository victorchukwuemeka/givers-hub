<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use App\Models\Configurations\Configuration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{/**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $model;
    public function __construct(Configuration $model)
    {
       $this->model = $model;
    }
    public function fillable() {
      return $this->model->getFillable();
    }

    public function index()
    {
        $list_contents = collect($this->model->pluck('option_value','option_key'))->toArray();
        $list_contents=(object)collect($list_contents)->reject(function($item){
        })->all();
        $content = [
              'list_contents' => $list_contents,
              'value' => $list_contents,
              'forms' =>  $this->model->formable(),
              'type'=> 'Configurations',
              'show_actions'=>true,
              'form_edit_url' => 'admin.configurations.edit',
              'form_create_route' => 'admin.configurations.store',
              'form_delete_url' => 'admin.configurations.delete',
              'fields' => $this->model->display,
              'form_textarea_format' => $this->model->form_textarea_format,
              'form_text_format' => $this->model->form_text_format,
              'form_display' => $this->model->form_display(),
              'form_model' => true,
              'form_target' => 'form-id',
              'form_id_create' => 'form-create',
              'form_id_update' => 'form-update',
              'form_selects' => [
              ],
              'custom_form_input' => [
              ],
              'controls' => [
                'edit'=>true,
                'cancel'=>true,
                'save'=>true,
              ]
          ] ;
        return view('admin.configurations.configurations')->with($content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $fillable = $this->model->filla();
        $validated = array_filter($request->only($fillable));
        foreach($request->all() as $req => $value){
            if (empty($request->file($req)) || !$request->file($req) instanceof UploadedFile ) {continue;}
            $validated[$req] = gallery_file_upload($request->file($req),'configurations');
        }
        $createed = false;
         foreach($validated as $k => $v){
           $createed = $this->model->where('option_key',$k)->update(['option_value' => $v]);
         }

        if($createed){
        return response()->json(['message' =>  success_message('Data Saved Successfully'),'reload'=>false]);
         }
        return response()->json(['message' => error_message('Could not create.')]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
