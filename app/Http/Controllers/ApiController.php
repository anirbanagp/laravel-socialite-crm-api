<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * this will contain all functionality related to vtiger api calling
 *
 * @author Anirban Saha
 */
class ApiController extends Controller
{
    /**
     * contain vtiger user id of super admin.
     * all contacts will be assigned under him
     * @var string
     */
    private $vtigerUserId;

    /**
     * this will call getchallenge api before login
     *
     * @return self
     */
    private function getToken()
    {
        $tokenUrl  =    API_URL . "?operation=getchallenge&&username=" . CRM_USERNAME;
        $response   =    getObjectFromJSON($tokenUrl);
        $this->token=   $response->result->token;
        return $this;
    }

    /**
     * call login api
     *
     * @return string session id
     */
    private function doLogin()
    {
        $curlPostData = [
            'operation' => 'login',
            'username'  => CRM_USERNAME,
            'accessKey' => md5($this->token . CRM_ACCESSKEY),
        ];
        $response       =   getObjectFromJSON(API_URL, $curlPostData);
        $crmSession     =   $response->result->sessionName;
        $this->vtigerUserId     =   $response->result->userId;
        $this->sessionId        =   $response->result->sessionName;
        return $crmSession;
    }

    /**
     * generate token, call login api
     *
     * @return string session id
     */
    private function getSessionId()
    {
        return $this->getToken()->doLogin();
    }

    /**
     * run query in vtiger system and return result
     *
     * @param  string $sql raw sql with trailing ';'
     *
     * @return object|boolean      api result on success| false on error
     */
    public function getResultFromApi(string $sql)
    {
        $crmSession    =   $this->getSessionId();
        $apiUrl        =   API_URL . "?operation=query&sessionName=" . $crmSession."&query=".urlencode($sql);
        $response       =   getObjectFromJSON($apiUrl);
        if($response->success) {
            return $response->result;
        }
        return false;
    }

    /**
     * create Contact on VTiger
     *
     * @param  array  $user_array user details
     *
     * @return object|boolean      api result on success| false on error
     */
    public function createContactOnVT(array $user_array)
    {
        $crmSession    =   $this->getSessionId();
        $contactData    =   [ 'assigned_user_id'=>$this->vtigerUserId, "leadsource" => "Web - Preventivi","cf_1455" => "Cliente"];
        $contactData    =   array_merge($user_array , $contactData);
        $objectJson     =   json_encode($contactData);
        $params         =   ["sessionName"=>$crmSession, "operation"=>'create', "element"=>$objectJson, "elementType"=>'Contacts'];
        $response       =   getObjectFromJSON(API_URL, $params);
        if($response->success) {
            return $response->result;
        }
        return false;
    }

    /**
     * delete Contact from VTiger
     *
     * @param  string  $id user vtiger id
     *
     * @return object|boolean      api result on success| false on error
     */
    public function deleteContactFromVT(string $id)
    {
        $crmSession    =   $this->getSessionId();
        $apiUrl        =   API_URL . "?operation=delete&sessionName=" . $crmSession."&id=".$id;
        $response       =   getObjectFromJSON($apiUrl);
        if($response->success) {
            return $response->result;
        }
        return false;
    }

    /**
     * retrive Contact from VTiger
     *
     * @param  string  $id user vtiger id
     *
     * @return object|boolean      api result on success| false on error
     */
    public function getContactFromVT(string $id)
    {
        $crmSession    =   $this->getSessionId();
        $apiUrl        =   API_URL . "?operation=retrieve&sessionName=" . $crmSession."&id=".$id;
        $response       =   getObjectFromJSON($apiUrl);
        if($response->success) {
            return $response->result;
        }
        return false;
    }

    /**
     * update Contact on VTiger
     *
     * @param  array  $user_array user details
     * @param  string $id         vtiger id
     *
     * @return object|boolean      api result on success| false on error
     */
    public function updateContactOnVT(array $user_array, string $id)
    {
        $oldObject      =   $this->getContactFromVT($id);
        if($oldObject) {
            foreach ($user_array as $field => $value) {
                $oldObject->{ $field }  =   $value;
            }
            $objectJson     =   json_encode($oldObject);
            $params         =   ["sessionName"=>$this->sessionId, "operation"=>'update', "element"=>$objectJson];
            $response       =   getObjectFromJSON(API_URL, $params);
            if($response->success) {
                return $response->result;
            }
            return false;
        }
        return false;
    }
}
