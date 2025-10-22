"""
Minimal LightFM training script.
Usage:
  python train.py --input ../storage/app/recommendations/interactions.csv --output model.joblib
"""
import argparse
import pandas as pd
from scipy.sparse import coo_matrix
from lightfm import LightFM
import joblib


def load_interactions(path):
    df = pd.read_csv(path)
    # Keep only positive interactions
    df = df[df['interaction'] > 0]
    # Map ids to sequential indexes
    user_map = {u: i for i, u in enumerate(df['user_id'].unique())}
    item_map = {i: j for j, i in enumerate(df['challenge_id'].unique())}
    df['uid'] = df['user_id'].map(user_map)
    df['iid'] = df['challenge_id'].map(item_map)
    interactions = coo_matrix((df['interaction'].astype(float), (df['uid'], df['iid'])))
    return interactions, user_map, item_map


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('--input', required=True, help='path to interactions csv')
    parser.add_argument('--output', required=True, help='path to save model')
    args = parser.parse_args()

    interactions, user_map, item_map = load_interactions(args.input)
    model = LightFM(no_components=32, loss='warp')
    model.fit(interactions, epochs=10, num_threads=4)

    joblib.dump({'model': model, 'user_map': user_map, 'item_map': item_map}, args.output)
    print('Model saved to', args.output)


if __name__ == '__main__':
    main()
