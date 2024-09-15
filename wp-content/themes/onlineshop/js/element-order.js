(function() {
    const originalQuerySelector = document.querySelector;
    const originalGetElementById = document.getElementById;

    const callCounts = {
        querySelector: 0,
        getElementById: 0
    };

    const elementCalls = {
        '#order_review.woocommerce-checkout-review-order': 0,
        '.shop_table.woocommerce-checkout-review-order-table': 0,
        '#payment.woocommerce-checkout-payment': 0
    };

    document.querySelector = function(selector) {
        callCounts.querySelector++;
        if (elementCalls[selector] !== undefined) {
            elementCalls[selector]++;
        }
        console.log(`querySelector called with: ${selector}`);
        return originalQuerySelector.call(document, selector);
    };

    document.getElementById = function(id) {
        callCounts.getElementById++;
        const selector = `#${id}`;
        if (elementCalls[selector] !== undefined) {
            elementCalls[selector]++;
        }
        console.log(`getElementById called with: ${id}`);
        return originalGetElementById.call(document, id);
    };

    document.addEventListener('DOMContentLoaded', function() {
        const outputDiv = document.createElement('div');
        outputDiv.className = 'output';
        outputDiv.innerHTML = `<h2>要素の呼び出し回数</h2><pre>${JSON.stringify(elementCalls, null, 2)}</pre>`;
        document.body.appendChild(outputDiv);
    });
})();
