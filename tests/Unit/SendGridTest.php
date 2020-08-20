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

        $response = $sendgrid->setSubject('The Mail Subject')
            ->setFrom('napoleon@example.com')
            ->setRecipients('napoleon101392@gmail.com', 'nap.carino@nuworks.ph')
            ->setContent('<p>Hello From SendGrid OmniMail</p>')
            ->send();

        $this->assertTrue($response);
    }
}
