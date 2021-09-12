<?php

namespace DRI_Workflows;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class Config
{
    /**
     * @var array
     */
    private static $availableKeys = array(
        'license_key',
        'validation_key',
        'template_version'
    );

    /**
     * @var array|null
     */
    private $properties;

    /**
     * @var \Administration
     */
    protected $admin;

    /**
     *
     */
    public function load()
    {
        if (null === $this->properties) {
            $this->admin = \Administration::getSettings('DRI_Workflows');

            foreach (self::$availableKeys as $availableKey) {
                $key = 'DRI_Workflows_'.$availableKey;

                if (isset($this->admin->settings[$key])) {
                    $this->properties[$availableKey] = $this->admin->settings[$key];
                }
            }
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    private function saveSetting($key, $value)
    {
        $this->properties[$key] = $value;
        $this->admin->saveSetting('DRI_Workflows', $key, $this->properties[$key], "base");
    }

    /**
     * @return string
     */
    public function getTemplateVersion()
    {
        return $this->getValue('template_version', 0);
    }

    /**
     * @param int $version
     */
    public function setTemplateVersion($version)
    {
        $this->load();
        $this->saveSetting('template_version', $version);
    }

    /**
     * @return string
     */
    public function getCurrentVersion()
    {
        return require 'modules/DRI_Workflows/version.php';
    }

    /**
     * @return string
     */
    public function getLicenseKey()
    {
        return $this->getValue('license_key');
    }

    /**
     * @return string
     */
    public function getValidationKey()
    {
        return $this->getValue('validation_key');
    }

    /**
     * @param string $validationKey
     */
    public function setValidationKey($validationKey)
    {
        $this->load();
        $this->properties['validation_key'] = $validationKey;
    }

    /**
     * @param string $validationKey
     */
    public function saveValidationKey($validationKey)
    {
        $this->setValidationKey($validationKey);
        $this->saveSetting('validation_key', $validationKey);
    }

    /**
     * @param string $licenseKey
     */
    public function setLicenseKey($licenseKey)
    {
        $this->load();
        $this->properties['license_key'] = $licenseKey;
    }

    /**
     * @param string $validUntil
     */
    public function setValidUntil($validUntil)
    {
        $this->load();
        $this->saveSetting('valid_until', $validUntil);
    }

    /**
     * @param string $users
     */
    public function setUserLimit($users)
    {
        $this->load();
        $this->saveSetting('users', $users);
    }

    /**
     * @param string $name
     * @param null $default
     *
     * @return null
     */
    private function getValue($name, $default = null)
    {
        $this->load();
        return isset($this->properties[$name]) ? $this->properties[$name] : $default;
    }
}
