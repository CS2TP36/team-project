document.addEventListener('DOMContentLoaded', function() {
    const asideLinks = document.querySelectorAll('aside li'); // Select list items in aside
    const contentSections = document.querySelectorAll('.content-section');
  
    asideLinks.forEach(link => {
      link.addEventListener('click', function() {
        const target = this.dataset.target;
  
        // Toggle underline on clicked link, remove from others
        asideLinks.forEach(otherLink => {
          if (otherLink === this) {
            otherLink.style.textDecoration = 'underline'; // Underline clicked
          } else {
            otherLink.style.textDecoration = 'none'; // Remove from others
          }
        });
  
        // Show the target section, hide others
        contentSections.forEach(section => {
          if (section.id === target) {
            section.style.display = 'block'; // Show target section
          } else {
            section.style.display = 'none'; // Hide other sections
          }
        });
  
  
        // Set active class
        asideLinks.forEach(li => li.classList.remove('active')); // Remove from all
        this.classList.add('active'); // Add to clicked
      });
    });
  
    // Set initial active state and underline
    const firstAsideLink = document.querySelector('aside li:first-child');
    if (firstAsideLink) {
      firstAsideLink.style.textDecoration = 'underline';
    }
  
    const firstSection = document.getElementById('dashboard');
    if (firstSection) {
      firstSection.style.display = 'block';
    }
  });