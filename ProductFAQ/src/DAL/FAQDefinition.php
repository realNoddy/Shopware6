<?php declare(strict_types=1);

namespace ProductFAQ\DAL;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;

use ProductFAQ\DAL\Aggregate\FAQRelationDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;

class FAQDefinition extends EntityDefinition
{

    public const ENTITY_NAME = 'n_faq';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id','id'))->addFlags(new Required(), new PrimaryKey()),
            (new IdField('type','type'))->addFlags(new Required()),
            (new LongTextField('question','question'))->addFlags(new Required()),
            (new LongTextField('answer', 'answer'))->addFlags(new Required()),
            new ManyToManyAssociationField('products', ProductDefinition::class, FAQRelationDefinition::class, 'faq_id', 'product_id')
        ]);
    }
}
