<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Zed\Mail\Business\Model\Mail;

use Spryker\Zed\Mail\Business\Exception\MailNotFoundException;
use Spryker\Zed\Mail\Business\Model\Mail\MailTypeCollection;
use Spryker\Zed\Mail\Dependency\Plugin\MailTypeInterface;

/**
 * @group Unit
 * @group Spryker
 * @group Zed
 * @group Mail
 * @group Business
 * @group Model
 * @group Mail
 * @group MailTypeCollectionTest
 */
class MailTypeCollectionTest extends \PHPUnit_Framework_TestCase
{

    const MAIL_TYPE_A = 'mail type a';

    /**
     * @return void
     */
    public function testAddMailTypeReturnFluentInterface()
    {
        $mailTypeCollection = $this->getMailCollection();
        $mailTypeMock = $this->getMailTypeMock();

        $this->assertInstanceOf(MailTypeCollection::class, $mailTypeCollection->add($mailTypeMock));
    }

    /**
     * @return void
     */
    public function testHasShouldReturnFalseWhenMailTypeNotInCollection()
    {
        $mailTypeCollection = $this->getMailCollection();

        $this->assertFalse($mailTypeCollection->has(static::MAIL_TYPE_A));
    }

    /**
     * @return void
     */
    public function testHasShouldReturnTrueWhenMailTypeInCollection()
    {
        $mailTypeMock = $this->getMailTypeMock();
        $mailTypeCollection = $this->getMailCollection();
        $mailTypeCollection->add($mailTypeMock);

        $this->assertTrue($mailTypeCollection->has(static::MAIL_TYPE_A));
    }

    /**
     * @return void
     */
    public function testGetByMailTypeShouldReturnMailTypeWhenMailTypeInCollection()
    {
        $mailTypeMock = $this->getMailTypeMock();
        $mailTypeCollection = $this->getMailCollection();
        $mailTypeCollection->add($mailTypeMock);

        $this->assertInstanceOf(MailTypeInterface::class, $mailTypeCollection->get(static::MAIL_TYPE_A));
    }

    /**
     * @return void
     */
    public function testGetByMailTypeShouldThrowExceptionWhenMailTypeNotInCollection()
    {
        $mailTypeCollection = $this->getMailCollection();

        $this->expectException(MailNotFoundException::class);
        $mailTypeCollection->get(static::MAIL_TYPE_A);
    }

    /**
     * @return \Spryker\Zed\Mail\Business\Model\Mail\MailTypeCollection
     */
    protected function getMailCollection()
    {
        return new MailTypeCollection();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Spryker\Zed\Mail\Dependency\Plugin\MailTypeInterface
     */
    protected function getMailTypeMock()
    {
        $mailTypeMock = $this->getMockBuilder(MailTypeInterface::class)->setMethods(['getName', 'build'])->getMock();
        $mailTypeMock->method('getName')->willReturn(static::MAIL_TYPE_A);

        return $mailTypeMock;
    }

}
