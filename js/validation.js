document.addEventListener("DOMContentLoaded", function () {

    const forms = document.querySelectorAll("form");

    forms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            const inputs = form.querySelectorAll(
                "input[required], select[required]"
            );

            let valid = true;

            inputs.forEach(function (input) {

                if (input.value.trim() === "") {

                    input.classList.add("is-invalid");

                    valid = false;

                } else {

                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");

                }

            });


            const emailInput = form.querySelector(
                'input[type="email"]'
            );

            if (emailInput && emailInput.value.trim() !== "") {

                const emailPattern =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(emailInput.value)) {

                    emailInput.classList.add("is-invalid");

                    valid = false;

                } else {

                    emailInput.classList.remove("is-invalid");
                    emailInput.classList.add("is-valid");

                }
            }


            if (!valid) {

                event.preventDefault();

                alert(
                    "Please check the required fields and enter valid information."
                );

            }

        });

    });

});