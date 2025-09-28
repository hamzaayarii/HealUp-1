<!-- Guest Footer - Simpler version for guest pages -->
<footer class="guest-footer bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 theme-transition" role="contentinfo">
	<div
		class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

		<!-- Guest Footer Grid -->
		<div
			class="guest-footer-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

			<!-- Brand Section -->
			<div class="brand-section col-span-1 sm:col-span-2 lg:col-span-2">
				<div class="flex items-center space-x-3 mb-4">
					<x-ui.logo variant="full" size="md"/>
					<span class="text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
				</div>
				<p class="text-gray-600 dark:text-gray-300 mb-6 max-w-md">
					Transform your healthcare practice with our comprehensive platform designed
															                    for modern medical professionals.
				</p>

				<!-- CTA Section -->
				<div class="cta-section">
					<h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Ready to get started?</h4>
					<div class="flex flex-col sm:flex-row gap-3">
						<a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 dark:bg-green-500 text-white font-medium rounded-md hover:bg-green-700 dark:hover:bg-green-600 transition-colors">
							Start Free Trial
						</a>
						<a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-md hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
							Sign In
						</a>
					</div>
				</div>
			</div>

			<!-- Product Links -->
			<div class="product-links">
				<h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
					Product
				</h3>
				<ul class="space-y-2">
					<li>
						<a href="#features" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Features
						</a>
					</li>
					<li>
						<a href="#pricing" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Pricing
						</a>
					</li>
					<li>
						<a href="#security" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Security
						</a>
					</li>
					<li>
						<a href="#integrations" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Integrations
						</a>
					</li>
				</ul>
			</div>

			<!-- Company Links -->
			<div class="company-links">
				<h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
					Company
				</h3>
				<ul class="space-y-2">
					<li>
						<a href="#about" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							About Us
						</a>
					</li>
					<li>
						<a href="#contact" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Contact
						</a>
					</li>
					<li>
						<a href="#careers" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Careers
						</a>
					</li>
					<li>
						<a href="#blog" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
							Blog
						</a>
					</li>
				</ul>
			</div>
		</div>

		<!-- Newsletter Signup (Optional) -->
		<div class="newsletter-section mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
			<div class="max-w-md">
				<h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
					Stay updated
				</h3>
				<p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
					Get the latest healthcare technology insights and product updates.
				</p>
				<form class="flex flex-col sm:flex-row gap-2">
					<input type="email" placeholder="Enter your email" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 rounded-md text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors" required>
					<button type="submit" class="px-4 py-2 bg-green-600 dark:bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-700 dark:hover:bg-green-600 transition-colors">
						Subscribe
					</button>
				</form>
			</div>
		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
			<div
				class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">

				<!-- Copyright -->
				<div class="copyright text-gray-500 dark:text-gray-400 text-sm">
					&copy;
					{{ date('Y') }}
					{{ config('app.name') }}
				. All rights reserved.
				</div>

				<!-- Legal Links -->
					<div class="legal-links flex items-center space-x-6"> <a href="#privacy" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-sm transition-colors">
						Privacy Policy
					</a>
					<a href="#terms" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-sm transition-colors">
						Terms of Service
					</a>
					<a href="#cookies" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 text-sm transition-colors">
						Cookie Policy
					</a>
				</div>

				<!-- Social Links -->
				<div class="social-links flex items-center space-x-4">
					<a href="#" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" aria-label="Follow us on Twitter">
						<x-ui.icon name="twitter" class="w-5 h-5"/>
					</a>
					<a href="#" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" aria-label="Follow us on LinkedIn">
						<x-ui.icon name="linkedin" class="w-5 h-5"/>
					</a>
					<a href="#" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" aria-label="Visit our GitHub">
						<x-ui.icon name="github" class="w-5 h-5"/>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>

