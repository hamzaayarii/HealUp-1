<#
Automated pipeline script for recommendations (Windows PowerShell)
Steps:
 1. Export interactions from Laravel
 2. (Optional) Create/activate Python venv or conda env
 3. Train LightFM model
 4. Generate model_output.csv
 5. Copy model_output.csv into storage and import into Laravel

Usage: in PowerShell (from project root)
  .\scripts\run_recs_pipeline.ps1 [-UseConda] [-CondaEnvName "recs"] [-K 10]

Note: This script expects either Conda to be available (recommended) or a working Python venv where dependencies are installed.
#>
param(
    [switch]$UseConda = $true,
    [string]$CondaEnvName = 'recs',
    [int]$K = 10
)

Set-StrictMode -Version Latest

$projectRoot = (Get-Location).Path
Write-Host "Project root: $projectRoot"

# 1) Export interactions
Write-Host "Running Laravel export..."
php artisan recs:export
if ($LASTEXITCODE -ne 0) { Write-Error "Export failed"; exit 1 }

# 2) Activate Python environment
if ($UseConda) {
    Write-Host "Activating conda environment: $CondaEnvName"
    conda activate $CondaEnvName
    if ($LASTEXITCODE -ne 0) { Write-Error "Failed to activate conda env. Ensure conda is installed."; exit 1 }
} else {
    $venvPath = Join-Path $projectRoot '.venv'
    if (Test-Path $venvPath) {
        Write-Host "Activating venv: $venvPath"
        # PowerShell activation
        & "$venvPath\Scripts\Activate.ps1"
    } else {
        Write-Host "No venv found at $venvPath. Creating..."
        python -m venv .venv
        & ".\.venv\Scripts\Activate.ps1"
        pip install --upgrade pip
        pip install -r python_recommender\requirements.txt
    }
}

# 3) Train model
Write-Host "Training model (this may take a while)..."
python python_recommender\train.py --input storage\app\recommendations\interactions.csv --output python_recommender\model.joblib
if ($LASTEXITCODE -ne 0) { Write-Error "Training failed"; exit 1 }

# 4) Generate model output CSV
Write-Host "Generating model output CSV..."
python python_recommender\generate_model_output.py --model python_recommender\model.joblib --output python_recommender\model_output.csv --k $K
if ($LASTEXITCODE -ne 0) { Write-Error "Generating model output failed"; exit 1 }

# 5) Copy and import into Laravel
$dest = Join-Path $projectRoot 'storage\app\recommendations\model_output.csv'
Copy-Item -Path python_recommender\model_output.csv -Destination $dest -Force
Write-Host "Importing model recommendations into DB..."
php artisan recs:import --path=recommendations/model_output.csv
if ($LASTEXITCODE -ne 0) { Write-Error "Import failed"; exit 1 }

Write-Host "Pipeline completed successfully."
