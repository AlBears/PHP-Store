(function () {
    'use strict';

    ACMESTORE.homeslider.homePageProducts = function () {
        var app = new Vue({
            el:'#root',
            data: {
                featured: [],
                loading: false
            },
            methods:{
                getFeaturedProducts: function () {
                    this.loading = true;
                    axios.get('/featured').then(function (response) {
                        console.log(response.data);
                        app.featured = response.data.featured;
                        app.loading = false;
                    });
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
