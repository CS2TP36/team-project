<?php

namespace Tests\Unit;

use App\Http\Emailer;
use PHPUnit\Framework\TestCase;

class EmailerTest extends TestCase
{

    public function testSendEmail()
    {
        $emailer = new Emailer('test');
        $this->assertTrue($emailer->sendEmail('matthew@speake.uk', 'Test Email', 'This is a test email'));
    }
}
