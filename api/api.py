import os
from dotenv import load_dotenv
import mysql.connector
from flask import Flask, jsonify, request
import numpy as np
from sklearn.neighbors import NearestNeighbors

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
            query = """
                SELECT users_b.*
                FROM favoritos_roomies
                JOIN users_b ON favoritos_roomies.user_b_id = users_b.user_id
                WHERE favoritos_roomies.user_a_id = %s;
                """
        else:  # user_type == "B"
            query = """
                SELECT casas.*
                FROM favoritos_casas
                JOIN casas ON favoritos_casas.casa_id = casas.id
                WHERE favoritos_casas.user_b_id = %s;
                """

        cursor.execute(query, (user_id,))
        favoritos = cursor.fetchall()
        print(f"Estos son los favoritos rescatados desde la BD: \n{favoritos}")

        if not favoritos:
            return jsonify({"error": "No se encontraron favoritos."}), 404

        # Extracción de características de favoritos
        features = []
        if user_type == "A":
            for favorito in favoritos:
                features.append([favorito['user_id'], favorito['edad'], favorito['sexo'], favorito['carrera'], 
                                 favorito['lifestyle'], favorito['padecimiento'], favorito['mascota']])
                #print(features)
        else:
            for favorito in favoritos:
                features.append([favorito['id'], favorito['ciudad'], favorito['colonia'], favorito['precio'], 
                                 favorito['muebles'], favorito['acepta_mascotas'], favorito['acepta_visitas']])

        #print(f"Features antes de NP {features}")
        # Convertir la lista de características a un array de NumPy
        features_array = np.array(features)
        print(f"Features despues de NP: \n {features_array}")
        ids = features_array[:, 0].astype(int).tolist()  # Convertir a enteros y luego a lista

        """
        # Entrenar el modelo KNN
        model_knn = NearestNeighbors(n_neighbors=5, metric='euclidean')
        model_knn.fit(features_array)

        # Obtener las recomendaciones de los K vecinos más cercanos
        distances, indices = model_knn.kneighbors(features_array)

        # Buscar los usuarios o casas recomendados en la base de datos
        recommended = []
        if user_type == "A":
            for index in indices.flatten():
                recommended.append(favoritos[index]['user_id'])  # Añadimos los IDs de los usuarios recomendados
        else:
            for index in indices.flatten():
                recommended.append(favoritos[index]['id'])  # Añadimos los IDs de las casas recomendadas
        """
        #print(f"Recomendaciones: {recommended}")
        print(f"Estos son los ID que se val a devolver al controlador:\n{ids}")
        return jsonify(ids)
    
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
