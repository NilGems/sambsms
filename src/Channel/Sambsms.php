<?php
/**
 * Created by PhpStorm.
 * User: nilge
 * Date: 10-04-19
 * Time: 12:01 AM
 */

namespace Laragems\SambSms\Channel;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\Notification;
use Laragems\SambSms\Message\SambsmsMessage;

class Sambsms
{
    protected $http;

    protected $url;

    public function __construct()
    {
        $this->http = new HttpClient();
        $this->url = config('laragems_sambsms.text_sms_api');
    }

    public function send($notifiable, Notification $notification)
    {
        $parameters = $this->buildJsonPayload($notification->toSambsms($notifiable));
        $this->url = $this->url . '?' . http_build_query($parameters);
        $res = $this->http->request('GET', $this->url);

        if($res->getStatusCode() == 200) {
            return $res->getBody();
        }

        return null;
    }

    protected function buildJsonPayload(SambsmsMessage $message)
    {
        $optional_parameters = [
            'campaign' => data_get($message, 'campaign', 0),
            'routeid' => data_get($message, 'route_id', 7),
            'senderid' => data_get($message, 'sender_id'),
            'time' => data_get($message, 'time', null),
            'type' => data_get($message, 'type', 'text')
        ];

        return array_merge([
            'key' => $message->key,
            'contacts' => $message->contacts,
            'msg' => $message->message,
        ], $optional_parameters, $message->http);
    }
}
