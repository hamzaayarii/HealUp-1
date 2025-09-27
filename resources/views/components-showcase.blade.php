{{-- UI Components Showcase Page --}}
<x-layouts.guest>
	<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
		<div
			class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<!-- Header -->
			<div class="text-center mb-12">
				<h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
					HealUp UI Components
				</h1>
				<p class="text-xl text-gray-600 dark:text-gray-300">
					A comprehensive showcase of our health platform's UI components
				</p>
			</div>

			<!-- Buttons Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Buttons</h2>
				<x-ui.card>
					<div class="space-y-6">
						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Primary Buttons</h3>
							<div class="flex flex-wrap gap-4">
								<x-ui.button variant="primary" size="sm">Small Primary</x-ui.button>
								<x-ui.button variant="primary" size="md">Medium Primary</x-ui.button>
								<x-ui.button variant="primary" size="lg">Large Primary</x-ui.button>
								<x-ui.button variant="primary" disabled>Disabled</x-ui.button>
								<x-ui.button variant="primary" loading>Loading</x-ui.button>
							</div>
						</div>

						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Button Variants</h3>
							<div class="flex flex-wrap gap-4">
								<x-ui.button variant="primary">Primary</x-ui.button>
								<x-ui.button variant="secondary">Secondary</x-ui.button>
								<x-ui.button variant="success">Success</x-ui.button>
								<x-ui.button variant="warning">Warning</x-ui.button>
								<x-ui.button variant="danger">Danger</x-ui.button>
								<x-ui.button variant="ghost">Ghost</x-ui.button>
								<x-ui.button variant="outline">Outline</x-ui.button>
							</div>
						</div>
					</div>
				</x-ui.card>
			</section>

			<!-- Form Components Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Form Components</h2>
				<x-ui.card>
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Input Fields</h3>
							<div class="space-y-4">
								<x-ui.form-input label="Email Address" type="email" placeholder="Enter your email" :icon="'<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207\'/></svg>'"/>

								<x-ui.form-input label="Password" type="password" placeholder="Enter your password" :icon="'<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\'/></svg>'"/>

								<x-ui.form-input label="With Error" type="text" placeholder="This field has an error" error="This field is required"/>
							</div>
						</div>

						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Progress Bars</h3>
							<div class="space-y-4">
								<x-ui.progress-bar value="25" label="25% Complete"/>
								<x-ui.progress-bar value="50" color="success" label="50% Complete"/>
								<x-ui.progress-bar value="75" color="warning" label="75% Complete" size="lg"/>
								<x-ui.progress-bar value="90" color="danger" label="90% Complete" animate/>
							</div>
						</div>
					</div>
				</x-ui.card>
			</section>

			<!-- Badges Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Badges</h2>
				<x-ui.card>
					<div class="space-y-6">
						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Variants</h3>
							<div class="flex flex-wrap gap-3">
								<x-ui.badge variant="primary">Primary</x-ui.badge>
								<x-ui.badge variant="secondary">Secondary</x-ui.badge>
								<x-ui.badge variant="success">Success</x-ui.badge>
								<x-ui.badge variant="warning">Warning</x-ui.badge>
								<x-ui.badge variant="danger">Danger</x-ui.badge>
								<x-ui.badge variant="info">Info</x-ui.badge>
							</div>
						</div>

						<div>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Sizes & Options</h3>
							<div class="flex flex-wrap items-center gap-3">
								<x-ui.badge size="xs">Extra Small</x-ui.badge>
								<x-ui.badge size="sm">Small</x-ui.badge>
								<x-ui.badge size="md">Medium</x-ui.badge>
								<x-ui.badge size="lg">Large</x-ui.badge>
								<x-ui.badge rounded="full">Rounded Full</x-ui.badge>
								<x-ui.badge removable>Removable</x-ui.badge>
							</div>
						</div>
					</div>
				</x-ui.card>
			</section>

			<!-- Alerts Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Alerts</h2>
				<div class="space-y-4">
					<x-ui.alert type="success" title="Success!" dismissible>
						Your health goals have been updated successfully.
					</x-ui.alert>

					<x-ui.alert type="info" title="Information">
						Remember to log your daily activities for better tracking.
					</x-ui.alert>

					<x-ui.alert type="warning" title="Warning" dismissible>
						You haven't logged any activities today. Don't forget to track your progress!
					</x-ui.alert>

					<x-ui.alert type="danger" title="Error">
						There was an error processing your request. Please try again.
					</x-ui.alert>
				</div>
			</section>

			<!-- Cards Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Cards</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<x-ui.card>
						<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Basic Card</h3>
						<p class="text-gray-600 dark:text-gray-300">This is a basic card with default styling.</p>
					</x-ui.card>

					<x-ui.card shadow="lg" hover>
						<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Enhanced Card</h3>
						<p class="text-gray-600 dark:text-gray-300">This card has a larger shadow and hover effect.</p>
					</x-ui.card>

					<x-ui.card padding="lg" rounded="xl">
						<x-slot:header>
							<h3 class="text-lg font-medium text-gray-900 dark:text-white">Card with Header</h3>
						</x-slot:header>

						<p class="text-gray-600 dark:text-gray-300">This card has a header and footer section.</p>

						<x-slot:footer>
							<x-ui.button variant="primary" size="sm">Action</x-ui.button>
						</x-slot:footer>
					</x-ui.card>
				</div>
			</section>

			<!-- Feature Cards Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Feature Cards</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<x-ui.feature-card title="Track Habits" description="Monitor your daily health habits and build lasting routines." iconcolor="success" :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\'/></svg>'"/>

					<x-ui.feature-card title="Progress Analytics" description="Visualize your health journey with detailed analytics and insights." iconcolor="info" :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z\'/></svg>'"/>

					<x-ui.feature-card title="Community Support" description="Connect with like-minded individuals on their health journey." iconcolor="primary" :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a4 4 0 110-5.292M15 21H3v-1a6 6 0 0112 0v1z\'/></svg>'"/>
				</div>
			</section>

			<!-- Statistics Section -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Statistics Cards</h2>
				<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
					<x-ui.stat-card value="1247" label="Active Users" color="primary" suffix="+" :icon="'<svg class=\'w-8 h-8\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z\'/></svg>'"/>

					<x-ui.stat-card value="89" label="Success Rate" color="success" suffix="%" :icon="'<svg class=\'w-8 h-8\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6\'/></svg>'"/>

					<x-ui.stat-card value="24" label="Daily Average" color="info" suffix=" hrs" :icon="'<svg class=\'w-8 h-8\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z\'/></svg>'"/>

					<x-ui.stat-card value="156" label="Challenges Completed" color="warning" :icon="'<svg class=\'w-8 h-8\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z\'/></svg>'"/>
				</div>
			</section>

			<!-- Interactive Components -->
			<section class="mb-16">
				<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Interactive Components</h2>
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
					<x-ui.card>
						<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Modal Example</h3>
						<x-ui.button x-data="" x-on:click.prevent="$dispatch('open-modal', 'example-modal')">
							Open Modal
						</x-ui.button>

						<x-ui.modal name="example-modal" title="Example Modal">
							<div class="space-y-4">
								<p class="text-gray-600 dark:text-gray-300">
									This is an example modal with a title and footer.
								</p>
								<p class="text-gray-600 dark:text-gray-300">
									You can put any content here, including forms, images, or other components.
								</p>
							</div>

							<x-slot:footer>
								<div class="flex justify-end space-x-3">
									<x-ui.button variant="secondary" x-on:click="$dispatch('close-modal', 'example-modal')">
										Cancel
									</x-ui.button>
									<x-ui.button variant="primary" x-on:click="$dispatch('close-modal', 'example-modal')">
										Save Changes
									</x-ui.button>
								</div>
							</x-slot:footer>
						</x-ui.modal>
					</x-ui.card>

					<x-ui.card>
						<h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Toast Notifications</h3>
						<div class="space-y-3">
							<x-ui.button x-data="" x-on:click="toast('Success! Your action was completed.', 'success')">
								Show Success Toast
							</x-ui.button>
							<x-ui.button x-data="" x-on:click="toast('This is an informational message.', 'info')">
								Show Info Toast
							</x-ui.button>
							<x-ui.button x-data="" x-on:click="toast('Warning: Please check your input.', 'warning')">
								Show Warning Toast
							</x-ui.button>
							<x-ui.button x-data="" x-on:click="toast('Error: Something went wrong.', 'danger')">
								Show Error Toast
							</x-ui.button>
						</div>
					</x-ui.card>
				</div>
			</section>

			<!-- Footer -->
			<div class="text-center py-8 border-t border-gray-200 dark:border-gray-700">
				<p class="text-gray-600 dark:text-gray-300">
					HealUp UI Components - Built with ❤️ for health and wellness
				</p>
			</div>
		</div>
	</div>

	<!-- Toast Container -->
	<x-ui.toast-container/>
</x-layouts.guest>

