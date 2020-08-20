### How to use

#### Single Recipients

```
$key = 'api-key';

$sendgrid = \OmniSmtp\OmniSmtp::create(\Napoleon\OmniSmtp\Sendgrid::class, $key);

$sendgrid->setSubject('The Mail Subject')
    ->setFrom('napoleon@example.com')
    ->setRecipients('testemail1@example.com')
    ->setContent('<p>Hello From SendGrid OmniMail</p>')
    ->send();
```

#### Multiple Recipients

```
$key = 'api-key';

$sendgrid = \OmniSmtp\OmniSmtp::create(\Napoleon\OmniSmtp\Sendgrid::class, $key);

$sendgrid->setSubject('The Mail Subject')
    ->setFrom('napoleon@example.com')
    ->setRecipients('testemail1@example.com', 'testemail2@example.com')
    ->setContent('<p>Hello From SendGrid OmniMail</p>')
    ->send();
```
