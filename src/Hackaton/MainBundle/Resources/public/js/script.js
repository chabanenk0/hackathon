$(document).ready(function () {
    /**
     * Send ajax request for get last comments and trips on front page
     */
    window.setInterval(function () {
        $.ajax({
            method: 'POST',
            url: Routing.generate('welcome_page'),
            dataType: 'html',
            success: function (data) {
                $('#comments_trips').html(data);
            }
        });
    }, 5000);
});
