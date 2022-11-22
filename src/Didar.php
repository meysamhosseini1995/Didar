<?php

namespace MeysamHosseini\Didar;

use Exception;
use MeysamHosseini\Didar\Http\Response;


class Didar
{
    const base_url = "https://app.didar.me";

    /**
     * @var
     */
    protected $api_key;

    /**
     * @var
     */
    protected $end_point;


    /**
     * @param $token
     */
    public function __construct($token)
    {
        if (!extension_loaded('curl')) {
            die('cURL library is not loaded');
        }
        if (is_null($token)) {
            die('apikey is empty');
        }
        $this->api_key = $token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->api_key;
    }

    /**
     * @param $token
     *
     * @return void
     */
    public function setToken($token)
    {
        $this->api_key = $token;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->end_point;
    }

    /**
     * @param $end_point
     *
     * @return void
     */
    public function setEndpoint($end_point)
    {
        $this->end_point = $end_point;
    }

    /**
     * @return string
     */
    public function makeUrl()
    {
        return self::base_url . '/' . $this->getEndpoint() . '?apikey=' . $this->getToken();
    }

    /**
     * @param string $Keyword
     * @param array  $Types
     *
     * @return array
     */
    public function searchAll(string $Keyword, array $Types = ["contact", "company", "deal", "case", "attachment"])
    {
        $this->setEndpoint('/api/search/search');
        return $this->curlPostData([
            "Keyword" => $Keyword,
            "Types"   => $Types
        ]);
    }


    /**
     * @return array
     */
    public function dealList()
    {
        $this->setEndpoint('/api/pipeline/list/0');
        return $this->curlPostData();
    }


    /**
     * @param string $ContactId
     * @param string $Title
     * @param array  $Data
     *
     * @return array
     */
    public function dealSave(string $ContactId,string $Title, array $Data = [])
    {
        $Data["ContactId"] = $ContactId;
        $Data["Title"] = $Title;
        $this->setEndpoint('/api/deal/save');
        return $this->curlPostData([
            "Deal" => $Data
        ]);
    }

    /**
     * @param string $DealId
     * @param string $Title
     * @param array  $Data
     *
     * @return array
     */
    public function dealUpdate(string $DealId,string $Title, array $Data = [])
    {
        $Data["Id"] = $DealId;
        $Data["Title"] = $Title;
        $this->setEndpoint('/api/deal/save');
        return $this->curlPostData([
            "Deal" => $Data
        ]);
    }


    /**
     * @return array
     */
    public function cardList()
    {
        $this->setEndpoint('/api/pipeline/list/1');
        return $this->curlPostData();
    }

    /**
     * @return array
     */
    public function activityType()
    {
        $this->setEndpoint('/api/activity/GetActivityType');
        return $this->curlPostData();
    }

    /**
     * @return array
     */
    public function customfieldList()
    {
        $this->setEndpoint('/api/customfield/GetCustomfieldList');
        return $this->curlPostData();
    }


    // Activity Section

    /**
     * @param array $Data
     * @param int   $From
     * @param int   $Limit
     *
     * @return array
     */
    public function activityList(array $Data = [], int $From = 0, int $Limit = 30)
    {
        $this->setEndpoint('/api/activity');
        return $this->curlPostData();
    }

    /**
     * @param string $DealId
     * @param string $Title
     * @param array  $Data
     * @param array  $NewAttachments
     *
     * @return array
     */
    public function saveActivity(string $DealId, string $Title, array $Data = [], array $NewAttachments = [])
    {
        $Data["DealId"] = $DealId;
        $Data["Title"] = $Title;
        $this->setEndpoint('/api/activity/save');
        return $this->curlPostData([
            "Activity"       => $Data,
            "NewAttachments" => $NewAttachments,
            "SetDone"        => false
        ]);
    }

    /**
     * @param string $DealId
     * @param string $ResultNote
     * @param array  $Data
     * @param array  $NewAttachments
     *
     * @return array
     */
    public function saveNote(string $DealId, string $ResultNote, array $Data = [], array $NewAttachments = [])
    {
        $Data["DealId"] = $DealId;
        $Data["ResultNote"] = $ResultNote;
        $Data["IsDone"] = true;
        $this->setEndpoint('/api/activity/save');
        return $this->curlPostData([
            "Activity"       => $Data,
            "NewAttachments" => $NewAttachments,
            "SetDone"        => true
        ]);
    }

    /**
     * @param array $Data
     * @param int   $From
     * @param int   $Limit
     *
     * @return array
     */
    public function searchActivity(array $Data = [], int $From = 0, int $Limit = 30)
    {
        $this->setEndpoint('/api/activity/search');
        return $this->curlPostData([
            "Criteria" => $Data,
            "From"     => $From,
            "Limit"    => $Limit
        ]);
    }

    // User Section

    /**
     * @return array
     */
    public function operatorList()
    {
        $this->setEndpoint('/api/User/List');
        return $this->curlPostData();
    }

    // Customer Section

    /**
     * @param array $Data
     *
     * @return array
     */
    public function saveCustomer(array $Data = [])
    {
        $this->setEndpoint('/api/contact/save');
        return $this->curlPostData([
            "Contact" => $Data
        ]);
    }

    /**
     * @param string $Keywords
     * @param array  $Data
     * @param int    $From
     * @param int    $Limit
     *
     * @return array
     */
    public function searchPerson(string $Keywords, array $Data = [], int $From = 0, int $Limit = 30)
    {
        $Data["Keywords"] = $Keywords;
        $this->setEndpoint('/api/contact/personsearch');
        return $this->curlPostData([
            "Criteria" => $Data,
            "From"     => $From,
            "Limit"    => $Limit
        ]);
    }

    /**
     * @param string $Keywords
     * @param array  $Data
     * @param int    $From
     * @param int    $Limit
     *
     * @return array
     */
    public function searchCompany(string $Keywords, array $Data = [], int $From = 0, int $Limit = 30)
    {
        $Data["Keywords"] = $Keywords;
        $this->setEndpoint('/api/contact/companysearch');
        return $this->curlPostData([
            "Criteria" => $Data,
            "From"     => $From,
            "Limit"    => $Limit
        ]);
    }


    /**
     * @param array $data
     *
     * @return array
     */
    public function curlPostData(array $data = [])
    {
        try {
            if (!is_null($data) && is_array($data)) {
                $data = json_encode($data);
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->makeUrl());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));


            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);

            $json_response = json_decode($response);

            if ($curl_errno) {
                throw new  Exception("curl have errors", $code);
            }
            if ($code != 200 && is_null($json_response)) {
                throw new  Exception(Response::getMessageCode($code), $code);
            }
            return ['status' => 'success', 'code' => $code, 'result' => $json_response];
        } catch (Exception $e) {
            return ['status' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

}