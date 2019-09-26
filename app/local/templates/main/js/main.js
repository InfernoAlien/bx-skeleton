$(document).ready(function() {
    $('body').on('click', '.voting-wjt__button', function (e) {
        $.ajax({
            type: "POST",
            url: "/api/internal/main/rating",
            data: "value="+$(this).data('value')+"&id="+$(this).data('id')+"&action="+$(this).data('action')+"",
            dataType: "json",
            success: function (data) {
                $(e.currentTarget).parent().find('span').html(data.value);
                if(data.value < 0) {
                    $(e.currentTarget).parent().find('span').addClass('voting-wjt__counter_negative');
                    $(e.currentTarget).parent().find('span').removeClass('voting-wjt__counter_positive');
                }
                else {
                    $(e.currentTarget).parent().find('span').addClass('voting-wjt__counter_positive');
                    $(e.currentTarget).parent().find('span').removeClass('voting-wjt__counter_negative');
                }
                $(e.currentTarget).prop("disabled",true);
                if($(e.currentTarget).hasClass("voting-wjt-minus")) {
                    $(e.currentTarget).parent().find('button').first().prop("disabled",false)
                }
                else {
                    $(e.currentTarget).parent().find('button').last().prop("disabled",false)
                }
            }
        });
    });
});