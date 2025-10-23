#!/usr/bin/env python3
"""
Setup script for HealUp Python AI Server
This script handles the initial setup of dependencies and ML models
"""

import subprocess
import sys
import os
import json
from pathlib import Path

def install_dependencies():
    """Install required Python packages"""
    print("🔧 Installing Python dependencies...")
    
    required_packages = [
        'flask',
        'flask-cors', 
        'numpy',
        'pandas',
        'scikit-learn',
        'joblib'
    ]
    
    try:
        for package in required_packages:
            print(f"Installing {package}...")
            subprocess.check_call([sys.executable, '-m', 'pip', 'install', package])
        print("✅ All dependencies installed successfully!")
        return True
    except subprocess.CalledProcessError as e:
        print(f"❌ Error installing dependencies: {e}")
        return False

def create_ml_model():
    """Create the advice prediction model"""
    print("🤖 Creating machine learning model...")
    
    try:
        import joblib
        import numpy as np
        from sklearn.ensemble import RandomForestClassifier
        
        # Create sample training data
        X = np.random.rand(100, 8)  # 8 features (age, weight, height, calories, etc.)
        y = np.random.choice(['Sleep', 'Nutrition', 'Activity'], 100)
        
        # Train model
        clf = RandomForestClassifier(n_estimators=10, random_state=42)
        clf.fit(X, y)
        
        # Save model
        model_path = Path(__file__).parent / 'advice_model.pkl'
        joblib.dump(clf, model_path)
        
        print(f"✅ ML model created at: {model_path}")
        return True
        
    except Exception as e:
        print(f"❌ Error creating ML model: {e}")
        return False

def check_events_json():
    """Check if events.json exists"""
    events_path = Path(__file__).parent / 'events.json'
    
    if not events_path.exists():
        print("⚠️  events.json not found. Creating sample file...")
        
        sample_events = [
            {
                "id": 1,
                "title": "Sample Event",
                "date": "2025-11-01",
                "location": "Online",
                "description": "Sample event for testing recommendations",
                "max_participants": 50,
                "current_participants": 0,
                "is_active": 1,
                "category_id": 1
            }
        ]
        
        with open(events_path, 'w', encoding='utf-8') as f:
            json.dump(sample_events, f, indent=2)
            
        print(f"✅ Sample events.json created at: {events_path}")
        print("💡 Run 'php artisan export:events' to sync with database")
    else:
        print("✅ events.json already exists")

def main():
    """Main setup function"""
    print("🚀 Starting HealUp Python AI Server Setup...")
    print("=" * 50)
    
    success = True
    
    # Step 1: Install dependencies
    if not install_dependencies():
        success = False
    
    print("\n" + "-" * 30 + "\n")
    
    # Step 2: Create ML model
    if not create_ml_model():
        success = False
    
    print("\n" + "-" * 30 + "\n")
    
    # Step 3: Check events.json
    check_events_json()
    
    print("\n" + "=" * 50)
    
    if success:
        print("🎉 Setup completed successfully!")
        print("\n📋 Next steps:")
        print("1. Run 'php artisan export:events' to sync events with database")
        print("2. Start the AI server with 'python app.py'")
        print("3. Test with 'curl http://localhost:5000/health'")
    else:
        print("❌ Setup completed with errors. Please check the output above.")
        
    return success

if __name__ == "__main__":
    main()