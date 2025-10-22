# Recommendations feature — summary & next moves

Date: 2025-10-22

This file summarizes what we implemented for the challenge recommender, how to run the end-to-end pipeline locally, and recommended next steps.

## What we implemented

- Lightweight heuristic recommender (fallback)
  - File: `app/Services/ChallengeRecommender.php`
  - Heuristic signals: user category affinity, popularity (participations_count), reward, active timeframe. Excludes challenges the user already participates in.

- Student access and UI
  - Student-facing route: `/challenges` (registered in `routes/web.php`).
  - Student sees 'Challenges' nav link (updated `resources/views/navigation-menu.blade.php`).
  - Recommender output is shown in `resources/views/professor/challenges/index.blade.php` — "Recommended for you" section.

- Instrumentation (impressions & clicks)
  - Migration: `database/migrations/2025_10_22_000000_create_recommendation_events_table.php`
  - Model: `app/Models/RecommendationEvent.php`
  - Controller endpoint: `app/Http/Controllers/RecommendationEventController.php` (POST `/recommendations/event`)
  - Client JS in `professor/challenges/index.blade.php` posts impressions and clicks using the endpoint.

- Export & training prototype
  - Artisan export command: `app/Console/Commands/ExportInteractions.php` (`php artisan recs:export`) -> writes `storage/app/recommendations/interactions.csv`.
  - Python prototype folder: `python_recommender/`
    - `requirements.txt` (LightFM, pandas, scipy, numpy, joblib)
    - `train.py` (train LightFM on interactions -> `model.joblib`)
    - `generate_model_output.py` (map model output -> `model_output.csv`)
    - `README.md` with usage steps

- Precompute serving (import pipeline)
  - Migration: `database/migrations/2025_10_22_000001_create_user_recommendations_table.php`
  - Model: `app/Models/UserRecommendation.php`
  - Import command: `app/Console/Commands/ImportRecommendations.php` (`php artisan recs:import`) — imports `model_output.csv` into `user_recommendations` table.
  - Controller wiring: `app/Http/Controllers/Professor/ChallengeController.php` prefers `user_recommendations` (model output) for students and falls back to heuristic if none exist.

- Automation script
  - PowerShell pipeline wrapper: `scripts/run_recs_pipeline.ps1` automates export -> train -> generate -> import (supports conda or venv flows).

## How it works (high level)

1. App records impressions and clicks via `/recommendations/event` when the "Recommended for you" block is shown and when a recommended card is clicked.
2. Periodically (manual or scheduled), run `php artisan recs:export` to export interactions (participations + click events) to CSV for training.
3. Train a LightFM model (or another implicit-feedback model) using the exported CSV. The prototype `python_recommender/train.py` shows a minimal example.
4. Produce a `model_output.csv` (columns: `user_id,challenge_id,score`) using `generate_model_output.py`.
5. Import `model_output.csv` into the DB with `php artisan recs:import` which populates `user_recommendations`.
6. When a student visits `/challenges`, controller loads top recommendations from `user_recommendations` and shows them. If none exist, the heuristic recommender runs.

## Quick-run commands (PowerShell)

1) Export interactions (already created earlier):
```powershell
php artisan recs:export
```

2) Train & generate (recommended: use Conda on Windows):
```powershell
# create/activate conda env (one-time)
conda create -n recs python=3.10 -y
conda activate recs
conda install -c conda-forge lightfm pandas scipy numpy joblib -y

# train
python python_recommender\train.py --input storage\app\recommendations\interactions.csv --output python_recommender\model.joblib

# generate model output CSV
python python_recommender\generate_model_output.py --model python_recommender\model.joblib --output python_recommender\model_output.csv --k 10
```

3) Import into Laravel:
```powershell
# copy to storage and import (or pass --path)
Copy-Item .\python_recommender\model_output.csv .\storage\app\recommendations\model_output.csv
php artisan recs:import --path=recommendations/model_output.csv
```

4) Optionally run the full pipeline via the PowerShell wrapper:
```powershell
.\scripts\run_recs_pipeline.ps1 -UseConda -CondaEnvName 'recs' -K 10
```

## Verification steps

- After import, check DB:
```powershell
php artisan tinker
>>> DB::table('user_recommendations')->where('user_id', 3)->take(10)->get();
```
- Visit `/challenges` as a student — recommended block should show model rows.
- Inspect `storage/app/recommendations/interactions.csv` and `python_recommender/model_output.csv` to verify contents.

## Next moves (recommended priority)

1. Instrumentation hardening (short, high priority)
   - Ensure impression events are recorded even when the recommended block is paginated or lazily loaded.
   - Add server-side logging for RecommendationEventController to spot invalid payloads.

2. Evaluation & training hardening (short-medium)
   - Add train/test split and compute precision@K / recall@K in `train.py`.
   - Add hyperparameter tuning (no_components, loss, epochs).

3. Monitoring & scheduling (medium)
   - Add an automated retraining schedule (nightly) and version model artifacts.
   - Add basic monitoring for import errors and model coverage (percent of active users with recommendations).

4. Production serving improvements (medium)
   - Add an admin UI to preview and QA imported recommendations.
   - Consider a lightweight inference API (FastAPI) for fresher recommendations or side-info scoring.

5. Long term / advanced (low-medium)
   - Add side-information (user features, challenge features) and move to hybrid models.
   - Track online metrics (CTR, join-rate) and run A/B tests vs. heuristic baseline.

## Risks & notes

- Windows environment: installing `lightfm` via pip may require build tools; Conda strongly recommended on Windows.
- Data quality: ensure `participations` and `recommendation_events` are populated with representative interactions before trusting the model.
- Privacy: recommendation events contain user IDs — store and handle according to privacy policy.

## Contact / where files live

- Laravel code: `app/Services/ChallengeRecommender.php`, `app/Models/RecommendationEvent.php`, `app/Models/UserRecommendation.php`, `app/Http/Controllers/RecommendationEventController.php`, `app/Console/Commands/*`
- Views: `resources/views/professor/challenges/index.blade.php`, `resources/views/navigation-menu.blade.php`
- Python prototype: `python_recommender/`
- Pipeline script: `scripts/run_recs_pipeline.ps1`

---

If you want, I can now:
- Add train/eval code to `train.py` (precision@K) and a small report generator, or
- Add an automated Conda env creation step to `run_recs_pipeline.ps1`, or
- Create a small admin page to preview imported recommendations.

Tell me which next action you prefer and I'll implement it.
