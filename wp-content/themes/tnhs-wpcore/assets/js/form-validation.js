// Show input error message
function showError(input, message) {
    const formControl = input.parentElement;
    formControl.classList.add('error');
    const mess = formControl.querySelector('.message');
    mess.innerText = message;
    return false;
}

// Show success outline
function showSuccess(input) {
    const formControl = input.parentElement;
    formControl.classList.remove('error');
    const message = formControl.querySelector('.message');
    message.innerText = '';
    return true;
}

// Check email is valid
function checkEmail(input) {
    const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (regex.test(input.value.trim())) {
        return showSuccess(input);
    } else {
        return showError(input, 'Email không hợp lệ');
    }
}

// Check required fields
function checkRequired(inputArr) {
    let isRequired = false;
    inputArr.forEach(function (input) {
        if (input.value.trim() === '') {
            showError(input, `${getFieldName(input)} không được để trống`);
            isRequired = false;
        } else {
            showSuccess(input);
            isRequired = true;
        }
    });

    return isRequired;
}

// Check input length
function checkLength(input, min, max) {
    if (input.value.length < min) {
        return showError(
            input,
            `${getFieldName(input)} phải có ít nhất ${min} ký tự`
        );
    }

    if (input.value.length > max) {
        return showError(
            input,
            `${getFieldName(input)} phải ít hơn ${max} ký tự`
        );
    } 

    return showSuccess(input);
}

// Check passwords match
function checkPasswordsMatch(input1, input2) {
    if (input1.value !== input2.value) {
        return showError(input2, 'Mật khẩu không trùng khớp');
    }
    return showSuccess((input2));
}

// Get fieldname
function getFieldName(input) {
    return document.querySelector(`label[for='${input.id}']`).innerText;
}