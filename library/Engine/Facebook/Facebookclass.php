<?php

include 'Facebook/FacebookCurlHttpClient.php';

require_once( 'Facebook/FacebookRequest.php' );

require_once( 'Facebook/FacebookResponse.php' );

require_once( 'Facebook/FacebookSDKException.php' );

require_once( 'Facebook/FacebookRequestException.php' );

require_once( 'Facebook/FacebookAuthorizationException.php' );

require_once( 'Facebook/GraphObject.php' );

require_once( 'Facebook/GraphUser.php' );

require_once( 'Facebook/FacebookCanvasLoginHelper.php' );
require_once( 'Facebook/FacebookPermissionException.php' );

use Facebook\FacebookRequest;
use Facebook\FacebookHttpable;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookPermissionException;

include 'Facebook/FacebookSession.php';

include 'Facebook/FacebookRedirectLoginHelper.php';

Use Facebook\FacebookSession;
Use Facebook\FacebookRedirectLoginHelper;

class Engine_Facebook_Facebookclass {

    // public $fbsession;
    ///Condition 1 - Presence of a static member variable
    private static $_instance = null;

    ///Condition 2 - Locked down the constructor
    private function __construct() {


        $objCore = Engine_Core_Core::getInstance();
        $this->_appSetting = $objCore->getAppSetting();
        $this->facebookId = $this->_appSetting->facebookId;
        $this->facebookSecret = $this->_appSetting->facebookSecret;

        $this->session = FacebookSession::setDefaultApplication($this->facebookId, $this->facebookSecret);
        //$this->helper = new FacebookRedirectLoginHelper($this->_appSetting->hostLink . '/signup');
        $this->helper = new FacebookRedirectLoginHelper('https://draftdaily.com/signup');
        $this->_session = $objCore->getSession(); 
        $this->_session->fbsession = $this->helper->getSessionFromRedirect();
    }

//Prevent any oustide instantiation of this class
    ///Condition 3 - Prevent any object or instance of that class to be cloned
    private function __clone() {
        
    }

//Prevent any copy of this object
    ///Condition 4 - Have a single globally accessible static method
    public static function getInstance() {
        if (!is_object(self::$_instance))  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Engine_Facebook_Facebookclass();
        return self::$_instance;
    }

    public function getLoginUrl() {
        return $this->helper->getLoginUrl(array('scope' => 'user_birthday,user_about_me,email,publish_actions'));
    }

    public function getUserDetails() {
        if ($this->_session->fbsession != NULL) {
            $user_profile = (new FacebookRequest(
                            $this->_session->fbsession, 'GET', '/me?fields=id,name,first_name,email'
                    ))->execute()->getGraphObject();
            return $user_profile;
        } else {
            return null;
        }
    }

    public function gefbToken() {
        if ($this->_session->fbsession != NULL) {
            return $this->_session->fbsession->getToken();
        } else {
            return null;
        }
    }

    /**
     * This function posts a link to the user's timeline with the provided message.
     * 
     * @param String $link_address Required. Link to be posted in form of a String.
     * @param String $message Optional. Message to be posted along with the link
     * @return null If session object is not valid
     * @return String ID of the link uploaded in form of String
     */
    public function wallPost($link, $message = null, $caption = null, $name = null) {

        if ($this->_session->fbsession == NULL) {
            $session = FacebookSession::newAppSession();
            $this->_session->fbsession = $session;
        }
        if ($this->_session->fbsession != NULL) {
            try {
                // Graph API to publish to timeline
                $msg_body = array(
                    'name' => $name,
                    'caption' => $caption,
                    'link' => $link,
                    'message' => $message
                );
                if (isset($this->_session->fbid) && $this->_session->fbid != null) {
                    $request = (new FacebookRequest($this->_session->fbsession, 'POST', '/' . $this->_session->fbid . '/feed', $msg_body))->execute();

                    // Get response as an array, returns ID of post
                    $result = $request->getGraphObject();
                }
            } catch (FacebookRequestException $e) {
//                echo "Exception occured, code: " . $e->getCode();
//                echo " with message: " . $e->getMessage();
            }
        }
    }

    public function userWallPost($fbId, $link, $message = null, $name = null, $description = null) {

        if ($this->_session->fbsession == NULL) {
            $session = FacebookSession::newAppSession();
            $this->_session->fbsession = $session;
        }
        if ($this->_session->fbsession != NULL && $fbId != null) {
            try {
                // Graph API to publish to timeline
                $msg_body = array(
                    'name' => $name,
                    'description' => $description,
                    'link' => $link,
                    'message' => $message
                );
                $request = (new FacebookRequest($this->_session->fbsession, 'POST', '/' . $fbId . '/feed', $msg_body))->execute();

                // Get response as an array, returns ID of post
                $result = $request->getGraphObject();
//                        return $result;
            } catch (FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
            }
        }
    }

    public function userJoinContest($fbID, $contest = null) {
        if ($this->_session->fbsession == NULL) {
            $session = FacebookSession::newAppSession();
            $this->_session->fbsession = $session;
        }
        if ($this->_session->fbsession != NULL && $fbID != NULL) {
            $objBody = array(
                'fb:app_id' => 1688597081460739,
                'og:title' => $contest,
                'og:image' => "http://draftoff.globusapps.com/assets/images/logo-large@2x1.png",
                'og:url' => $this->_appSetting->hostLink,
                'og:description' => "Join contest in Draftoff to win prize money of contest"
            );
            $object = array('contest' => json_encode($objBody));
            try {
                $request = new FacebookRequest($this->_session->fbsession, 'POST', '/' . $fbID . '/draftdaily:join', $object);

                // Get response as an array, returns ID of post
                $result = $request->execute()->getGraphObject();
            } catch (FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
            }
        }
    }

    public function autopost($fbId, $fbToken, $link, $message = null, $name, $description) {

        if ($this->_session->fbsession == NULL) {
            $session = FacebookSession::newAppSession();
            $this->_session->fbsession = $session;
        }
        $params = array(
            "access_token" => $fbToken,
            "message" => $message,
            "link" => $link,
            "name" => $name,
            "caption" => $name,
            "description" => $description
        );
        try {
            $request = (new FacebookRequest($this->_session->fbsession, 'POST', '/' . $fbId . '/feed', $params))->execute();

            // Get response as an array, returns ID of post
            $request->getGraphObject();
        } catch (Exception $e) {
//            echo $e->getMessage();die;
        }
    }

}

?>