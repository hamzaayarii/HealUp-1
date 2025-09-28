// HealUp Floating Bubbles Control Panel
// Add this to your browser console for advanced bubble control

window.HealUpBubbles = {
    // Pause/Resume all bubbles
    toggle: (pause = false) => {
        if (window.floatingBubbles) {
            window.floatingBubbles.toggleBubbles(pause);
        }
    },

    // Clear all bubbles
    clear: () => {
        if (window.floatingBubbles) {
            window.floatingBubbles.bubbles.forEach(bubbleData => {
                window.floatingBubbles.removeBubble(bubbleData.element);
            });
        }
    },

    // Create a burst of bubbles
    burst: (count = 5) => {
        if (window.floatingBubbles) {
            for (let i = 0; i < count; i++) {
                setTimeout(() => {
                    window.floatingBubbles.createBubble();
                }, i * 200);
            }
        }
    },

    // Get current bubble count
    count: () => {
        return window.floatingBubbles ? window.floatingBubbles.bubbles.length : 0;
    },

    // Performance info
    performance: () => {
        if (window.floatingBubbles) {
            return {
                bubbleCount: window.floatingBubbles.bubbles.length,
                maxBubbles: window.floatingBubbles.maxBubbles,
                performance: window.floatingBubbles.performance,
                isDarkTheme: window.floatingBubbles.isDarkTheme,
                isVisible: window.floatingBubbles.isVisible
            };
        }
        return null;
    },

    // Change performance mode
    setPerformance: (mode) => {
        if (window.floatingBubbles && ['high', 'medium', 'low'].includes(mode)) {
            const settings = {
                high: { maxBubbles: 25, interval: 2000 },
                medium: { maxBubbles: 15, interval: 3000 },
                low: { maxBubbles: 10, interval: 4000 }
            };

            window.floatingBubbles.maxBubbles = settings[mode].maxBubbles;
            window.floatingBubbles.creationInterval = settings[mode].interval;

            console.log(`Performance mode set to: ${mode}`);
        }
    }
};

// Usage examples:
// HealUpBubbles.burst(10);        // Create 10 bubbles at once
// HealUpBubbles.toggle(true);     // Pause all bubbles
// HealUpBubbles.toggle(false);    // Resume all bubbles
// HealUpBubbles.clear();          // Remove all bubbles
// HealUpBubbles.count();          // Get current bubble count
// HealUpBubbles.performance();    // Get performance info
// HealUpBubbles.setPerformance('low'); // Set to low performance mode

console.log('🫧 HealUp Floating Bubbles Control Panel loaded!');
console.log('Use HealUpBubbles.burst(10) to create a bubble burst!');
