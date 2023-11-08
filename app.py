from flask import Flask, render_template, request, redirect, url_for, flash
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.secret_key = 'secret_key_for_flash_messages'


# Dummy user data (replace with a database)
users = [{'username': 'user1', 'password': generate_password_hash('password1')},
         {'username': 'user2', 'password': generate_password_hash('password2')}]

@app.route('/')
def index():
    return render_template('index.html')


# API for login
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        user = next((user for user in users if user['username'] == username), None)

        if user and check_password_hash(user['password'], password):
            flash('Login successful', 'success')
            # Implement your session management or token generation here
            return render_template('user.html', username=username)
        else:
            flash('Invalid username or password', 'error')

    return render_template('login.html')
    

# API for register
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        # Check if the username is already taken
        if any(user['username'] == username for user in users):
            flash('Username already taken. Please choose another one.', 'error')
        else:
            # Hash the password before storing it
            hashed_password = generate_password_hash(password)
            users.append({'username': username, 'password': hashed_password})
            flash('Registration successful. You can now log in.', 'success')
            return redirect(url_for('login'))

    return render_template('register.html')


# ...
# API for user
@app.route('/user',methods=['GET', 'POST'])
def user(): 
    # if request.method == 'POST':
    username = username
    print(username)
        
    # Get the user details from the session or token (implement your session management or token verification here)
    # For simplicity, we'll use a dummy user
    dummy_user = {'username': username}
    
    return render_template('user.html', user=dummy_user)

# ...


if __name__ == '__main__':
    app.run(debug=True)
