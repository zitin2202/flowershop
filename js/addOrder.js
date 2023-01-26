function  add_order(user_id){
    let form=new FormData();
    let password_input=document.getElementById('InputPasswordforOrder')
    form.append('user_id', user_id);
    form.append('password_input', password_input.value);

    let request_options={method: 'POST', body: form};
    fetch('https://pr-dmitriev.xn--80ahdri7a.site/order/create', request_options)
        .then(response=>response.text())
        .then(result=>{
            console.log(result)
            if (result === 'password_false'){
                password_input.style.border = "red solid 1px";
                document.getElementById('invalid_feedback').style.display = "block"
            }
            else if (result === "true"){
                window.location = "https://pr-dmitriev.xn--80ahdri7a.site/order/index";
            }

        })
}