var PortfolioPostsButton = document.getElementById('portfolio-posts-btn');
var PortfolioPostContainer = document.getElementById('portfolio-posts-container');

if (PortfolioPostsButton){
	PortfolioPostsButton.addEventListener('click', function(){
	
	var ourRequest = new XMLHttpRequest();
	ourRequest.open('GET', PhilsData.siteURL+'/wp-json/wp/v2/posts?categories=5&order=asc');
	ourRequest.onload = function(){
		if (ourRequest.status >= 200 & ourRequest.status < 400) {
			var data = JSON.parse(ourRequest.responseText);
			createHTML(data);
			PortfolioPostsButton.remove();
		}else {
			console.log("We connected to the server, but is returned an error");
		}
	};
										
	ourRequest.onerror = function(){
		console.log("Connection Error");
	};
		
	ourRequest.send();
});
}

function createHTML(postsData) {
	var ourHTMLString =''; 
	for (i = 0; i< postsData.length; i++){
		ourHTMLString += '<h2>' + postsData[i].title.rendered + '</h2>';
		ourHTMLString += postsData[i].content.rendered;
		
	}
	PortfolioPostContainer.innerHTML = ourHTMLString;
}

//Quick Add Posts AJAX
var quickAddButton = document.querySelector('#quick-add-btn');

if (quickAddButton){
	quickAddButton.addEventListener('click', function(){
		var ourPostData = {
			"title": document.querySelector('.add-posts-form [name="title"]').value,
			"content": document.querySelector('.add-posts-form [name="content"]').value,
			"status": "publish"
		}
		
		
		var createPost = new XMLHttpRequest();
		createPost.open("POST", PhilsData.siteURL+"/wp-json/wp/v2/posts");
		//Authorization Check
		createPost.setRequestHeader("X-WP-Nonce", PhilsData.nonce);
		//Declare the Post format
		createPost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		createPost.send(JSON.stringify(ourPostData));
		createPost.onreadystatechange = function(){
			if (createPost.readyState == 4 ){
				if (createPost.status == 201) {
					document.querySelector('.add-posts-form [name="title"]').value = '';
					document.querySelector('.add-posts-form [name="content"]').value = '';
				}else {
					alert("Error -try again");
				}
			}
		}
	});
}
