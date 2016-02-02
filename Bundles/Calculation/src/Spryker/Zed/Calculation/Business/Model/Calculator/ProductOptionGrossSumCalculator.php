<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Calculation\Business\Model\Calculator;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductOptionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ProductOptionGrossSumCalculator implements CalculatorInterface
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function recalculate(QuoteTransfer $quoteTransfer)
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $this->assertItemRequirements($itemTransfer);

            $this->setProductOptionSumGrossPrice($itemTransfer);

            $productOptionUnitTotal = $this->getProductOptionUnitTotal($itemTransfer);
            $productOptionSumTotal = $this->getProductOptionSumTotal($itemTransfer);

            $itemTransfer->setUnitGrossPriceWithProductOptions($itemTransfer->getUnitGrossPrice() + $productOptionUnitTotal);
            $itemTransfer->setSumGrossPriceWithProductOptions($itemTransfer->getSumGrossPrice() + $productOptionSumTotal);
        }
    }

    /**
     * @param ProductOptionTransfer $productOptionTransfer
     *
     * @return void
     */
    protected function assertProductOptionRequirements(ProductOptionTransfer $productOptionTransfer)
    {
        $productOptionTransfer->requireQuantity();
    }

    /**
     * @param ItemTransfer $itemTransfer
     *
     * @return void
     */
    protected function assertItemRequirements(ItemTransfer $itemTransfer)
    {
        $itemTransfer->requireSumGrossPrice()->requireQuantity();
    }


    /**
     * @param ItemTransfer $itemTransfer
     *
     * @return int
     */
    protected function getProductOptionUnitTotal(ItemTransfer $itemTransfer)
    {
        $productOptionUnitTotal = 0;
        foreach ($itemTransfer->getProductOptions() as $productOptionTransfer) {
            $this->assertProductOptionRequirements($productOptionTransfer);
            $productOptionUnitTotal += $productOptionTransfer->getUnitGrossPrice();
        }

        return $productOptionUnitTotal;
    }

    /**
     * @param ItemTransfer $itemTransfer
     *
     * @return int
     */
    protected function getProductOptionSumTotal(ItemTransfer $itemTransfer)
    {
        $productOptionSumTotal = 0;
        foreach ($itemTransfer->getProductOptions() as $productOptionTransfer) {
            $this->assertProductOptionRequirements($productOptionTransfer);
            $productOptionSumTotal += $productOptionTransfer->getSumGrossPrice();
        }

        return $productOptionSumTotal;
    }

    /**
     * @param ItemTransfer $itemTransfer
     *
     * @return void
     */
    protected function setProductOptionSumGrossPrice(ItemTransfer $itemTransfer)
    {
        foreach ($itemTransfer->getProductOptions() as $productOptionTransfer) {
            $this->assertProductOptionRequirements($productOptionTransfer);
            $productOptionTransfer->setSumGrossPrice(
                $productOptionTransfer->getUnitGrossPrice() * $productOptionTransfer->getQuantity()
            );
        }
    }

}
