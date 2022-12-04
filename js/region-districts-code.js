// user country code for selected option
let user_country_code = "IN";

(function () {
    // Get the country name and state name from the imported script.
    let country_list = country_and_states["country"];
    let states_list = country_and_states["states"];

    // creating country name drop-down
    let option = "";
    option += "<option>Select Birth Region</option>";
    for (let country_code in country_list) {
        // set selected option user country
        let selected =
            country_code == user_country_code ? " selected" : "";
        option += '<option value="'+country_code + '"' + selected + ">" + country_list[country_code] + "</option>";
    }
    document.getElementById("country").innerHTML = option;

    // creating district name drop-down
    let text_box =
        '<label for="state">District</label><input type="text" class="form-control" name="district" class="input-text" id="state">';
    let state_code_id = document.getElementById("state-code");

    function create_states_dropdown() {
        // get selected country code
        let country_code = document.getElementById("country").value;
        let states = states_list[country_code];
        // invalid country code or no states add textbox
        if (!states) {
            state_code_id.innerHTML = text_box;
            return;
        }
        let option = "";
        if (states.length > 0) {
            option = '<label for="state">District</label><select class="form-control" name="district" id="state">\n';
            for (let i = 0; i < states.length; i++) {
                option += '<option value="' + states[i].code + '">' + states[i].name + "</option>";
            }
            option += "</select>";
        } else {
            // create input textbox if no states
            option = text_box;
        }
        state_code_id.innerHTML = option;
    }

    // country select change event
    const country_select = document.getElementById("country");
    country_select.addEventListener(
        "change",
        create_states_dropdown
    );

    create_states_dropdown();
})();