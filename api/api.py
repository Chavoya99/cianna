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
        connection = mysql.connector.connect(
            host='localhost',  # Dirección del servidor donde se encuentra la BD
            user="root",       # Usuario para acceder a la BD
            password='',       # Contraseña para acceder a la BD
            database="cianna"  # Nombre de la BD
        )
        return connection
    except mysql.connector.Error as err:
        # En caso de error al conectar, retornar un mensaje de error
        return jsonify({"error": "Error al conectar con la base de datos: " + str(err)}), 500

# Ruta para recuperar datos de la tabla 'favoritos' con validación de API_KEY
@app.route('/favoritos', methods=['GET'])
def get_favoritos():
    # Verificar que la API_KEY proporcionada en el encabezado sea válida
    api_key_from_request = request.headers.get('Authorization')  # Recibir el token de autorización

    if api_key_from_request != f"Bearer {api_key}":
        return jsonify({"error": "Unauthorized: API Key no válida o no proporcionada."}), 401  # Si la API_KEY no coincide

    # Intentar recuperar los datos
    try:
        connection = get_db_connection()
        if isinstance(connection, tuple):  # Si la conexión no fue exitosa
            return connection  # Ya es un error con mensaje y código adecuado

        cursor = connection.cursor(dictionary=True)  # Manejo de diccionario para facilitar el acceso
        cursor.execute('SELECT * FROM favoritos_casas;')  # Consulta
        favoritos = cursor.fetchall()  # Datos obtenidos de la consulta
        cursor.close()  # Importante cerrar el cursor al terminar
        connection.close()  # Importante también cerrar la conexión al terminar

        if not favoritos:
            return jsonify({"error": "No se encontraron favoritos."}), 404  # Si no hay resultados en la consulta

        return jsonify(favoritos)  # Retorno de resultados
    
    except mysql.connector.Error as err:
        return jsonify({"error": f"Error en la base de datos: {err}"}), 500
    except Exception as err:
        return jsonify({"error": f"Error inesperado: {str(err)}"}), 500


if __name__ == '__main__':
    app.run(debug=True, port=5000)


'''
@app.route('/')
def home():
    return jsonify({"message": "Hola Mundo desde Flask!"})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
'''