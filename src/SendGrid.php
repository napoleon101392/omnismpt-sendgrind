<?php

namespace Napoleon\OmniSmtp;

use SendGrid\Mail\Mail;
use OmniSmtp\Exceptions\OmniMailException;

class SendGrid extends Base
{
    /**
     * Mail subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Sender
     *
     * @var string
     */
    protected $from;

    /**
     * Recipients
     *
     * @var array
     */
    protected $recipients;

    /**
     * Body content
     *
     * @var string
     */
    protected $content;

    /**
     * The of the body content
     * default to "text/plain"
     *
     * @var string
     */
    protected $contentBodyType;

    /**
     * Instance
     *
     * @param string $apikey
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setContent(string $html)
    {
        $this->content = $html;

        return $this;
    }

    /**
     * Creates an Mail instance
     * Merge the collected data
     * and sending it to recipients
     *
     * @return OmniMailException|boolean
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
            throw OmniMailException::actualSendingEmailException(json_encode($response->body()));
        }

        return true;
    }

    /**
     * Mutator for body type
     *
     * @param string $type
     *
     * @return self
     */
    public function contentBodyType($type = "text/plain")
    {
        $this->contentBodyType = $type;

        return $this;
    }

    /**
     * Manipulate recipeints to add in
     * mail container
     *
     * @param \SendGrid\Mail\Mail $mail
     *
     * @return \SendGrid\Mail\Mail
     */
    protected function addTo(Mail $mail)
    {
        foreach ($this->recipients as $email) {
            $mail->addTo($email);

            $this->email[] = $email;

            unset($email);
        }

        return $mail;
    }

    /**
     * Dataset
     *
     * @return array
     */
    public function getData()
    {
        $data = [
            'recipient' => $this->recipients,
            'sender' => $this->from,
            'subject' => $this->subject,
            'content' => $this->content
        ];

        return $data;
    }
}
