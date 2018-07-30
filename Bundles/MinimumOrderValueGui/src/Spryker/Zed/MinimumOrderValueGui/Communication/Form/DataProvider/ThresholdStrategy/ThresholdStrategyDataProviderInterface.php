<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MinimumOrderValueGui\Communication\Form\DataProvider\ThresholdStrategy;

use Generated\Shared\Transfer\MinimumOrderValueTransfer;

interface ThresholdStrategyDataProviderInterface
{
    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\MinimumOrderValueTransfer $minimumOrderValueTransfer
     *
     * @return array
     */
    public function getData(array $data, MinimumOrderValueTransfer $minimumOrderValueTransfer): array;
}
