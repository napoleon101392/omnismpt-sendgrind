<?php


namespace Tests\Unit;

use OmniSmtp\OmniSmtp;
use PHPUnit\Framework\TestCase;

class SendGridTest extends TestCase
{
    public function testSendGridEmail()
    {
        $key = 'api-key';

        $sendgrid = OmniSmtp::create(\Napoleon\OmniSmtp\Sendgrid::class, $key);

        $response = $sendgrid->setSubject($subject = 'The Mail Subject')
            ->setFrom($sender = 'napoleon@example.com')
            ->setRecipients($email1 = 'napoleon101392@gmail.com', $email2 = 'nap.carino@nuworks.ph')
            ->setContent($content = '<p>Hello From SendGrid OmniMail</p>');

        $this->assertEquals($response->getData(), [
            'recipient' => [
                $email1,
                $email2
            ],
            'sender' => $sender,
            'subject' => $subject,
            'content' => $content
        ]);
    }
}
