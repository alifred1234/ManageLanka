const usertype = document.querySelector("#user");
const district = document.getElementById("district");
const NID = document.getElementById("NID");
const repID = document.getElementById("repID");
const company = document.getElementById("company");
const businessID = document.getElementById("businessID");
const adminID = document.getElementById("adminID")
const group = document.getElementById("group");
const list1 = document.getElementById("list1");
const radio1 = document.getElementById("citizen");
const radio2 = document.getElementById("business");
const radio3 = document.getElementById("admin");



function change() {
    NID.classList.remove("show");
    NID.classList.add("hidden");
    district.classList.remove("show");
    district.classList.add("hidden");
    repID.classList.remove("show");
    repID.classList.add("hidden");
    businessID.classList.remove("show");
    businessID.classList.add("hidden");
    company.classList.remove("show");
    company.classList.add("hidden");
    group.classList.remove("show");
    group.classList.add("hidden");
    adminID.classList.remove("show");
    adminID.classList.add("hidden");


    switch (usertype.value) {
        case "citizen":
            NID.classList.remove("hidden");
            NID.classList.add("show");
            district.classList.remove("hidden");
            district.classList.add("show");
            break;

        case "municipal":
            district.classList.remove("hidden");
            district.classList.add("show");
            repID.classList.remove("hidden");
            repID.classList.add("show");
            break;

        case "recycler":
        case "restaurant":
        case "retailer":
            businessID.classList.remove("hidden");
            businessID.classList.add("show");
            company.classList.remove("hidden");
            company.classList.add("show");
            break;

        case "admin":
            adminID.classList.remove("hidden");
            adminID.classList.add("show");
            break;

        case "volunteer":
            group.classList.remove("hidden");
            group.classList.add("show");
    }
}

function radio() {

    // hiding the list until the user selects the user type
    list1.classList.remove("show");
    list1.classList.add("hidden");

    // hiding the user dependent fields
    NID.classList.remove("show");
    NID.classList.add("hidden");
    district.classList.remove("show");
    district.classList.add("hidden");
    repID.classList.remove("show");
    repID.classList.add("hidden");
    businessID.classList.remove("show");
    businessID.classList.add("hidden");
    company.classList.remove("show");
    company.classList.add("hidden");
    group.classList.remove("show");
    group.classList.add("hidden");
    adminID.classList.remove("show");
    adminID.classList.add("hidden");

    // setting the list selection to default when changing between user types
    usertype.value = 'default';

    if (radio1.checked && radio1.value == 'citizen') {
        list1.classList.remove("hidden");
        list1.classList.add("show");
        // Citizen option
        usertype.options[1].disabled = false;
        // business options
        usertype.options[2].disabled = true;
        usertype.options[3].disabled = true;
        usertype.options[4].disabled = true;
        usertype.options[5].disabled = true;
        usertype.options[6].disabled = true;
        // admin option
        usertype.options[7].disabled = true;
    }

    if (radio2.checked && radio2.value == 'business') {
        list1.classList.remove("hidden");
        list1.classList.add("show");
        // Citizen option
        usertype.options[1].disabled = true;
        // business options
        usertype.options[2].disabled = false;
        usertype.options[3].disabled = false;
        usertype.options[4].disabled = false;
        usertype.options[5].disabled = false;
        usertype.options[6].disabled = false;
        // admin option
        usertype.options[7].disabled = true;
    }

    if (radio3.checked && radio3.value == 'admin') {
        list1.classList.remove("hidden");
        list1.classList.add("show");
        // Citizen option
        usertype.options[1].disabled = true;
        // business options
        usertype.options[2].disabled = true;
        usertype.options[3].disabled = true;
        usertype.options[4].disabled = true;
        usertype.options[5].disabled = true;
        usertype.options[6].disabled = true;
        // admin option
        usertype.options[7].disabled = false;
    }
};

