function edit_promo(self, index) {
    //edit the promotion
    let object = self.getAttribute("data-object");
    let promo = JSON.parse(object);

    document.getElementById("edit_promotion").style.display = "block";
    document.getElementById("edit_product_index").innerText = '#'+index;
    document.getElementById("add_promotion").style.display = "none";
    // fill edit form with data from the promo
    document.getElementById("edit_product_id").value = promo.id;
    document.getElementById("edit_product_name").value = promo.name;
    document.getElementById("edit_product_price").value = promo.price;
    document.getElementById("edit_discounted_price").value = promo.discounted_price;
    document.getElementById("edit_expiry_date").value = promo.expiry_date;
    document.getElementById("edit_product_image").src = promo.image_path;
}

function readImagePath(input, img_tag_id) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById(img_tag_id).src =  e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
