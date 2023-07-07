<?php

namespace App\Tests;

use App\Services\EmailService;
use App\Services\Invoice;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceTest extends KernelTestCase
{
    public function testProcessInvoice(): void
    {
        $emailServiceMock = $this->createMock(EmailService::class);

        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->willReturn(true);

        $invoice = new Invoice($emailServiceMock);
        $result=$invoice->process("wyona@gmail.com", 30);

        $this->assertTrue($result);
    }
}
