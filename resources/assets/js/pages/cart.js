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
            },

            methods: {
                displayItems: function(){
                    this.loading = true;
                    setTimeout(() => {
                        axios.get('/cart/items').then(function(response){
                            if(response.data.fail){
                                app.fail = true;
                                app.message = response.data.fail;
                                app.loading = false;
                            } else {
                                app.items = response.data.items;
                                app.cartTotal = response.data.cartTotal;
                                app.loading = false;
                            }
                        })
                    }, 2000);
                },

                updateQuantity: function(product_id, operator) {
                    console.log(operator, product_id);
                }
            },

            created: function () {
                this.displayItems();
            }
        });
    };
})();