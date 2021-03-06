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

namespace Magento\Catalog\Model\Layer\Search;

use Magento\CatalogSearch\Model\Layer\Search\StateKey;

class StateKeyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $storeManagerMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $customerSessionMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $queryFactoryMock;

    /**
     * @var \Magento\CatalogSearch\Model\Layer\Search\StateKey
     */
    protected $model;

    protected function setUp()
    {
        $this->storeManagerMock = $this->getMock('\Magento\Framework\StoreManagerInterface');
        $this->customerSessionMock = $this->getMock('\Magento\Customer\Model\Session', array(), array(), '', false);
        $this->queryFactoryMock = $this->getMock(
            '\Magento\Search\Model\QueryFactory',
            array(),
            array(),
            '',
            false
        );

        $this->model = new StateKey($this->storeManagerMock, $this->customerSessionMock, $this->queryFactoryMock);
    }

    /**
     * @covers \Magento\CatalogSearch\Model\Layer\Search\StateKey::toString
     * @covers \Magento\CatalogSearch\Model\Layer\Search\StateKey::__construct
     */
    public function testToString()
    {
        $categoryMock = $this->getMock('\Magento\Catalog\Model\Category', array(), array(), '', false);
        $categoryMock->expects($this->once())->method('getId')->will($this->returnValue('1'));

        $storeMock = $this->getMock('\Magento\Store\Model\Store', array(), array(), '', false);
        $this->storeManagerMock->expects($this->once())->method('getStore')->will($this->returnValue($storeMock));
        $storeMock->expects($this->once())->method('getId')->will($this->returnValue('2'));

        $this->customerSessionMock->expects($this->once())->method('getCustomerGroupId')->will($this->returnValue('3'));

        $queryMock = $this->getMock('\Magento\CatalogSearch\Helper\Query', array('getId'), array(), '', false);
        $queryMock->expects($this->once())->method('getId')->will($this->returnValue('4'));
        $this->queryFactoryMock->expects($this->once())->method('get')->will($this->returnValue($queryMock));

        $this->assertEquals('Q_4_STORE_2_CAT_1_CUSTGROUP_3', $this->model->toString($categoryMock));
    }
}
