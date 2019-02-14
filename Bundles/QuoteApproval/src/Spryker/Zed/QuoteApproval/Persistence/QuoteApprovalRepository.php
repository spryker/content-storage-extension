<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\QuoteApproval\Persistence;

use Generated\Shared\Transfer\QuoteApprovalTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\QuoteApproval\Persistence\QuoteApprovalPersistenceFactory getFactory()
 */
class QuoteApprovalRepository extends AbstractRepository implements QuoteApprovalRepositoryInterface
{
    /**
     * @param int $idQuote
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalTransfer[]
     */
    public function getQuoteApprovalsByIdQuote(int $idQuote): array
    {
        $quoteApprovalEntities = $this->getFactory()
            ->createQuoteApprovalPropelQuery()
            ->filterByFkQuote($idQuote)
            ->orderByIdQuoteApproval()
            ->find();

        $quoteApprovalTransfers = [];

        foreach ($quoteApprovalEntities as $quoteApprovalEntity) {
            $quoteApprovalTransfers[] = $this->getFactory()
                ->createQuoteApprovalMapper()
                ->mapQuoteApprovalEntityToTransfer(
                    $quoteApprovalEntity,
                    new QuoteApprovalTransfer()
                );
        }

        return $quoteApprovalTransfers;
    }

    /**
     * @param int $idQuoteApproval
     *
     * @return int|null
     */
    public function findIdQuoteByIdQuoteApproval(int $idQuoteApproval): ?int
    {
        $quoteApprovalEntity = $this->getFactory()
            ->createQuoteApprovalPropelQuery()
            ->filterByIdQuoteApproval($idQuoteApproval)
            ->find()
            ->getFirst();

        return $quoteApprovalEntity ? $quoteApprovalEntity->getFkQuote() : null;
    }

    /**
     * @param int $idQuoteApproval
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalTransfer|null
     */
    public function findQuoteApprovalById(int $idQuoteApproval): ?QuoteApprovalTransfer
    {
        $quoteApprovalEntity = $this->getFactory()
            ->createQuoteApprovalPropelQuery()
            ->findOneByIdQuoteApproval($idQuoteApproval);

        if ($quoteApprovalEntity === null) {
            return null;
        }

        $quoteApprovalTransfer = $this->getFactory()
            ->createQuoteApprovalMapper()
            ->mapQuoteApprovalEntityToTransfer($quoteApprovalEntity, new QuoteApprovalTransfer());

        return $quoteApprovalTransfer;
    }
}
