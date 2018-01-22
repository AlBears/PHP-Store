(function() {
    'use strict';

    ACMESTORE.product.details = function() {
        var app = new Vue({
            el:'#product',
            data: {
                product: [],
                category: [],
                subCategory: [],
                similarProducts: [],
                productId: $('#product').data('id'),
                loading: false
            },
            methods: {
                getProductDetails: function() {
                    this.loading = true;
                    setTimeout(function(){
                        axios.get('/product-details/' + app.productId).then(
                            function(response){
                                app.product = response.data.product;
                                app.category = response.data.category;
                                app.subCategory = response.data.subCategory;
                                app.similarProducts = response.data.similarProducts;
                                app.loading = false;
                            }
                        );
                    }, 1000);

                },
                stringLimit: function (string, value) {
                    return ACMESTORE.module.truncateString(string, value);
                },
                addToCart: function(id) {
                    var message = ACMESTORE.module.addItemToCart(id);
                    alert(message);
                }
            },
            created: function() {
                this.getProductDetails();
            }
        });
    }
})();