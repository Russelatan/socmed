document.addEventListener("DOMContentLoaded", () => {
	const postForm = document.querySelector(".post-form");

	async function create_post(e) {
		e.preventDefault();
		const formdata = new FormData(postForm);

		const response = await fetch("../routes.php", {
			method: "POST",
			body: formdata,
		});

		const data = await response.json();

		if (data.status === "success") {
			swal({
				title: "Success!",
				text: data.message,
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

	postForm.addEventListener("submit", create_post);
});
