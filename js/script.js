$(document).ready(function(){
  // AJAX Request
	var blogCount = 1; 
	$("#blog-button").click(function() {
		// Load 2 more comments after click
		blogCount = blogCount + 1; 
		// 3 Params - link, data we want to include (POST), callback function
		$("#blog").load("load-blogs.php", {
			// Include data into the value's using POST methods
			blogNewCount: blogCount
		});
	});

  /**
  * Intersection Observer
  */
  var images = document.querySelectorAll('img.gallery-image');
  // 2 params - Callback function and options
  var observer = new IntersectionObserver(function(entries, observer){
    entries.forEach(entry => {
      // Image is in viewport
      if (entry.isIntersecting) {
        var img = entry.target;
        img.setAttribute('src', img.getAttribute('data-src'));
        observer.unobserve(img);
      }
    })
  }, {
    rootMargin: '0px 0px 10% 0px'
  });

  // Set observer function for all elements
  images.forEach(img => {
    observer.observe(img);
  });
});  
