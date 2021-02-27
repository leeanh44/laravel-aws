<?php

namespace Modules\Api\Adapters;

use GuzzleHttp\Client;
use Modules\Api\Contracts\Adapters\FirebaseAdapter;

class FirebaseAdapterImpl implements FirebaseAdapter
{
    private $apiConfig;

    public function __construct()
    {
        $this->apiConfig = [
            'url' => config('firebase.push_url'),
            'server_key' => config('firebase.server_key'),
            'device_type' => config('firebase.device_type')
        ];
    }

    /**
     * Sending push message to single user by Firebase
     *
     * @param string $deviceToken
     * @param array $notification
     * @param array $data
     * @return bool
     */
    public function send(string $deviceToken, array $notification, array $data) : bool
    {
        if ($data['device_type'] === $this->apiConfig['device_type']['ios']) {
            $fields = [
                'to'   => $deviceToken,
                'notification' => $notification,
                'data' => $data
            ];
        } else {
            $fields = [
                'to'   => $deviceToken,
                'data' => array_merge($data, $notification)
            ];
        }

        return $this->sendPushNotification($fields);
    }

    /**
     * GuzzleHttp request to firebase servers
     *
     * @param array $fields
     * @return bool
     */
    private function sendPushNotification(array $fields): bool
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='. $this->apiConfig['server_key'],
            ]
        ]);
        $res = $client->post(
            $this->apiConfig['url'],
            ['body' => json_encode($fields)]
        );

        $res = json_decode($res->getBody());
        if ($res->failure) {
            \Log::error("ERROR_PUSH_NOTIFICATION: ".$fields['to']);

            return false;
        }

        return true;
    }
}
