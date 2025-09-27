<!-- Features Section -->
<section id="features" class="relative z-10 py-20 bg-white dark:bg-gray-900 theme-transition">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4 theme-transition">Comprehensive Wellness Platform</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto theme-transition">
                Everything students and teachers need to build healthy habits, track progress, and create a culture of preventive wellness.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <x-welcome.feature-card
                icon="check-circle"
                title="Daily Habit Tracking"
                description="Build and maintain healthy habits with daily progress tracking, streaks, and personalized categories."
                gradient="from-green-50 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/30"
                iconBg="bg-green-600 dark:bg-green-700"
                border="border-green-100 dark:border-green-800"
                :features="['Custom habit categories', 'Daily progress logging', 'Streak counting & rewards']"
            />

            <x-welcome.feature-card
                icon="fire"
                title="Wellness Challenges"
                description="Join group challenges with classmates and compete in healthy activities to stay motivated together."
                gradient="from-blue-50 to-cyan-100 dark:from-blue-900/20 dark:to-cyan-900/30"
                iconBg="bg-blue-600 dark:bg-blue-700"
                border="border-blue-100 dark:border-blue-800"
                :features="['Group challenges', 'Leaderboards & rankings', 'Team participation']"
            />

            <x-welcome.feature-card
                icon="lightbulb"
                title="Personalized Advice"
                description="Get personalized wellness advice from teachers or AI, with follow-up chat sessions for continuous support."
                gradient="from-purple-50 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/30"
                iconBg="bg-purple-600 dark:bg-purple-700"
                border="border-purple-100 dark:border-purple-800"
                :features="['Teacher-generated advice', 'AI wellness insights', 'Follow-up chat sessions']"
            />

            <x-welcome.feature-card
                icon="users"
                title="Social Community"
                description="Share wellness posts, comment on others' journeys, and build a supportive community around health."
                gradient="from-amber-50 to-orange-100 dark:from-amber-900/20 dark:to-orange-900/30"
                iconBg="bg-amber-600 dark:bg-amber-700"
                border="border-amber-100 dark:border-amber-800"
                :features="['Wellness posts & updates', 'Community discussions', 'Peer support network']"
            />

            <x-welcome.feature-card
                icon="chart-bar"
                title="Progress Analytics"
                description="Visualize your wellness journey with detailed analytics, trends, and achievement milestones."
                gradient="from-teal-50 to-green-100 dark:from-teal-900/20 dark:to-green-900/30"
                iconBg="bg-teal-600 dark:bg-teal-700"
                border="border-teal-100 dark:border-teal-800"
                :features="['Progress visualization', 'Habit trend analysis', 'Achievement tracking']"
            />

            <x-welcome.feature-card
                icon="shield-check"
                title="Safe & Secure"
                description="Your wellness data is protected with role-based access, ensuring privacy between students and teachers."
                gradient="from-rose-50 to-pink-100 dark:from-rose-900/20 dark:to-pink-900/30"
                iconBg="bg-rose-600 dark:bg-rose-700"
                border="border-rose-100 dark:border-rose-800"
                :features="['Role-based permissions', 'Data privacy controls', 'Secure communication']"
            />
        </div>
    </div>
</section>
