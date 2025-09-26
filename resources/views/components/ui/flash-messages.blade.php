{{-- Flash Messages Component --}}
@if(session('status'))
    <div class="flash-message flash-status bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-md mb-4"
        role="alert">
        <div class="flex items-center">
            <x-ui.icon name="information-circle" class="w-5 h-5 mr-2 text-blue-600" />
            <span>{{ session('status') }}</span>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="flash-message flash-success bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md mb-4"
        role="alert">
        <div class="flex items-center">
            <x-ui.icon name="check-circle" class="w-5 h-5 mr-2 text-green-600" />
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="flash-message flash-error bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md mb-4"
        role="alert">
        <div class="flex items-center">
            <x-ui.icon name="exclamation-circle" class="w-5 h-5 mr-2 text-red-600" />
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="flash-message flash-warning bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md mb-4"
        role="alert">
        <div class="flex items-center">
            <x-ui.icon name="exclamation-triangle" class="w-5 h-5 mr-2 text-yellow-600" />
            <span>{{ session('warning') }}</span>
        </div>
    </div>
@endif
