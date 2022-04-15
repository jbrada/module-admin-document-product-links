<?php
declare(strict_types=1);

namespace JBrada\AdminDocumentProductLinks\Plugin\Block\Adminhtml\Items\Column\Name;

use JBrada\AdminDocumentProductLinks\Model\Query\IsProductExisting;
use Magento\Sales\Block\Adminhtml\Items\Column\Name;

class LinkToProductInAdmin
{
    /**
     * HTML entity for visualisation of target="_blank"
     */
    private const LINK_SYMBOL_HTML_ENTITY = '&#x2197;';

    /**
     * @var IsProductExisting
     */
    private IsProductExisting $isProductExisting;

    /**
     * @param IsProductExisting $isProductExisting
     */
    public function __construct(IsProductExisting $isProductExisting)
    {
        $this->isProductExisting = $isProductExisting;
    }

    /**
     * Plugin appends <a href="(..) after product name and SKU
     *
     * @param Name $subject
     * @param string $html
     * @return string
     */
    public function afterToHtml(Name $subject, string $html): string
    {
        $item = $subject->getItem();
        if ($item->getProductId() === null || $item->getStoreId() === null) {
            return $html;
        }

        $productId = (int)$item->getProductId();
        $storeId = (int)$item->getStoreId();

        if ($this->isProductExisting->query($productId) === false) {
            return $html;
        }

        return $html . '<br />' . $this->getLinkHtml($subject, $productId, $storeId);
    }

    /**
     * Link HTML generator
     *
     * @param Name $subject
     * @param int $productId
     * @param int $storeId
     * @return string
     */
    private function getLinkHtml(Name $subject, int $productId, int $storeId): string
    {
        $url = $subject->getUrl('catalog/product/edit', [
            'store' => $storeId,
            'id' => $productId
        ]);

        return sprintf(
            '<a href="%s" target="_blank">%s %s</a>',
            $url,
            (string)__('Open product'),
            self::LINK_SYMBOL_HTML_ENTITY
        );
    }
}
