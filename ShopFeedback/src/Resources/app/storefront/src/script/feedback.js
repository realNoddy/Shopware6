
//OffCanvasCart
//AddToCart

//PluginManager.getPlugin('AddToCart').$emitter.subscribe('openOffCanvasCart', ()=>{console.log("");});
//https://developer.shopware.com/docs/guides/plugins/plugins/storefront/reacting-to-javascript-events#registering-to-events

import AddToCartPlugin from 'src/plugin/add-to-cart/add-to-cart.plugin';
import DomAccess from 'src/helper/dom-access.helper';
import HttpClient from 'src/service/http-client.service';
import FormSerializeUtil from 'src/utility/form/form-serialize.util';


export default class Feedback extends AddToCartPlugin {

    init() {
        console.log("feedback init");
        this._cart = DomAccess.querySelector(document, '.header-cart');
        this._client = new HttpClient(window.accessKey, window.contextToken);
        super.init();
    }

    _openOffCanvasCart(instance, requestUrl, formData) {
        this._client.post(requestUrl, formData, this._afterAddItemToCart());
    }

    _afterAddItemToCart(){
        this._refreshCart();
        const formData = FormSerializeUtil.serialize(this._form);
        console.log(FormSerializeUtil.serializeJson(this._form));
    }

    _refreshCart(){
        const cartWidget = DomAccess.querySelector(this._cart, '[data-cart-widget]');
        const cartWidgetInstance = window.PluginManager.getPluginInstanceFromElement(cartWidget, 'CartWidget');
        setTimeout(()=>{
            cartWidgetInstance.fetch();
        },50);
        
    }

}