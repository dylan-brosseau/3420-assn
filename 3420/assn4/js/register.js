// register.js
document.addEventListener('DOMContentLoaded', function () {
    // Username availability check
    document.getElementById('username').addEventListener('blur', function() {
        const username = this.value.trim();
        const availabilitySpan = document.getElementById('usernameAvailability');

        if (username !== '') {
            // Make an AJAX request to check username availability
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_username_availability.php'); // Change the PHP script name accordingly
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    availabilitySpan.textContent = response.message;
                    availabilitySpan.className = 'availability ' + (response.available ? 'available' : 'unavailable');
                }
            };
            xhr.send('username=' + encodeURIComponent(username));
        }
    });

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthDiv = document.getElementById('passwordStrength');

        // Password strength calculation logic
        let strength;
        if (password.length < 5) {
            strength = 'Weak';
        } else if (password.length >= 5 && password.length <= 10) {
            strength = 'Average';
        } else {
            strength = 'Strong';
        }

        // Display password strength
        strengthDiv.textContent = 'Password Strength: ' + strength;
    });
});
