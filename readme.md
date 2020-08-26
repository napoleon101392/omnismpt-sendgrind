[![Build Status](https://travis-ci.org/napoleon101392/omnismpt-sendgrind.svg?branch=master)](https://travis-ci.org/napoleon101392/omnismpt-sendgrind)

### Installation
`composer require napoleon/omnismtp-sendgrid`

### How to use

#### Single Recipients

```php
<?php

$key = 'api-key';

$sendgrid = \OmniSmtp\OmniSmtp::create(\Napoleon\OmniSmtp\SendGrid::class, $key);

$sendgrid->setSubject('The Mail Subject')
    ->setFrom('napoleon@example.com')
    ->setRecipients('testemail1@example.com')
    ->setContent('<p>Hello From SendGrid OmniMail</p>')
    ->send();
```

#### Multiple Recipients

```php
<?php
$key = 'api-key';

$sendgrid = \OmniSmtp\OmniSmtp::create(\Napoleon\OmniSmtp\SendGrid::class, $key);

$sendgrid->setSubject('The Mail Subject')
    ->setFrom('napoleon@example.com')
    ->setRecipients('testemail1@example.com', 'testemail2@example.com')
    ->setContent('<p>Hello From SendGrid OmniMail</p>')
    ->send();
```
