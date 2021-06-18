// Validation

const patterns = {
    telephone: /^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/,
    name: /^[a-z ,.'-]+$/i,
    password: /^[a-z0-9@-]{8,20}$/i,
    email: /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
    postalcode: /^[0-9]+$/,
    address: /^[a-z ,.'-]+$/i

};

function validate(field) {
    if (patterns[field.name].test(field.value) || field.value.length == 0) {
        field.className = 'form-control';
    } else {
        field.className = 'invalid';
        check = false;
    }
}

function validatePassword() {
    var password_1 = document.getElementById("password_1");
    var password_2 = document.getElementById("password_2");
    if (!(password_2.value.length == 0)) {
        if (password_1.value == password_2.value) {
            if (password_1.value.length >= 8 && password_1.value.length <= 20) {
                password_1.className = 'form-control';
                document.getElementById("submit").disabled = false;
            } else {
                password_1.className = 'invalid';
                document.getElementById("submit").disabled = true;
            }
            password_2.className = 'form-control';
        } else {
            password_2.className = 'invalid';
            document.getElementById("submit").disabled = true;
        }
    }
    if (password_1.value.length == 0 && password_2.value.length == 0) {
        password_1.className = 'form-control';
        password_2.className = 'form-control';
    }

}
