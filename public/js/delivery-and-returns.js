document.addEventListener('DOMContentLoaded', function () {
    // Event listeners for tab buttons
    document.getElementById('tab-delivery').addEventListener('click', function () {
        switchTab('delivery-info', 'tab-delivery');
    });

    document.getElementById('tab-returns').addEventListener('click', function () {
        switchTab('return-info', 'tab-returns');
    });

    function switchTab(sectionId, tabId) {
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(function (section) {
            section.style.display = 'none';
        });

        // Remove active class from all tabs
        document.querySelectorAll('.tab-btn').forEach(function (tab) {
            tab.classList.remove('active-tab');
        });

        // Show the selected section and activate the selected tab
        document.getElementById(sectionId).style.display = 'block';
        document.getElementById(tabId).classList.add('active-tab');
    }

    // Initialize with Delivery tab active
    switchTab('delivery-info', 'tab-delivery');
});
