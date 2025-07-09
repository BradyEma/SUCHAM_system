import pandas as pd
import joblib
import os
from sklearn.linear_model import LinearRegression

# Load your orders dataset
df = pd.read_csv('storage/app/data/orders.csv')  # Adjust path if needed

# Convert order_date to datetime
df['order_date'] = pd.to_datetime(df['order_date'])

# Group by month and total quantity
df['month'] = df['order_date'].dt.to_period('M')
monthly_data = df.groupby('month')['quantity'].sum().reset_index()
monthly_data['month'] = monthly_data['month'].astype(str)

# Prepare training data
X = pd.get_dummies(monthly_data['month'])  # One-hot encode months
y = monthly_data['quantity']

# Train the model
model = LinearRegression()
model.fit(X, y)

# Ensure directory exists before saving
os.makedirs('ml/models', exist_ok=True)
joblib.dump(model, 'ml/models/demand_model.pkl')

# Make a prediction (e.g. for August 2025)
next_month = pd.get_dummies(pd.Series(['2025-08']))
next_month = next_month.reindex(columns=X.columns, fill_value=0)  # match training structure
prediction = model.predict(next_month)
# save output as csv
output = pd.DataFrame([{
    'product': 'Sugar',
    'predicted_for': '2025-08-01',
    'quantity': prediction[0]
}])
output.to_csv('storage/app/data/demand_predictions.csv', index=False)

print(f"Predicted quantity for 2025-08: {prediction[0]:.2f}")

