
import json
import sys
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np

# Load events from a local JSON file (simulate DB)
import os
def load_events():
    base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
    events_path = os.path.join(base_dir, 'python_ai', 'events.json')
    with open(events_path, 'r', encoding='utf-8') as f:
        return json.load(f)

def recommend_events(user_interest, top_n=5):
    events = load_events()
    descriptions = [e['description'] for e in events]
    titles = [e['title'] for e in events]
    # Add user interest to the list for vectorization
    corpus = descriptions + [user_interest]
    vectorizer = TfidfVectorizer()
    tfidf_matrix = vectorizer.fit_transform(corpus)
    # Compute similarity between user interest and all events
    user_vec = tfidf_matrix[-1]
    event_vecs = tfidf_matrix[:-1]
    similarities = cosine_similarity(user_vec, event_vecs).flatten()
    # Get top N event indices
    top_indices = np.argsort(similarities)[-top_n:][::-1]
    recommended = [events[i] for i in top_indices]
    return recommended

if __name__ == "__main__":
    user_interest = sys.argv[1] if len(sys.argv) > 1 else ""
    recommended = recommend_events(user_interest)
    print("Recommended events:")
    for event in recommended:
        print(f"- {event['title']} ({event['date']}): {event['description']}")
