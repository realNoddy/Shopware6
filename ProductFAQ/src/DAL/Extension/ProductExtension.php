<?php declare(strict_types=1);

namespace ProductFAQ\DAL\Extension;

use ProductFAQ\DAL\Aggregate\FAQRelationDefinition;
use ProductFAQ\DAL\FAQDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductExtension extends EntityExtension
{

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new ManyToManyAssociationField(
                'n_faqs',
                FAQDefinition::class,
                FAQRelationDefinition::class,
                'product_id',
                'faq_id'
            ))->addFlags(new Inherited())
        );
    }

    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }
    
}
