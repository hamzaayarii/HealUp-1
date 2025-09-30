@props(['stats'])

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
        <div class="text-2xl font-bold text-blue-600">{{ $stats['total_habits'] ?? 0 }}</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">Total Habits</div>
    </div>
    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
        <div class="text-2xl font-bold text-green-600">{{ $stats['completed'] ?? 0 }}</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">Completed</div>
    </div>
    <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
        <div class="text-2xl font-bold text-orange-600">{{ $stats['pending'] ?? 0 }}</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
    </div>
    <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
        <div class="text-2xl font-bold text-purple-600">{{ $stats['completion_rate'] ?? 0 }}%</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">Completion Rate</div>
    </div>
</div>
