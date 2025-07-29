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
    document.getElementById('checkout-btn')?.addEventListener('click', () => {
        if (cart.length > 0) {
            alert('Procediendo al pago... (Simulación)');
            // Aquí iría la integración con PayPal, Stripe, etc.
            // Por ahora, redirigimos a una página de éxito de compra.
            window.location.href = '../controllers/ShopController.php?action=checkout';
        } else {
            alert('El carrito está vacío.');
        }
    });
});
