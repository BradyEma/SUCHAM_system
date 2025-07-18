import pandas as pd
from sklearn.cluster import KMeans
import joblib
import os

# ✅ Load dataset
df = pd.read_csv('storage/app/data/customer_orders.csv')

# ✅ Aggregate per customer
agg = df.groupby('customer_id').agg({
    'order_amount': 'sum',
    'order_id': 'count'
}).rename(columns={'order_id': 'order_count'})

# ✅ Use only numeric features for clustering
features = agg[['order_amount', 'order_count']]

# ✅ Train KMeans
kmeans = KMeans(n_clusters=3, n_init=10)
agg['cluster'] = kmeans.fit_predict(features)

# ✅ Save to disk
os.makedirs('storage/app/data', exist_ok=True)
os.makedirs('ml/models', exist_ok=True)
agg.to_csv('storage/app/data/customer_segments.csv')
joblib.dump(kmeans, 'ml/models/customer_segmenter.pkl')

print("Customer segmentation complete. CSV and model saved.")
