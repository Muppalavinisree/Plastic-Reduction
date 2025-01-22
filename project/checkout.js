// Toggle payment options based on the selected payment method
function togglePaymentOptions() {
    var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    var digitalPaymentOptions = document.getElementById('digital-payment-options');
    var paymentScanner = document.getElementById('payment-scanner');

    if (paymentMethod === "cod") {
        // Show cash on delivery only
        digitalPaymentOptions.style.display = "none";
        paymentScanner.style.display = "none";
    } else if (paymentMethod === "digital") {
        // Show digital payment options and scanner
        digitalPaymentOptions.style.display = "block";
        paymentScanner.style.display = "block";
    }
}

// Initialize payment options when the page loads
window.onload = function() {
    togglePaymentOptions();  // Ensure correct payment options are displayed on page load
};
