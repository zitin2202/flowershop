function add_product(id, count){
    let form=new FormData();
    form.append('product_id', id);
    form.append('count', count);
    console.log(id, count)
    let request_options={method: 'POST', body: form};
    fetch('https://pr-dmitriev.xn--80ahdri7a.site/cart/create', request_options)
        .then(response=>response.text())
        .then(result=>{
            console.log(result)
            let title=document.getElementById('addProductModalTitle');
            let body=document.getElementById('addProductModalBody');
            if (result === 'false'){
                title.innerText='Ошибка';
                body.innerHTML="Ошибка добавления товара, вероятно, товар уже раскупили"
            } else if (result === 'true')
            {
                title.innerText='Успех';
                body.innerHTML="Товар успешно добавлен в корзину"
            }
            let myModal = new bootstrap.Modal(document.getElementById("addProductModal"), {});
            myModal.show();
        })
}
