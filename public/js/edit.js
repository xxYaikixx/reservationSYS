function editableRepresentive() {
    document.getElementById("representative_family_name").removeAttribute("readonly");
    document.getElementById("representative_last_name").removeAttribute("readonly");
    document.getElementById("representative_tel").removeAttribute("readonly");
    document.getElementById("representative_mail").removeAttribute("readonly");
}

function editableReservation() {
    document.getElementById("date").removeAttribute("readonly");
    document.getElementById("time").classList.remove("disabled");
    document.getElementById("counts").classList.remove("disabled");
}