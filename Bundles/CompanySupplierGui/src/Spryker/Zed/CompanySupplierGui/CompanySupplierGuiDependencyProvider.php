<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanySupplierGui;

use Spryker\Zed\CompanySupplierGui\Dependency\Facade\CompanySupplierGuiToCompanySupplierFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanySupplierGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_SUPPLIER = 'FACADE_COMPANY_SUPPLIER';
    public const QUERY_CONTAINER_COMPANY_SUPPLIER = 'QUERY_CONTAINER_COMPANY_SUPPLIER';
    public const FACADE_MONEY = 'FACADE_MONEY';
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addCompanySupplierFacade($container);
        $container = $this->addCompanySupplierQueryContainer($container);
        $container = $this->addMoneyFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanySupplierFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_SUPPLIER] = function (Container $container) {
            return new CompanySupplierGuiToCompanySupplierFacadeBridge($container->getLocator()->companySupplier()->facade());
        };

        return $container;
    }

    protected function addCompanySupplierQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_COMPANY_SUPPLIER] = function (Container $container) {
            return $container->getLocator()->companySupplier()->queryContainer();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMoneyFacade(Container $container): Container
    {
        $container[static::FACADE_MONEY] = function (Container $container) {
            return $container->getLocator()->money()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return $container->getLocator()->store()->facade();
        };

        return $container;
    }
}
