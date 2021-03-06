<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Rma\Test\Constraint;

use Magento\Customer\Test\Fixture\Customer;
use Magento\Rma\Test\Fixture\Rma;
use Magento\Rma\Test\Page\Adminhtml\RmaIndex;
use Magento\Sales\Test\Fixture\OrderInjectable;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 * Assert that return request displayed in Returns grid.
 */
class AssertRmaInGrid extends AbstractConstraint
{
    /**
     * Assert that return request displayed in Returns grid:
     * - customer
     * - status (pending)
     * - orderID
     *
     * @param Rma $rma
     * @param RmaIndex $rmaIndex
     * @return void
     */
    public function processAssert(Rma $rma, RmaIndex $rmaIndex)
    {
        /** @var OrderInjectable $order*/
        $order = $rma->getDataFieldConfig('order_id')['source']->getOrder();
        /** @var Customer $customer */
        $customer = $order->getDataFieldConfig('customer_id')['source']->getCustomer();
        $orderId = $rma->getOrderId();
        $filter = [
            'order_id' => $orderId,
            'customer' => sprintf('%s %s', $customer->getFirstname(), $customer->getLastname()),
            'status' => $rma->getStatus(),
        ];

        $rmaIndex->open();
        \PHPUnit_Framework_Assert::assertTrue(
            $rmaIndex->getRmaGrid()->isRowVisible($filter),
            'Rma for order ' . $orderId . ' is absent in grid.'
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Rma is present in grid';
    }
}
