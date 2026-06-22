document.addEventListener('DOMContentLoaded', function () {
    addGlobalErrorHandling();

    const form = document.querySelector('#rcf-order-form');
    if (form) {
        submitForm(form);
    }
});

const RCF_GENERIC_ERROR_MESSAGE = 'Error al enviar el pedido. Por favor, intentalo de nuevo o pongase en contacto con nosotros si el problema persiste.';

function changeQty(productId, qty) {
    const input = document.querySelector(`#rcf-input-qty-${productId}`);
    if (!input) {
        return;
    }

    const currentQty = Number.parseInt(input.value, 10) || 0;
    const nextQty = Math.max(0, currentQty + qty);
    input.value = nextQty;

    updateSummary();
}

function updateSummary() {
    const summaryItemsContainer = document.querySelector('#rcf-summary-items');
    const summaryTotal = document.querySelector('#rcf-summary-total');

    if (!summaryItemsContainer || !summaryTotal) {
        return;
    }

    const qtyInputs = document.querySelectorAll('.rcf-product-qty .rcf-qty-input');

    let totalPrice = 0;
    let hasItems = false;

    summaryItemsContainer.innerHTML = '';

    for (const input of qtyInputs) {
        const qty = Number.parseInt(input.value, 10) || 0;
        if (qty > 0) {
            hasItems = true;
            const productName = input.dataset.name;
            const productPrice = Number.parseFloat(input.dataset.price) || 0;
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

function submitForm(form) {
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const submitButton = document.querySelector('.rcf-submit-button');

        if (submitButton && submitButton.disabled) {
            return;
        }

        try {
            if (!isAjaxConfigValid()) {
                throw new Error('Configuracion AJAX no disponible.');
            }

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const products = prepareData();
            if (!products.length) {
                throw new Error('Debes seleccionar al menos un producto.');
            }

            const customerName = getFieldValue('#rcf-customer-name');
            const customerCIF = getFieldValue('#rcf-customer-cif');
            const customerPhone = getFieldValue('#rcf-customer-phone');
            const customerEmail = getFieldValue('#rcf-customer-email');
            const customerShippingAddress = getFieldValue('#rcf-customer-shipping-address');
            const customerBillingAddress = getFieldValue('#rcf-customer-billing-address');

            if (submitButton) {
                submitButton.disabled = true;
            }

            const formData = new FormData();
            formData.append('action', 'rcf_submit_order');
            formData.append('_ajax_nonce', rcfData.nonce);
            formData.append('name', customerName);
            formData.append('cif', customerCIF);
            formData.append('phone', customerPhone);
            formData.append('email', customerEmail);
            formData.append('shippingAddress', customerShippingAddress);
            formData.append('billingAddress', customerBillingAddress);
            formData.append('products', JSON.stringify(products));

            const response = await fetch(rcfData.ajaxUrl, {
                method: 'POST',
                body: formData
            });

            let payload = null;
            try {
                payload = await response.json();
            } catch (parseError) {
                payload = null;
            }

            if (!response.ok || !payload || !payload.success) {
                const message = payload && payload.data && payload.data.message
                    ? payload.data.message
                    : RCF_GENERIC_ERROR_MESSAGE;
                throw new Error(message);
            }

            cleanAside(true);
        } catch (error) {
            console.error('Error en envio de formulario:', error);
            const message = error && error.message ? error.message : RCF_GENERIC_ERROR_MESSAGE;
            cleanAside(false, message);
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
            }
        }
    });
}

function cleanAside(bool, errorMessage) {
    const asideElement = document.querySelector('#rcf-form-container');
    if (!asideElement) {
        return;
    }

    asideElement.innerHTML = '';

    const asideContent = document.createElement('div');
    asideContent.classList.add('rcf-aside-content');
    const asideText = document.createElement('p');
    if (bool) {
        asideText.textContent = 'Tu pedido se ha enviado correctamente! En breve nos pondremos en contacto contigo para confirmar los detalles y el pago. ¡Gracias por confiar en nosotros!';
    } else {
        asideText.textContent = errorMessage || RCF_GENERIC_ERROR_MESSAGE;
    }
    asideContent.appendChild(asideText);
    asideElement.appendChild(asideContent);
}

function prepareData() {
    const qtyInputs = document.querySelectorAll('.rcf-product-qty .rcf-qty-input');
    const products = [];

    for (const input of qtyInputs) {
        const qty = Number.parseInt(input.value, 10) || 0;
        if (qty > 0) {
            products.push({
                id: input.dataset.id,
                name: input.dataset.name,
                price: Number.parseFloat(input.dataset.price) || 0,
                quantity: qty
            });
        }
    }

    return products;
}

function getFieldValue(selector) {
    const field = document.querySelector(selector);
    return field ? field.value.trim() : '';
}

function isAjaxConfigValid() {
    return typeof rcfData !== 'undefined' && !!rcfData.ajaxUrl && !!rcfData.nonce;
}

function addGlobalErrorHandling() {
    window.addEventListener('error', function (event) {
        console.error('Error global capturado:', event.error || event.message);
    });

    window.addEventListener('unhandledrejection', function (event) {
        console.error('Promesa rechazada no controlada:', event.reason);
    });
}