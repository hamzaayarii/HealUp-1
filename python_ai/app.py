"""
Serveur Flask pour l'analyse nutritionnelle avec IA locale
Remplace l'API OpenAI par un modèle Python local
"""

from flask import Flask, request, jsonify
from flask_cors import CORS
import numpy as np
import pandas as pd
from datetime import datetime
import json
import logging

# Configuration du logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = Flask(__name__)
CORS(app)

# ============================================================================
# MODÈLES DE RÈGLES NUTRITIONNELLES (RULE-BASED AI)
# ============================================================================

class NutritionAnalyzer:
    """
    Analyseur nutritionnel basé sur des règles expertes
    Utilise des algorithmes de décision basés sur des connaissances nutritionnelles
    """
    
    def __init__(self):
        # Valeurs nutritionnelles recommandées (ajustables)
        self.recommended_daily = {
            'calories': {'min': 1800, 'max': 2500, 'optimal': 2000},
            'proteines': {'min': 46, 'max': 150, 'optimal': 75},
            'glucides': {'min': 130, 'max': 300, 'optimal': 225},
            'lipides': {'min': 44, 'max': 100, 'optimal': 65},
            'fibres': {'min': 25, 'max': 35, 'optimal': 30}
        }
        
        # Base de connaissances pour les recommandations
        self.food_categories = {
            'fruits': {'description': 'Riches en vitamines et fibres', 'daily_servings': 2},
            'legumes': {'description': 'Essentiels pour les fibres et minéraux', 'daily_servings': 3},
            'proteines': {'description': 'Construction musculaire', 'daily_servings': 2},
            'cereales': {'description': 'Source d\'énergie', 'daily_servings': 3},
            'produits_laitiers': {'description': 'Calcium et protéines', 'daily_servings': 2}
        }
    
    def analyze_meal(self, meal_data):
        """
        Analyse un repas et retourne des suggestions
        """
        calories = meal_data.get('calories', 0)
        proteines = meal_data.get('proteines', 0)
        glucides = meal_data.get('glucides', 0)
        lipides = meal_data.get('lipides', 0)
        
        analysis = {
            'equilibre_score': self._calculate_balance_score(calories, proteines, glucides, lipides),
            'recommendations': [],
            'warnings': [],
            'strengths': []
        }
        
        # Analyse des calories
        if calories < 300:
            analysis['warnings'].append("Repas trop léger - augmentez les portions")
        elif calories > 800:
            analysis['warnings'].append("Repas très calorique - modérez les portions")
        else:
            analysis['strengths'].append("Apport calorique équilibré")
        
        # Analyse des protéines
        protein_percentage = (proteines * 4 / calories * 100) if calories > 0 else 0
        if protein_percentage < 15:
            analysis['recommendations'].append("Ajoutez des protéines (poulet, poisson, légumineuses)")
        elif protein_percentage > 35:
            analysis['warnings'].append("Trop de protéines - variez avec des glucides complexes")
        else:
            analysis['strengths'].append("Bon apport en protéines")
        
        # Analyse des glucides
        carb_percentage = (glucides * 4 / calories * 100) if calories > 0 else 0
        if carb_percentage < 40:
            analysis['recommendations'].append("Ajoutez des glucides complexes (riz complet, quinoa)")
        elif carb_percentage > 65:
            analysis['warnings'].append("Trop de glucides - réduisez les sucres simples")
        else:
            analysis['strengths'].append("Bon équilibre en glucides")
        
        # Analyse des lipides
        fat_percentage = (lipides * 9 / calories * 100) if calories > 0 else 0
        if fat_percentage < 20:
            analysis['recommendations'].append("Ajoutez des graisses saines (huile d'olive, avocat)")
        elif fat_percentage > 35:
            analysis['warnings'].append("Trop de lipides - limitez les graisses saturées")
        else:
            analysis['strengths'].append("Bon apport en lipides")
        
        return analysis
    
    def _calculate_balance_score(self, calories, proteines, glucides, lipides):
        """
        Calcule un score d'équilibre nutritionnel (0-100)
        """
        if calories == 0:
            return 0
        
        # Pourcentages idéaux
        ideal_protein = 20  # 20% des calories
        ideal_carbs = 50    # 50% des calories
        ideal_fats = 30     # 30% des calories
        
        # Pourcentages actuels
        actual_protein = (proteines * 4 / calories * 100)
        actual_carbs = (glucides * 4 / calories * 100)
        actual_fats = (lipides * 9 / calories * 100)
        
        # Calcul des écarts
        protein_diff = abs(actual_protein - ideal_protein)
        carbs_diff = abs(actual_carbs - ideal_carbs)
        fats_diff = abs(actual_fats - ideal_fats)
        
        # Score (plus l'écart est faible, plus le score est élevé)
        score = 100 - (protein_diff + carbs_diff + fats_diff) / 3
        return max(0, min(100, score))
    
    def suggest_alternatives(self, ingredient_data):
        """
        Suggère des alternatives pour un ingrédient
        """
        category = ingredient_data.get('categorie', '')
        calories = ingredient_data.get('calories_pour_100g', 0)
        proteines = ingredient_data.get('proteines_pour_100g', 0)
        
        alternatives = []
        
        # Base de données d'alternatives par catégorie
        alternatives_db = {
            'fruits': [
                {'nom': 'Pomme', 'raison': 'Faible en calories, riche en fibres'},
                {'nom': 'Banane', 'raison': 'Source d\'énergie rapide'},
                {'nom': 'Baies', 'raison': 'Riches en antioxydants'}
            ],
            'legumes': [
                {'nom': 'Brocoli', 'raison': 'Riche en vitamines et faible en calories'},
                {'nom': 'Épinards', 'raison': 'Excellent pour le fer'},
                {'nom': 'Carottes', 'raison': 'Riches en bêta-carotène'}
            ],
            'proteines': [
                {'nom': 'Poulet', 'raison': 'Protéines maigres de qualité'},
                {'nom': 'Saumon', 'raison': 'Oméga-3 et protéines'},
                {'nom': 'Lentilles', 'raison': 'Protéines végétales et fibres'}
            ],
            'cereales': [
                {'nom': 'Quinoa', 'raison': 'Protéines complètes'},
                {'nom': 'Riz complet', 'raison': 'Glucides complexes'},
                {'nom': 'Avoine', 'raison': 'Fibres et énergie durable'}
            ]
        }
        
        # Suggestions basées sur la catégorie
        category_lower = category.lower()
        for cat_key, suggestions in alternatives_db.items():
            if cat_key in category_lower:
                alternatives = suggestions[:3]
                break
        
        # Si pas de catégorie trouvée, suggestions génériques
        if not alternatives:
            if calories > 200:
                alternatives.append({
                    'nom': 'Option légère',
                    'raison': 'Cherchez des alternatives à faible teneur calorique'
                })
            if proteines < 10:
                alternatives.append({
                    'nom': 'Source de protéines',
                    'raison': 'Ajoutez des protéines (œufs, tofu, viande maigre)'
                })
        
        return alternatives
    
    def analyze_weekly_pattern(self, meals_data):
        """
        Analyse les habitudes alimentaires sur une semaine
        """
        if not meals_data:
            return {
                'status': 'insufficient_data',
                'message': 'Pas assez de données pour l\'analyse hebdomadaire'
            }
        
        # Calculs des moyennes
        total_calories = sum(meal.get('calories', 0) for meal in meals_data)
        total_proteines = sum(meal.get('proteines', 0) for meal in meals_data)
        total_glucides = sum(meal.get('glucides', 0) for meal in meals_data)
        total_lipides = sum(meal.get('lipides', 0) for meal in meals_data)
        
        num_meals = len(meals_data)
        avg_calories = total_calories / num_meals if num_meals > 0 else 0
        
        analysis = {
            'moyennes': {
                'calories': round(avg_calories, 1),
                'proteines': round(total_proteines / num_meals, 1),
                'glucides': round(total_glucides / num_meals, 1),
                'lipides': round(total_lipides / num_meals, 1)
            },
            'tendances': [],
            'recommendations': []
        }
        
        # Analyse des tendances
        if avg_calories < 1800:
            analysis['tendances'].append("Apport calorique insuffisant")
            analysis['recommendations'].append("Augmentez vos portions ou ajoutez des collations nutritives")
        elif avg_calories > 2500:
            analysis['tendances'].append("Apport calorique élevé")
            analysis['recommendations'].append("Modérez les portions et privilégiez les aliments moins caloriques")
        else:
            analysis['tendances'].append("Apport calorique dans la normale")
        
        # Recommandations générales
        analysis['recommendations'].append("Variez vos sources de protéines (animales et végétales)")
        analysis['recommendations'].append("Consommez au moins 5 portions de fruits et légumes par jour")
        analysis['recommendations'].append("Hydratez-vous régulièrement (1.5-2L d'eau par jour)")
        
        return analysis
    
    def generate_meal_plan(self, objective_calories, num_meals=7):
        """
        Génère un plan de repas pour la semaine
        """
        calories_per_meal = objective_calories / 3  # 3 repas principaux
        
        meal_templates = [
            {
                'nom': 'Petit-déjeuner équilibré',
                'description': 'Flocons d\'avoine, fruits, yaourt grec',
                'calories': calories_per_meal * 0.3,
                'type': 'petit_dejeuner'
            },
            {
                'nom': 'Déjeuner protéiné',
                'description': 'Poulet grillé, quinoa, légumes verts',
                'calories': calories_per_meal * 1.2,
                'type': 'dejeuner'
            },
            {
                'nom': 'Dîner léger',
                'description': 'Saumon, riz complet, brocoli vapeur',
                'calories': calories_per_meal * 1.0,
                'type': 'diner'
            },
            {
                'nom': 'Repas végétarien',
                'description': 'Lentilles, riz, salade composée',
                'calories': calories_per_meal,
                'type': 'dejeuner'
            },
            {
                'nom': 'Option méditerranéenne',
                'description': 'Poisson blanc, légumes grillés, huile d\'olive',
                'calories': calories_per_meal,
                'type': 'diner'
            }
        ]
        
        plan = []
        for i in range(num_meals):
            meal = meal_templates[i % len(meal_templates)].copy()
            meal['jour'] = f"Jour {i + 1}"
            plan.append(meal)
        
        return {
            'plan_hebdomadaire': plan,
            'objectif_calories': objective_calories,
            'conseils': [
                'Adaptez les portions selon votre faim',
                'Hydratez-vous tout au long de la journée',
                'Variez les sources de protéines',
                'Privilégiez les aliments frais et de saison'
            ]
        }
    
    def detect_deficiencies(self, nutrition_stats, period_days=7):
        """
        Détecte les carences nutritionnelles potentielles
        """
        deficiencies = []
        recommendations = []
        
        # Messages descriptifs pour chaque nutriment
        nutrient_messages = {
            'calories': {
                'high': 'Severe calorie deficit detected. Your energy intake is significantly below recommended levels.',
                'moderate': 'Moderate calorie deficit. Consider increasing your overall food intake.'
            },
            'proteines': {
                'high': 'Severe protein deficiency. Essential for muscle maintenance and immune function.',
                'moderate': 'Moderate protein deficit. Add more lean meats, fish, eggs, or legumes to your diet.'
            },
            'glucides': {
                'high': 'Severe carbohydrate deficiency. Your body needs carbs for energy.',
                'moderate': 'Low carbohydrate intake. Consider adding whole grains, fruits, and vegetables.'
            },
            'lipides': {
                'high': 'Severe fat deficiency. Healthy fats are essential for hormone production and vitamin absorption.',
                'moderate': 'Low fat intake. Include sources like olive oil, nuts, avocados, and fatty fish.'
            },
            'fibres': {
                'high': 'Severe fiber deficiency. Critical for digestive health.',
                'moderate': 'Low fiber intake. Increase consumption of fruits, vegetables, and whole grains.'
            }
        }
        
        for nutrient, values in self.recommended_daily.items():
            actual = nutrition_stats.get(nutrient, 0)
            
            if actual < values['min']:
                severity = 'élevée' if actual < values['min'] * 0.7 else 'modérée'
                severity_key = 'high' if severity == 'élevée' else 'moderate'
                
                deficiencies.append({
                    'nutriment': nutrient,
                    'valeur_actuelle': round(actual, 1),
                    'valeur_recommandee': values['optimal'],
                    'severite': severity,
                    'message': nutrient_messages.get(nutrient, {}).get(severity_key, f'{severity.capitalize()} deficiency in {nutrient}.')
                })
                
                # Recommandations spécifiques
                if nutrient == 'proteines':
                    recommendations.append("Augmentez votre consommation de viandes maigres, poissons, œufs ou légumineuses")
                elif nutrient == 'glucides':
                    recommendations.append("Ajoutez des céréales complètes, fruits et légumes à vos repas")
                elif nutrient == 'lipides':
                    recommendations.append("Intégrez des sources de graisses saines (huile d'olive, noix, avocat)")
                elif nutrient == 'fibres':
                    recommendations.append("Consommez plus de fruits, légumes et céréales complètes")
        
        return {
            'carences_detectees': deficiencies,
            'recommendations': recommendations,
            'periode_analyse': f"{period_days} jours"
        }


# ============================================================================
# ENDPOINTS API
# ============================================================================

# Instance de l'analyseur
analyzer = NutritionAnalyzer()

@app.route('/health', methods=['GET'])
def health_check():
    """Vérification de l'état du serveur"""
    return jsonify({
        'status': 'ok',
        'service': 'HealUp Nutrition AI',
        'model': 'Rule-Based Expert System',
        'version': '1.0.0'
    })

@app.route('/analyze/meal', methods=['POST'])
def analyze_meal():
    """Analyse un repas individuel"""
    try:
        data = request.json
        logger.info(f"Analyzing meal: {data}")
        
        result = analyzer.analyze_meal(data)
        
        return jsonify({
            'success': True,
            'data': result
        })
    except Exception as e:
        logger.error(f"Error analyzing meal: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

@app.route('/suggest/alternatives', methods=['POST'])
def suggest_alternatives():
    """Suggère des alternatives pour un ingrédient"""
    try:
        data = request.json
        logger.info(f"Suggesting alternatives for: {data}")
        
        alternatives = analyzer.suggest_alternatives(data)
        
        # Message d'analyse basé sur les alternatives trouvées
        ingredient_name = data.get('nom', 'Ingrédient')
        category = data.get('categorie', 'général')
        
        message = f"Voici {len(alternatives)} alternatives nutritionnelles pour {ingredient_name} dans la catégorie {category}."
        
        recommendations = []
        if alternatives:
            recommendations.append("Choisissez des alternatives avec des profils nutritionnels similaires")
            recommendations.append("Tenez compte de vos objectifs caloriques quotidiens")
            if len(alternatives) >= 3:
                recommendations.append("Variez vos sources nutritionnelles pour un régime équilibré")
        
        return jsonify({
            'success': True,
            'data': {
                'alternatives': alternatives,
                'message': message,
                'recommendations': recommendations,
                'similarity_score': 0.85 if alternatives else 0
            }
        })
    except Exception as e:
        logger.error(f"Error suggesting alternatives: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

@app.route('/analyze/weekly', methods=['POST'])
def analyze_weekly():
    """Analyse les habitudes hebdomadaires"""
    try:
        data = request.json
        meals_data = data.get('meals', [])
        logger.info(f"Analyzing weekly pattern for {len(meals_data)} meals")
        
        result = analyzer.analyze_weekly_pattern(meals_data)
        
        return jsonify({
            'success': True,
            'data': result
        })
    except Exception as e:
        logger.error(f"Error analyzing weekly pattern: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

@app.route('/generate/meal-plan', methods=['POST'])
def generate_meal_plan():
    """Génère un plan de repas"""
    try:
        data = request.json
        objective_calories = data.get('objectif_calories', 2000)
        num_meals = data.get('nombre_repas', 7)
        
        logger.info(f"Generating meal plan: {objective_calories} cal, {num_meals} meals")
        
        plan = analyzer.generate_meal_plan(objective_calories, num_meals)
        
        return jsonify({
            'success': True,
            'data': plan
        })
    except Exception as e:
        logger.error(f"Error generating meal plan: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

@app.route('/detect/deficiencies', methods=['POST'])
def detect_deficiencies():
    """Détecte les carences nutritionnelles"""
    try:
        data = request.json
        nutrition_stats = data.get('nutrition_stats', {})
        period_days = data.get('period_days', 7)
        
        logger.info(f"Detecting deficiencies for period: {period_days} days")
        logger.info(f"Received nutrition stats type: {type(nutrition_stats)}")
        
        # Si nutrition_stats est une liste, convertir en dict ou utiliser defaults
        if isinstance(nutrition_stats, list):
            logger.warning("nutrition_stats is a list, using default values")
            nutrition_stats = {
                'calories': 1800,
                'proteines': 60,
                'glucides': 200,
                'lipides': 60
            }
        
        result = analyzer.detect_deficiencies(nutrition_stats, period_days)
        
        return jsonify({
            'success': True,
            'data': result
        })
    except Exception as e:
        logger.error(f"Error detecting deficiencies: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

@app.route('/optimize/meal', methods=['POST'])
def optimize_meal():
    """Optimise un repas selon des critères"""
    try:
        data = request.json
        meal_data = data.get('meal', {})
        criteria = data.get('criteria', {})
        
        logger.info(f"Optimizing meal with criteria: {criteria}")
        
        # Analyse actuelle
        current_analysis = analyzer.analyze_meal(meal_data)
        
        # Suggestions d'optimisation
        optimizations = []
        
        if criteria.get('reduce_calories'):
            optimizations.append({
                'type': 'calories',
                'suggestion': 'Réduisez les portions de 20% ou remplacez par des alternatives moins caloriques'
            })
        
        if criteria.get('increase_protein'):
            optimizations.append({
                'type': 'proteines',
                'suggestion': 'Ajoutez 50g de poulet ou 100g de tofu pour plus de protéines'
            })
        
        if criteria.get('balance_macros'):
            optimizations.append({
                'type': 'equilibre',
                'suggestion': 'Ajustez les proportions: 50% glucides, 30% lipides, 20% protéines'
            })
        
        return jsonify({
            'success': True,
            'data': {
                'current_analysis': current_analysis,
                'optimizations': optimizations
            }
        })
    except Exception as e:
        logger.error(f"Error optimizing meal: {str(e)}")
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


#================================================================
# generate Advices
#================================================================
import joblib
import random
model = joblib.load('advice_model.pkl')

ADVICE_LIBRARY = {
    'Sleep': [
        {'title': 'Improve Your Sleep', 'content': 'Try to maintain a consistent bedtime and wake-up schedule.'},
        {'title': 'Nap Smartly', 'content': 'Short 20-min naps can boost energy without affecting nighttime sleep.'},
        {'title': 'Optimize Your Bedroom', 'content': 'Keep your room dark, quiet, and cool to improve sleep quality.'}
    ],
    'Nutrition': [
        {'title': 'Eat More Veggies', 'content': 'Add at least 2 servings of vegetables to each meal.'},
        {'title': 'Stay Hydrated', 'content': 'Drink at least 8 glasses of water daily.'},
        {'title': 'Balance Macronutrients', 'content': 'Ensure each meal has carbs, protein, and healthy fats.'}
    ],
    'Activity': [
        {'title': 'Take a Walk', 'content': 'A 20-minute walk after meals helps digestion and metabolism.'},
        {'title': 'Stretch Daily', 'content': 'Spend 10 minutes stretching to improve mobility and reduce tension.'},
        {'title': 'Strength Training', 'content': 'Include 2-3 strength sessions per week for overall health.'}
    ]
}

@app.route('/predict_advice', methods=['POST'])
def predict_advice():
    data = request.json or {}
    
    required_keys = ['age','poids','taille','total_calories','total_proteines','total_glucides','total_lipides','current_streak']
    if not all(k in data for k in required_keys):
        return jsonify([])  # return empty array instead of null

    features = np.array([[data['age'], data['poids'], data['taille'],
                          data['total_calories'], data['total_proteines'],
                          data['total_glucides'], data['total_lipides'],
                          data['current_streak']]])
    
    advice_type = model.predict(features)[0]
    
    advice_options = ADVICE_LIBRARY.get(advice_type, [])
    advice_list = random.sample(advice_options, k=min(3, len(advice_options)))
    
    return jsonify(advice_list)


# ============================================================================
# DÉMARRAGE DU SERVEUR
# ============================================================================

if __name__ == '__main__':
    logger.info("Starting HealUp Nutrition AI Server...")
    logger.info("Model: Rule-Based Expert System")
    logger.info("Port: 5000")
    logger.info("Available endpoints:")
    logger.info("  GET  /health")
    logger.info("  POST /analyze/meal")
    logger.info("  POST /suggest/alternatives")
    logger.info("  POST /analyze/weekly")
    logger.info("  POST /generate/meal-plan")
    logger.info("  POST /detect/deficiencies")
    logger.info("  POST /optimize/meal")
    app.run(host='0.0.0.0', port=5000, debug=False, use_reloader=False)
