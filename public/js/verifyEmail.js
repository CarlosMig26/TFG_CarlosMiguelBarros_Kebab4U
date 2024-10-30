const emailInput = document.getElementById('email');

emailInput.addEventListener('blur', (event) => {

    const email = document.getElementById('email').value;

    const data = { email };

    document.getElementById('validEmail').style.display = 'block';

    const options = {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    };

    document.getElementById('validEmail').textContent = 'Verifying...';

    fetch('/api/verifyEmail', options)
        .then(response => response.json())
        .then(data => {

            if (data['verifyEmail'] === 0) {
                document.getElementById('validEmail').textContent = 'Este email está disponible';
            } else {
                document.getElementById('validEmail').textContent = 'Este email ya está registrado';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
})
