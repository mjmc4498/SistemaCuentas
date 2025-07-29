// Carrito de compras
let cart = [];

// Función para agregar al carrito
function addToCart(id, name, price) {
    cart.push({ id, name, price });
    updateCartView();
}

// Función para eliminar del carrito
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCartView();
}

// Función para actualizar la vista del carrito
function updateCartView() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    let total = 0;

    if (cartItems) {
        cartItems.innerHTML = '';
        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td><button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}">Eliminar</button></td>
            `;
            cartItems.appendChild(row);
            total += parseFloat(item.price);
        });
    }

    if (cartTotal) {
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Event listeners para agregar al carrito
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const name = button.closest('.card').querySelector('.card-title').textContent;
            const price = button.closest('.card').querySelector('.card-text strong').textContent.replace('Precio: $', '');
            addToCart(id, name, price);
        });
    });

    // Event listeners para eliminar del carrito
    document.getElementById('cart-items')?.addEventListener('click', event => {
        if (event.target.classList.contains('remove-from-cart')) {
            const id = event.target.dataset.id;
            removeFromCart(id);
        }
    });

    // Placeholder para la pasarela de pago
    function handleCheckout(method) {
        if (cart.length > 0) {
            alert(`Procediendo al pago con ${method}... (Simulación)`);
            window.location.href = `../controllers/ShopController.php?action=checkout&method=${method}`;
        } else {
            alert('El carrito está vacío.');
        }
    }

    document.getElementById('checkout-btn-paypal')?.addEventListener('click', () => handleCheckout('paypal'));
    document.getElementById('checkout-btn-yape')?.addEventListener('click', () => handleCheckout('yape'));
    document.getElementById('checkout-btn-plin')?.addEventListener('click', () => handleCheckout('plin'));

    // Manejo del modo oscuro
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle?.addEventListener('click', () => {
        const body = document.body;
        if (body.classList.contains('theme-light')) {
            body.classList.remove('theme-light');
            body.classList.add('theme-dark');
            themeToggle.textContent = 'Modo Claro';
        } else {
            body.classList.remove('theme-dark');
            body.classList.add('theme-light');
            themeToggle.textContent = 'Modo Oscuro';
        }
    });

    // Inicialización de gráficas en la página de reportes
    const salesByPlatformCtx = document.getElementById('salesByPlatformChart')?.getContext('2d');
    if (salesByPlatformCtx) {
        new Chart(salesByPlatformCtx, {
            type: 'pie',
            data: {
                labels: ['Netflix', 'HBO', 'Disney+'],
                datasets: [{
                    label: 'Ventas por Plataforma',
                    data: [12, 19, 3],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }
        });
    }

    const topSellersCtx = document.getElementById('topSellersChart')?.getContext('2d');
    if (topSellersCtx) {
        new Chart(topSellersCtx, {
            type: 'bar',
            data: {
                labels: ['Vendedor1', 'Vendedor2', 'Vendedor3'],
                datasets: [{
                    label: 'Ventas por Vendedor',
                    data: [30, 25, 15],
                    backgroundColor: '#4BC0C0'
                }]
            }
        });
    }

    const monthlyIncomeCtx = document.getElementById('monthlyIncomeChart')?.getContext('2d');
    if (monthlyIncomeCtx) {
        new Chart(monthlyIncomeCtx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
                datasets: [{
                    label: 'Ingresos Mensuales',
                    data: [1200, 1500, 1300, 1800],
                    borderColor: '#FF9F40',
                    fill: false
                }]
            }
        });
    }
});
