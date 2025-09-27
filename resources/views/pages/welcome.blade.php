<x-guest-layout>
    <!-- External CSS for floating bubbles -->
    <link rel="stylesheet" href="{{ asset('css/floating-bubbles.css') }}">

    <div class="scroll-smooth">
        <!-- Floating Bubbles Background Overlay -->
        <x-welcome.floating-bubbles />

        <!-- Hero Section -->
        <x-welcome.hero-section />

        <!-- Features Section -->
        <x-welcome.features-section />

        <!-- Why Choose HealUp Section -->
        <x-welcome.about-section />

        <!-- CTA Section -->
        <x-welcome.cta-section />

        <!-- Back to Top Button -->
        <x-welcome.back-to-top />

        @push('scripts')
            <script src="{{ asset('js/welcome-page.js') }}"></script>
        @endpush
    </div>
</x-guest-layout>
