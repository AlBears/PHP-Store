(function () {
    'use strict';

    ACMESTORE.admin.create = function () {
        //create subcategory
        $(".add-subcategory").on('click', function (e) {
            var token = $(this).data('token');
            var category_id = $(this).attr('id');
            var name = $("#subcategory-name-"+category_id).val();

            $.ajax({
                type: 'POST',
                url: '/admin/product/subcategory/create',
                data: {token: token, name: name, category_id: category_id},
                success: function (data) {
                    var response = jQuery.parseJSON(data);
                    $(".notification").css("display", 'block').delay(4000).slideUp(300)
                        .html(response.success);
                },
                error:function (request, error) {
                    var errors = jQuery.parseJSON(request.responseText);
                    var ul = document.createElement('ul');
                    $.each(errors, function (key, value) {
                        var li = document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $(".notification").css("display", 'block').removeClass('primary')
                        .addClass('alert').delay(6000).slideUp(300)
                        .html(ul);
                }
            });

            e.preventDefault();
        })
    };
})();

