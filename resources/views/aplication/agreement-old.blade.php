        var inProcces = false;
        setInterval(function(){

           $('.loading').each(function(index, el) {
                var curent = $(this);
                var tr = '';
                $.ajax({
                    url: "{{route("get_app")}}",
                    method: 'POST',
                    data:{appId:curent.val()},
                    beforeSend: function(){
                        inProcces = true;
                    },
                    success: function (response) {
                        //console.log(response);
                        if (response.stateCode != '0') {
                            tr = curent.parents('tr').html(response.result).animate({
                                backgroundColor: response.color,
                                color: "#fff"
                            }, 1500).addClass('animation-color');

                            setTimeout(function(){
                                    $('tr.animation-color').animate({
                                        backgroundColor: "#fff",
                                        color: "#292b2c"
                                    }, 1500);

                            }, 3000);
                        }
                    }
                }).done(function( msg ) {
                    inProcces = false;
                    if (tr.length >= 1) {
                        showMore(tr.find('.showmore'));
                    }
                    
                });
            });

        },30000);