/**
 * New Product Section - JavaScript Functionality
 * Basic vanilla JS implementation for maximum browser compatibility
 */
window.onload = function() {
    console.log("Window fully loaded - product-redesign.js running");

    // Select all filter buttons and product cards
    var filterButtons = document.querySelectorAll('.filter-btn');
    var productCards = document.querySelectorAll('.product-card-new');
    
    console.log("Found " + filterButtons.length + " filter buttons");
    console.log("Found " + productCards.length + " product cards");
    
    // Make sure we found elements before proceeding
    if (filterButtons.length > 0 && productCards.length > 0) {
        
        // Show all products initially by removing 'hidden' class
        for (var i = 0; i < productCards.length; i++) {
            productCards[i].classList.remove('hidden');
            productCards[i].style.display = 'flex';
        }
        
        // Set "All Products" button as active initially
        for (var i = 0; i < filterButtons.length; i++) {
            if (filterButtons[i].getAttribute('data-filter') === 'all') {
                filterButtons[i].classList.add('active');
            } else {
                filterButtons[i].classList.remove('active');
            }
        }
        
        // Add click event listeners to each filter button
        for (var i = 0; i < filterButtons.length; i++) {
            filterButtons[i].addEventListener('click', function() {
                
                var selectedFilter = this.getAttribute('data-filter');
                console.log("Filter clicked: " + selectedFilter);
                
                // Update active button
                for (var j = 0; j < filterButtons.length; j++) {
                    filterButtons[j].classList.remove('active');
                }
                this.classList.add('active');
                
                // Show/hide products based on selected filter
                for (var k = 0; k < productCards.length; k++) {
                    var productCategory = productCards[k].getAttribute('data-category');
                    console.log("Checking product #" + k + " with category: " + productCategory);
                    
                    if (selectedFilter === 'all' || productCategory === selectedFilter) {
                        // Show this product
                        productCards[k].style.display = 'flex';
                        productCards[k].style.opacity = '1';
                        productCards[k].style.transform = 'translateY(0)';
                    } else {
                        // Hide this product
                        productCards[k].style.opacity = '0';
                        productCards[k].style.transform = 'translateY(20px)';
                        
                        // Use closure to maintain reference to current card
                        (function(card) {
                            setTimeout(function() {
                                card.style.display = 'none';
                            }, 300);
                        })(productCards[k]);
                    }
                }
            });
        }
        
        // Trigger click on "All Products" button to initialize the view
        for (var i = 0; i < filterButtons.length; i++) {
            if (filterButtons[i].getAttribute('data-filter') === 'all') {
                // Simulate a click on the "All Products" button
                var clickEvent = new Event('click');
                filterButtons[i].dispatchEvent(clickEvent);
                break;
            }
        }
    }
    
    // Add hover/touch effects for product cards
    for (var i = 0; i < productCards.length; i++) {
        // For mouse devices
        productCards[i].addEventListener('mouseenter', function() {
            this.classList.add('hover');
        });
        
        productCards[i].addEventListener('mouseleave', function() {
            this.classList.remove('hover');
        });
        
        // For touch devices
        productCards[i].addEventListener('touchstart', function() {
            this.classList.add('active');
        });
        
        productCards[i].addEventListener('touchend', function() {
            var card = this;
            setTimeout(function() {
                card.classList.remove('active');
            }, 300);
        });
    }
}; 