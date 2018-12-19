<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\AvailabilityNotification\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

interface AvailabilityNotificationToMailInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return mixed
     */
    public function handleMail(MailTransfer $mailTransfer);
}
