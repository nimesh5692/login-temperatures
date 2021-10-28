<?php

namespace App\Listeners;

use App\Models\UserLoginData;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdateUserMetadata
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $loggedInCity = array_rand(config('cities.cities'));

        $lon = config('cities.cities.' . $loggedInCity . '.lon');
        $lat = config('cities.cities.' . $loggedInCity . '.lat');

        // $client = new \GuzzleHttp\Client(['verify' => base_path() . '/cacert-2021-10-26.pem']);

        // $response = $client->get('https://api.openweathermap.org/data/2.5/onecall?lat=' . $lat . '&lon=' . $lon . '&exclude=minutely,hourly,daily,alerts&appid={8dc9ba99c4e5fe28f4dc20edbc1848c0}', [
        //     'headers' => [
        //         'Accept' => 'application/json',
        //         'Authorization' => '8dc9ba99c4e5fe28f4dc20edbc1848c0'
        //     ]
        // ]);

        $url = "api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=8dc9ba99c4e5fe28f4dc20edbc1848c0";


        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
            CURLOPT_CAINFO         => base_path() . '/cacert-2021-10-26.pem',
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $response  = curl_exec($ch);

        $errors = curl_error($ch);

        curl_close($ch);

        $response = json_decode($response, true);

        if ($errors) {
            dd($errors);
        }

        $userMetaData = [
            'user_id' => Auth::user()->id,
            'city' => $loggedInCity,
            'temperature' => $response['main']['temp']
        ];

        UserLoginData::create($userMetaData);
    }
}
