
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
        random_test["selected"] = selected_option;
        front_modal_for_test(random_test);
    }
}



function front_modal_for_test(option) {
    console.log(option);
    var option_selected;
    switch (option.selected) {
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
                                <span class="col text-center">`+option[0]+`</span>
                                <span class="col-3 text-center">`+option_selected+`</span>
                                <span class="col text-center">`+option[1]+`</span>
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="number" id="`+USER_INFO.MY_UNIQUE_ID+`_input" min="1" max="50" step="1" class="form-control">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;


    document.getElementById("AFK_TESTS").innerHTML = html_modal;
    document.getElementById("btn_if_user_was_afk").click();
    var timer_id = start_timer();
    console.log(timer_id);
    answer_test(USER_INFO.MY_UNIQUE_ID+"_afk_math_test_modal",USER_INFO.MY_UNIQUE_ID+"_input",option,timer_id)

}


function answer_test(modal,input,option,timer_id) {
    document.getElementById(input).addEventListener("keypress",(e)=>{
        if (e.key==="Enter") {
            event.preventDefault();
            if (check_answer(document.getElementById(input).value,option)) {
                var close_btn = document.createElement("button");
                close_btn.setAttribute('class',"btn-close");
                close_btn.setAttribute('data-bs-dismiss',"modal");
                close_btn.setAttribute('aria-label',"Close");
                document.getElementById(input).insertAdjacentElement('beforeend',close_btn);
                close_btn.click();
                clearInterval(timer_id)
            }else{
                document.getElementById(input).style.border="2px solid red";
            }
        }
    })

}

function check_answer(input,option) {
    var option_selected;
    switch (option.selected) {
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
    if (input == eval(option[0] + option_selected + option[1])) {
        return true;
    }else{
        return false;
    }
}

function start_timer() {
    var sec_timer = 0;
    var timer = setInterval(()=>{
        sec_timer++;
        if (sec_timer == 60) {
            test_time_out(sec_timer,timer_id);
        }
    },1000)
    return timer;

}

function test_time_out(sec_timer,timer_id) {
    if (sec_timer == 60 && timer_id!=null) {
        history.back()
    }
}