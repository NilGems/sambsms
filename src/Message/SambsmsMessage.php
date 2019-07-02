<?php
/**
 * Created by PhpStorm.
 * User: nilge
 * Date: 10-04-19
 * Time: 12:03 AM
 */

namespace Laragems\SambSms\Message;

use Illuminate\Support\Carbon;

class SambsmsMessage
{
    public $key;

    public $campaign;

    public $route_id;

    public $type;

    public $contacts;

    public $sender_id;

    public $message;

    public $time;

    public $http = [];

    public function __construct()
    {
        $this->key = config('sambsms.key');
        $this->sender_id = config('sambsms.sender_id');
    }

    /**
     * @param $id
     * @return $this
     */
    public function setRouteId($id)
    {
        $this->route_id = $id;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setCampaignId($id)
    {
        $this->campaign = $id;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param array|string $contacts
     * @return $this
     */
    public function setContacts($contacts)
    {
        if (is_array($contacts))
        {
            $contacts = implode(',', $contacts);
        }
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @param $sender_id
     * @return $this
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param Carbon $time
     * @return $this
     */
    public function setTime(Carbon $time)
    {

        $this->time = $time->isoFormat('Y-MM-dd H:I');
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setHttp(array $options)
    {
        $this->http = $options;
        return $this;
    }
}
