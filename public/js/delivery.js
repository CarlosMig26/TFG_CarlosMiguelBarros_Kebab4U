document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.acceptDeliveryBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            let orderContainer = button.closest('.order-container');
            let orderId = button.getAttribute('data-order-id');
            let restaurantAddress = orderContainer.querySelector('.resAdd').innerText;
            let clientAddress = orderContainer.querySelector('.usrAdd') ? orderContainer.querySelector('.usrAdd').innerText : orderContainer.querySelector('.gstAdd').innerText;

            if (!restaurantAddress || !clientAddress) {
                console.log('Faltan datos');
                return;
            }

            document.getElementById('start').value = restaurantAddress;
            document.getElementById('end').value = clientAddress;

            fetch(`/api/orders/${orderId}/accept-delivery`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'}
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data);
                    button.style.display = 'none';
                    orderContainer.querySelector('.completeDeliveryBtn').style.display = 'inline';
                    orderContainer.classList.remove('new');
                    orderContainer.classList.add('delivering');
                } else {
                    alert('Failed to update order status');
                }
            });
        });
    });

    document.querySelectorAll('.completeDeliveryBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            let orderId = button.getAttribute('data-order-id');

            fetch(`/api/orders/${orderId}/complete-delivery`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'}
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.style.display = 'none';
                    let orderContainer = button.closest('.order-container');
                    orderContainer.classList.remove('delivering');
                    orderContainer.classList.add('delivered');
                } else {
                    alert('Failed to update order status');
                }
            });
        });
    });

    document.querySelectorAll('.delete-order-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            let orderId = button.getAttribute('data-order-id');

            fetch(`/api/orders/${orderId}`, {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json',}
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let orderContainer = button.closest('.order-container');
                    orderContainer.remove();
                } else {
                    alert('Failed to delete order');
                }
            });
        });
    });
});
