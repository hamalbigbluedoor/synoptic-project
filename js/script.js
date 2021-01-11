  var images = document.querySelectorAll('img');
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
