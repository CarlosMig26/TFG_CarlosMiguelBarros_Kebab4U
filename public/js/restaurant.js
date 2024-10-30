function toggleEditForm(dishId) {
    var form = document.getElementById('edit-form-' + dishId);
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
