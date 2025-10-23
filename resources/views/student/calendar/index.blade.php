<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('My Wellness Calendar') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Track your challenge progress and daily check-ins
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('student.challenges.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Back to Challenges
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" id="calendar-stats">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Current Streak</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="current-streak">0 days</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Check-ins</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="total-checkins">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Challenges</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="current-challenges">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Points</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="total-points">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="p-6">
                    <div id="calendar" class="fc"></div>
                </div>
            </div>

            <!-- Legend -->
            <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Calendar Legend</h3>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Challenge Period</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Completed Check-in</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-yellow-500 rounded mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Pending Check-in</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Check-in Modal -->
    // ...existing code...

<!-- Check-in Modal -->
<div id="checkin-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-all">
            <div class="p-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="modal-title">Daily Check-in</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" id="modal-description">
                            Mark today's check-in as completed?
                        </p>
                    </div>
                    <button id="modal-close" class="ml-4 -mt-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" aria-label="Close modal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="mt-3">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div id="modal-progress" class="bg-green-600 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                    <p id="modal-progress-text" class="text-xs text-gray-500 dark:text-gray-400 mt-2">Progress: 0%</p>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button id="modal-cancel"
                            class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                    <button id="modal-confirm"
                            class="px-3 py-1 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Check-in
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Styles pour FullCalendar -->
    <style>
        .fc {
            font-family: inherit;
        }
        
        .fc-event {
            cursor: pointer;
            border: none;
            font-size: 0.8em;
            padding: 2px 4px;
        }
        
        .fc-daygrid-event {
            border-radius: 4px;
        }
        
        .fc-event-title {
            font-weight: 500;
        }
    </style>

    <!-- Scripts -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Déclarer toutes les variables en premier
            let calendarEl = document.getElementById('calendar');
            let currentEvent = null;
            
            // Éléments du modal - DOIVENT ÊTRE DÉFINIS AVANT TOUTE UTILISATION
            const modal = document.getElementById('checkin-modal');
            const modalCancel = document.getElementById('modal-cancel');
            const modalConfirm = document.getElementById('modal-confirm');
            const modalProgress = document.getElementById('modal-progress');
            const modalProgressText = document.getElementById('modal-progress-text');

            // Vérifier que tous les éléments existent
            if (!calendarEl) {
                console.error('Calendar element not found');
                return;
            }

            if (!modal || !modalCancel || !modalConfirm) {
                console.error('Modal elements not found');
                return;
            }

            // Initialize calendar
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                firstDay: 1,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("student.calendar.events") }}',
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    
                    const event = info.event;
                    const extendedProps = event.extendedProps;
                    
                    if (extendedProps.type === 'checkin' && !extendedProps.checked) {
                        currentEvent = event;
                        showCheckinModal(extendedProps);
                    }
                },
                eventContent: function(arg) {
                    const extendedProps = arg.event.extendedProps;
                    
                    if (extendedProps.type === 'checkin') {
                        return {
                            html: `
                                <div class="flex items-center justify-center p-1">
                                    <span class="text-xs font-medium">${extendedProps.checked ? '✅' : '⏳'} Jour ${extendedProps.day}</span>
                                </div>
                            `
                        };
                    }
                    
                    if (extendedProps.type === 'challenge') {
                        return { html: '' };
                    }
                    
                    return { html: arg.event.title };
                },
                loading: function(isLoading) {
                    if (!isLoading) {
                        loadStats();
                    }
                }
            });

            calendar.render();

            // Fonctions
            function showCheckinModal(extendedProps) {
                const progress = extendedProps.progress || 0;
                if (modalProgress) {
                    modalProgress.style.width = progress + '%';
                }
                if (modalProgressText) {
                    modalProgressText.textContent = `Progression: ${Math.round(progress)}%`;
                }
                
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function hideModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                currentEvent = null;
            }

            function loadStats() {
                fetch('{{ route("student.calendar.stats") }}')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Stats data:', data);
                        
                        const currentStreakEl = document.getElementById('current-streak');
                        const totalCheckinsEl = document.getElementById('total-checkins');
                        const currentChallengesEl = document.getElementById('current-challenges');
                        const totalPointsEl = document.getElementById('total-points');
                        
                        if (currentStreakEl) currentStreakEl.textContent = data.current_streak + ' jours';
                        if (totalCheckinsEl) totalCheckinsEl.textContent = data.total_checkins;
                        if (currentChallengesEl) currentChallengesEl.textContent = data.current_challenges;
                        if (totalPointsEl) totalPointsEl.textContent = data.total_points;
                    })
                    .catch(error => {
                        console.error('Error loading stats:', error);
                    });
            }

            function showNotification(message, type = 'info') {
                if (type === 'success') {
                    alert('✅ ' + message);
                } else {
                    alert('❌ ' + message);
                }
            }

            // Event listeners - DOIVENT ÊTRE APRÈS LA DÉCLARATION DES VARIABLES
            modalCancel.addEventListener('click', hideModal);
            
            modalConfirm.addEventListener('click', function() {
                if (!currentEvent) return;
                
                const extendedProps = currentEvent.extendedProps;
                
                fetch('{{ route("student.calendar.checkin") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        participation_id: extendedProps.participation_id,
                        date: currentEvent.startStr
                    })
                })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        return response.text().then(text => {
                            throw new Error('Server returned: ' + text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
    if (data.success) {
        // Mettre à jour l'événement immédiatement
        currentEvent.setProp('color', '#10b981');
        currentEvent.setExtendedProp('checked', true);
        currentEvent.setExtendedProp('progress', data.progress);
        
        // Rafraîchir tous les événements après un court délai
        setTimeout(() => {
            calendar.refetchEvents();
            loadStats();
        }, 300);
        
        // Afficher le message de succès
        showNotification('✅ ' + data.message, 'success');
        
        // Vérifier si le défi est complété et afficher l'alerte
        if (data.challenge_completed && data.completion_message) {
            // Délai pour laisser voir le premier message
            setTimeout(() => {
                showChallengeCompletionAlert(data.completion_message, data.new_badges);
            }, 1000);
        }
        
    } else {
        showNotification('❌ ' + data.message, 'error');
    }
    hideModal();
})
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Erreur lors du check-in: ' + error.message, 'error');
                    hideModal();
                });
            });

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideModal();
                }
            });

            // Load initial stats
            loadStats();
        });
        function showBadgeAlert(message, newBadges = []) {
    if (newBadges && newBadges.length > 0) {
        const badgeNames = newBadges.map(badge => badge.name).join(', ');
        showNotification(`🎉 ${message} Badges débloqués: ${badgeNames}`, 'success');
    } else {
        showNotification(`🎉 ${message}`, 'success');
    }
}
function showChallengeCompletionAlert(message, newBadges = []) {
    let badgeText = '';
    if (newBadges && newBadges.length > 0) {
        const badgeNames = newBadges.map(badge => badge.name).join(', ');
        badgeText = `\n\n🎉 Badges débloqués: ${badgeNames}`;
    }
    
    // Utiliser une alerte navigateur simple mais stylisée
    if (confirm(`🏆 DÉFI ACCOMPLI! 🏆\n\n${message}${badgeText}\n\nFélicitations pour cette réalisation! 🎊`)) {
        // L'utilisateur a cliqué sur OK
        console.log('Utilisateur a célébré sa victoire!');
    }
}
    </script>
    
</x-app-layout>