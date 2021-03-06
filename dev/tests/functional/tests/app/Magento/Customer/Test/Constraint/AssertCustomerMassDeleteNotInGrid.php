<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Customer\Test\Constraint;

use Magento\Customer\Test\Fixture\CustomerInjectable;
use Magento\Customer\Test\Page\Adminhtml\CustomerIndex;
use Mtf\Constraint\AbstractConstraint;

/**
 * Class AssertCustomerMassDeleteNotInGrid
 * Check that mass deleted customers are not in customer's grid
 */
class AssertCustomerMassDeleteNotInGrid extends AbstractConstraint
{
    /**
     * Constraint severeness
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Asserts that mass deleted customers are not in customer's grid
     *
     * @param CustomerIndex $customerIndexPage
     * @param AssertCustomerNotInGrid $assertCustomerNotInGrid
     * @param int $customersQtyToDelete
     * @param CustomerInjectable[] $customers
     * @return void
     */
    public function processAssert(
        CustomerIndex $customerIndexPage,
        AssertCustomerNotInGrid $assertCustomerNotInGrid,
        $customersQtyToDelete,
        $customers
    ) {
        for ($i = 0; $i < $customersQtyToDelete; $i++) {
            $assertCustomerNotInGrid->processAssert($customers[$i], $customerIndexPage);
        }
    }

    /**
     * Success message if Customer not in grid
     *
     * @return string
     */
    public function toString()
    {
        return 'Deleted customers are absent in Customer grid.';
    }
}
