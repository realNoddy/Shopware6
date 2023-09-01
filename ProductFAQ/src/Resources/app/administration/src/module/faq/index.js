import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

const { Module } = Shopware;

Module.register('product-faq', {
    type: 'plugin',
    title: 'ProductFAQ.General.Title',
    description: 'ProductFAQ.General.Description',
    color: '#F88962',
    icon: 'default-shopping-paper-bag-product',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        list: {
            component: 'product-faq-list',
            path: 'list'
        }
    },

    navigation: [
        {
            label: 'ProductFAQ.General.Title',
            color: '#F88962',
            icon: 'default-shopping-paper-bag-product',
            path: 'product.faq.index',
            position: 100
        }
    ]
})