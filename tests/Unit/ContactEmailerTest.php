<?php

namespace Tests\Unit;

use App\Http\Emailers\ContactEmailer;
use App\Models\ContactItem;
use PHPUnit\Framework\TestCase;

class ContactEmailerTest extends TestCase
{

    public function test__construct()
    {
        $contactEmailer = new ContactEmailer();
        $this->assertEquals('support', $contactEmailer->name);
    }

    public function testConfirmation()
    {
        $contactEmailer = new ContactEmailer();
        $this->assertTrue($contactEmailer->sendConfirmation(new ContactItem([
            'name' => 'Test User',
            'email' => 'matthew@speake.uk',
            'phone' => '+447777777777',
            'message' => 'This is a test message'
        ])));
    }

}
