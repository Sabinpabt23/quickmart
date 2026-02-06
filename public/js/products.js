// public/js/products.js - External JavaScript file

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all product page functionality
    
    // 1. Search functionality
    initSearch();
    
    // 2. Price range filter
    initPriceRange();
    
    // 3. Category filter
    initCategoryFilter();
    
    // 4. Quantity selectors
    initQuantitySelectors();
    
    // 5. Wishlist buttons
    initWishlist();
    
    // 6. Sort functionality
    initSorting();
});

// Search Functionality
function initSearch() {
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-button');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            if (!searchInput.value.trim()) {
                e.preventDefault();
                showToast('Please enter a search term', 'warning');
            }
        });
    }
    
    // Live search debounce (optional - for AJAX)
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                // Could implement AJAX live search here
                console.log('Searching for:', this.value);
            }, 500);
        });
    }
}

// Price Range Filter
function initPriceRange() {
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const applyPriceFilter = document.getElementById('applyPriceFilter');
    
    if (priceRange && priceValue) {
        // Update display when slider moves
        priceRange.addEventListener('input', function() {
            priceValue.textContent = 'Rs. ' + formatNumber(this.value);
            
            // Update hidden inputs
            if (minPriceInput) minPriceInput.value = 0;
            if (maxPriceInput) maxPriceInput.value = this.value;
        });
        
        // Format initial value
        priceValue.textContent = 'Rs. ' + formatNumber(priceRange.value);
    }
    
    // Apply price filter
    if (applyPriceFilter) {
        applyPriceFilter.addEventListener('click', function() {
            const min = minPriceInput ? minPriceInput.value : 0;
            const max = maxPriceInput ? maxPriceInput.value : priceRange.max;
            
            // Submit form or update URL
            updateUrlFilter('price', `${min}-${max}`);
        });
    }
}

// Category Filter
function initCategoryFilter() {
    const categoryItems = document.querySelectorAll('.category-item');
    const categoryInput = document.getElementById('categoryInput');
    
    categoryItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const category = this.getAttribute('data-category');
            
            // Update active state
            categoryItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // Update hidden input
            if (categoryInput) {
                categoryInput.value = category;
            }
            
            // Submit form or update URL
            updateUrlFilter('category', category);
        });
    });
}

// Quantity Selectors
function initQuantitySelectors() {
    // Quantity buttons in product grid
    document.querySelectorAll('.increase-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-input-group').querySelector('input');
            const max = parseInt(input.getAttribute('max')) || 99;
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-input-group').querySelector('input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });
}

// Wishlist Functionality
function initWishlist() {
    document.querySelectorAll('.btn-wishlist').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            // Toggle visual state
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('far');
            icon.classList.toggle('fas');
            
            // Save to localStorage (or send to backend)
            toggleWishlist(productId);
            
            // Show notification
            showToast(
                this.classList.contains('active') 
                    ? 'Added to wishlist!' 
                    : 'Removed from wishlist!',
                'success'
            );
        });
    });
    
    // Check initial wishlist state from localStorage
    checkWishlistState();
}

// Sorting Functionality
function initSorting() {
    const sortSelect = document.getElementById('sortSelect');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            updateUrlFilter('sort', this.value);
        });
    }
}

// Helper Functions
function updateUrlFilter(key, value) {
    const url = new URL(window.location.href);
    
    if (value === '' || value === 'all' || value === 'default') {
        url.searchParams.delete(key);
    } else {
        url.searchParams.set(key, value);
    }
    
    // Reset to page 1 when filtering
    url.searchParams.delete('page');
    
    // Navigate to new URL
    window.location.href = url.toString();
}

function formatNumber(num) {
    return parseInt(num).toLocaleString('en-IN');
}

function toggleWishlist(productId) {
    let wishlist = JSON.parse(localStorage.getItem('quickmart_wishlist') || '[]');
    
    const index = wishlist.indexOf(productId);
    if (index === -1) {
        wishlist.push(productId);
    } else {
        wishlist.splice(index, 1);
    }
    
    localStorage.setItem('quickmart_wishlist', JSON.stringify(wishlist));
}

function checkWishlistState() {
    const wishlist = JSON.parse(localStorage.getItem('quickmart_wishlist') || '[]');
    
    document.querySelectorAll('.btn-wishlist').forEach(button => {
        const productId = button.getAttribute('data-id');
        if (wishlist.includes(productId)) {
            button.classList.add('active');
            const icon = button.querySelector('i');
            if (icon) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            }
        }
    });
}

function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    // Add to container
    const container = document.querySelector('.toast-container') || createToastContainer();
    container.appendChild(toast);
    
    // Show toast
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    // Remove after hide
    toast.addEventListener('hidden.bs.toast', function() {
        this.remove();
    });
}

function createToastContainer() {
    const container = document.createElement('div');
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    document.body.appendChild(container);
    return container;
}

// Export functions if using modules
// export { initSearch, initPriceRange, initCategoryFilter };