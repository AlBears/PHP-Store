(function () {
    'use strict';

    ACMESTORE.homeslider.homePageProducts = function () {
        var app = new Vue({
            el:'#root',
            data: {
                featured: [],
                products: [],
                loading: false
            },
            methods:{
                getFeaturedProducts: function () {
                    this.loading = true;
                    axios.all(
                        [
                        axios.get('/featured'), axios.get('/get-products')
                        ] 
                    ).then(axios.spread(function(featuredResponse, productsReasponse){
                        app.featured = featuredResponse.data.featured;
                        app.products = productsReasponse.data.products;
                        app.loading = false;
                    }));
                },
                stringLimit: function (string, value) {
                    if(string.length > value){
                        return string.substring(0, value) + '...';
                    }else{
                        return string;
                    }
                }
            },
            created: function () {
                this.getFeaturedProducts();
            }
        });
    }
})();
