document.addEventListener('DOMContentLoaded', function () {
    
});

function changeQty(productId, qty) {
    const input = document.querySelector(`#rcf-input-qty-${productId}`);
    if (!input || (input.value <= 0 && qty < 0)) {
        return;
    }
    input.value = parseInt(input.value) + qty;
    updateSummary();
}

function updateSummary() {
    const summaryItemsContainer = document.querySelector('#rcf-summary-items');
    const summaryTotal = document.querySelector('#rcf-summary-total');
    const qtyInputs = document.querySelectorAll('.rcf-product-qty .rcf-qty-input');

    let totalPrice = 0;
    let hasItems = false;

    summaryItemsContainer.innerHTML = '';

    for (const input of qtyInputs) {
        const qty = parseInt(input.value);
        if (qty > 0) {
            hasItems = true;
            const productName = input.dataset.name;
            const productPrice = parseFloat(input.dataset.price);
            const itemTotalPrice = qty * productPrice;
            totalPrice += itemTotalPrice;

            const itemElement = document.createElement('div');
            itemElement.classList.add('rcf-summary-item');
            itemElement.textContent = `${productName} x ${qty} - ${itemTotalPrice.toFixed(2)}€`;
            summaryItemsContainer.appendChild(itemElement);
        }
    }

    if (!hasItems) {
        const emptyMessage = document.createElement('p');
        emptyMessage.classList.add('rcf-summary-empty');
        emptyMessage.textContent = 'No has seleccionado ningún pack todavía.';
        summaryItemsContainer.appendChild(emptyMessage);
    }

    summaryTotal.textContent = `${totalPrice.toFixed(2)}€`;
}

// TODO: Implement form submission logic, validation, and AJAX request to submit the form data to the server.