// register.js
document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');

    if (!registerForm) {
        console.error('Register form not found!');
        return;
    }

    let isRegistering = false;

    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        // Check if the form is already being submitted
        if (isRegistering) {
            return;
        }

        // Set the flag and disable the submit button
        isRegistering = true;
        const submitButton = registerForm.querySelector("button[type='submit']");
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = "Registering...";
        }

        const formData = new FormData(registerForm);

// AAAAAAAAAAAAAAAAAAAAA
const email = registerForm.querySelector("input[name='email']").value.trim();
        const emailRegex = /^[A-Za-z0-9!#$%&'*+\/=?^_`{|}~.-]+@gmail\.com$/;
        if (!emailRegex.test(email)) {
            showToast("Email must be in the format (alphabet, number, special character)+@gmail.com. Only @gmail.com addresses are allowed.", "error");
            isRegistering = false;
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = "Register";
            }
            return;
        }
        // AAAAAAAAAAAAAAAAAAAAAA
        try {
            const response = await fetch("register.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.status === "success") {
                showToast(result.message, "success");
                setTimeout(() => {
                    window.location.href = "dashboard.php";
                }, 2000);
            } else {
                showToast(result.message, "error");
                
                // Reset the flag and button state
                isRegistering = false;
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = "Register";
                }
            }
        } catch (error) {
            console.error('Error during registration:', error);
            showToast("An unexpected error occurred. Please try again.", "error");
            
            // Reset the flag and button state
            isRegistering = false;
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = "Register";
            }
        }
    });
});
