// CanteenPro - JavaScript Utilities and Helper Functions

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Add any global initialization here
    console.log('CanteenPro Application Loaded');
    
    // Initialize tooltips or other UI elements
    initializeUI();
}

// UI Initialization
function initializeUI() {
    // Add click handlers for dynamic elements
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Handle button clicks
        });
    });
}

// Helper function to format currency
function formatCurrency(amount) {
    return '₹' + parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Helper function to format date
function formatDate(date) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(date).toLocaleDateString('en-IN', options);
}

// Search functionality
function searchItems(searchTerm, containerSelector) {
    const items = document.querySelectorAll(containerSelector);
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm.toLowerCase())) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// Alert helper
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = `
        <span>${type === 'success' ? '✓' : type === 'error' ? '❌' : 'ℹ️'}</span>
        <p>${message}</p>
    `;
    
    document.body.insertBefore(alertDiv, document.body.firstChild);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

// Form validation helper
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = 'var(--danger)';
            isValid = false;
        } else {
            input.style.borderColor = '';
        }
    });
    
    return isValid;
}

// Export helper for reports
function exportToCSV(data, filename = 'report.csv') {
    let csv = '';
    
    // Add headers
    if (data.length > 0) {
        const headers = Object.keys(data[0]);
        csv += headers.join(',') + '\n';
        
        // Add rows
        data.forEach(row => {
            const values = headers.map(header => {
                const value = row[header];
                return typeof value === 'string' ? `"${value}"` : value;
            });
            csv += values.join(',') + '\n';
        });
    }
    
    // Create blob and download
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    a.remove();
}

// Print helper
function printContent(elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(element.innerHTML);
    printWindow.document.close();
    printWindow.print();
}

// Keyboard shortcuts
document.addEventListener('keydown', function(event) {
    // Ctrl/Cmd + B for new bill
    if ((event.ctrlKey || event.metaKey) && event.key === 'b') {
        event.preventDefault();
        // Redirect to billing page
        if (window.location.pathname.includes('/staff/')) {
            window.location.href = '/staff/billing.php';
        }
    }
    
    // Ctrl/Cmd + M for menu
    if ((event.ctrlKey || event.metaKey) && event.key === 'm') {
        event.preventDefault();
        // Redirect to menu page
        if (window.location.pathname.includes('/staff/')) {
            window.location.href = '/staff/menu.php';
        }
    }
});

// Confirmation dialog
function confirmAction(message) {
    return confirm(message);
}

// API helper function
function makeAPICall(endpoint, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    if (data && method !== 'GET') {
        options.body = JSON.stringify(data);
    }
    
    return fetch(endpoint, options)
        .then(response => response.json())
        .catch(error => {
            console.error('API Error:', error);
            showAlert('Error making request', 'error');
        });
}

// Statistics calculation
function calculateStats(data, field) {
    if (!Array.isArray(data) || data.length === 0) return 0;
    return data.reduce((sum, item) => sum + (parseFloat(item[field]) || 0), 0);
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Theme toggle (if needed)
function toggleTheme() {
    const html = document.documentElement;
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

// Load saved theme
function loadSavedTheme() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    }
}

// Export functions for use in other scripts
window.CanteenPro = {
    formatCurrency,
    formatDate,
    searchItems,
    showAlert,
    validateForm,
    exportToCSV,
    printContent,
    confirmAction,
    makeAPICall,
    calculateStats,
    debounce,
    toggleTheme,
    loadSavedTheme
};
