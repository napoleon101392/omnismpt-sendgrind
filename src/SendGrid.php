<?php

namespace Napoleon\OmniSmtp;

use SendGrid\Mail\Mail;
use OmniSmtp\Exceptions\OmniMailException;

class SendGrid extends Base
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $sendgrid;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $subject;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $from;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $recipients;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $content;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $contentBodyType;

    /**
     * Undocumented function
     *
     * @param [type] $apikey
     */
    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * Set mail subject
     *
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set smtp sender
     *
     * Needs to be override by smtp providers
     *
     * @param string $from
     *
     * @return $this
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set smtp recipients
     *
     * @param array $recipients
     *
     * @return $this
     */
    public function setRecipients(...$recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Set mail content. This is an html content
     *
     * @param string $html
     *
     * @return $this
     */
    public function setContent(string $html)
    {
        $this->content = $html;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function send()
    {
        $email = new Mail();
        $email = $this->addTo($email);
        $email->setFrom($this->from);
        $email->setSubject($this->subject);
        $email->addContent($this->contentBodyType, $this->content);

        $response = (new \SendGrid($this->apikey))->send($email);

        if (!in_array($response->statusCode(), [200, 201, 202])) {
            throw OmniMailException::actualSendingEmailException(json_encode($response->content));
        }

        return true;
    }

    /**
     * Undocumented function
     *
     * @param string $type
     *
     * @return void
     */
    public function contentBodyType($type = "text/plain")
    {
        $this->contentBodyType = $type;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param [type] $mail
     *
     * @return Mail
     */
    protected function addTo($mail)
    {
        foreach ($this->recipients as $email) {
            $mail->addTo($email);

            unset($email);
        }

        return $mail;
    }
}
