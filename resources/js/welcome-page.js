// Enhanced Floating Bubbles JavaScript
class FloatingBubbles {
    constructor() {
        this.container = document.getElementById('bubbles-container');
        this.bubbles = [];
        this.mouseX = 0;
        this.mouseY = 0;
        this.isMouseMoving = false;
        this.lastMouseMove = 0;
        this.isDarkTheme = document.documentElement.classList.contains('dark');
        this.isVisible = true;
        this.performance = this.detectPerformance();

        // Performance settings
        this.maxBubbles = this.performance.high ? 25 : this.performance.medium ? 15 : 10;
        this.creationInterval = this.performance.high ? 2000 : this.performance.medium ? 3000 : 4000;

        this.init();
    }

    detectPerformance() {
        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        const memory = navigator.deviceMemory || 4;
        const cores = navigator.hardwareConcurrency || 2;

        // Simple performance detection
        const isHighPerf = memory >= 8 && cores >= 4 && (!connection || connection.effectiveType === '4g');
        const isMediumPerf = memory >= 4 && cores >= 2 && (!connection || connection.effectiveType !== 'slow-2g');

        return {
            high: isHighPerf,
            medium: isMediumPerf && !isHighPerf,
            low: !isMediumPerf
        };
    }

    init() {
        // Respect user preferences first
        this.respectMotionPreferences();

        // Create initial bubbles
        this.createInitialBubbles();

        // Set up mouse tracking
        this.setupMouseTracking();

        // Set up touch support for mobile devices
        this.setupTouchSupport();

        // Set up theme change detection
        this.setupThemeDetection();

        // Start bubble generation interval
        this.startBubbleGeneration();

        // Clean up old bubbles periodically
        this.startCleanup();

        // Add window focus/blur handlers for performance
        window.addEventListener('focus', () => {
            this.isVisible = true;
        });

        window.addEventListener('blur', () => {
            this.isVisible = false;
        });
    }

    createInitialBubbles() {
        const initialCount = window.innerWidth < 768 ? 8 : 12;
        for (let i = 0; i < initialCount; i++) {
            setTimeout(() => this.createBubble(), i * 500);
        }
    }

    createBubble() {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        // Random size (responsive and performance-aware)
        const size = this.getRandomSize();
        bubble.style.width = size + 'px';
        bubble.style.height = size + 'px';

        // Random horizontal position with some margin
        const margin = size / 2;
        const x = margin + Math.random() * (window.innerWidth - size - margin * 2);
        bubble.style.left = x + 'px';

        // Start from bottom
        bubble.style.bottom = '-' + size + 'px';

        // Random animation duration (slower for larger bubbles)
        const baseDuration = this.performance.high ? 12 : this.performance.medium ? 15 : 18;
        const duration = size > 80 ?
            baseDuration + Math.random() * 8 :
            (baseDuration * 0.7) + Math.random() * 6;
        bubble.style.animationDuration = duration + 's';

        // Apply theme class
        bubble.classList.add(this.isDarkTheme ? 'dark-theme' : 'light-theme');

        // Special bubble types based on size and chance
        const specialChance = Math.random();
        if (size > 100 && specialChance < 0.15) {
            bubble.classList.add('glow');
        } else if (size > 80) {
            bubble.classList.add('large');
        }

        // Add slight random rotation for variety
        const rotation = Math.random() * 360;
        bubble.style.transform = `rotate(${rotation}deg)`;

        // Performance optimization: use transform3d for hardware acceleration
        bubble.style.transform += ' translateZ(0)';

        // Add to container and bubbles array
        this.container.appendChild(bubble);
        this.bubbles.push({
            element: bubble,
            x: x,
            y: window.innerHeight + size,
            size: size,
            originalX: x,
            repelStrength: size > 80 ? 180 : size > 60 ? 150 : 120,
            isSpecial: bubble.classList.contains('glow'),
            createdAt: Date.now()
        });

        // Start animation with slight delay for performance
        requestAnimationFrame(() => {
            bubble.classList.add('animate-float-up');
        });

        // Remove bubble after animation completes
        setTimeout(() => {
            this.removeBubble(bubble);
        }, duration * 1000 + 1000);
    }

    getRandomSize() {
        const screenWidth = window.innerWidth;
        let minSize, maxSize;

        if (screenWidth < 480) {
            minSize = 20;
            maxSize = 60;
        } else if (screenWidth < 768) {
            minSize = 30;
            maxSize = 80;
        } else {
            minSize = 40;
            maxSize = 120;
        }

        // Weighted towards smaller sizes
        const rand = Math.random();
        if (rand < 0.7) {
            return minSize + Math.random() * (maxSize * 0.6 - minSize);
        } else {
            return maxSize * 0.6 + Math.random() * (maxSize * 0.4);
        }
    }

    setupMouseTracking() {
        let mouseTimeout;
        let animationFrame;

        // Throttled mouse move handler for better performance
        const throttledMouseMove = this.throttle((e) => {
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
            this.isMouseMoving = true;
            this.lastMouseMove = Date.now();

            // Clear existing timeout
            clearTimeout(mouseTimeout);

            // Update bubble positions with RAF for smooth animation
            if (animationFrame) {
                cancelAnimationFrame(animationFrame);
            }
            animationFrame = requestAnimationFrame(() => {
                this.updateBubblePositions();
            });

            // Reset mouse moving flag after delay
            mouseTimeout = setTimeout(() => {
                this.isMouseMoving = false;
                this.resetBubblePositions();
            }, 800);
        }, 16); // ~60fps

        document.addEventListener('mousemove', throttledMouseMove);

        // Pause bubble interaction when mouse leaves window
        document.addEventListener('mouseleave', () => {
            this.isMouseMoving = false;
            this.resetBubblePositions();
        });
    }

    throttle(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    updateBubblePositions() {
        if (!this.isMouseMoving) return;

        // Use RAF for smooth animations
        this.bubbles.forEach(bubbleData => {
            const bubble = bubbleData.element;

            // Skip if bubble is not visible (performance optimization)
            const rect = bubble.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight) {
                return;
            }

            const bubbleCenterX = rect.left + rect.width / 2;
            const bubbleCenterY = rect.top + rect.height / 2;

            const distance = Math.sqrt(
                Math.pow(this.mouseX - bubbleCenterX, 2) +
                Math.pow(this.mouseY - bubbleCenterY, 2)
            );

            if (distance < bubbleData.repelStrength) {
                // Calculate repel direction with smoother easing
                const angle = Math.atan2(
                    bubbleCenterY - this.mouseY,
                    bubbleCenterX - this.mouseX
                );

                const repelForce = (bubbleData.repelStrength - distance) / bubbleData.repelStrength;
                const easing = 1 - Math.pow(1 - repelForce, 3); // Cubic easing

                const maxOffset = bubbleData.isSpecial ? 80 : 60;
                const offsetX = Math.cos(angle) * easing * maxOffset;
                const offsetY = Math.sin(angle) * easing * maxOffset;

                // Preserve original rotation and add repel transform
                const currentRotation = bubble.style.transform.match(/rotate\([^)]+\)/)?.[0] || '';
                bubble.style.transform = `${currentRotation} translate(${offsetX}px, ${offsetY}px) translateZ(0)`;
                bubble.classList.add('mouse-repel');
            } else {
                // Restore original transform
                const currentRotation = bubble.style.transform.match(/rotate\([^)]+\)/)?.[0] || '';
                bubble.style.transform = `${currentRotation} translateZ(0)`;
                bubble.classList.remove('mouse-repel');
            }
        });
    }

    resetBubblePositions() {
        this.bubbles.forEach(bubbleData => {
            const bubble = bubbleData.element;
            bubble.style.transform = '';
            bubble.classList.remove('mouse-repel');
        });
    }

    setupThemeDetection() {
        // Watch for theme changes
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'class') {
                    const wasDark = this.isDarkTheme;
                    this.isDarkTheme = document.documentElement.classList.contains('dark');

                    if (wasDark !== this.isDarkTheme) {
                        this.updateBubbleThemes();
                    }
                }
            });
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });
    }

    updateBubbleThemes() {
        this.bubbles.forEach(bubbleData => {
            const bubble = bubbleData.element;
            bubble.classList.remove('light-theme', 'dark-theme');
            bubble.classList.add(this.isDarkTheme ? 'dark-theme' : 'light-theme');
        });
    }

    startBubbleGeneration() {
        // Performance-aware bubble generation
        const generateBubble = () => {
            if (!this.isVisible) return;

            // Adjust max bubbles based on screen size and performance
            const screenMultiplier = window.innerWidth < 768 ? 0.6 : window.innerWidth < 1024 ? 0.8 : 1;
            const maxBubbles = Math.floor(this.maxBubbles * screenMultiplier);

            if (this.bubbles.length < maxBubbles) {
                this.createBubble();
            }
        };

        // Initial bubbles
        generateBubble();

        // Set up generation interval
        setInterval(generateBubble, this.creationInterval);

        // Pause generation when tab is not visible
        document.addEventListener('visibilitychange', () => {
            this.isVisible = !document.hidden;
            if (this.isVisible) {
                // Resume with a few bubbles
                setTimeout(() => {
                    for (let i = 0; i < 3; i++) {
                        setTimeout(generateBubble, i * 500);
                    }
                }, 1000);
            }
        });
    }

    startCleanup() {
        setInterval(() => {
            this.bubbles = this.bubbles.filter(bubbleData => {
                if (!bubbleData.element.parentNode) {
                    return false;
                }
                return true;
            });
        }, 5000);
    }

    removeBubble(bubbleElement) {
        if (bubbleElement && bubbleElement.parentNode) {
            bubbleElement.parentNode.removeChild(bubbleElement);
        }

        this.bubbles = this.bubbles.filter(
            bubbleData => bubbleData.element !== bubbleElement
        );
    }

    // Public method to pause/resume bubbles
    toggleBubbles(pause = false) {
        this.bubbles.forEach(bubbleData => {
            const bubble = bubbleData.element;
            if (pause) {
                bubble.style.animationPlayState = 'paused';
            } else {
                bubble.style.animationPlayState = 'running';
            }
        });
    }

    // Touch device support
    setupTouchSupport() {
        if ('ontouchstart' in window) {
            document.addEventListener('touchmove', (e) => {
                if (e.touches.length === 1) {
                    const touch = e.touches[0];
                    this.mouseX = touch.clientX;
                    this.mouseY = touch.clientY;
                    this.isMouseMoving = true;

                    requestAnimationFrame(() => {
                        this.updateBubblePositions();
                    });

                    setTimeout(() => {
                        this.isMouseMoving = false;
                        this.resetBubblePositions();
                    }, 1000);
                }
            }, { passive: true });
        }
    }

    // Accessibility: respect user's motion preferences
    respectMotionPreferences() {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        const handleMotionPreference = (e) => {
            if (e.matches) {
                // Reduce animations for accessibility
                this.maxBubbles = Math.floor(this.maxBubbles * 0.5);
                this.creationInterval *= 2;
                this.bubbles.forEach(bubbleData => {
                    bubbleData.element.style.animationDuration = '30s';
                });
            }
        };

        prefersReducedMotion.addListener(handleMotionPreference);
        handleMotionPreference(prefersReducedMotion);
    }
}

// Initialize bubbles when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.floatingBubbles = new FloatingBubbles();

    // Load control panel for development
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        const script = document.createElement('script');
        script.src = '/js/bubble-controls.js';
        document.head.appendChild(script);
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.floatingBubbles) {
        // Recreate bubbles with new responsive sizes
        setTimeout(() => {
            window.floatingBubbles.bubbles.forEach(bubbleData => {
                window.floatingBubbles.removeBubble(bubbleData.element);
            });
            window.floatingBubbles.createInitialBubbles();
        }, 1000);
    }
});

// Back to top button functionality
const backToTop = document.getElementById('backToTop');

// Show/hide back to top button based on scroll position
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTop.classList.remove('opacity-0', 'invisible');
    } else {
        backToTop.classList.add('opacity-0', 'invisible');
    }
});

// Scroll to top when button is clicked
backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in-up');
        }
    });
}, observerOptions);

// Observe all feature cards and sections
document.querySelectorAll('.group, [class*="animate-fade-in-up"]').forEach(element => {
    observer.observe(element);
});
