<?php
declare(strict_types=1);

namespace JBrada\AdminOrderProductLinks\Test\Integration\Model\Query;

use JBrada\AdminOrderProductLinks\Model\Query\IsProductExisting;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;
use TddWizard\Fixtures\Catalog\ProductBuilder;
use TddWizard\Fixtures\Catalog\ProductFixture;

class IsProductExistingTest extends TestCase
{
    /**
     * A random high entity_id that does not exist in Magento
     */
    private const NOT_EXISTING_PRODUCT_ID = 9999999999;

    /**
     * @var IsProductExisting
     */
    private $isProductExisting = null;

    protected function setUp(): void
    {
        $this->isProductExisting = Bootstrap::getObjectManager()->get(IsProductExisting::class);
    }

    /**
     * @magentoDataFixture JBrada_AdminOrderProductLinks::_files/product_simple.php
     */
    public function testSuccess()
    {
        $this->assertTrue($this->isProductExisting->query(1));
    }

    public function testProductNotExisting()
    {
        $this->assertFalse($this->isProductExisting->query(self::NOT_EXISTING_PRODUCT_ID));
    }


}
