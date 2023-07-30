$(document).ready(() => {
    let url_0 = url = "/cart/view";


    function getCart(){
        $.ajax({
            url: url,
            method: 'post',
            async: false,
            success: function (data) {
                if(data) {
                    $('#cart-pjax').html(data);
                    if($('#cart-pjax .cart-content').hasClass('cart-fill')) {
                        $('#order').removeClass('disabled');
                        $('#clear').removeClass('disabled');
                    } else {
                        $('#order').addClass('disabled');
                        $('#clear').addClass('disabled');
                    }
                }
            }
        });
    }

    $('#cart-link').click(function(e){
        e.preventDefault();
        url = url_0;
        getCart();
        $("#cart").modal('show');
    })

    $('#pjax-catalog, .product-view').on('click', '.cart-add', function(e) {
        e.preventDefault();
        $.ajax({
            url: url + "?btn=btn-add&id=" + $(this).data('product-id'),
            method: 'post',
            async: false,
            success: (data) => {
                if (data === false) {
                    $('#modal-error').modal('show');
                    setTimeout(function() {
                        $('#modal-error').modal('hide');
                    }, 3000);

                }
            }
        })
    })

    $('#clear').click(function(e) {
        e.preventDefault();
        url = url_0;
        $.ajax({
            url:url + "?btn=clear",
            method: 'post',
            async: false,
            success: function (data) {
                if(data)
                getCart();
            }
        })
    })

});

