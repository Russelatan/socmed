document.addEventListener("DOMContentLoaded", () => {
	const signupForm = document.querySelector(".signup-form");

	async function signup(e) {
		e.preventDefault();
		const formdata = new FormData(signupForm);

		const response = await fetch("../../routes.php", {
			method: "POST",
			body: formdata,
		});

		const data = await response.json();

		if (data.status === "success") {
			// alert("iquen");
			// console.log("run");
			swal({
				title: "Success!",
				text: data.emailError
					? "Account created successfully!\n" + data.emailError
					: "Account created successfully!",
				icon: "success",
				button: "OK",
			});

			console.log(data.status, data.message);
		} else {
			swal({
				title: "Error!",
				text: data.message,
				icon: "error",
				button: "Try Again",
			});
			console.log(data.status, data.message);
		}
	}

	signupForm.addEventListener("submit", signup);
});
