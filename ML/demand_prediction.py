import pandas as pd
import joblib
import os
from sklearn.linear_model import LinearRegression

# ✅ Load your orders dataset
df = pd.read_csv('storage/app/data/orders.csv')  # Ensure this file exists

# ✅ Convert order_date to datetime
df['order_date'] = pd.to_datetime(df['order_date'])

# ✅ Group by month and total quantity
df['month'] = df['order_date'].dt.to_period('M')
monthly_data = df.groupby('month')['quantity'].sum().reset_index()
monthly_data['month'] = monthly_data['month'].astype(str)

# ✅ Prepare training data
X = pd.get_dummies(monthly_data['month'])  # One-hot encode months
y = monthly_data['quantity']

# ✅ Train the model
model = LinearRegression()
model.fit(X, y)

# ✅ Save the trained model for future use
os.makedirs('ml/models', exist_ok=True)
joblib.dump(model, 'ml/models/demand_model.pkl')

# ✅ Predict for next month
next_month_str = '2025-08'
next_month = pd.get_dummies(pd.Series([next_month_str]))
next_month = next_month.reindex(columns=X.columns, fill_value=0)
prediction = model.predict(next_month)

# ✅ Prepare prediction result
output = pd.DataFrame([{
    'product': 'Sugar',
    'predicted_for': f'{next_month_str}-01',
    'quantity': round(prediction[0])
}])

# ✅ Save prediction as CSV into Laravel's storage directory
output_dir = os.path.join('storage', 'app', 'data')
os.makedirs(output_dir, exist_ok=True)
output_path = os.path.join(output_dir, 'demand_predictions.csv')
output.to_csv(output_path, index=False)

# ✅ Confirm completion
print(f"Predicted quantity for {next_month_str}: {prediction[0]:.2f}")
print(f"Prediction saved to {output_path}")

# import pandas as pd
# import joblib
# import os
# from sklearn.linear_model import LinearRegression

# # Load your orders dataset
# df = pd.read_csv('storage/app/data/orders.csv')  # Adjust path if needed

# # Convert order_date to datetime
# df['order_date'] = pd.to_datetime(df['order_date'])

# # Group by month and total quantity
# df['month'] = df['order_date'].dt.to_period('M')
# monthly_data = df.groupby('month')['quantity'].sum().reset_index()
# monthly_data['month'] = monthly_data['month'].astype(str)

# # Prepare training data
# X = pd.get_dummies(monthly_data['month'])  # One-hot encode months
# y = monthly_data['quantity']

# # Train the model
# model = LinearRegression()
# model.fit(X, y)

# # Ensure directory exists before saving
# os.makedirs('ml/models', exist_ok=True)
# joblib.dump(model, 'ml/models/demand_model.pkl')

# # Make a prediction (e.g. for August 2025)
# next_month = pd.get_dummies(pd.Series(['2025-08']))
# next_month = next_month.reindex(columns=X.columns, fill_value=0)  # match training structure
# prediction = model.predict(next_month)
# # save output as csv
# output = pd.DataFrame([{
#     'product': 'Sugar',
#     'predicted_for': '2025-08-01',
#     'quantity': prediction[0]
# }])
# output.to_csv('storage/app/data/demand_predictions.csv', index=False)

# print(f"Predicted quantity for 2025-08: {prediction[0]:.2f}")

