<?php


namespace Tests\Unit;

use OmniSmtp\OmniSmtp;
use PHPUnit\Framework\TestCase;

class SendGridTest extends TestCase
{
    public function testSendGridEmail()
    {
        $data = [
            'recipient' => [
                $email1 = 'napoleon101392@gmail.com',
                $email2 = 'nap.carino@nuworks.ph'
            ],
            'sender' => $sender = 'napoleon@example.com',
            'subject' => $subject = 'The Mail Subject',
            'content' => $content = '<p>Hello From SendGrid OmniMail</p>'
        ];

        $sendgrid = OmniSmtp::create(\Napoleon\OmniSmtp\SendGrid::class, 'api-key');

        $response = $sendgrid->setSubject($subject)
            ->setFrom($sender)
            ->setRecipients($email1, $email2)
            ->setContent($content);

        $this->assertEquals($response->getData(), $data);
    }
}
