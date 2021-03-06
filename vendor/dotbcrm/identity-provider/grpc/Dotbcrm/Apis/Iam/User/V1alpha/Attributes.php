<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: user/v1alpha/user.proto

namespace Dotbcrm\Apis\Iam\User\V1alpha;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * User attributes
 * The attributes are based on (a subet of) the Openid Connect Claims:
 * https://openid.net/specs/openid-connect-basic-1_0.html#StandardClaims
 * Attributes which are synced into a DotbCRM instances are documented. Note
 * that not every attribute will necessarily by synced. Eventually most of the
 * user attributes will be migrated over to the IdP.
 * User information will be made available over the UserInfo Openid Connect
 * endpoint and should not be fetched by clients directly from the IdP API.
 *
 * Generated from protobuf message <code>dotbcrm.apis.iam.user.v1alpha.Attributes</code>
 */
class Attributes extends \Google\Protobuf\Internal\Message
{
    /**
     * Given name(s) or first name(s) of the End-User. Note that in some
     * cultures, people can have multiple given names; all can be present, with
     * the names being separated by space characters.
     * Dotb field mapping: `users.first_name`
     *
     * Generated from protobuf field <code>string given_name = 1;</code>
     */
    private $given_name = '';
    /**
     * Surname(s) or last name(s) of the End-User. Note that in some cultures,
     * people can have multiple family names or no family name; all can be
     * present, with the names being separated by space characters.
     * Dotb field mapping: `users.last_name`
     *
     * Generated from protobuf field <code>string family_name = 2;</code>
     */
    private $family_name = '';
    /**
     * Middle name(s) of the End-User. Note that in some cultures, people can
     * have multiple middle names; all can be present, with the names being
     * separated by space characters. Also note that in some cultures, middle
     * names are not used.
     * Dotb field mpping: n/a
     *
     * Generated from protobuf field <code>string middle_name = 3;</code>
     */
    private $middle_name = '';
    /**
     * Casual name of the End-User that may or may not be the same as the
     * given_name. For instance, a nickname value of Mike might be returned
     * alongside a given_name value of Michael.
     * Dotb legacy field mapping: n/a
     *
     * Generated from protobuf field <code>string nickname = 4;</code>
     */
    private $nickname = '';
    /**
     * End-User's preferred postal address.
     * Dotb field mapping: see `Address`
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.user.v1alpha.Address address = 5;</code>
     */
    private $address = null;
    /**
     * End-User's preferred e-mail address. Its value MUST conform to the
     * [RFC5322] addr-spec syntax. The RP MUST NOT rely upon this value being
     * unique.
     * Dotb field mapping: `users.email_addresses` link
     *
     * Generated from protobuf field <code>string email = 6;</code>
     */
    private $email = '';
    /**
     * End-User's preferred telephone number. E.164 [E.164] is RECOMMENDED as
     * the format of this Claim, for example, +1 (425) 555-1212 or
     * +56 (2) 687 2400. If the phone number contains an extension, it is
     * RECOMMENDED that the extension be represented using the [RFC3966]
     * extension syntax, for example, +1 (604) 555-1234;ext=5678.
     * Dotb field mapping: `users.phone_work`
     *
     * Generated from protobuf field <code>string phone_number = 7;</code>
     */
    private $phone_number = '';

    public function __construct() {
        \GPBMetadata\User\V1Alpha\User::initOnce();
        parent::__construct();
    }

    /**
     * Given name(s) or first name(s) of the End-User. Note that in some
     * cultures, people can have multiple given names; all can be present, with
     * the names being separated by space characters.
     * Dotb field mapping: `users.first_name`
     *
     * Generated from protobuf field <code>string given_name = 1;</code>
     * @return string
     */
    public function getGivenName()
    {
        return $this->given_name;
    }

    /**
     * Given name(s) or first name(s) of the End-User. Note that in some
     * cultures, people can have multiple given names; all can be present, with
     * the names being separated by space characters.
     * Dotb field mapping: `users.first_name`
     *
     * Generated from protobuf field <code>string given_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setGivenName($var)
    {
        GPBUtil::checkString($var, True);
        $this->given_name = $var;

        return $this;
    }

    /**
     * Surname(s) or last name(s) of the End-User. Note that in some cultures,
     * people can have multiple family names or no family name; all can be
     * present, with the names being separated by space characters.
     * Dotb field mapping: `users.last_name`
     *
     * Generated from protobuf field <code>string family_name = 2;</code>
     * @return string
     */
    public function getFamilyName()
    {
        return $this->family_name;
    }

    /**
     * Surname(s) or last name(s) of the End-User. Note that in some cultures,
     * people can have multiple family names or no family name; all can be
     * present, with the names being separated by space characters.
     * Dotb field mapping: `users.last_name`
     *
     * Generated from protobuf field <code>string family_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setFamilyName($var)
    {
        GPBUtil::checkString($var, True);
        $this->family_name = $var;

        return $this;
    }

    /**
     * Middle name(s) of the End-User. Note that in some cultures, people can
     * have multiple middle names; all can be present, with the names being
     * separated by space characters. Also note that in some cultures, middle
     * names are not used.
     * Dotb field mpping: n/a
     *
     * Generated from protobuf field <code>string middle_name = 3;</code>
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Middle name(s) of the End-User. Note that in some cultures, people can
     * have multiple middle names; all can be present, with the names being
     * separated by space characters. Also note that in some cultures, middle
     * names are not used.
     * Dotb field mpping: n/a
     *
     * Generated from protobuf field <code>string middle_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setMiddleName($var)
    {
        GPBUtil::checkString($var, True);
        $this->middle_name = $var;

        return $this;
    }

    /**
     * Casual name of the End-User that may or may not be the same as the
     * given_name. For instance, a nickname value of Mike might be returned
     * alongside a given_name value of Michael.
     * Dotb legacy field mapping: n/a
     *
     * Generated from protobuf field <code>string nickname = 4;</code>
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Casual name of the End-User that may or may not be the same as the
     * given_name. For instance, a nickname value of Mike might be returned
     * alongside a given_name value of Michael.
     * Dotb legacy field mapping: n/a
     *
     * Generated from protobuf field <code>string nickname = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setNickname($var)
    {
        GPBUtil::checkString($var, True);
        $this->nickname = $var;

        return $this;
    }

    /**
     * End-User's preferred postal address.
     * Dotb field mapping: see `Address`
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.user.v1alpha.Address address = 5;</code>
     * @return \Dotbcrm\Apis\Iam\User\V1alpha\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * End-User's preferred postal address.
     * Dotb field mapping: see `Address`
     *
     * Generated from protobuf field <code>.dotbcrm.apis.iam.user.v1alpha.Address address = 5;</code>
     * @param \Dotbcrm\Apis\Iam\User\V1alpha\Address $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkMessage($var, \Dotbcrm\Apis\Iam\User\V1alpha\Address::class);
        $this->address = $var;

        return $this;
    }

    /**
     * End-User's preferred e-mail address. Its value MUST conform to the
     * [RFC5322] addr-spec syntax. The RP MUST NOT rely upon this value being
     * unique.
     * Dotb field mapping: `users.email_addresses` link
     *
     * Generated from protobuf field <code>string email = 6;</code>
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * End-User's preferred e-mail address. Its value MUST conform to the
     * [RFC5322] addr-spec syntax. The RP MUST NOT rely upon this value being
     * unique.
     * Dotb field mapping: `users.email_addresses` link
     *
     * Generated from protobuf field <code>string email = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setEmail($var)
    {
        GPBUtil::checkString($var, True);
        $this->email = $var;

        return $this;
    }

    /**
     * End-User's preferred telephone number. E.164 [E.164] is RECOMMENDED as
     * the format of this Claim, for example, +1 (425) 555-1212 or
     * +56 (2) 687 2400. If the phone number contains an extension, it is
     * RECOMMENDED that the extension be represented using the [RFC3966]
     * extension syntax, for example, +1 (604) 555-1234;ext=5678.
     * Dotb field mapping: `users.phone_work`
     *
     * Generated from protobuf field <code>string phone_number = 7;</code>
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * End-User's preferred telephone number. E.164 [E.164] is RECOMMENDED as
     * the format of this Claim, for example, +1 (425) 555-1212 or
     * +56 (2) 687 2400. If the phone number contains an extension, it is
     * RECOMMENDED that the extension be represented using the [RFC3966]
     * extension syntax, for example, +1 (604) 555-1234;ext=5678.
     * Dotb field mapping: `users.phone_work`
     *
     * Generated from protobuf field <code>string phone_number = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setPhoneNumber($var)
    {
        GPBUtil::checkString($var, True);
        $this->phone_number = $var;

        return $this;
    }

}

