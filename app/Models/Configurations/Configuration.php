<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

class Configuration extends Model
{
    use HasFactory, KeepsDeletedModels;

    protected $fillable = [
        'option_key',
        'option_value',
        'input_type',
        'sort',
    ];


    public $form_edit_validate = [
        'option_key' => ['required', 'unique:configurations'],
        'input_type' => 'required',
    ];

    public $form_edit_validate_update = [
        'input_type' => 'required',
    ];

    public $form_validate_messages = [
        'option_key.required' => 'The name field is required',
    ];

    public $form_display = [
        'option_key' => 'name',
        'input_type' => 'input_type',
    ];

    public $form_select = [
       'input_type' => ['text'=>'text', 'file'=>'file', 'textarea'=>'textarea','textarea_summernote'=>'textarea_summernote', 'select'=>'select',],
    ];

    public function formable() {
       return collect(self::pluck('input_type','option_key'))->toArray();
    }

    public function filla() {
        return collect(self::pluck('option_key'))->toArray();
     }

    public $form_validate = [
      
    ];

    public $form_textarea_format = [
    ];

    public $form_text_format = [
        'option_key'
    ];

    public $form_file_format = [

    ];

    public function form_display(){
        return collect(self::pluck('option_key','option_key'))->toArray();
    }

    public $display = [
        'name'=>'option_key',
    ];

}
