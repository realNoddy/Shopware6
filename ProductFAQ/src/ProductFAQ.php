<?php declare(strict_types=1);

namespace ProductFAQ;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\EntityIndexerRegistry;


class ProductFAQ extends Plugin
{
    public function activate(ActivateContext $activateContext):void
    {
        $entityIndexerRegistry = $this->container->get(EntityIndexerRegistry::class);
        $entityIndexerRegistry->sendIndexingMessage(['product.indexer']);
    }
}