document.getElementById('userRegistrationImg').addEventListener('click', function () {
    document.getElementById('userRegistrationForm').style.display = 'block';
    document.getElementById('restaurantRegistrationForm').style.display = 'none';
    document.getElementById('registrationButtons').style.display = 'none';
    attachBackButtonListener();
});

document.getElementById('restaurantRegistrationImg').addEventListener('click', function () {
    document.getElementById('userRegistrationForm').style.display = 'none';
    document.getElementById('restaurantRegistrationForm').style.display = 'block';
    document.getElementById('registrationButtons').style.display = 'none';
    attachBackButtonListener();
});

function attachBackButtonListener() {
    document.querySelectorAll('#backBtn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('userRegistrationForm').style.display = 'none';
            document.getElementById('restaurantRegistrationForm').style.display = 'none';
            document.getElementById('registrationButtons').style.display = 'flex';
        });
    });
}
