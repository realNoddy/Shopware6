<?php declare(strict_types=1);

namespace ProductFAQ\DAL;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class FAQCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return FAQEntity::class;
    }
}

