<?php
declare(strict_types=1);

namespace JBrada\AdminOrderProductLinks\Model\Query;

use JBrada\AdminOrderProductLinks\Api\IsProductExistingInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class IsProductExisting implements IsProductExistingInterface
{
    /**
     * Limit for getAllIds function call
     */
    private const LIMIT_IDS_COUNT = 1;

    /**
     * @var CollectionFactory $collectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Checks if product exists
     *
     * @param int $productId
     * @return bool
     */
    public function query(int $productId): bool
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('entity_id', $productId);

        return count($collection->getAllIds(self::LIMIT_IDS_COUNT)) > 0;
    }
}
