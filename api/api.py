import os
from dotenv import load_dotenv
import mysql.connector
from flask import Flask, jsonify, request

# Cargar las variables del archivo .env
load_dotenv()

# Obtener la API_KEY del archivo .env
api_key = os.getenv('API_KEY')

app = Flask(__name__)

# Conexión a la BD
def get_db_connection():
    try:
        return mysql.connector.connect(
            host='localhost',  # Dirección del servidor donde se encuentra la BD
            user="root",       # Usuario para acceder a la BD
            password='',       # Contraseña para acceder a la BD
            database="cianna"  # Nombre de la BD
        )
    except mysql.connector.Error as err:
        print(f"Error al conectar con la base de datos: {err}")  # Log para depuración
        return None  # Retornar None en lugar de JSON

# Ruta para recuperar datos de la tabla 'favoritos' con validación de API_KEY
@app.route('/favoritos', methods=['GET'])
def get_favoritos():
    # Verificar que la API_KEY proporcionada en el encabezado sea válida
    api_key_from_request = request.headers.get('Authorization')  # Recibir el token de autorización
    if api_key_from_request != f"Bearer {api_key}":
        return jsonify({"error": "Unauthorized: API Key no válida o no proporcionada."}), 401

    # Obtener parámetros
    user_id = request.args.get('user_id')
    user_type = request.args.get('user_type')

    # Validaciones
    if not user_id:
        return jsonify({"error": "ID del usuario no válido o no proporcionado."}), 400
    if not user_type:
        return jsonify({"error": "Tipo del usuario no válido o no proporcionado."}), 400
    if user_type not in ["A", "B"]:
        return jsonify({"error": "Tipo de usuario no reconocido."}), 400
    
    # Convertir user_id a entero (manejo de error seguro)
    try:
        user_id = int(user_id)
    except ValueError:
        return jsonify({"error": "ID del usuario no es un número entero válido."}), 400

    # Intentar recuperar los datos
    connection = get_db_connection()
    if connection is None:
        return jsonify({"error": "No se pudo conectar a la base de datos."}), 500

    cursor = None  # Inicializar cursor para manejo seguro
    try:
        cursor = connection.cursor(dictionary=True)
        
        if user_type == "A":
            query = "SELECT * FROM favoritos_roomies WHERE user_a_id = %s;"
        else:  # user_type == "B"
            query = "SELECT * FROM favoritos_casas WHERE user_b_id = %s;"

        cursor.execute(query, (user_id,))
        favoritos = cursor.fetchall()

        if not favoritos:
            return jsonify({"error": "No se encontraron favoritos."}), 404

        return jsonify(favoritos)
    except mysql.connector.Error as err:
        return jsonify({"error": f"Error en la base de datos: {err}"}), 500
    except Exception as err:
        return jsonify({"error": f"Error inesperado: {str(err)}"}), 500
    finally:
        if cursor:
            cursor.close()
        connection.close()

if __name__ == '__main__':
    app.run(debug=True, port=5000)
