@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-4 theme-transition']) }}>
        <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
