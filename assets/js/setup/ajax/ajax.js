

jQuery(document).ready(function($) {
    
    function asyncRequests() {
        
        $('#button_car').on('click', function(e) {
            if(e.target.tagName === 'A'){
                e.preventDefault();
                
            }
            $('#button_car').prop('disabled', true);
            $('#button_car').text('Loading...');

            $.ajax({
                type: "POST",
                url: madman_ajax_object.ajax_url,
                data: {
                    action: 'madman_ajax_handle',
                    nonce: madman_ajax_object.nonce,
                    name: 'Farid'
                },
                dataType: "json",
               
                success: (response) => {
                    console.log(response);

                    $('#car_content').html(JSON.stringify(response));
                    $('#button_car').prop('disabled', false);
                    $('#button_car').text('Get a car');
                },
                error: (response) => {
                    console.log(response);
                    $('#button_car').prop('disabled', false);
                    $('#button_car').text('Get a car');

                }
            });
            
        })
    }

    

    pipe([], asyncRequests);
    
    
});




