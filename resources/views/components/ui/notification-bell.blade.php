{{-- Notification Bell Component --}}
@props([
    'count' => 0,
    'class' => ''
])

<div class="notification-bell relative {{ $class }}" x-data="{ open: false }">
    {{-- Bell Button --}}
    <button type="button"
            class="notification-trigger p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-md relative"
            @click="open = !open"
            @click.away="open = false"
            :aria-expanded="open"
            aria-label="View notifications">

        {{-- Bell Icon --}}
        <x-ui.icon name="bell" class="w-6 h-6" />

        {{-- Notification Badge --}}
        @if($count > 0)
            <span class="notification-badge absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                {{ $count > 99 ? '99+' : $count }}
            </span>
        @endif
    </button>

    {{-- Notification Dropdown --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="notification-dropdown absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">

        {{-- Dropdown Header --}}
        <div class="notification-header px-4 py-3 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                @if($count > 0)
                    <button type="button"
                            class="text-xs text-blue-600 hover:text-blue-800"
                            onclick="markAllAsRead()">
                        Mark all as read
                    </button>
                @endif
            </div>
        </div>

        {{-- Notification List --}}
        <div class="notification-list max-h-64 overflow-y-auto">
            @if($count > 0)
                {{-- Sample notifications - replace with actual data --}}
                <div class="notification-item px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <x-ui.icon name="information-circle" class="w-4 h-4 text-blue-600" />
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">System Update</p>
                            <p class="text-sm text-gray-500">New features are now available.</p>
                            <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="notification-item px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <x-ui.icon name="check-circle" class="w-4 h-4 text-green-600" />
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Profile Updated</p>
                            <p class="text-sm text-gray-500">Your profile has been successfully updated.</p>
                            <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                        </div>
                    </div>
                </div>
            @else
                {{-- No notifications state --}}
                <div class="notification-empty px-4 py-8 text-center">
                    <x-ui.icon name="bell-slash" class="w-12 h-12 text-gray-300 mx-auto mb-3" />
                    <p class="text-sm text-gray-500">No new notifications</p>
                </div>
            @endif
        </div>

        {{-- Dropdown Footer --}}
        @if($count > 0)
            <div class="notification-footer px-4 py-3 border-t border-gray-200">
                <a href="#"
                   class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    View all notifications
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function markAllAsRead() {
        // Implement mark all as read functionality
        console.log('Mark all notifications as read');
        // You would typically make an AJAX call here
    }
</script>
@endpush
