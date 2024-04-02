<?php
use App\Models\Configurations\Configuration;
use App\Models\Message;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\ServiceItemProperty;
use App\Models\Slider;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

if (!function_exists('settings')) {
    /**
     * @param $field
     * @param string $default
     * @return mixed
     */
    function settings($field)
    {
        $records = Configuration::where('option_key', $field)->first();
        return $records?->option_value;
    }
}
if (!function_exists('currency')) {
    function currency($symbol=false)
    {
        return $symbol ? settings('currency_symbol') : settings('currency');
    }
}

function all_user_alerts($take=10)
{
   return Message::where('user_id',user()->id)->orderBy('id','desc')->get()->take($take);
}

if (!function_exists('new_alert_count')) {
    function new_alert_count(){
        return Message::where('user_id',user()->id)->where('status','unread')->get()->count();
    }
}


if (!function_exists('all_roles')) {
    function all_roles()
    {
        return collect(Role::all()->pluck('name' ,'id'))->toArray();
    }
}
if (!function_exists('all_permissions')) {
    function all_permissions()
    {
        return collect(Permission::all()->pluck('name' ,'id'))->toArray();
    }
}


if (!function_exists('get_slider_list')) {
    function get_slider_list($take=10)
    {
        return Slider::where('status',1)->orderBy('id','desc')->take($take)->get();
    }
}

if (!function_exists('default_pagination_number')) {
    function default_pagination_number() {
        return 10;
    }
}


if (!function_exists('get_service_categories')) {
    function get_service_categories() {
        $cat = [
           'land',
           'car',
           'machine',
           'contruction',
           'rent',
        ];
        return array_combine($cat,$cat);
    }
}

