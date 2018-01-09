jQuery(document).ready(function($) {
    
    function get_price_tag(selector) {
        type = $('div.product .summary');
        var pricetag = type.parents('ins .woocommerce-Price-amount').text();
        if (type.parents('body').find('div.product').hasClass('product-type-variable')) {
            pricetag = type.find(' .woocommerce-variation-price .price ins .woocommerce-Price-amount').text();
            if (!pricetag) { 
                pricetag = type.find(' .woocommerce-variation-price .price .woocommerce-Price-amount').text();
                if (!pricetag) { 
                    pricetag = type.find(' ins .woocommerce-Price-amount').text();
                    if (!pricetag) { 
                        pricetag = type.find(' .woocommerce-Price-amount').text();
                    }
                }
            }
        } else if (type.parents('body').find('div.product').hasClass('sale')) {
            pricetag = type.find(' .price ins .woocommerce-Price-amount').text();
        } else {
            if (!pricetag) {
                pricetag = type.find(' .woocommerce-Price-amount').text();
            } else {
                pricetag = type.find(' ins .woocommerce-Price-amount').text();
            }
        }
        return pricetag;
    }

    $(document).on('click', "button.krak-quickorder", function(e) {
        e.preventDefault();
        $(this).hide();
        $('.krak-quick-order').removeClass('hidden');
    });
    
    $(document).on('click', "button.send-krak-quickorder", function(e) {
        e.preventDefault();
        $(this).hide();
        $('.lds-css').removeClass('hidden');
        $('.krak-quick-order').addClass('hidden');
        
        //Get Form
        var name = $('input[name="krak-name"]').val();
        var address = $('textarea[name="krak-address"]').val();
        var postcode = $('input[name="krak-postcode"]').val();
        var quantity = $('input[name="krak-quantity"]').val();
        var email = $('input[name="krak-email"]').val();
        
        var waMessage = $('.krak-wa-message').text();
        var waNumber = $('.krak-wa-number').text();
        waNumber = waNumber.replace( " ", '');
        waNumber = waNumber.replace( "+", '');
        var productTitle = $('h1.product_title').text();
        var productID = $('main div').attr('id');
        productID = productID.replace("product-", '');
        var productPrice = get_price_tag($('.summary .price'))
        
        //Function
        waMessage = waMessage.replace("[product_title]", productTitle);
        waMessage = waMessage.replace("[product_price]", productPrice);
        waMessage = waMessage.replace("[product_id]", productID);
        waMessage = waMessage.replace("[user_name]", name);
        waMessage = waMessage.replace("[user_address]", address);
        waMessage = waMessage.replace("[user_postal]", postcode);
        waMessage = waMessage.replace("[user_quantity]", quantity);
        waMessage = waMessage.replace("[user_email]", email);
        
        //Parsing
        waMessage = waMessage.replace( "-", '%2D');
        waMessage = waMessage.replace( "&",'%26');
        waMessage = waMessage.replace( /(\r\n|\n|\r)/gm ,'%0A');
        waMessage = waMessage + '%0A%0ABuy Pro Version :%0Ahttps://krak.lasida.work/#pro';
        
        
        console.log(waMessage);
        
        var linkRedirect = 'https://api.whatsapp.com/send?l=id&phone=[number]&text=[konten]';
        var linkRedirect = linkRedirect.replace("[number]", waNumber);
        var linkRedirect = linkRedirect.replace("[konten]", waMessage);
        
        setTimeout(function(){
            window.location.href = linkRedirect;              
        }, 3000);
        
        //Reset Form
        $('input[name="krak-name"]').val('');
        $('textarea[name="krak-address"]').val('');
        $('input[name="krak-postcode"]').val('');
        $('input[name="krak-quantity"]').val('');
        $('input[name="krak-email"]').val('');
        
    });
    
});