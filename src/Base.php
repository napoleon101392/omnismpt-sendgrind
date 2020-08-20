<?php

namespace Napoleon\OmniSmtp;

use OmniSmtp\Common\ProviderInterface;

abstract class Base implements ProviderInterface
{
    public function __construct(Mail $mail)
    {
        $this->email = $mail;
    }

    /**
     * Set authorization header name
     *
     * @param string $bearer
     *
     * @return $this
     */
    public function setAuthorizationHearerName(string $bearer = 'Authorization'){}

    /**
     * Get authorization  header name
     *
     * @return string
     */
    public function getAuthorizationHeaderName(){}

    /**
     * Get mail subject
     *
     * @return void
     */
    public function getSubject(){}

    /**
     * Get email html content
     *
     * @return $this
     */
    public function getContent(){}

    /**
     * Get sender
     *
     * @return mixed
     */
    public function getFrom(){}

    /**
     * Get recipients
     *
     * @return array
     */
    public function getRecipients(){}

    /**
     * Set SMTP apikey
     *
     * @param string $apikey
     *
     * @return $this
     */
    public function setApiKey(string $apikey)
    {}

    /**
     * Get SMTP api key
     *
     * @return string|null
     */
    public function getApikey(){}
}
