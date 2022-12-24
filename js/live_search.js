// live search
$(document).ready(function () {
    $("#live_search").keyup(function (e) { 
        var input = $(this).val();
        // alert(input);

        if (input != ""){
            $.ajax({
                type: "POST",
                url: "livesearch.php",
                data: {input:input},

                success: function (data) {
                    $("#searchresult").html(data);
                    $("#searchresult").css("display", "block");
                }
            });
        } else {
            $("#searchresult").css("display", "none");
        }
    });
});