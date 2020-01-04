import {  required, min, max, email, alpha, alpha_num, alpha_spaces, numeric } from 'vee-validate/dist/rules';
import { extend } from 'vee-validate';
import { utils } from 'ethers';

extend( 'ethereumAddress', {
    validate: (value) => {
        try {
            utils.getAddress(value);
            return true;
        }catch(e) {
            return false
        }
    },
    message: '"{_value_}" is not a valid wallet address'
});

extend('unique', {
    validate: (value, {table, column}) => {
        return new Promise((resolve, reject) => {
            axios.post('/api/validate/unique', {value: value, column: column, table: table})
                .then(response => {
                    let data = response.data;
                    return data.valid
                        ? resolve({valid: data.valid})
                        : resolve({valid: data.valid, data: {message: data.message}});
                })
        })
    },
    params: ['table', 'column'],
    message: (field, params) => {
        let message = `this ${field} already exists`;
        return message.toLowerCase();
    }
});

extend('lengthBetween', {
    validate: (value, { min, max }) => {
        return value.length >= min && value.length <= max;
    },
    params: ['min', 'max'],
    message: 'The {_field_} length must be between {min} and {max} alphanumeric characters'
});

extend("numeric", {
    ...numeric,
    message: '{_field_} is required'
});

extend("required", {
    ...required,
    message: '{_field_} is required'
});

extend("email", {
    ...email,
    message: '{_value_} is an invalid format of email'
});

extend("min", {
    ...min,
    message: 'The {_field_} field must be at least {length} characters'
});

extend("max", {
    ...max,
    message: 'The {_field_} field must be at least {length} characters'
});

extend("alpha", {
    ...alpha,
    message: '{_field_} should only contain alphabet characters'
});

extend("alpha_num", {
    ...alpha_num,
    message: '{_field_} should only contain alphabet and numeric characters'
});

extend("alpha_spaces", {
    ...alpha_spaces,
    message: 'Your {_field_} should only contain alphabets and space characters'
});

extend('alphanumeric_spaces', {
    validate: function alphanumeric_spaces(value) {
        let pattern = /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/;
        return value.match(pattern);
    },
    message: 'Only alphabets, numbers and spaces are allowed'
});
