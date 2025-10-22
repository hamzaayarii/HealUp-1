"""
Given model.joblib produced by train.py (which contains {'model', 'user_map', 'item_map'}), generate a CSV of top-N recommendations mapped back to original user_id and challenge_id.
Usage:
  python generate_model_output.py --model model.joblib --output model_output.csv --k 10
"""
import argparse
import joblib
import numpy as np
import pandas as pd


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('--model', required=True)
    parser.add_argument('--output', required=True)
    parser.add_argument('--k', type=int, default=10)
    args = parser.parse_args()

    data = joblib.load(args.model)
    model = data['model']
    user_map = data['user_map']
    item_map = data['item_map']

    # reverse maps
    inv_user = {v: k for k, v in user_map.items()}
    inv_item = {v: k for k, v in item_map.items()}

    n_users = len(user_map)
    n_items = len(item_map)

    rows = []
    for u_idx in range(n_users):
        scores = model.predict(u_idx, np.arange(n_items))
        top_k = np.argsort(-scores)[:args.k]
        for rank, item_idx in enumerate(top_k):
            rows.append([inv_user[u_idx], inv_item[item_idx], float(scores[item_idx])])

    df = pd.DataFrame(rows, columns=['user_id', 'challenge_id', 'score'])
    df.to_csv(args.output, index=False)
    print('Wrote', args.output)


if __name__ == '__main__':
    main()
