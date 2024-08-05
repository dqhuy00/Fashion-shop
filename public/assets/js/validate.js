function validator(option) {
    ((option)=>{
        let isError = false;
        const form = document.forms[option.form];
        function validate(rules , inputName){
            const errorElement = inputName.parentElement.querySelector('.massage-error em')
            errorElement.innerText = '';
            for(let i = 0; i < rules.length; i++) {
                const message = rules[i].test(inputName.value);
                if(message){
                    isError = true;
                    errorElement.innerText = message;
                    break;
                }else{
                    isError = false;
                }
             }
        }
        Object.keys(option.rules).forEach(name => {
            const inputName = document.querySelector('[name="' + name+'"]');
            inputName.onblur = function (e) {
                e.target.value = e.target.value.trim();
                validate(option.rules[name],inputName);
            }
        });
        form.onsubmit = function (e){
            if(isError){
                e.preventDefault();
            }
        }
    })(option)
};
validator.require = function () {
    return {
        test: function(value){
           return value.trim() === '' ? 'vui lồng nhâp nội dung' : ''
        }
    }
}
validator.minLength = function (name , min) {
    return {
        name,
        test :  function (value){
            return value.length < min ? `độ dài phải lớn hơn ${min}`: '';
        }
    }
}
validator.isNumber = function () {
    return {
        test :  function (value){
            const regEx = /\D/;
            return regEx.test(value) ? `nhập vào phải là số`: '';
        }
    }
}