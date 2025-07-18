import pandas as pd
from sklearn.cluster import KMeans
import joblib
import sys
sys.stdout.reconfigure(encoding='utf-8')
import os

# Load the dataset
df = pd.read_csv('storage/app/data/datasets.csv')

# Preprocess
df['order_date'] = pd.to_datetime(df['order_date'])
df['year_month'] = df['order_date'].dt.to_period('M')

# Aggregate by customer
agg = df.groupby(['customer_id', 'customers_email']).agg({
    'order_amount': 'sum',
    'order_id': 'count'
}).reset_index().rename(columns={'order_id': 'order_count'})

features = agg[['order_amount', 'order_count']]

# KMeans clustering
kmeans = KMeans(n_clusters=3, n_init=10)
agg['cluster'] = kmeans.fit_predict(features)

# Label clusters by spend (just for clarity)
cluster_summary = agg.groupby('cluster')['order_amount'].mean().sort_values()
cluster_labels = {}
for i, cluster_id in enumerate(cluster_summary.index):
    if i == 0:
        label = 'Low Spender'
    elif i == 1:
        label = 'Medium Spender'
    else:
        label = 'High Spender'
    cluster_labels[cluster_id] = label

agg['label'] = agg['cluster'].map(cluster_labels)

# Save segmented data and model
os.makedirs('ml/models', exist_ok=True)
os.makedirs('storage/app/data', exist_ok=True)
agg.to_csv('storage/app/data/customer_segments.csv', index=False)
joblib.dump(kmeans, 'ml/models/customer_segmenter.pkl')

print("✅ Customer segmentation completed.")
