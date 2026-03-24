<?php 
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

if(!function_exists('loadCompanySettings')){
    function loadCompanySettings(){
        $companySettings = Setting::all();
        $settingdata=array();
        foreach($companySettings as $setting){
            $settingdata[$setting->name] = $setting->value;
        }
        Cache::put('companySettings', $settingdata);
    }
}


if(!function_exists('get')){
    function get($name, $default = null)
    {    
        $companySettings = Cache::get('companySettings');
         if(isset($companySettings[$name])){
            return $companySettings[$name];
        }
        return $default;
    }
}

if (!function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs()
    {
        $segments = Request::segments();
        $breadcrumbs = collect();
        $url = '';

        foreach ($segments as $index => $segment) {
            $url .= '/' . $segment;
            $breadcrumb = [
                'title' => ucfirst(str_replace('-', ' ', $segment)),
                'url' => url($url)
            ];
            $breadcrumbs->push($breadcrumb);
        }

        return $breadcrumbs;
    }
}



if (!function_exists('getHomeClient')) {
    function getHomeClient()
    {
        $requestdata = [
            'userid'    => session('external_user')['id'] ?? 0,
            'companyid' => session('external_user')['companyid'] ?? 0,
            'roleid'    => session('external_user')['roleid'] ?? 0
           
        ];

        $service = app(\App\Services\ApiAuthService::class);
        return $service->Gethomeclient($requestdata);
    }
}


if (!function_exists('numberToWords')) {
    function numberToWords($number, $currency = 'Dollars')
    {
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $words = ucfirst($f->format($number));

        return "{$words} {$currency}";
    }
}

if (!function_exists('hour_minute')) {
    function hour_minute($payload, $extract = false)
    {
        if($payload){
            $splitX = explode(':', $payload);

            if($extract){
                switch($extract){
                    case 'h':
                        $extract = 0;
                        break;
                    case 'm':
                        $extract = 1;
                        break;
                    default:
                        return null;
                }
                return $splitX[$extract];
            }

            return $splitX;
        }

        return null;
    }
}