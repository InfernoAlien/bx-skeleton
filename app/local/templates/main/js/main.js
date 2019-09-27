$(document).ready(function() {
    $('body').on('click', '.voting-wjt__button', function (e) {
        $.ajax({
            type: "POST",
            url: "/api/internal/main/rating",
            data: {
                value: $(this).data('value'),
                id: $(this).data('id'),
                action: $(this).data('action'),
            },
            dataType: "json",
            success: function (data) {
                $rtContainer = $(e.currentTarget).parent().find('.js-change-rating');

                $ratingContainer.html(data.value);
                if(data.value < 0) {
                    $rtContainer.addClass('voting-wjt__counter_negative');
                    $rtContainer.removeClass('voting-wjt__counter_positive');
                } else {
                    $rtContainer.addClass('voting-wjt__counter_positive');
                    $rtContainer.removeClass('voting-wjt__counter_negative');
                }
                $(e.currentTarget).prop("disabled", true);
                if ($(e.currentTarget).hasClass("voting-wjt-minus")) {
                    $(e.currentTarget).parent().find('button').first().prop("disabled", false)
                } else {
                    $(e.currentTarget).parent().find('button').last().prop("disabled", false)
                }
            }
        });
    });
});