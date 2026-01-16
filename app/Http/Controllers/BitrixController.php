<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BitrixService;

class BitrixController extends Controller
{
    public function installApp(Request $request)
    {
        
        $result = [
            'rest_only' => true,
            'install' => false,
        ];

        if ($request->input('event') == 'ONAPPINSTALL' && $request->filled('auth')) {
           $result['install'] =$request->input('auth');
        } elseif ($request->input('PLACEMENT') == 'DEFAULT') {
            $result['rest_only'] = false;
            $result['install'] = [
                'access_token' => htmlspecialchars($request->input('AUTH_ID')),
                'expires_in' => htmlspecialchars($request->input('AUTH_EXPIRES')),
                'application_token' => htmlspecialchars($request->input('APP_SID')),
                'refresh_token' => htmlspecialchars($request->input('REFRESH_ID')),
                'domain' => htmlspecialchars($request->input('DOMAIN')),
                'client_endpoint' => 'https://' . htmlspecialchars($request->input('DOMAIN')) . '/rest/',
            ];
        }

      /*  $this->setLog([
            'request' => $request->all(),
            'result' => $result,
        ], 'installApp');
*/
//dd($result);
https://my.bitrix24.com/rest/entity.item.get.json?ENTITY=menu&auth=d161f25928c3184678924ec127edd29a
print_r($result);

        return View('install', ['result' => $result]);
    }

    // Other methods...

    private function setAppSettings($arSettings, $isInstall = false)
    {
        $return = false;
        if (is_array($arSettings)) {
            $oldData = $this->getAppSettings();
            if (!$isInstall && !empty($oldData) && is_array($oldData)) {
                $arSettings = array_merge($oldData, $arSettings);
            }
            $return = $this->setSettingData($arSettings);
        }
        return $return;
    }

    
}
