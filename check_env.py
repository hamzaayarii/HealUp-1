#!/usr/bin/env python3
"""
HealUp Environment Checker
Verifies that all services are running correctly
"""

import requests
import subprocess
import sys
import os
from pathlib import Path
import json

def check_service(name, url, expected_keys=None):
    """Check if a service is running and responding"""
    try:
        response = requests.get(url, timeout=5)
        if response.status_code == 200:
            if expected_keys:
                data = response.json()
                missing_keys = [key for key in expected_keys if key not in data]
                if missing_keys:
                    print(f"❌ {name}: Missing expected keys: {missing_keys}")
                    return False
            print(f"✅ {name}: Running")
            return True
        else:
            print(f"❌ {name}: HTTP {response.status_code}")
            return False
    except requests.exceptions.RequestException as e:
        print(f"❌ {name}: Connection failed - {e}")
        return False

def check_file_exists(file_path, description):
    """Check if a required file exists"""
    if Path(file_path).exists():
        print(f"✅ {description}: Found")
        return True
    else:
        print(f"❌ {description}: Missing at {file_path}")
        return False

def check_python_packages():
    """Check if required Python packages are installed"""
    required_packages = ['flask', 'flask_cors', 'numpy', 'pandas', 'scikit_learn', 'joblib']
    missing_packages = []
    
    for package in required_packages:
        try:
            __import__(package)
        except ImportError:
            missing_packages.append(package)
    
    if missing_packages:
        print(f"❌ Python packages missing: {', '.join(missing_packages)}")
        return False
    else:
        print("✅ Python packages: All installed")
        return True

def check_laravel_env():
    """Check Laravel environment"""
    env_path = Path('.env')
    if not env_path.exists():
        print("❌ Laravel .env file: Missing")
        return False
    
    # Check for Python AI URL setting
    with open(env_path, 'r') as f:
        env_content = f.read()
        if 'PYTHON_AI_URL' in env_content:
            print("✅ Laravel .env: Python AI URL configured")
        else:
            print("⚠️  Laravel .env: PYTHON_AI_URL not set (will use default)")
    
    return True

def main():
    """Main verification function"""
    print("🔍 HealUp Environment Check")
    print("=" * 40)
    
    all_good = True
    
    # Check Laravel server
    laravel_running = check_service(
        "Laravel Server", 
        "http://localhost:8000",
    )
    all_good &= laravel_running
    
    # Check Python AI server
    python_ai_running = check_service(
        "Python AI Server", 
        "http://localhost:5000/health",
        expected_keys=['status', 'service', 'model']
    )
    all_good &= python_ai_running
    
    # Check Vite dev server
    vite_running = check_service(
        "Vite Dev Server", 
        "http://localhost:5173",
    )
    # Vite is optional for basic functionality
    if not vite_running:
        print("ℹ️  Vite dev server not running (assets may not hot-reload)")
    
    print("\n" + "-" * 40)
    
    # Check required files
    files_ok = True
    files_ok &= check_file_exists("python_ai/app.py", "Python AI Server")
    files_ok &= check_file_exists("python_ai/advice_model.pkl", "ML Model")
    files_ok &= check_file_exists("python_ai/events.json", "Events Data")
    files_ok &= check_file_exists("python_ai/event_recommender.py", "Event Recommender")
    
    all_good &= files_ok
    
    print("\n" + "-" * 40)
    
    # Check Python packages
    packages_ok = check_python_packages()
    all_good &= packages_ok
    
    print("\n" + "-" * 40)
    
    # Check Laravel environment
    env_ok = check_laravel_env()
    all_good &= env_ok
    
    print("\n" + "=" * 40)
    
    if all_good:
        print("🎉 All systems are working correctly!")
        print("\n📋 Your HealUp application is ready to use:")
        print("🌐 Frontend: http://localhost:8000")
        print("🤖 AI Server: http://localhost:5000")
        if vite_running:
            print("⚡ Assets: http://localhost:5173")
    else:
        print("⚠️  Some issues were found. Please check the output above.")
        print("\n🔧 Quick fixes:")
        if not python_ai_running:
            print("- Start Python AI: cd python_ai && python app.py")
        if not laravel_running:
            print("- Start Laravel: php artisan serve")
        if not packages_ok:
            print("- Install packages: cd python_ai && python setup.py")
        if not files_ok:
            print("- Run setup: cd python_ai && python setup.py")
            print("- Sync events: php artisan export:events")
    
    return all_good

if __name__ == "__main__":
    success = main()
    sys.exit(0 if success else 1)