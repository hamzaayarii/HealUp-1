<!-- Interactive Dashboard Preview -->
<div class="relative animate-fade-in-up" style="animation-delay: 0.3s;">
	<div
		class="relative rounded-3xl overflow-hidden shadow-2xl bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700 theme-transition">
		<!-- Mock Dashboard -->
		<div
			class="space-y-4">
			<!-- Header -->
			<div class="flex items-center justify-between">
				<h3 class="font-semibold text-gray-800 dark:text-gray-200 theme-transition">Today's Wellness Overview</h3>
				<div class="w-3 h-3 bg-green-400 dark:bg-green-500 rounded-full animate-pulse-slow"></div>
			</div>

			<!-- Progress Circles -->
			<div class="grid grid-cols-3 gap-4">
				<x-welcome.progress-circle percentage="70" color="green" label="Daily Steps"/>
				<x-welcome.progress-circle percentage="55" color="cyan" label="Habits"/>
				<x-welcome.progress-circle percentage="80" color="purple" label="Challenges"/>
			</div>

			<!-- Activity List -->
			<div class="space-y-2">
				<x-welcome.activity-item color="green" activity="Morning Walk Challenge" points="50"/>
				<x-welcome.activity-item color="blue" activity="Hydration Habit" points="30"/>
				<x-welcome.activity-item color="purple" activity="Meditation Session" points="25"/>
			</div>
		</div>
	</div>

	<!-- Floating Elements -->
	<div class="absolute -top-4 -right-4 w-8 h-8 bg-green-400 dark:bg-green-500 rounded-full opacity-80 animate-float theme-transition"></div>
	<div class="absolute -bottom-4 -left-4 w-6 h-6 bg-teal-400 dark:bg-teal-500 rounded-full opacity-80 animate-float theme-transition" style="animation-delay: 1s;"></div>
</div>
