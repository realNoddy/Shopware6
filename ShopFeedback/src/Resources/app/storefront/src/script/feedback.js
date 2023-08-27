console.log("feedback");
//OffCanvasCart
//AddToCart


PluginManager.getPlugin('AddToCart').$emitter.subscribe('openOffCanvasCart', ()=>{console.log("");});
//https://developer.shopware.com/docs/guides/plugins/plugins/storefront/reacting-to-javascript-events#registering-to-events