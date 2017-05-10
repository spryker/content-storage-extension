<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Header;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ApiFilterTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Model\Processor\Pre\Filter\Header\PaginationByHeaderFilterPreProcessor;

/**
 * @group Functional
 * @group Spryker
 * @group Zed
 * @group Api
 * @group Business
 * @group Model
 * @group Processor
 * @group Pre
 * @group Filter
 * @group Header
 * @group PaginationByHeaderFilterPreProcessorTest
 */
class PaginationByHeaderFilterPreProcessorTest extends Test
{

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testProcessWithDefaultsPageOne()
    {
        $config = new ApiConfig();
        $processor = new PaginationByHeaderFilterPreProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setFilter(new ApiFilterTransfer());
        $apiRequestTransfer->setHeaderData([
            PaginationByHeaderFilterPreProcessor::RANGE => ['users 0-19/200'],
        ]);

        $apiRequestTransferAfter = $processor->process($apiRequestTransfer);
        $this->assertSame(20, $apiRequestTransferAfter->getFilter()->getLimit());
        $this->assertSame(0, $apiRequestTransferAfter->getFilter()->getOffset());
    }

    /**
     * @return void
     */
    public function testProcessWithDefaultsPageTwo()
    {
        $config = new ApiConfig();
        $processor = new PaginationByHeaderFilterPreProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setFilter(new ApiFilterTransfer());
        $apiRequestTransfer->setHeaderData([
            PaginationByHeaderFilterPreProcessor::RANGE => ['users 20-39/200'],
        ]);

        $apiRequestTransferAfter = $processor->process($apiRequestTransfer);
        $this->assertSame(20, $apiRequestTransferAfter->getFilter()->getLimit());
        $this->assertSame(20, $apiRequestTransferAfter->getFilter()->getOffset());
    }

    /**
     * @return void
     */
    public function testProcessWithCustomLimit()
    {
        $config = new ApiConfig();
        $processor = new PaginationByHeaderFilterPreProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setFilter(new ApiFilterTransfer());
        $apiRequestTransfer->setHeaderData([
            PaginationByHeaderFilterPreProcessor::RANGE => ['users 20-29/200'],
        ]);

        $apiRequestTransferAfter = $processor->process($apiRequestTransfer);
        $this->assertSame(10, $apiRequestTransferAfter->getFilter()->getLimit());
        $this->assertSame(20, $apiRequestTransferAfter->getFilter()->getOffset());
    }

}
