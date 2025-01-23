# Real-Time Game Updates with WebSockets  

This project is a **real-time WebSocket-based application** that allows users to create teams and games, each involving two teams. When a game is updated, **WebSockets** ensure that all connected clients receive real-time status updates instantly. This provides a seamless and interactive experience for users without requiring manual refreshes.  

## Installation  

Follow these steps to set up the project on your local machine:  

1. **Clone the repository**  
   ```sh
   git clone https://github.com/vimuths123/sockerupdate.git .
   ```  

2. **Navigate to the project directory**  
   ```sh
   cd sockerupdate
   ```  

3. **Install dependencies**  
   ```sh
   composer install
   npm install
   ```  

4. **Set up the environment file**  
   ```sh
   cp .env.example .env
   ```  
   - Update the `.env` file with your database and WebSocket configurations.  

5. **Generate the application key**  
   ```sh
   php artisan key:generate
   ```

6. **Run migrations and seed the database**  
   ```sh
   php artisan migrate --seed
   ```
   
7. **Generate storage symlinks**  
   ```sh
   php artisan storage:link
   ```

8. **Start the WebSocket server**  
   ```sh
   php artisan websockets:serve
   ```  

9. **Run the application**  
   ```sh
   php artisan serve
   npm run dev
   ```  

Now, you can access the application in your browser and experience real-time game updates! 🚀  
