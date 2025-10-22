# Test du serveur Python AI
Write-Host "🧪 Test du serveur Python AI" -ForegroundColor Cyan
Write-Host ""

$pythonUrl = "http://localhost:5000"

# Test 1: Health Check
Write-Host "Test 1: Health Check..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$pythonUrl/health" -Method Get -ErrorAction Stop
    Write-Host "✅ Health check réussi!" -ForegroundColor Green
    Write-Host "   Service: $($response.service)" -ForegroundColor Gray
    Write-Host "   Model: $($response.model)" -ForegroundColor Gray
    Write-Host ""
} catch {
    Write-Host "❌ Erreur health check: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host ""
    exit 1
}

# Test 2: Analyze Meal
Write-Host "Test 2: Analyze Meal..." -ForegroundColor Yellow
$mealData = @{
    calories = 650
    proteines = 35
    glucides = 75
    lipides = 20
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$pythonUrl/analyze/meal" -Method Post -Body $mealData -ContentType "application/json" -ErrorAction Stop
    Write-Host "✅ Analyze meal réussi!" -ForegroundColor Green
    Write-Host "   Score: $($response.data.balance_score)" -ForegroundColor Gray
    Write-Host ""
} catch {
    Write-Host "❌ Erreur analyze meal: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "   Details: $($_.ErrorDetails.Message)" -ForegroundColor Gray
    Write-Host ""
}

# Test 3: Suggest Alternatives
Write-Host "Test 3: Suggest Alternatives..." -ForegroundColor Yellow
$ingredientData = @{
    nom = "Poulet"
    categorie = "viandes"
    calories_pour_100g = 165
    proteines_pour_100g = 31
    glucides_pour_100g = 0
    lipides_pour_100g = 3.6
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$pythonUrl/suggest/alternatives" -Method Post -Body $ingredientData -ContentType "application/json" -ErrorAction Stop
    Write-Host "✅ Suggest alternatives réussi!" -ForegroundColor Green
    Write-Host "   Alternatives trouvées: $($response.data.alternatives.Count)" -ForegroundColor Gray
    Write-Host ""
} catch {
    Write-Host "❌ Erreur suggest alternatives: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "   Details: $($_.ErrorDetails.Message)" -ForegroundColor Gray
    Write-Host ""
}

Write-Host "🎉 Tests terminés!" -ForegroundColor Cyan
