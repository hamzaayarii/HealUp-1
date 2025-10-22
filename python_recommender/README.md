This folder contains a minimal prototype to train a LightFM model on exported interactions.

Steps:
1. Export interactions from Laravel:
   php artisan recs:export
   This writes `storage/app/recommendations/interactions.csv`.

2. Create a Python virtualenv and install requirements:
   python -m venv .venv
   .\.venv\Scripts\activate
   pip install -r requirements.txt

3. Train:
   python train.py --input ..\storage\app\recommendations\interactions.csv --output model.joblib

The script saves `model.joblib` containing the LightFM model and id mappings.

Notes:
- This is a minimal prototype. You should add train/test splitting, evaluation (precision@K), hyperparameter search, and persistence strategy for production.

4. Generate model output CSV (top-N per user)
   python generate_model_output.py --model model.joblib --output model_output.csv --k 10

5. Import into Laravel (default path storage/app/recommendations/model_output.csv):
   php artisan recs:import --path=recommendations/model_output.csv

After import, the application will serve these model recommendations for students (fallback to heuristic when no model rows exist).
