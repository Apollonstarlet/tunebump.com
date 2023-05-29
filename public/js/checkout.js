(function($) {

	$(document).ready(function() {

        "use strict"

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var stripe = Stripe($('#stripe_publishable').val());

        var donateButton = $('#donate');
        
        donateButton.on('click', function(e) {
            e.preventDefault();
            donateButton.prop('disabled',true);
            var amount = document.getElementById('amount').value;
            
            if(amount==''){
                alert('Please give some value');
                return;
            }
            $.ajax({
        
                url: '/stripe/initiateCheckout',
                type: 'POST',
                
                data: {
                    amount: amount 
                },
                
                success: function (data) { 
                    stripe.redirectToCheckout({
                        sessionId: data
                    })
                },
                error : function (data){
                    alert('Error');
                    donateButton.prop('disabled',false);
                }
            });
            
            
        });

    })

})(jQuery);