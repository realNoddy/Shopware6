import AddToCartPlugin from 'src/plugin/add-to-cart/add-to-cart.plugin';
import DomAccess from 'src/helper/dom-access.helper';
import HttpClient from 'src/service/http-client.service';
import FormSerializeUtil from 'src/utility/form/form-serialize.util';


export default class Feedback extends AddToCartPlugin {

    init() {
        
        this._cart = DomAccess.querySelector(document, '.header-cart [data-cart-widget]');
        this._client = new HttpClient(window.accessKey, window.contextToken);

        if (typeof Feedback.notification === 'undefined') {
            const notificationDiv = document.createElement('div');
            notificationDiv.id ='shop-feedback-notification';
            document.querySelector('body').append(notificationDiv);
            Feedback.notification = notificationDiv;
        }

        super.init();
    }

    _openOffCanvasCart(instance, requestUrl, formData) {
        this._client.post(requestUrl, formData, this._afterAddItemToCart());
    }

    _afterAddItemToCart(){
        const formButton = DomAccess.querySelector(this._form, '.btn-buy');
        formButton.classList.add('shop-feedback');
        formButton.innerText = formButton.dataset.addToCartText;
        formButton.disabled = true;
        setTimeout(()=>{
            formButton.classList.remove('shop-feedback');
            formButton.innerText = formButton.title;
            formButton.disabled = false;
        },1000);
        this._showNotification(this._form);
        this._refreshCart();
    }

    _showNotification(productForm){
        const productNotification = document.createElement('div');
        productNotification.classList.add('shop-feedback-item-notification');
        productNotification.classList.add('notification-show');
        const productData = FormSerializeUtil.serializeJson(productForm);
        let productPrice = "0";
        if (productForm.id == "productDetailPageBuyProductForm"){
            productPrice = productForm.closest('.product-detail-content').querySelector('.product-detail-price').innerText;
        }else{
            productPrice = productForm.closest('.product-info').querySelector('.product-price').innerText;
        }
        
        let productQuantity = 1;
        for (const key in productData) {
            if (key.includes('[quantity]')) {
                productQuantity = productData[key];
                break;
            }
        }
        productNotification.innerHTML = "<h5>"+productData['product-name']+"</h5>"+productQuantity+"x <strong>"+productPrice+"</strong>";
        Feedback.notification.append(productNotification);
        productNotification.addEventListener('click', ()=>{
            productNotification.classList.remove('notification-show');
            productNotification.classList.add('notification-remove');
        });
        productNotification.addEventListener("animationend", () => {
            productNotification.remove();
        });
    }

    _refreshCart(){
        const cartWidgetInstance = window.PluginManager.getPluginInstanceFromElement(this._cart, 'CartWidget');
        this._cart.classList.add('cart-feedback');
        setTimeout(()=>{
            cartWidgetInstance.fetch();
        },50);
    }

}

