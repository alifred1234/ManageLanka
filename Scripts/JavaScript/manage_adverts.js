function edit_advert(self, index){
    //edit the advert
    let object = self.getAttribute("data-object");
    let advert = JSON.parse(object);
    let location = advert.location;
    let type = advert.type;
    let price = advert.price;
    let amount = advert.amount;
    let grace_period = advert.grace_period;

    document.getElementById("edit_advert").style.display = "block";
    document.getElementById("edit_advert_index").innerText = '#'+index;
    document.getElementById("add_advert").style.display = "none";

    // fill the form
    document.getElementById("edit_g_location").value = location;
    document.getElementById("edit_g_type").value = type;
    document.getElementById("edit_g_price").value = price;
    document.getElementById("edit_g_amount").value = amount;
    document.getElementById("edit_g_period").value = grace_period;
    document.getElementById("edit_advert_id").value = advert.id;

}