# 🧠 HealUp Python AI - Modèle Local de Nutrition

## 📖 Description

Serveur d'intelligence artificielle **local** basé sur Python pour l'analyse nutritionnelle de HealUp. Ce serveur remplace l'API OpenAI externe par un système de règles expertes local, éliminant le besoin de clés API tierces.

## ✨ Fonctionnalités

### 🔬 Analyse Nutritionnelle
- **Analyse de repas** : Évalue l'équilibre nutritionnel d'un repas individuel
- **Score d'équilibre** : Calcule un score de 0-100 basé sur les macronutriments
- **Recommandations** : Suggestions personnalisées pour améliorer l'équilibre

### 🔄 Alternatives Intelligentes
- **Substitutions** : Suggère des alternatives pour chaque ingrédient
- **Critères nutritionnels** : Basé sur la catégorie et les valeurs nutritionnelles
- **Base de connaissances** : Recommandations expertes par catégorie d'aliments

### 📊 Analyse Hebdomadaire
- **Tendances** : Analyse des habitudes alimentaires sur 7 jours
- **Moyennes** : Calcul des apports moyens en calories et macronutriments
- **Alertes** : Détection des apports insuffisants ou excessifs

### 📅 Plan de Repas
- **Génération automatique** : Plan de repas pour 7 jours
- **Objectifs caloriques** : Adapté aux besoins individuels
- **Variété** : Templates de repas équilibrés et variés

### ⚠️ Détection de Carences
- **Analyse nutritionnelle** : Compare aux valeurs recommandées
- **Sévérité** : Évaluation du niveau de carence (modérée/élevée)
- **Recommandations ciblées** : Conseils spécifiques par nutriment

### ⚡ Optimisation de Repas
- **Ajustements personnalisés** : Suggestions pour atteindre les objectifs
- **Critères flexibles** : Réduire calories, augmenter protéines, équilibrer macros

---

## 🚀 Installation

### Prérequis
- **Python 3.8+** installé
- **pip** (gestionnaire de paquets Python)

### Étapes

1. **Naviguer dans le dossier**
```powershell
cd c:\Users\oussama\Desktop\healup\python_ai
```

2. **Créer un environnement virtuel** (recommandé)
```powershell
python -m venv venv
.\venv\Scripts\Activate.ps1
```

3. **Installer les dépendances**
```powershell
pip install -r requirements.txt
```

---

## ▶️ Démarrage

### Lancer le serveur
```powershell
python app.py
```

Le serveur démarre sur **http://localhost:5000**

### Vérifier l'état
Ouvrir dans le navigateur ou avec curl :
```
http://localhost:5000/health
```

Réponse attendue :
```json
{
  "status": "ok",
  "service": "HealUp Nutrition AI",
  "model": "Rule-Based Expert System",
  "version": "1.0.0"
}
```

---

## 🔌 Endpoints API

### 1️⃣ Health Check
**GET** `/health`

Vérification de l'état du serveur.

**Réponse** :
```json
{
  "status": "ok",
  "service": "HealUp Nutrition AI",
  "model": "Rule-Based Expert System",
  "version": "1.0.0"
}
```

---

### 2️⃣ Analyse de Repas
**POST** `/analyze/meal`

Analyse un repas individuel et retourne des recommandations.

**Body** :
```json
{
  "calories": 650,
  "proteines": 35,
  "glucides": 70,
  "lipides": 20
}
```

**Réponse** :
```json
{
  "success": true,
  "data": {
    "equilibre_score": 85.5,
    "recommendations": [
      "Ajoutez des glucides complexes (riz complet, quinoa)"
    ],
    "warnings": [],
    "strengths": [
      "Bon apport en protéines",
      "Apport calorique équilibré"
    ]
  }
}
```

---

### 3️⃣ Alternatives d'Ingrédients
**POST** `/suggest/alternatives`

Suggère des alternatives pour un ingrédient.

**Body** :
```json
{
  "nom": "Poulet",
  "categorie": "Proteines",
  "calories_pour_100g": 165,
  "proteines_pour_100g": 31
}
```

**Réponse** :
```json
{
  "success": true,
  "alternatives": [
    {
      "nom": "Poulet",
      "raison": "Protéines maigres de qualité"
    },
    {
      "nom": "Saumon",
      "raison": "Oméga-3 et protéines"
    },
    {
      "nom": "Lentilles",
      "raison": "Protéines végétales et fibres"
    }
  ]
}
```

---

### 4️⃣ Analyse Hebdomadaire
**POST** `/analyze/weekly`

Analyse les habitudes alimentaires sur une période.

**Body** :
```json
{
  "meals": [
    {
      "calories": 500,
      "proteines": 25,
      "glucides": 60,
      "lipides": 15,
      "date": "2025-10-10"
    },
    {
      "calories": 700,
      "proteines": 35,
      "glucides": 80,
      "lipides": 20,
      "date": "2025-10-11"
    }
  ]
}
```

**Réponse** :
```json
{
  "success": true,
  "data": {
    "moyennes": {
      "calories": 600.0,
      "proteines": 30.0,
      "glucides": 70.0,
      "lipides": 17.5
    },
    "tendances": [
      "Apport calorique dans la normale"
    ],
    "recommendations": [
      "Variez vos sources de protéines (animales et végétales)",
      "Consommez au moins 5 portions de fruits et légumes par jour"
    ]
  }
}
```

---

### 5️⃣ Génération de Plan de Repas
**POST** `/generate/meal-plan`

Génère un plan de repas pour la semaine.

**Body** :
```json
{
  "objectif_calories": 2000,
  "nombre_repas": 7
}
```

**Réponse** :
```json
{
  "success": true,
  "data": {
    "plan_hebdomadaire": [
      {
        "nom": "Petit-déjeuner équilibré",
        "description": "Flocons d'avoine, fruits, yaourt grec",
        "calories": 600.0,
        "type": "petit_dejeuner",
        "jour": "Jour 1"
      }
    ],
    "objectif_calories": 2000,
    "conseils": [
      "Adaptez les portions selon votre faim",
      "Hydratez-vous tout au long de la journée"
    ]
  }
}
```

---

### 6️⃣ Détection de Carences
**POST** `/detect/deficiencies`

Détecte les carences nutritionnelles.

**Body** :
```json
{
  "nutrition_stats": {
    "calories": 1500,
    "proteines": 40,
    "glucides": 180,
    "lipides": 50,
    "fibres": 15
  },
  "period_days": 7
}
```

**Réponse** :
```json
{
  "success": true,
  "data": {
    "carences_detectees": [
      {
        "nutriment": "fibres",
        "valeur_actuelle": 15.0,
        "valeur_recommandee": 30,
        "severite": "modérée"
      }
    ],
    "recommendations": [
      "Consommez plus de fruits, légumes et céréales complètes"
    ],
    "periode_analyse": "7 jours"
  }
}
```

---

### 7️⃣ Optimisation de Repas
**POST** `/optimize/meal`

Optimise un repas selon des critères.

**Body** :
```json
{
  "meal": {
    "calories": 800,
    "proteines": 25,
    "glucides": 100,
    "lipides": 30
  },
  "criteria": {
    "reduce_calories": true,
    "increase_protein": false,
    "balance_macros": true
  }
}
```

**Réponse** :
```json
{
  "success": true,
  "data": {
    "current_analysis": {
      "equilibre_score": 78.2,
      "recommendations": [...],
      "warnings": [...]
    },
    "optimizations": [
      {
        "type": "calories",
        "suggestion": "Réduisez les portions de 20% ou remplacez par des alternatives moins caloriques"
      },
      {
        "type": "equilibre",
        "suggestion": "Ajustez les proportions: 50% glucides, 30% lipides, 20% protéines"
      }
    ]
  }
}
```

---

## 🧪 Tests

### Test avec curl (PowerShell)
```powershell
# Health Check
curl http://localhost:5000/health

# Analyse de repas
$body = @{
    calories = 650
    proteines = 35
    glucides = 70
    lipides = 20
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:5000/analyze/meal" -Method Post -Body $body -ContentType "application/json"
```

### Test avec le navigateur
Ouvrir **http://localhost:5000/health** dans Chrome/Edge

---

## 🏗️ Architecture

### Modèle Rule-Based (Basé sur des Règles)

Le système utilise des **règles expertes** en nutrition :

1. **Ratios macronutriments idéaux** :
   - Protéines : 20% des calories
   - Glucides : 50% des calories
   - Lipides : 30% des calories

2. **Valeurs nutritionnelles recommandées** :
   - Calories : 1800-2500 kcal/jour
   - Protéines : 46-150g/jour
   - Glucides : 130-300g/jour
   - Lipides : 44-100g/jour
   - Fibres : 25-35g/jour

3. **Base de connaissances alimentaires** :
   - Fruits : Vitamines, fibres, antioxydants
   - Légumes : Minéraux, fibres, faible en calories
   - Protéines : Construction musculaire
   - Céréales : Énergie durable
   - Produits laitiers : Calcium, protéines

### Avantages du Modèle Local

✅ **Pas de clé API** : Aucune dépendance externe  
✅ **Gratuit** : Aucun coût d'utilisation  
✅ **Rapide** : Réponses instantanées (pas de latence réseau)  
✅ **Privé** : Les données restent sur votre serveur  
✅ **Personnalisable** : Ajustez les règles selon vos besoins  
✅ **Fiable** : Pas de quotas ou limites de requêtes  

---

## 🔧 Configuration Laravel

### 1. Mettre à jour `.env`
```env
PYTHON_AI_URL=http://localhost:5000
```

### 2. Les services PHP sont déjà configurés
- `AIRepasService.php` : Utilise `callPythonAI()`
- `AIAnalysisService.php` : Utilise `callPythonAI()`

### 3. Démarrer les deux serveurs

**Terminal 1 - Serveur Python** :
```powershell
cd python_ai
python app.py
```

**Terminal 2 - Serveur Laravel** :
```powershell
php artisan serve
```

---

## 📝 Logs

Les logs sont affichés dans la console lors de l'exécution :

```
INFO:__main__:Starting HealUp Nutrition AI Server...
INFO:__main__:Model: Rule-Based Expert System
INFO:__main__:Port: 5000
INFO:werkzeug: * Running on http://0.0.0.0:5000
INFO:__main__:Analyzing meal: {'calories': 650, 'proteines': 35, ...}
```

---

## 🛠️ Personnalisation

### Modifier les valeurs recommandées

Éditez `app.py`, section `NutritionAnalyzer.__init__()` :

```python
self.recommended_daily = {
    'calories': {'min': 1800, 'max': 2500, 'optimal': 2000},
    'proteines': {'min': 46, 'max': 150, 'optimal': 75},
    # Ajustez selon vos besoins...
}
```

### Ajouter des alternatives

Éditez `app.py`, section `suggest_alternatives()` :

```python
alternatives_db = {
    'fruits': [
        {'nom': 'Mangue', 'raison': 'Riche en vitamine C'},
        # Ajoutez vos alternatives...
    ]
}
```

---

## 🚨 Dépannage

### Problème : Port 5000 déjà utilisé
**Solution** : Changez le port dans `app.py` :
```python
app.run(host='0.0.0.0', port=5001, debug=True)
```
Et dans Laravel `.env` :
```env
PYTHON_AI_URL=http://localhost:5001
```

### Problème : Module Flask introuvable
**Solution** : Installez les dépendances :
```powershell
pip install -r requirements.txt
```

### Problème : Erreur "Python AI Exception" dans Laravel
**Vérifiez** :
1. Le serveur Python est démarré : `python app.py`
2. L'URL est correcte dans `.env` : `PYTHON_AI_URL=http://localhost:5000`
3. Testez manuellement : `curl http://localhost:5000/health`

---

## 📚 Documentation Complémentaire

- **API REST** : Tous les endpoints sont documentés ci-dessus
- **Modèle nutritionnel** : Basé sur les recommandations de l'OMS et de l'ANSES
- **Extensibilité** : Ajoutez facilement de nouveaux endpoints dans `app.py`

---

## 🎓 Pour l'Encadrant

### Pourquoi un modèle local ?

1. **Conformité académique** : Développement d'algorithmes propres
2. **Autonomie** : Pas de dépendance à des services tiers payants
3. **Apprentissage** : Compréhension approfondie des règles nutritionnelles
4. **Transparence** : Chaque décision est traçable et explicable
5. **Performance** : Réponses instantanées sans latence réseau

### Technologies utilisées

- **Flask** : Framework web Python léger
- **Rule-Based AI** : Système expert basé sur des règles nutritionnelles
- **NumPy/Pandas** : Calculs statistiques (si nécessaire plus tard)
- **Algorithmes personnalisés** : Scores d'équilibre, détection de carences

### Évolutions possibles

- Intégration de **ML** : Apprentissage à partir de l'historique utilisateur
- **NLP** : Analyse de recettes en langage naturel
- **Recommandations personnalisées** : Adaptation au profil utilisateur
- **API GraphQL** : Alternative REST pour plus de flexibilité

---

## 📄 Licence

Projet académique HealUp - 2025

---

**Développé avec ❤️ pour HealUp**  
*Intelligence Artificielle Locale et Transparente*
