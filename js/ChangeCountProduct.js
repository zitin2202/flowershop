function changeCountProduct(id, count){
    let form=new FormData();
    form.append('product_id', id);
    form.append('count', count);
    let request_options={method: 'POST', body: form};
    fetch('https://pr-dmitriev.xn--80ahdri7a.site/cart/update', request_options)
        .then(response=>response.text())
        .then(result=>{


            if (result === "false"){
                let title=document.getElementById('addProductModalTitle');
                let body=document.getElementById('addProductModalBody');
                title.innerText='Ошибка';
                body.innerHTML="Ошибка добавления товара, вероятно, товар уже раскупили"
                let myModal = new bootstrap.Modal(document.getElementById("addProductModal"), {});
                myModal.show();
            }
            else {
                window.location = "https://pr-dmitriev.xn--80ahdri7a.site/cart/index";

            }
        });


}
