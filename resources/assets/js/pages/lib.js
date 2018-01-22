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
        addItemToCart: function(id) {
            return id;
        }
    }
})();

