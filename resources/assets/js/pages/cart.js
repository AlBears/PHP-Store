(function () {
    'use strict';

    ACMESTORE.product.cart = function () {
        
        var app = new Vue({
            el: '#shopping_cart',
            data: {
                items: [],
                cartTotal: [],
                loading: false,
                fail: false,
                message: ''
            }
        });
    };
})();