
# # Sample dataset with user attributes, destinations, and restaurant preferences
# data = {
#     'user_id': [1, 2, 3],
#     'salary': [60000, 75000, 55000],
#     'food_preferences': ['Italian', 'Mexican', 'Japanese'],
#     'location_preferences': ['Beach', 'City', 'Mountain'],
#     'destination': ['Beach Resort', 'City Apartment', 'Mountain Cabin'],
#     'restaurant': ['Italian Restaurant', 'Mexican Restaurant', 'Sushi Bar'],
# }
import random
import pandas as pd
import math

# Initialize empty lists for each column
user_ids = []
budgets = []
food_preferences = []
location_preferences = []
destinations = []
restaurants = []

# Generate 100 random examples
for user_id in range(1, 5001):
    user_ids.append(user_id)
    budgets.append(math.ceil(random.randint(200, 5000)/ 100) * 100)  # Random salary between 40,000 and 90,000
    food_pref = random.choice(['Italian', 'Mexican', 'Japanese', 'Chinese', 'Indian', 'Sri Lankan','Thai','Greek','Spanish','Brazilian','Korean','Turkish','Moroccan','Vietenamese','Ithiopian','Russian','Malaysian','Swedish','Jamaican','Australian','German','Indonesian','Filipino','Bangladesi','Hawaiian','Finnish'])
    food_preferences.append(food_pref)
    location_pref = random.choice(['Beach', 'City', 'Mountains', 'Countryside','Island','Lakeside','Forested','Cultural','Artistic','Industrial','Entertainment','Music','Military','Religious','Sporting Evets','Historical','Desert'])
    location_preferences.append(location_pref)
    destination = f"{location_pref} {random.choice(['Resort', 'Apartment', 'Cabin','Hostel','Hotel','Inn','Guesthouse','Lodge','Cabin','Airbnb','TreeHouse'])}"
    destinations.append(destination)
    restaurant = f'{food_pref} Restaurant'
    restaurants.append(restaurant)

# Create a DataFrame from the generated lists
data = {
    'user_id': user_ids,
    'budget': budgets,
    'food_preferences': food_preferences,
    'location_preferences': location_preferences,
    'destination': destinations,
    'restaurant': restaurants,
}

df = pd.DataFrame(data)

# Print the first few rows of the generated dataset
print(df)

# df.to_csv('output.csv', index=False)
