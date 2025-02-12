document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('nav li');
    const contentSections = document.querySelectorAll('.content-section'); // Select sections
  
    navItems.forEach(item => {
      item.addEventListener('click', function() {
        const target = this.dataset.target;
  
        // Remove active class from all nav items and content sections
        navItems.forEach(li => li.classList.remove('active'));
        contentSections.forEach(section => section.classList.remove('active'));
  
        // Add active class to the clicked nav item
        this.classList.add('active');
  
        // Show the corresponding content section
        const targetSection = document.getElementById(target);
        if (targetSection) {
          targetSection.classList.add('active');
        }
      });
    });
  
    // Set the initial active state
    const firstNavItem = document.querySelector('nav li:first-child');
    if (firstNavItem) {
        firstNavItem.classList.add('active');
    }
  
    const firstSection = document.getElementById('product-info');
    if (firstSection) {
        firstSection.classList.add('active');
    }
  });