# import subprocess

# def install_package(package_name):
#     subprocess.check_call(['pip', 'install', package_name])

# # Example: Install pandas
# install_package('pandas')

# import pandas as pd
from modal import Image, Stub, wsgi_app
#modal serve test.py
#Created flask_app => https://nethmifonseka97--test-py-flask-app-dev.modal.run

stub = Stub()
image = Image.debian_slim().pip_install("flask","pymongo")


@stub.function(image=image)
@wsgi_app()
def flask_app():
    from flask import Flask, request

    web_app = Flask(__name__)

    @web_app.get("/msg")
    def home():
        return "Recommend"

    # @web_app.post("/echo")
    # def echo():
    #     return request.json
    @web_app.post("/echo")
    def echo():
        from sklearn.feature_extraction.text import TfidfVectorizer
        from sklearn.metrics.pairwise import linear_kernel
        from pymongo import MongoClient

        client = MongoClient("mongodb+srv://test:test@cluster0.47ozeut.mongodb.net/test?retryWrites=true")
        db = client.get_database('ml')
        records = db.budget
        df = list(records.find()) 

        # Vectorize the text attributes (food preferences, location preferences, destination)
        tfidf_vectorizer = TfidfVectorizer()
        tfidf_matrix = tfidf_vectorizer.fit_transform(df['food_preferences'] + " " + df['location_preferences'] + " " + df['destination'])

        # Calculate cosine similarity
        cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)

        # Function to recommend destinations and restaurants
        def recommend_destinations(user_data):
            user_profile = user_data['food_preferences'] + " " + user_data['location_preferences'] + " " + user_data['destination']

            # Get the index of the user's row in the dataset
            user_idx = df[df['user_id'] == user_data['user_id']].index[0]

            # Calculate the cosine similarities for the user's profile
            sim_scores = list(enumerate(cosine_sim[user_idx]))

            # Sort the destinations and restaurants by similarity scores
            sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

            # Get the top 5 recommendations
            sim_scores = sim_scores[1:6]  # Exclude the user's own row
            recommendations = df.iloc[[x[0] for x in sim_scores]]

            return recommendations[['destination', 'restaurant']]

    
    @web_app.post("/ml")
    def ml():

        # file_path = '/ml.csv'
        from pymongo import MongoClient
        client = MongoClient("mongodb+srv://test:test@cluster0.47ozeut.mongodb.net/test?retryWrites=true")
        db = client.get_database('ml')
        records = db.budget
        dataset = list(records.find())
        # print(dataset)
        
        
        # Read the CSV file into a DataFrame
        # df = pd.read_csv(file_path)

        # Assuming df is your DataFrame
        # Create an empty list to store the converted dataset
        # dataset = []

        # Iterate over rows in the DataFrame
        # for index, row in df.iterrows():
        #     # Create a dictionary for each row and append it to the dataset list
        #     data = {
        #         'city': row['city'],
        #         'accommodation': row['accommodation'],
        #         'accommodation_budget': row['accommodation_budget'],
        #         'restaurant': row['restaurant'],
        #         'food_preference': row['food_preference'],
        #         'food_budget': row['food_budget'],
        #         'interest': row['interest'],
        #         'interest_budget': row['interest_budget']
        #     }
        #     dataset.append(data)

   
        user_city =  request.json["city"]
        user_budget = request.json["budget"]
        food = request.json["food"]
        leisure = request.json["interest"]

        
        city_data = [entry for entry in dataset if entry['city'].lower() == user_city.lower()]
        # print(city_data)

        if not city_data:
            return "Sorry, we don't have information for that city in our dataset."

        # Find combinations of accommodation and interest places within budget
        valid_combinations = []
        for accommodation in city_data:
            for interest in city_data:
                for restaurant in city_data:
                    if restaurant['food_preference'].lower() == food.lower() and interest['interest'].lower() == leisure.lower():
                        total_budget = accommodation['accommodation_budget'] + interest['interest_budget'] + restaurant['food_budget']
                        if total_budget <= user_budget:
                            valid_combinations.append({
                                'accommodation_place': accommodation['accommodation'],
                                'interest_place': interest['interest'],
                                'restaurant': restaurant['restaurant'],
                                'total_budget': total_budget
                            })

        if not valid_combinations:
            return f"Sorry, we couldn't find any valid combinations within your budget in {user_city}."

        # Select the combination with the highest total budget within the user's budget
        best_combination = max(valid_combinations, key=lambda x: x['total_budget'])

        try:
            result = {'accommodation_place': best_combination['accommodation_place'],
                'interest_place': best_combination['interest_place'],
                'restaurant': best_combination['restaurant'],
                'total_budget': best_combination['total_budget']}
        except:
            result = {"accomadation": "HotelB"}
        
        print (result)
        
        return result

    
        # recommendation = recommend_place(user_city, user_budget,food, leisure, dataset)

        # if isinstance(recommendation, str):
        #     print(recommendation)
        # else:
        #     print(f"Recommended Accommodation: {recommendation['accommodation_place']}")
        #     print(f"Recommended Interest Place: {recommendation['interest_place']}")
        #     print(f"Recommended Interest Place: {recommendation['restaurant']}")
        #     print(f"Recommended Interest Place: {recommendation['total_budget']}")


        # try:
        #     salary = request.json["salary"]
        #     if salary > 2000:
        #         result = {"hotel": "HotelA"}
        #     else:
        #         result = {"hotel": "HotelB"}
        # except KeyError:
        #     result = {"error": "Salary not found in the request JSON"}

        # return result


    return web_app