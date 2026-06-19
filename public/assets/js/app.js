function changeQty(id, delta) {
    const input = document.getElementById('input-qty-' + id);
    let val = parseInt(input.value) || 0;
    val += delta;
    if (val < 0) val = 0;
    input.value = val;
    input.dispatchEvent(new Event('input', { bubbles: true }));
}

window.changeQty = changeQty;

document.addEventListener('DOMContentLoaded', function () {
    const qtyInputs = document.querySelectorAll('.menaki-qty-input');
    const summaryItems = document.getElementById('menaki-summary-items');
    const summaryTotal = document.getElementById('menaki-summary-total');

    function updateMenakiCalculator() {
        let html = '';
        let total = 0;
        let hasItems = false;

        qtyInputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            if (qty > 0) {
                const price = parseFloat(input.getAttribute('data-price')) || 0;
                const name = input.getAttribute('data-name');
                const subtotal = price * qty;
                total += subtotal;
                hasItems = true;

                html += `<div class="rcf-summary-item">
                        <span class="rcf-summary-item__name">${name} <strong>(x${qty})</strong></span>
                        <span class="rcf-summary-item__subtotal">${subtotal.toFixed(2)}€</span>
                    </div>`;
            }
        });

        if (!hasItems) {
            summaryItems.innerHTML = '<p class="rcf-summary-empty">No has seleccionado ningún pack todavía.</p>';
        } else {
            summaryItems.innerHTML = html;
        }
        summaryTotal.textContent = total.toFixed(2) + '€';
    }

    qtyInputs.forEach(input => {
        input.addEventListener('input', updateMenakiCalculator);
    });
});