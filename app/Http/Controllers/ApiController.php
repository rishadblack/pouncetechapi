<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function callPhrApi(Request $request)
    {
        return $this->tryRawCode();


        // dd(file_exists(storage_path('app/public/ssl/final/server.pem')));

        // dd(Storage::disk('public')->path('ssl/password.key'));

        // $client = new Client(['verify' => storage_path('app/public/ssl/final/server.pem')]);
        // $client->request('POST', 'https://ytjyeh.api-qa.prh.fi/YTJAPIJulkinen.ilmoitusnumero/notification/identifier', [
        //     // 'verify' => [storage_path('app/public/ssl/final/server.pem')],
        //     'headers' => [
        //             'PRH-user-key' => '6feab3c5ded9d33dd1c48cbd2818414b',
        //             'BIS-Client-Id' => 'GJ8G0G1G',
        //             'BIS-Origin-IP' => '103.58.73.171',
        //             'BIS-Correlation-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
        //             'BIS-Session-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
        //             'BIS-Message-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
        //             'BIS-Transaction-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
        //             'Content-Type' => 'application/json',
        //             'Accept' => 'application/json'
        //         ],
        // ]);

        // return $client;


        $response = Http::acceptJson()
        ->withOptions([
            'cart' => [storage_path('app/public/ssl/final/server.pem'), 'TTqJP6anC73LPDBq6kIg'],
        ])
        ->withHeaders([
            'PRH-user-key' => '6feab3c5ded9d33dd1c48cbd2818414b',
            'BIS-Client-Id' => 'GJ8G0G1G',
            'BIS-Origin-IP' => '103.58.73.171',
            'BIS-Correlation-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Session-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Message-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Transaction-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'Content-Type' => 'application/json',
        ])->post('https://ytjyeh.api-qa.prh.fi/YTJAPIJulkinen.ilmoitusnumero/notification/identifier', []);

        dd($response->getReasonPhrase());
        return $response;
    }

    public function tryRawCode()
    {
        $header = [
            'PRH-user-key' => '6feab3c5ded9d33dd1c48cbd2818414b',
            'BIS-Client-Id' => 'GJ8G0G1G',
            'BIS-Origin-IP' => '103.58.73.171',
            'BIS-Correlation-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Session-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Message-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'BIS-Transaction-Id' => 'c68900e1-e011-6aC2-f7f2-0fCFfCAC7c8c',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $posts = [

        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://ytjyeh.api-qa.prh.fi/YTJAPIJulkinen.ilmoitusnumero/notification/identifier',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $posts,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSLCERTPASSWD => 'TTqJP6anC73LPDBq6kIg',
            CURLOPT_CAINFO => storage_path('app/public/ssl/final/server.crt'),
            CURLOPT_SSLCERT => storage_path('app/public/ssl/api-qa-3180885-4_2022.crt'),
            CURLOPT_SSLKEY => storage_path('app/public/ssl/api-qa-3180885-4_2022.key'),
            // CURLOPT_NOSIGNAL => 1
        ]);

        $response = curl_exec($curl);

        // dd($response);

        $err = curl_error($curl);
        dd($err);

        curl_close($curl);

        echo(json_encode($response));
        echo("\n\n");
        if ($err) {
            return ["success" => false, "message" => $err];
        } else {
            return ["success" => true, "data" => json_decode($response)];
        }
    }
}
