# 🍽️ Module Repas & Ingrédients - Documentation Complète

## 📋 Vue d'ensemble

Ce module fournit une gestion complète des repas et ingrédients avec des fonctionnalités avancées de recherche, tri et intelligence artificielle pour l'analyse nutritionnelle.

## ✨ Fonctionnalités Implémentées

### 1. 🔍 Recherche et Filtres Avancés

#### Pour les Repas (`RepasController`)
- **Recherche par nom** : Recherche dans les noms de repas et les ingrédients associés
- **Filtrage par type** : petit-déjeuner, déjeuner, dîner, collation
- **Filtrage par date** : Plage de dates (date_debut, date_fin)
- **Filtrage nutritionnel** :
  - Calories min/max
  - Protéines min
- **Tri dynamique** : Par nom, date, calories, protéines, glucides, lipides

#### Pour les Ingrédients (`IngredientController`)
- **Recherche par nom**
- **Filtrage par catégorie** : fruits, légumes, céréales, viandes, etc.
- **Filtrage nutritionnel** :
  - Calories min/max (pour 100g)
  - Protéines min
  - Glucides max
  - Lipides max
- **Tri dynamique** : Par nom, calories, protéines, glucides, lipides, fibres

### 2. 🤖 Fonctionnalités IA

#### A. Suggestions de Repas (`AIRepasService`)

##### `getSuggestions(User $user, array $preferences)`
Génère des suggestions de repas personnalisées basées sur :
- Objectif calorique
- Objectif protéines
- Restrictions alimentaires
- Historique récent

**Exemple d'utilisation** :
```php
$preferences = [
    'objectif_calories' => 2000,
    'objectif_proteines' => 100,
    'restrictions' => ['gluten', 'lactose']
];
$suggestions = app(AIRepasService::class)->getSuggestions($user, $preferences);
```

**Route API** : `POST /repas/ai/suggestions`

##### `suggestAlternativeIngredients(Ingredient $ingredient, array $criteria)`
Suggère des ingrédients alternatifs similaires :
- Même catégorie
- Calories similaires (±50 kcal)
- Protéines similaires (±5g)

**Route API** : `GET /ingredients/{id}/alternatives`

##### `generateWeeklyMealPlan(User $user, array $preferences)`
Crée un plan de repas complet pour 7 jours.

**Route API** : `POST /repas/ai/weekly-plan`

##### `optimizeRepas(Repas $repas, array $targets)`
Optimise un repas existant pour atteindre des objectifs nutritionnels spécifiques.

**Route API** : `POST /repas/{id}/optimize`

#### B. Analyse Nutritionnelle (`AIAnalysisService`)

##### `analyzeNutritionalBalance(User $user, $periode = 7)`
Analyse l'équilibre nutritionnel sur une période donnée.
- Calcule les moyennes quotidiennes
- Identifie les tendances
- Fournit des recommandations

**Route API** : `POST /repas/ai/analyze-balance`

##### `detectDeficiencies(User $user, $periode = 14)`
Détecte les carences nutritionnelles potentielles :
- Compare aux valeurs recommandées
- Calcule le pourcentage de couverture
- Évalue la sévérité (severe, moderate, mild)
- Recommande des aliments spécifiques

**Route API** : `POST /repas/ai/detect-deficiencies`

##### `generateNutritionReport(User $user, $periode = 30)`
Génère un rapport nutritionnel complet :
- Statistiques globales
- Tendances
- Top ingrédients utilisés
- Distribution des types de repas
- Insights IA

**Route API** : `POST /repas/ai/nutrition-report`

##### `predictGoalAchievement(User $user, array $goals)`
Prédit l'atteinte des objectifs nutritionnels :
- Progression actuelle
- Statut (achieved, on_track, needs_improvement, off_track)
- Estimation du nombre de jours pour atteindre l'objectif

**Route API** : `POST /repas/ai/predict-goals`

##### `analyzeMealQuality(Repas $repas)`
Analyse la qualité d'un repas spécifique :
- Score de variété (0-100)
- Score d'équilibre (0-100)
- Score de qualité des ingrédients (0-100)
- Score global
- Évaluation IA détaillée

**Route API** : `GET /repas/{id}/analyze-quality`

## 🛠️ Configuration

### Configuration de l'API IA

Ajoutez votre clé API OpenAI dans le fichier `.env` :

```env
OPENAI_API_KEY=sk-your-api-key-here
```

**Note** : Si aucune clé n'est configurée, le système fonctionne en mode démo avec des réponses mock.

### Personnalisation des Valeurs Recommandées

Dans `AIAnalysisService::detectDeficiencies()`, vous pouvez ajuster les valeurs recommandées :

```php
$recommended = [
    'calories' => 2000,      // Ajustable selon le profil utilisateur
    'proteines' => 50,
    'glucides' => 250,
    'lipides' => 70,
    'fibres' => 25
];
```

## 📊 Exemples d'Utilisation

### 1. Recherche de Repas avec Filtres

**URL** : `GET /repas?search=poulet&type_repas=dejeuner&min_calories=400&sort=calories_total&direction=desc`

### 2. Obtenir des Suggestions IA

```javascript
fetch('/repas/ai/suggestions', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
        objectif_calories: 2000,
        objectif_proteines: 100,
        restrictions: ['lactose']
    })
})
.then(response => response.json())
.then(data => console.log(data.suggestions));
```

### 3. Analyser l'Équilibre Nutritionnel

```javascript
fetch('/repas/ai/analyze-balance', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
        periode: 7  // 7 derniers jours
    })
})
.then(response => response.json())
.then(data => console.log(data.analysis));
```

### 4. Recherche d'Ingrédients Alternatifs

```javascript
fetch('/ingredients/5/alternatives?calories_similar=true&proteines_similar=false')
    .then(response => response.json())
    .then(data => {
        console.log('Alternatives:', data.alternatives);
        console.log('AI Analysis:', data.ai_analysis);
    });
```

## 🎨 Vues Améliorées

### Repas (repas/index-enhanced.blade.php)
- Formulaire de recherche et filtres avancés
- Affichage en cartes avec toutes les informations nutritionnelles
- Panel IA intégré pour accéder aux fonctionnalités intelligentes
- Interface responsive et moderne

### Ingrédients (ingredients/index-enhanced.blade.php)
- Recherche et filtres par catégorie et valeurs nutritionnelles
- Affichage en grille avec emojis de catégories
- Bouton "Find Alternatives" sur chaque carte
- Modal pour afficher les alternatives suggérées

## 🚀 Pour Utiliser les Nouvelles Vues

Remplacez les vues existantes ou créez de nouvelles routes :

```php
// Dans routes/web.php
Route::get('/repas-enhanced', function() {
    return view('repas.index-enhanced', $data);
})->name('repas.index.enhanced');
```

Ou renommez simplement les fichiers :
```bash
mv resources/views/repas/index-enhanced.blade.php resources/views/repas/index.blade.php
mv resources/views/ingredients/index-enhanced.blade.php resources/views/ingredients/index.blade.php
```

## 📈 Scores et Métriques

### Score de Variété
- Basé sur le nombre de catégories d'ingrédients
- Maximum 100 pour 8+ catégories différentes

### Score d'Équilibre
- Basé sur la répartition des macronutriments
- Idéal : 15-25% protéines, 45-65% glucides, 20-35% lipides

### Score de Qualité
- Basé sur le pourcentage d'ingrédients "sains"
- Catégories saines : fruits, légumes, céréales, poissons, noix-graines, légumineuses

## 🔐 Sécurité

Toutes les routes sont protégées par :
- Authentification (`auth:sanctum`)
- Vérification CSRF
- Validation des entrées
- Protection contre les injections SQL (Eloquent ORM)

## 🧪 Tests

Pour tester les fonctionnalités IA sans clé API, utilisez le mode démo :
- Les services retournent des réponses mock réalistes
- Toutes les fonctionnalités sont testables
- Ajoutez votre clé API pour des résultats réels

## 📝 Notes Importantes

1. **Performance** : Les appels IA peuvent prendre 2-5 secondes. Utilisez des indicateurs de chargement.
2. **Coûts** : Les appels OpenAI sont facturés. Surveillez votre utilisation.
3. **Cache** : Envisagez de mettre en cache les réponses IA fréquentes.
4. **Limites** : L'API OpenAI a des limites de taux. Implémentez un rate limiting si nécessaire.

## 🎯 Prochaines Améliorations Possibles

- [ ] Cache Redis pour les réponses IA
- [ ] File d'attente (Queue) pour les analyses longues
- [ ] Export PDF des rapports nutritionnels
- [ ] Graphiques interactifs avec Chart.js
- [ ] Notifications push pour les recommandations
- [ ] Intégration avec des APIs nutritionnelles externes
- [ ] Support multilingue
- [ ] Application mobile (API ready)

## 🆘 Support

Pour toute question ou problème :
1. Vérifiez que la clé API est correctement configurée
2. Consultez les logs Laravel : `storage/logs/laravel.log`
3. Activez le mode debug dans `.env` : `APP_DEBUG=true`

---

**Créé le** : 11 octobre 2025
**Version** : 1.0.0
**Auteur** : GitHub Copilot
