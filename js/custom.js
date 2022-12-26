/** @format */

// Username verification
$(document).ready(function () {
	$(".verify_username").keyup(function (e) {
		var username = $(".verify_username").val();
		$.ajax({
			type: "POST",
			url: "registercode.php",
			data: {
				check_sumbmit_btn_username: 1,
				username_id: username,
			},
			success: function (response) {
				// alert(response);
				$(".notice_username").text(response);
			},
		});
	});
});

// phoneNumber verification
$(document).ready(function () {
	$(".verify_phone_number").keyup(function (e) {
		var phone_number = $(".verify_phone_number").val();
		$.ajax({
			type: "POST",
			url: "registercode.php",
			data: {
				check_sumbmit_btn_phone_number: 1,
				phone_number_id: phone_number,
			},
			success: function (response) {
				// alert(response);
				$(".notice_phone_number").text(response);
			},
		});
	});
});

// email verification
$(document).ready(function () {
	$(".verify_email").keyup(function (e) {
		var email = $(".verify_email").val();

		$.ajax({
			type: "POST",
			url: "registercode.php",
			data: {
				check_sumbmit_btn_email: 1,
				email_id: email,
			},
			success: function (response) {
				// alert(response);
				$(".notice_email").text(response);
			},
		});
	});
});

// add more society
$(document).ready(function () {
	$(document).on("click", ".remove-btn", function () {
		$(this).closest(".main-form").remove();
	});

	$(document).on("click", ".add-more-form", function () {
		$(".paste-new-forms").append(
			'<div class="row main-form my-2">\
                        <div class="col-md-5">\
                        <div class="form-group">\
                                <label for="society_name">Society name</label>\
                                <select type="text" name="society_name[]" id="society" class="form-control rounded-0" placeholder="Society Name">\
                                    <option value="">None</option>\
                                    <option value="Catholic Women Association">Catholic Women Association</option>\
                                    <option value="Charismatic Renewal">Charismatic Renewal</option>\
                                    <option value="Christian Mothers and Fathers">Christian Mothers and Fathers</option>\
                                    <option value="Knight and Ladies of the Alter">Knight and Ladies of the Alter</option>\
                                    <option value="Knight and Ladies of St. John\'s International">Knight and Ladies of St. John\'s International</option>\
                                    <option value="Knight and Ladies of Marshal">Knight and Ladies of Marshal</option>\
                                    <option value="Sacred Heart of Jesus">Sacred heart of Jesus</option>\
                                    <option value="Senior Choir">Senior Choir</option>\
                                    <option value="St. Anthony Guild">St. Anthony Guild</option>\
                                    <option value="St. Cecilia Singing Band">St. Cecilia Singing Band</option>\
                                    <option value="St. Theresa\'s of Child Jesus">St. Theresa of the Child Jesus</option>\
                                    <option value="Youth Choir">Youth Choir</option>\
                                </select>\
                            </div>\
                        </div>\
                        <div class="col-md-5">\
                            <div class="form-group">\
                            <label for="office_held">Office held</label>\
                                <input type="text" name="office_held[]" class="form-control rounded-0" id="office_held">\
                            </div>\
                        </div>\
                        <div class="col-md-2">\
                                <br>\
                                <button type="button" class="remove-btn btn btn-danger rounded-0">Remove</button>\
                        </div>\
                    </div>'
		);
	});
});

// live search for members
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
                    $("#element").css("visibility", "hidden");
                }
            });
        } else {
            $("#searchresult").css("display", "none");
            $("#element").css("visibility", "visible");
        }
    });
});

/**region and district dependable dropdown */
// user region code for selected option
let user_country_code = "IN";
(function () {
    // Get the region name and district name from the imported script.
    let country_list = country_and_states["country"];
    let states_list = country_and_states["states"];

    // creating region name drop-down
    let option = "";
    option += "<option>Select Birth Region</option>";
    for (let country_code in country_list) {
        // set selected option user region
        let selected =
            country_code == user_country_code ? " selected" : "";
        option += '<option value="'+country_code + '"' + selected + ">" + country_list[country_code] + "</option>";
    }
    document.getElementById("country").innerHTML = option;

    // creating district name drop-down
    let text_box =
        '<label for="district">District</label><input type="text" class="form-control rounded-0" name="district" class="input-text" id="district">';
    let state_code_id = document.getElementById("state-code");

    function create_states_dropdown() {
        // get selected region code
        let country_code = document.getElementById("country").value;
        let states = states_list[country_code];
        // invalid region code or no district add textbox
        if (!states) {
            state_code_id.innerHTML = text_box;
            return;
        }
        let option = "";
        if (states.length > 0) {
            option = '<label for="district">District</label><select class="form-control rounded-0" name="district" id="district">\n';
            for (let i = 0; i < states.length; i++) {
                option += '<option value="' + states[i].code + '">' + states[i].name + "</option>";
            }
            option += "</select>";
        } else {
            // create input textbox if no district
            option = text_box;
        }
        state_code_id.innerHTML = option;
    }

    // region select change event
    const country_select = document.getElementById("country");
    country_select.addEventListener(
        "change",
        create_states_dropdown
    );

    create_states_dropdown();
})();