import sys
print("Python used:", sys.executable)


import pandas as pd
import pickle
import os
import sys
sys.stdout.reconfigure(encoding='utf-8')
from sklearn.linear_model import LinearRegression
from datetime import datetime
from dateutil.relativedelta import relativedelta

# 🌍 Resolve Laravel base path
base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# 📂 Paths
csv_path = os.path.join(base_dir, 'storage', 'app', 'data', 'datasets.csv')
output_path = os.path.join(base_dir, 'storage', 'app', 'data', 'demand_predictions.csv')
model_dir = os.path.join(base_dir, 'ml', 'models')
os.makedirs(model_dir, exist_ok=True)

# ✅ Load dataset
df = pd.read_csv(csv_path)

# 🧹 Clean and prepare
df['order_date'] = pd.to_datetime(df['order_date'], errors='coerce')
df = df.dropna(subset=['order_date'])  # drop rows with invalid dates
df['month'] = df['order_date'].dt.to_period('M').astype(str)

# 🧠 Forecast per product
all_predictions = []

for product in df['product'].unique():
    product_data = df[df['product'] == product]
    monthly = product_data.groupby('month')['order_amount'].sum().reset_index()

    # Convert month to datetime
    monthly['month'] = pd.to_datetime(monthly['month'], format='%Y-%m')
    monthly = monthly.sort_values('month')

    # Create numeric month index (0, 1, 2, ...)
    monthly['month_idx'] = (monthly['month'] - monthly['month'].min()).dt.days // 30

    X = monthly[['month_idx']]
    y = monthly['order_amount']

    if len(X) < 3:
        continue

    # Train model
    model = LinearRegression()
    model.fit(X, y)

    # Forecast next 6 months
    last_idx = monthly['month_idx'].max()
    last_month = monthly['month'].max()
    for i in range(1, 7):
        future_idx = [[last_idx + i]]
        predicted_qty = model.predict(future_idx)[0]
        future_month = last_month + relativedelta(months=i)
        all_predictions.append({
            'product': product,
            'predicted_for': future_month.strftime('%Y-%m-01'),
            'quantity': round(predicted_qty, 2)
        })

    # Save model per product
    with open(os.path.join(model_dir, f'demand_model_{product.replace(" ", "_")}.pkl'), 'wb') as f:
        pickle.dump(model, f)

# 💾 Save predictions
output_df = pd.DataFrame(all_predictions)
output_df.to_csv(output_path, index=False)

print(f"✅ Forecast saved: {len(output_df)} rows to {output_path}")

# well this code works but it is too linear
# import pandas as pd
# import pickle
# import os
# import sys
# sys.stdout.reconfigure(encoding='utf-8')
# from sklearn.linear_model import LinearRegression
# from datetime import datetime
# from dateutil.relativedelta import relativedelta

# # 🌍 Resolve Laravel base path
# base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# # 📂 Paths
# csv_path = os.path.join(base_dir, 'storage', 'app', 'data', 'datasets.csv')
# output_path = os.path.join(base_dir, 'storage', 'app', 'data', 'demand_predictions.csv')
# model_dir = os.path.join(base_dir, 'ml', 'models')
# os.makedirs(model_dir, exist_ok=True)

# # ✅ Load dataset
# df = pd.read_csv(csv_path)

# # 🧹 Clean and prepare
# df['order_date'] = pd.to_datetime(df['order_date'], errors='coerce')
# df = df.dropna(subset=['order_date'])  # drop rows with invalid dates
# df['month'] = df['order_date'].dt.to_period('M').astype(str)

# # 🧠 Forecast per product
# all_predictions = []

# for product in df['product'].unique():
#     product_data = df[df['product'] == product]
#     monthly = product_data.groupby('month')['order_amount'].sum().reset_index()
    
#     # One-hot encode months
#     X = pd.get_dummies(monthly['month'])
#     y = monthly['order_amount']

#     # Skip if not enough data
#     if len(X.columns) < 3:
#         continue

#     # Train model
#     model = LinearRegression()
#     model.fit(X, y)
    
#     # Forecast next 6 months
#     today = datetime.today().replace(day=1)
#     future_months = [(today + relativedelta(months=i)).strftime('%Y-%m') for i in range(1, 7)]
    
#     for month_str in future_months:
#         X_pred = pd.get_dummies(pd.Series([month_str]))
#         X_pred = X_pred.reindex(columns=X.columns, fill_value=0)
#         predicted_qty = model.predict(X_pred)[0]

#         all_predictions.append({
#             'product': product,
#             'predicted_for': f"{month_str}-01",
#             'quantity': round(predicted_qty, 2)
#         })

#     # Save model per product
#     with open(os.path.join(model_dir, f'demand_model_{product.replace(" ", "_")}.pkl'), 'wb') as f:
#         pickle.dump(model, f)

# # 💾 Save predictions
# output_df = pd.DataFrame(all_predictions)
# output_df.to_csv(output_path, index=False)

# print(f"✅ Forecast saved: {len(output_df)} rows to {output_path}")
