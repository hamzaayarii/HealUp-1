// HealUp Admin Dashboard - JavaScript Functions

document.addEventListener('DOMContentLoaded', function() {
    initializeAdmin();
});

function initializeAdmin() {
    // Initialize sidebar toggle
    initSidebarToggle();

    // Initialize theme toggle
    initThemeToggle();

    // Initialize tooltips
    initTooltips();

    // Initialize charts (if Chart.js is loaded)
    if (typeof Chart !== 'undefined') {
        initCharts();
    }

    // Initialize data tables (if DataTables is loaded)
    if (typeof $.fn.DataTable !== 'undefined') {
        initDataTables();
    }

    // Initialize notifications
    initNotifications();
}

// Sidebar Toggle Functionality
function initSidebarToggle() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.admin-sidebar');
    const content = document.querySelector('.admin-content');

    if (sidebarToggle && sidebar && content) {
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth > 768) {
                // Desktop: Collapse/Expand
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('collapsed');

                // Store sidebar state
                localStorage.setItem('healup_admin_sidebar', sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
            } else {
                // Mobile: Show/Hide
                sidebar.classList.toggle('show');

                // Store sidebar state
                localStorage.setItem('healup_admin_sidebar', sidebar.classList.contains('show') ? 'open' : 'closed');
            }
        });

        // Restore sidebar state
        const sidebarState = localStorage.getItem('healup_admin_sidebar');
        if (window.innerWidth > 768) {
            if (sidebarState === 'collapsed') {
                sidebar.classList.add('collapsed');
                content.classList.add('collapsed');
            }
        } else {
            if (sidebarState === 'closed') {
                sidebar.classList.remove('show');
            }
        }
    }

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });
}

// Theme Toggle Functionality
function initThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    if (themeToggle) {
        // Get saved theme or default to light
        const savedTheme = localStorage.getItem('healup_admin_theme') || 'light';
        html.classList.toggle('dark', savedTheme === 'dark');
        updateThemeToggleIcon(savedTheme);

        themeToggle.addEventListener('click', function() {
            const isDark = html.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';

            html.classList.toggle('dark', newTheme === 'dark');
            localStorage.setItem('healup_admin_theme', newTheme);
            updateThemeToggleIcon(newTheme);

            // Animate the toggle
            themeToggle.style.transform = 'rotate(180deg)';
            setTimeout(() => {
                themeToggle.style.transform = 'rotate(0deg)';
            }, 300);
        });
    }
}

function updateThemeToggleIcon(theme) {
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        const icon = themeToggle.querySelector('i');
        if (icon) {
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
    }
}

// Tooltips Initialization
function initTooltips() {
    // Initialize Bootstrap tooltips if available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// Charts Initialization
function initCharts() {
    // Users Chart
    const usersCtx = document.getElementById('usersChart');
    if (usersCtx) {
        new Chart(usersCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Users',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Activity Chart
    const activityCtx = document.getElementById('activityChart');
    if (activityCtx) {
        new Chart(activityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive', 'Pending'],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ['#10B981', '#EF4444', '#F59E0B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
}

// DataTables Initialization
function initDataTables() {
    $('.admin-datatable').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            search: "Search records:",
            lengthMenu: "Show _MENU_ records per page",
            info: "Showing _START_ to _END_ of _TOTAL_ records",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        columnDefs: [
            { orderable: false, targets: [-1] } // Disable ordering on last column (usually actions)
        ]
    });
}

// Notifications System
function initNotifications() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(function(alert) {
            fadeOut(alert);
        });
    }, 5000);
}

// Utility Functions
function fadeOut(element) {
    element.style.opacity = '0';
    element.style.transform = 'translateY(-20px)';
    setTimeout(function() {
        element.remove();
    }, 300);
}

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';

    notification.innerHTML = `
        <i class="fas fa-${getIconForType(type)} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto-hide after 4 seconds
    setTimeout(() => {
        fadeOut(notification);
    }, 4000);
}

function getIconForType(type) {
    const icons = {
        success: 'check-circle',
        danger: 'exclamation-triangle',
        warning: 'exclamation-circle',
        info: 'info-circle'
    };
    return icons[type] || 'info-circle';
}

// AJAX Helper Functions
function makeRequest(url, method = 'GET', data = null) {
    return fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: data ? JSON.stringify(data) : null
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Request failed:', error);
        showNotification('An error occurred. Please try again.', 'danger');
    });
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Export functions for global use
window.HealUpAdmin = {
    showNotification,
    makeRequest,
    validateForm,
    fadeOut
};

// Handle responsive sidebar
window.addEventListener('resize', function() {
    const sidebar = document.querySelector('.admin-sidebar');
    const content = document.querySelector('.admin-content');

    if (window.innerWidth > 768) {
        // Desktop mode: remove mobile classes
        sidebar.classList.remove('show');

        // Restore collapsed state if it was saved
        const sidebarState = localStorage.getItem('healup_admin_sidebar');
        if (sidebarState === 'collapsed') {
            sidebar.classList.add('collapsed');
            content.classList.add('collapsed');
        }
    } else {
        // Mobile mode: remove desktop classes
        sidebar.classList.remove('collapsed');
        content.classList.remove('collapsed');
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
