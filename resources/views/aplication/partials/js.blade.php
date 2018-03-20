<script type="text/javascript">
    $(document).ready(function() {
        moment.locale('ro');
        var min      = moment().add(-60, 'years');
        var max      = moment().add(-22, 'years');
        var defaultD = moment('10-06-1989','DD-MM-YYYY');
        $('#datetimepicker').datetimepicker({
            useCurrent: false,
            locale: 'ro',
            minDate: min,
            maxDate: max,
            format: 'DD-MM-YYYY',
            defaultDate: max,
            stepping: false,
            ignoreReadonly: true,
            allowInputToggle: true,
            //viewMode: 'decades'
        });

    });

    function showMore(showmore) {
        var showChar   = 160;  // How many characters are shown by default
        var breakpoint = 'show-lg';
        var ellipsestext = "...";
        showmore.each(function () {
            var curent       = $(this);
            var moretext     = curent.data('moretext');
            var lesstext     = curent.data('lesstext');
            if(curent.hasClass('comment')){ ellipsestext = ""; }else{ ellipsestext = "..."; }
            var content = curent.text();
            showChar = parseInt(curent.data(breakpoint));
            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '</span><span class="morecontent"><span>' + h + '</span>&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });
    }
    showMore($('.showmore'));
    $("body").delegate(".morelink", "click", function(event){
        event.preventDefault();
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            var moretext = $(this).parents('.showmore').data('moretext');
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            var lesstext = $(this).parents('.showmore').data('lesstext');
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
    });

    

</script>