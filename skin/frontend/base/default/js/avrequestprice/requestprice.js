function loadRequestPriceForm(reloadurl)
{

    new Ajax.Request(reloadurl, {
        method: 'post',
        parameters: Form.serialize($('product_addtocart_form')),
        onSuccess: function (transport) {
            /*$('output-div').innerHTML = "";
             $('output-div').innerHTML = transport.responseText;
             $('output-div').addClassName('output-div');*/
            var json = transport.responseText.evalJSON();
            var displayString = json.message;
            if (json.success) {
                jQuery('body').append('<div id="reqprice-wrap"></div>');
                jQuery('#reqprice-wrap').html('');
                jQuery('#reqprice-wrap').html(json.request_form);
                jQuery.fancybox.open({
                    src: '#reqprice-wrap'
                });
            }
        }
    });
}

function submitRequestPriceForm(f, submiturl) {
    new Ajax.Request(submiturl, {
        method: 'post',
        parameters: Form.serialize($('rprice_form')),
        onSuccess: function (transport) {
            var json = transport.responseText.evalJSON();
            var displayString = json.message;
            if (json.success) {
                jQuery('#reqprice-wrap').html('<ul class="messages"><li class="success-msg"><ul><li><span>' + displayString + '</span></li></ul></li></ul>');
                //jQuery('#messages_product_view').html('<ul class="messages"><li class="success-msg"><ul><li><span>' + displayString + '</span></li></ul></li></ul>');
                //jQuery.fancybox.close();
            } else
            {
                jQuery('#reqprice-wrap').html('<ul class="messages"><li class="error-msg"><ul><li><span>' + displayString + '</span></li></ul></li></ul>');
                //jQuery('#messages_product_view').html('<ul class="messages"><li class="error-msg"><ul><li><span>' + displayString + '</span></li></ul></li></ul>');
            }
        }
    });
}