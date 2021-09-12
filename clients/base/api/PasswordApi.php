<?php




class PasswordApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'create' => array(
                'reqType' => 'GET',
                'path' => array('password', 'request'),
                'pathVars' => array('module'),
                'method' => 'requestPassword',
                'shortHelp' => 'This method sends email requests to reset passwords',
                'longHelp' => 'include/api/help/password_request_get_help.html',
                'noLoginRequired' => true,
                'ignoreSystemStatusError' => true,
            ),
        );
    }

    /**
     * Resets password and sends email to user
     * @param ServiceBase $api
     * @param array $args
     * @return bool
     * @throws DotbApiExceptionRequestMethodFailure
     * @throws DotbApiExceptionMissingParameter
     */
    public function requestPassword(ServiceBase $api, array $args)
    {
        require_once('modules/Users/language/en_us.lang.php');
        $res = $GLOBALS['dotb_config']['passwordsetting'];

        $requiredParams = array(
            'email',
            'username',
        );
        if (!$GLOBALS['dotb_config']['passwordsetting']['forgotpasswordON']) {
            throw new DotbApiExceptionRequestMethodFailure(translate(
                'LBL_FORGOTPASSORD_NOT_ENABLED',
                'Users'
            ), $args);
        }

        foreach ($requiredParams as $key => $param) {
            if (!isset($args[$param])) {
                throw new DotbApiExceptionMissingParameter('Error: Missing argument.', $args);
            }
        }

        $usr = empty($this->usr) ? new User() : $this->usr;
        $useremail = $args['email'];
        $username = $args['username'];

        if (!empty($username) && !empty($useremail)) {
            $usr_id = $usr->retrieve_user_id($username);
            $usr->retrieve($usr_id);

            if (!$usr->isPrimaryEmail($useremail))
            {
                throw new DotbApiExceptionRequestMethodFailure(translate(
                    'LBL_PROVIDE_USERNAME_AND_EMAIL',
                    'Users'
                ), $args);
            }

            if ($usr->portal_only || $usr->is_group) {
                throw new DotbApiExceptionRequestMethodFailure(translate(
                    'LBL_PROVIDE_USERNAME_AND_EMAIL',
                    'Users'
                ), $args);
            }
            // email invalid can not reset password
            if (!DotbEmailAddress::isValidEmail($usr->emailAddress->getPrimaryAddress($usr))) {
                throw new DotbApiExceptionRequestMethodFailure(translate('ERR_EMAIL_INCORRECT', 'Users'), $args);
            }

            $isLink = !$GLOBALS['dotb_config']['passwordsetting']['SystemGeneratedPasswordON'];
            // if i need to generate a password (not a link)
            $password = $isLink ? '' : User::generatePassword();

            // Create URL
            // if i need to generate a link
            if ($isLink) {
                $guid = create_guid();
                $url = $GLOBALS['dotb_config']['site_url'] . "/index.php?entryPoint=Changenewpassword&guid=$guid";
                $time_now = TimeDate::getInstance()->nowDb();
                $q = "INSERT INTO users_password_link (id, username, date_generated) VALUES('" . $guid . "','" . $username . "','" . $time_now . "') ";
                $usr->db->query($q);
            }

            if ($isLink && isset($res['lostpasswordtmpl'])) {
                $emailTemp_id = $res['lostpasswordtmpl'];
            } else {
                $emailTemp_id = $res['generatepasswordtmpl'];
            }

            $additionalData = array(
                'link' => $isLink,
                'password' => $password
            );

            if (isset($url)) {
                $additionalData['url'] = $url;
            }

            $result = $usr->sendEmailForPassword($emailTemp_id, $additionalData);

            if ($result['status']) {
                return true;
            } elseif ($result['message'] != '') {
                throw new DotbApiExceptionRequestMethodFailure($result['message'], $args);
            } else {
                throw new DotbApiExceptionRequestMethodFailure('LBL_EMAIL_NOT_SENT', $args);
            }

        } else {
            throw new DotbApiExceptionMissingParameter('Error: Empty argument', $args);
        }
    }
}
