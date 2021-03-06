<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisherInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 */
class ErpDeliveryNotePageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisherInterface
     */
    public function createErpDeliveryNotePageSearchPublisher(): ErpDeliveryNotePageSearchPublisherInterface
    {
        return new ErpDeliveryNotePageSearchPublisher(
            $this->getEntityManager(),
            $this->getQueryContainer(),
            $this->getUtilEncodingService(),
            $this->createErpDeliveryNotePageSearchDataMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisherInterface
     */
    public function createErpDeliveryNotePageSearchUnPublisher(): ErpDeliveryNotePageSearchUnpublisherInterface
    {
        return new ErpDeliveryNotePageSearchUnpublisher(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected function createErpDeliveryNotePageSearchDataMapper(): ErpDeliveryNotePageSearchDataMapperInterface
    {
        return new ErpDeliveryNotePageSearchDataMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
