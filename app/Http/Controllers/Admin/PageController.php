<?php

namespace App\Http\Controllers\Admin;

use AmiCrud\AmiCrud;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends AmiCrud
{
    public function __construct(Page $model){
        $this->model = $model;
        $this->crud_name = 'Page';

        $this->index_view = 'amicrud.general';
        $this->main_route = 'admin.pages';
        $this->page_layout = 'layouts.app';
        $this->list_view = 'amicrud.shared.list';

        $this->formable = [
            'name' => [
                'col' => '6',
            ],
            'view' => [
                'col' => '6',
                'validate_create' => 'nullable|string',
                'validate_update' => 'nullable|string',
                'display_field' => false,
            ],
            'url' => [
                'col' => '12',
                'display_field' => false,
            ],
            'content' => [
                'type' => 'textarea_summernote',
                'col' => '12',
                'validate_create' => 'nullable|string',
                'validate_update' => 'nullable|string',
                'display_field' => false,
            ],
            'status' => [
                'type' => 'select',
                'validate_create' => 'nullable|string',
                'validate_update' => 'nullable|string',
                'display_field' => false,
                'select_items' => [
                    'active' => 'active',
                    'in-active' => 'in-active',
                ]
            ],
        ];

        $this->controls = [
            'save' => true,
            'new' => true,
            'cancel' => true,
            'edit' => true,
        ];
    }
}
