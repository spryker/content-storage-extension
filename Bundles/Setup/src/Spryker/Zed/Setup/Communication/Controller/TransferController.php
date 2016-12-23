<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Setup\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\ZedRequest\Communication\Plugin\TransferObject\TransferServer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * @method \Spryker\Zed\Setup\Business\SetupFacade getFacade()
 */
class TransferController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response|array
     */
    public function repeatAction(Request $request)
    {
        $repeatData = $this->getFacade()->getRepeatData($request);

        if (!is_array($repeatData)) {
            return new Response('No request to repeat.');
        }

        TransferServer::getInstance()->activateRepeating();
        $request = Request::createFromGlobals();
        $request->attributes->set('module', $repeatData['module']);
        $request->attributes->set('controller', $repeatData['controller']);
        $request->attributes->set('action', $repeatData['action']);

        $request->request->replace($repeatData);

        return $this->getApplication()->handle($request, HttpKernelInterface::SUB_REQUEST);
    }

}
