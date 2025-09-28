{{-- Mobile Menu Button Component --}}
@props([
    'class' => ''
])

<button type="button"
        {{ $attributes->merge(['class' => "mobile-menu-button p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md $class"]) }}
        data-mobile-menu-toggle
        aria-expanded="false"
        aria-controls="mobile-menu"
        aria-label="Toggle mobile menu">

    {{-- Hamburger Icon --}}
    <span class="hamburger-icon block">
        <x-ui.hamburger-icon class="w-6 h-6" />
    </span>

    {{-- Close Icon (hidden by default) --}}
    <span class="close-icon hidden">
        <x-ui.icon name="x" class="w-6 h-6" />
    </span>
</button>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('[data-mobile-menu-toggle]');
        if (button) {
            button.addEventListener('click', function() {
                const hamburger = button.querySelector('.hamburger-icon');
                const close = button.querySelector('.close-icon');
                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                // Toggle icons
                hamburger.classList.toggle('hidden');
                close.classList.toggle('hidden');

                // Update aria-expanded
                button.setAttribute('aria-expanded', !isExpanded);
            });
        }
    });
</script>
@endpush
