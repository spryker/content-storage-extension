<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanySupplier\Business;

use Generated\Shared\Transfer\CompanySupplierCollectionTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\CompanySupplier\Persistence\CompanySupplierRepositoryInterface getRepository()
 * @method \Spryker\Zed\CompanySupplier\Persistence\CompanySupplierEntityManagerInterface getEntityManager()
 */
class CompanySupplierFacade extends AbstractFacade implements CompanySupplierFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\CompanySupplierCollectionTransfer
     */
    public function getAllSuppliers(): CompanySupplierCollectionTransfer
    {
        return $this->getRepository()->getAllSuppliers();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param int $idProduct
     *
     * @return \Generated\Shared\Transfer\CompanySupplierCollectionTransfer
     */
    public function getSuppliersByIdProduct(int $idProduct): CompanySupplierCollectionTransfer
    {
        return $this->getRepository()->getSuppliersByIdProduct($idProduct);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function saveCompanySuppliersForProductConcrete(ProductConcreteTransfer $productConcreteTransfer): void
    {
        $this->getEntityManager()->saveCompanySuppliersForProductConcrete($productConcreteTransfer);
    }

    public function formatProductSuppliersCollection(ObjectCollection $spyProductCollection)
    {
        return $this->getFactory()->createProductSupplierFormatter()->format($spyProductCollection);
    }
}
