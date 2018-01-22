(function(){
    'use strict';

    ACMESTORE.module = {
        truncateString: function limit(string, value) {
            if(string.length > value){
                return string.substring(0, value) + '...';
            }else{
                return string;
            } 
        },
        addItemToCart: function(id, callback) {
            var token = $('.display-products').data('token');

            if(token == null || !token) {
                token = $('.product').data('token');
            }

            var postData = $.param({product_id:id, token});
            axios.post('/cart', postData).then(function(response){
                callback(response.data.success);
            })
        }
    }
})();

