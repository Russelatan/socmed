document.addEventListener("DOMContentLoaded", () => {
	const postForm = document.querySelector(".post-form");
  const mainPostsContainer = document.querySelector(".main-posts-container");
  const mainReadPost = document.querySelector(".main-read-post");

  let page = 1;
  let isFetching = false;
  let last_fetched_id = 0;

	async function create_post(e) {
		e.preventDefault();
		const formdata = new FormData(postForm);

		const response = await fetch("../routes.php", {
			method: "POST",
			body: formdata,
		});

		const data = await response.json();

		if (data.status === "success") {
      page = 1;
      last_fetched_id = 0;
      isFetching = false;
      mainPostsContainer.innerHTML = ``;
      view_post();
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

  async function view_post(){
    console.log("ISFETCHING:", isFetching)
    if (isFetching) return;
    isFetching = true;
    const formData = new FormData();
    formData.append("action", "read_post");
    formData.append("last_id", last_fetched_id);


		const response = await fetch("../routes.php", {
			method: "POST",
      body: formData,
		});

		const data = await response.json();
    

		if (data.status === "success") {
			console.log(data.posts)
      isFetching = false;
      console.log("ISFETCHING:", isFetching)
      
      last_fetched_id = data.posts[data.posts.length-1].post_id;
      console.log("last_id:", last_fetched_id)
      const posts = data.posts;

      if (data.posts.length !== 0){
        console.log("page:", page)
        page++;
      }
      
      posts.forEach( (post) => {
        console.log("post_id:",post.post_id)
        const post_newsfeed = document.createElement("div");
        post_newsfeed.classList.add("post-newsfeed");

        const container_info_user = document.createElement("div");
        container_info_user.classList.add("container-info-user");

        

        const profile_url = document.createElement("a");
        profile_url.href = `../../view_template/user_profile.php?id=${post.user_id}`;
        container_info_user.appendChild(profile_url);

        const contact_image = document.createElement("img");
        contact_image.classList.add("contact-img");
        contact_image.alt = "post profile";
        contact_image.src = "../" + post.profile_image;
        profile_url.appendChild(contact_image);

        const h1 = document.createElement("h1");
        h1.textContent = post.fname + post.lname;
        profile_url.appendChild(h1);

        const p = document.createElement("p");
        p.textContent = post.created_at;
        container_info_user.appendChild(p);

        const container_info_post = document.createElement("div");
        container_info_post.classList.add("container-info-post");

        const post_url = document.createElement("a");
        post_url.href = `../../view_template/user_post.php?id=${post.post_id}`;
        post_url.appendChild(container_info_post);

        const content = document.createElement("p");
        content.textContent = post.content;
        

        const content_container = document.createElement("div");
        content_container.classList.add("post-content-container")
        content_container.appendChild(content);

        container_info_post.appendChild(content_container)

        

        const container_image_post = document.createElement("div");
        container_image_post.classList.add("container-image-post");

        if (post.directory !== null){
          post.directory = post.directory.split(",")
          post.directory.forEach((imageUrl) => {
            const img = document.createElement("img");
            img.classList.add("post-image");
            img.src = "../" + imageUrl;
            img.alt = "post image";
            container_image_post.appendChild(img);
            container_info_post.appendChild(container_image_post);
          })
          
        }

        post_newsfeed.appendChild(container_info_user);
        post_newsfeed.appendChild(post_url);
        mainPostsContainer.append(post_newsfeed);

        

        
      });

			console.log(data.status, data.message);
		} 
    // else {
		// 	swal({
		// 		title: "Error!",
		// 		text: data.message,
		// 		icon: "error",
		// 		button: "Try Again",
		// 	});
		// 	console.log(data.status, data.message);
		// }
    
    
  }

  

	postForm.addEventListener("submit", create_post);
  mainPostsContainer.addEventListener("scroll",() => {
    console.log(isFetching)

    // console.log(mainPostsContainer.scrollTop + mainPostsContainer.clientHeight, mainPostsContainer.scrollHeight - 10, isFetching)
    if(!isFetching && mainPostsContainer.scrollTop + mainPostsContainer.clientHeight >= mainPostsContainer.scrollHeight - 10){
      view_post();
      console.log(isFetching)
    };
  })

  view_post();
});
