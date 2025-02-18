document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll("section");

    function revealSections() {
        sections.forEach((section) => {
            const sectionTop = section.getBoundingClientRect().top;
            const triggerPoint = window.innerHeight * 0.85; // Adjust trigger point if needed

            if (sectionTop < triggerPoint) {
                section.classList.add("show");
            }
        });
    }

    // Run the function on scroll
    window.addEventListener("scroll", revealSections);

    // Run once on page load to check already visible sections
    revealSections();
});