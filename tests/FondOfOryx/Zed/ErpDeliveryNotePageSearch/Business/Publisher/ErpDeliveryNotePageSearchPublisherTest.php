<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Propel\Runtime\Collection\ObjectCollection;

class ErpDeliveryNotePageSearchPublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit
     */
    protected $companyBusinessUnitMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress
     */
    protected $erpDeliveryNoteAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface
     */
    protected $erpDeliveryNotePageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected $erpDeliveryNotePageSearchDataMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface
     */
    protected $erpDeliveryNotePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected $erpDeliveryNotePageSearchToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher
     */
    protected $erpDeliveryNotePageSearchPublisher;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem
     */
    protected $erpDeliveryNoteItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense
     */
    protected $erpDeliveryNoteExpenseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Country\Persistence\SpyCountry
     */
    protected $countryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected $erpDeliveryNoteQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote
     */
    protected $erpDeliveryNoteMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $objectCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePageSearchEntityManagerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchQueryContainerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchDataMapperMock = $this->getMockBuilder(ErpDeliveryNotePageSearchDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteQueryMock = $this->getMockBuilder(FooErpDeliveryNoteQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteMock = $this->getMockBuilder(FooErpDeliveryNote::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryMock = $this->getMockBuilder(SpyCountry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemMock = $this->getMockBuilder(FooErpDeliveryNoteItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteExpenseMock = $this->getMockBuilder(FooErpDeliveryNoteExpense::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitMock = $this->getMockBuilder(SpyCompanyBusinessUnit::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteAddressMock = $this->getMockBuilder(FooErpDeliveryNoteAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchPublisher = new ErpDeliveryNotePageSearchPublisher(
            $this->erpDeliveryNotePageSearchEntityManagerMock,
            $this->erpDeliveryNotePageSearchQueryContainerMock,
            $this->erpDeliveryNotePageSearchToUtilEncodingServiceMock,
            $this->erpDeliveryNotePageSearchDataMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testPublish()
    {
        $erpDeliveryNoteIds = [];

        $orderEntities = [
            $this->erpDeliveryNoteMock,
        ];
        $itemObjectCollection = new ObjectCollection([$this->erpDeliveryNoteItemMock]);
        $expenseObjectCollection = new ObjectCollection([$this->erpDeliveryNoteExpenseMock]);

        $updatedAt = new DateTime('NOW');

        $this->erpDeliveryNotePageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds')
            ->with($erpDeliveryNoteIds)
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->erpDeliveryNoteQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($orderEntities);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getSpyCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitMock);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getFooErpDeliveryNoteItems')
            ->willReturn($itemObjectCollection);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getFooErpDeliveryNoteExpenses')
            ->willReturn($expenseObjectCollection);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getFooErpDeliveryNoteBillingAddress')
            ->willReturn($this->erpDeliveryNoteAddressMock);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getFooErpDeliveryNoteShippingAddress')
            ->willReturn($this->erpDeliveryNoteAddressMock);

        $this->erpDeliveryNoteAddressMock->expects(static::atLeastOnce())
            ->method('getSpyCountry')
            ->willReturn($this->countryMock);

        $this->countryMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn('DE');

        $this->companyBusinessUnitMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpDeliveryNoteAddressMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpDeliveryNoteMock->expects(static::atLeastOnce())
            ->method('getUpdatedAt')
            ->willReturn($updatedAt);

        $this->erpDeliveryNotePageSearchPublisher->publish($erpDeliveryNoteIds);
    }
}
