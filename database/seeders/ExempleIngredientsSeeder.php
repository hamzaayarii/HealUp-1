<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class ExempleIngredientsSeeder extends Seeder
{
    /**
     * Seed de la base de données avec des exemples d'ingrédients
     * Pour tester la fonctionnalité "Alternatives"
     */
    public function run()
    {
        // Nettoyer les anciennes données (optionnel)
        // Ingredient::truncate();

        $ingredients = [
            // ========================================
            // LÉGUMES (catégorie: legumes)
            // ========================================
            [
                'nom' => 'Tomate',
                'categorie' => 'legumes',
                'calories_pour_100g' => 18,
                'proteines_pour_100g' => 0.9,
                'glucides_pour_100g' => 3.9,
                'lipides_pour_100g' => 0.2,
                'fibres_pour_100g' => 1.2
            ],
            [
                'nom' => 'Poivron rouge',
                'categorie' => 'legumes',
                'calories_pour_100g' => 20,
                'proteines_pour_100g' => 1.0,
                'glucides_pour_100g' => 4.6,
                'lipides_pour_100g' => 0.3,
                'fibres_pour_100g' => 1.7
            ],
            [
                'nom' => 'Courgette',
                'categorie' => 'legumes',
                'calories_pour_100g' => 17,
                'proteines_pour_100g' => 1.2,
                'glucides_pour_100g' => 3.1,
                'lipides_pour_100g' => 0.3,
                'fibres_pour_100g' => 1.0
            ],
            [
                'nom' => 'Concombre',
                'categorie' => 'legumes',
                'calories_pour_100g' => 15,
                'proteines_pour_100g' => 0.7,
                'glucides_pour_100g' => 3.6,
                'lipides_pour_100g' => 0.1,
                'fibres_pour_100g' => 0.5
            ],
            [
                'nom' => 'Carotte',
                'categorie' => 'legumes',
                'calories_pour_100g' => 41,
                'proteines_pour_100g' => 0.9,
                'glucides_pour_100g' => 9.6,
                'lipides_pour_100g' => 0.2,
                'fibres_pour_100g' => 2.8
            ],

            // ========================================
            // CÉRÉALES (catégorie: cereales)
            // ========================================
            [
                'nom' => 'Riz blanc',
                'categorie' => 'cereales',
                'calories_pour_100g' => 130,
                'proteines_pour_100g' => 2.7,
                'glucides_pour_100g' => 28.0,
                'lipides_pour_100g' => 0.3,
                'fibres_pour_100g' => 0.4
            ],
            [
                'nom' => 'Riz complet',
                'categorie' => 'cereales',
                'calories_pour_100g' => 123,
                'proteines_pour_100g' => 2.6,
                'glucides_pour_100g' => 25.6,
                'lipides_pour_100g' => 1.0,
                'fibres_pour_100g' => 1.8
            ],
            [
                'nom' => 'Quinoa',
                'categorie' => 'cereales',
                'calories_pour_100g' => 120,
                'proteines_pour_100g' => 4.4,
                'glucides_pour_100g' => 21.3,
                'lipides_pour_100g' => 1.9,
                'fibres_pour_100g' => 2.8
            ],
            [
                'nom' => 'Pâtes complètes',
                'categorie' => 'cereales',
                'calories_pour_100g' => 124,
                'proteines_pour_100g' => 5.0,
                'glucides_pour_100g' => 25.0,
                'lipides_pour_100g' => 1.0,
                'fibres_pour_100g' => 3.0
            ],
            [
                'nom' => 'Boulgour',
                'categorie' => 'cereales',
                'calories_pour_100g' => 115,
                'proteines_pour_100g' => 3.5,
                'glucides_pour_100g' => 23.0,
                'lipides_pour_100g' => 0.5,
                'fibres_pour_100g' => 4.5
            ],

            // ========================================
            // PROTÉINES (catégorie: proteines)
            // ========================================
            [
                'nom' => 'Poulet grillé',
                'categorie' => 'proteines',
                'calories_pour_100g' => 165,
                'proteines_pour_100g' => 31.0,
                'glucides_pour_100g' => 0.0,
                'lipides_pour_100g' => 3.6,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Dinde',
                'categorie' => 'proteines',
                'calories_pour_100g' => 160,
                'proteines_pour_100g' => 29.0,
                'glucides_pour_100g' => 0.0,
                'lipides_pour_100g' => 4.0,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Tofu',
                'categorie' => 'proteines',
                'calories_pour_100g' => 76,
                'proteines_pour_100g' => 8.0,
                'glucides_pour_100g' => 1.9,
                'lipides_pour_100g' => 4.8,
                'fibres_pour_100g' => 0.3
            ],
            [
                'nom' => 'Saumon',
                'categorie' => 'proteines',
                'calories_pour_100g' => 206,
                'proteines_pour_100g' => 22.0,
                'glucides_pour_100g' => 0.0,
                'lipides_pour_100g' => 13.0,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Œufs',
                'categorie' => 'proteines',
                'calories_pour_100g' => 155,
                'proteines_pour_100g' => 13.0,
                'glucides_pour_100g' => 1.1,
                'lipides_pour_100g' => 11.0,
                'fibres_pour_100g' => 0.0
            ],

            // ========================================
            // FRUITS (catégorie: fruits)
            // ========================================
            [
                'nom' => 'Pomme',
                'categorie' => 'fruits',
                'calories_pour_100g' => 52,
                'proteines_pour_100g' => 0.3,
                'glucides_pour_100g' => 13.8,
                'lipides_pour_100g' => 0.2,
                'fibres_pour_100g' => 2.4
            ],
            [
                'nom' => 'Poire',
                'categorie' => 'fruits',
                'calories_pour_100g' => 57,
                'proteines_pour_100g' => 0.4,
                'glucides_pour_100g' => 15.2,
                'lipides_pour_100g' => 0.1,
                'fibres_pour_100g' => 3.1
            ],
            [
                'nom' => 'Banane',
                'categorie' => 'fruits',
                'calories_pour_100g' => 89,
                'proteines_pour_100g' => 1.1,
                'glucides_pour_100g' => 22.8,
                'lipides_pour_100g' => 0.3,
                'fibres_pour_100g' => 2.6
            ],
            [
                'nom' => 'Orange',
                'categorie' => 'fruits',
                'calories_pour_100g' => 47,
                'proteines_pour_100g' => 0.9,
                'glucides_pour_100g' => 11.8,
                'lipides_pour_100g' => 0.1,
                'fibres_pour_100g' => 2.4
            ],
            [
                'nom' => 'Fraises',
                'categorie' => 'fruits',
                'calories_pour_100g' => 32,
                'proteines_pour_100g' => 0.7,
                'glucides_pour_100g' => 7.7,
                'lipides_pour_100g' => 0.3,
                'fibres_pour_100g' => 2.0
            ],

            // ========================================
            // PRODUITS LAITIERS (catégorie: laitiers)
            // ========================================
            [
                'nom' => 'Yaourt nature',
                'categorie' => 'laitiers',
                'calories_pour_100g' => 59,
                'proteines_pour_100g' => 3.5,
                'glucides_pour_100g' => 4.7,
                'lipides_pour_100g' => 3.3,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Yaourt grec',
                'categorie' => 'laitiers',
                'calories_pour_100g' => 97,
                'proteines_pour_100g' => 9.0,
                'glucides_pour_100g' => 3.6,
                'lipides_pour_100g' => 5.0,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Fromage blanc 0%',
                'categorie' => 'laitiers',
                'calories_pour_100g' => 44,
                'proteines_pour_100g' => 7.5,
                'glucides_pour_100g' => 4.0,
                'lipides_pour_100g' => 0.2,
                'fibres_pour_100g' => 0.0
            ],
            [
                'nom' => 'Lait écrémé',
                'categorie' => 'laitiers',
                'calories_pour_100g' => 34,
                'proteines_pour_100g' => 3.4,
                'glucides_pour_100g' => 5.0,
                'lipides_pour_100g' => 0.1,
                'fibres_pour_100g' => 0.0
            ],

            // ========================================
            // LÉGUMINEUSES (catégorie: legumineuses)
            // ========================================
            [
                'nom' => 'Lentilles vertes',
                'categorie' => 'legumineuses',
                'calories_pour_100g' => 116,
                'proteines_pour_100g' => 9.0,
                'glucides_pour_100g' => 20.0,
                'lipides_pour_100g' => 0.4,
                'fibres_pour_100g' => 7.9
            ],
            [
                'nom' => 'Pois chiches',
                'categorie' => 'legumineuses',
                'calories_pour_100g' => 164,
                'proteines_pour_100g' => 8.9,
                'glucides_pour_100g' => 27.4,
                'lipides_pour_100g' => 2.6,
                'fibres_pour_100g' => 7.6
            ],
            [
                'nom' => 'Haricots rouges',
                'categorie' => 'legumineuses',
                'calories_pour_100g' => 127,
                'proteines_pour_100g' => 8.7,
                'glucides_pour_100g' => 22.8,
                'lipides_pour_100g' => 0.5,
                'fibres_pour_100g' => 6.4
            ],
            [
                'nom' => 'Haricots blancs',
                'categorie' => 'legumineuses',
                'calories_pour_100g' => 139,
                'proteines_pour_100g' => 9.7,
                'glucides_pour_100g' => 25.0,
                'lipides_pour_100g' => 0.5,
                'fibres_pour_100g' => 6.3
            ],
        ];

        // Insérer les ingrédients
        foreach ($ingredients as $ingredient) {
            Ingredient::updateOrCreate(
                ['nom' => $ingredient['nom']],
                $ingredient
            );
        }

        $this->command->info('✅ ' . count($ingredients) . ' ingrédients exemples créés avec succès!');
        $this->command->info('');
        $this->command->info('📊 Résumé par catégorie:');
        $this->command->info('   - Légumes: 5 ingrédients (tomate, poivron, courgette, concombre, carotte)');
        $this->command->info('   - Céréales: 5 ingrédients (riz blanc, riz complet, quinoa, pâtes, boulgour)');
        $this->command->info('   - Protéines: 5 ingrédients (poulet, dinde, tofu, saumon, œufs)');
        $this->command->info('   - Fruits: 5 ingrédients (pomme, poire, banane, orange, fraises)');
        $this->command->info('   - Laitiers: 4 ingrédients (yaourt nature, yaourt grec, fromage blanc, lait)');
        $this->command->info('   - Légumineuses: 4 ingrédients (lentilles, pois chiches, haricots rouges/blancs)');
        $this->command->info('');
        $this->command->info('🧪 Pour tester les alternatives:');
        $this->command->info('   1. Allez sur http://localhost:8000/ingredients');
        $this->command->info('   2. Cliquez "Get Alternatives" sur:');
        $this->command->info('      - Tomate → verra courgette, concombre, poivron (légumes similaires)');
        $this->command->info('      - Riz blanc → verra riz complet, quinoa, pâtes (céréales similaires)');
        $this->command->info('      - Poulet → verra dinde, tofu (protéines similaires)');
        $this->command->info('      - Pomme → verra poire, orange, fraises (fruits similaires)');
    }
}
