<?php
declare(strict_types=1);

namespace JBrada\AdminDocumentProductLinks\Api;

interface IsProductExistingInterface
{
    /**
     * Checks existence of a product by ProductId
     *
     * @param int $productId
     * @return bool
     */
    public function query(int $productId): bool;
}
