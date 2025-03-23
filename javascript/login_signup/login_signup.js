document.addEventListener("DOMContentLoaded", () => {

  const signupForm = document.querySelector(".signup-form");

  async function signup(e){
    e.preventDefault();
    const formdata = new FormData(signupForm);

    const response = await fetch("signupcheck.php", {
      method: "POST",
      body: formdata,
    })

    const data = await response.json();

    if (data.success){
      console.log(data.status, data.message);
    }
    else{
      console.log(data.status, data.message);

    }
  }

  signupForm.addEventListener("submit", signup);
})