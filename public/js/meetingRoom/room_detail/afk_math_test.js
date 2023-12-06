
function prime_number(number) {
    var x = number / 2;
    var is_number_prime =true;
    if (number === 1 || number === 0) {
        return false;
    }else{
        for (let i = 2; i < x; i++) {
            if (number%x == 0) {
                is_number_prime = false;
                break;
            }
        }
        return is_number_prime;
    }
}


function get_possible_options(number) {


    var multiply_option = [];
    var divide_option = [];
    var plus_option = [];
    var minus_option = [];

    for (let i = 2; i < number; i++) {
        if (number % i === 0) {
            (multiply_option).push([i,number / i]);
        }
        if (number * i < 100) {
            (divide_option).push([number * i,i]);
        }
        if (number + i < 100) {
            (plus_option).push([i,number - i]);
        }
        if (number - i > 0) {
            (minus_option).push([i,number + i]);
        }
    }
    var possible_options = {
        number : number,
        multiply: multiply_option,
        divide: divide_option,
        plus: plus_option,
        minus : minus_option,
    }
    return possible_options;
}


function AFK_math_test() {
    var random_int = Math.floor(Math.random()* 50) + 2;
    
    var random_option_int = Math.floor(Math.random()* 3);
    var selected_option;

    switch (random_option_int) {
        case 0:
            selected_option = "multiply";
            break;
        case 1:
            selected_option = "divide";
            break;
        case 2:
            selected_option = "plus";
            break;
        case 3:
            selected_option = "minus";
            break;
    }
    var possible_options = get_possible_options(random_int);
    var random_test_selector_index = Math.floor(Math.random() * (possible_options[selected_option].length -1));
    var random_test = possible_options[selected_option][random_test_selector_index];
    if (random_test === undefined) {
        AFK_math_test();
    }else{
        front_modal_for_test(random_test,selected_option);
    }
}



function front_modal_for_test(selected_test,option) {
    console.log(selected_test,option);
    var option_selected;
    switch (option) {
        case "multiply":
            option_selected = "*";
            break;
        case "divide":
            option_selected = "/";
            break;
        case "plus":
            option_selected = "+";
            break;
        case "minus":
            option_selected = "-";
            break;
    }
    var html_modal = `

    <button type="button" id="btn_if_user_was_afk" class="mw-0 mh-0 d-none" data-bs-toggle="modal" data-bs-target="#`+USER_INFO.MY_UNIQUE_ID+`_afk_math_test_modal"></button>


    <div class="modal fade" id="`+USER_INFO.MY_UNIQUE_ID+`_afk_math_test_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="`+USER_INFO.MY_UNIQUE_ID+`_afk_math_test_modal_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="`+USER_INFO.MY_UNIQUE_ID+`_afk_math_test_modal_Label">answer question</h1>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="row fs-5">
                                <span class="col text-center">`+selected_test[0]+`</span>
                                <span class="col-3 text-center">`+option_selected+`</span>
                                <span class="col text-center">`+selected_test[1]+`</span>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="number" min="1" max="50" step="1" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

    document.getElementById("AFK_TESTS").innerHTML = html_modal;
    document.getElementById("btn_if_user_was_afk").click();
}