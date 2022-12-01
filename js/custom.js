// Username verification
$(document).ready(function () {
    $('.verify_username').keyup(function (e) { 
        var username = $('.verify_username').val();
        $.ajax({
            type: "POST",
            url: "registercode.php",
            data: {
                "check_sumbmit_btn_username":1,
                "username_id":username,
            },
            success: function (response) {
                // alert(response); 
                $('.notice_username').text(response);
            }
        });
    });
});


// phoneNumber verification
$(document).ready(function () {
    $('.verify_phone_number').keyup(function (e) { 
        var phone_number = $('.verify_phone_number').val();
        $.ajax({
            type: "POST",
            url: "registercode.php",
            data: {
                "check_sumbmit_btn_phone_number":1,
                "phone_number_id":phone_number,
            },
            success: function (response) {
                // alert(response); 
                $('.notice_phone_number').text(response);
            }
        });
    });
});


// email verification
$(document).ready(function () {
    $('.verify_email').keyup(function (e) { 
        var email = $('.verify_email').val();

        $.ajax({
            type: "POST",
            url: "registercode.php",
            data: {
                "check_sumbmit_btn_email":1,
                "email_id":email,
            },
            success: function (response) {
                // alert(response); 
                $('.notice_email').text(response);
            }
        });
    });
});


$(document).ready(function () {
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.main-form').remove();
    });

    $(document).on('click', '.add-more-form', function () {
        $(".paste-new-forms").prepend(`<div class="main-form mt-3 border-bottom">
        <div class="row">
            <div class="col-md-5 mb-3">
                <div class="form-group">
                    <label for="society"></label>
                    <select type="text" name="society_name[]" id="society" class="form-control" placeholder="Society Name">
                        <option value="None">None</option>
                        <option value="Catholic Women Association">Catholic Women Association</option>
                        <option value="Charismatic Renewal">Charismatic Renewal</option>
                        <option value="Christian Mothers and Fathers">Christian Mothers and Fathers</option>
                        <option value="Knight and Ladies of the Alter">Knight and Ladies of the Alter</option>
                        <option value="Knight and Ladies of St. Johns International">Knight and Ladies of St. John's International</option>
                        <option value="Knight and Ladies of Marshal">Knight and Ladies of Marshal</option>
                        <option value="Sacred Heart of Jesus">Sacred heart of Jesus</option>
                        <option value="Senior Choir">Senior Choir</option>
                        <option value="St. Anthony Guild">St. Anthony Guild</option>
                        <option value="St. Cecilia Singing Band">St. Cecilia Singing Band</option>
                        <option value="St. Theresa of Child Jesus">St. Theresa's of Child Jesus</option>
                        <option value="Youth Choir">Youth Choir</option>
                    </select>
                </div>
            </div>

            <div class="col-md-5 mb-3">
                <div class="form-group">
                    <label for="position"></label>
                    <input type="text" name="position[]" id="position" class="form-control" placeholder="Position">
                </div>
            </div>

            <div class="col-md-2 mb-3 d-grid">
                <div class="form-group">
                    <br>
                    <button type="button" class="btn btn-outline-danger remove-btn">Remove</button>
                </div>
            </div>
        </div>
    </div>`);
    });
});