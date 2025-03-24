import os
import mysql.connector
from flask import Flask, jsonify, request
import numpy as np
import pandas as pd
from sklearn.neighbors import NearestNeighbors
from sklearn.preprocessing import StandardScaler, OneHotEncoder
from sklearn.compose import ColumnTransformer
#from dotenv import load_dotenv
# Cargar las variables del archivo .env
#load_dotenv()

# Obtener la API_KEY del archivo .env
api_key = os.getenv('API_KEY')

app = Flask(__name__)

# Conexión a la BD
def get_db_connection():
    try:
        return mysql.connector.connect(
            host=os.getenv('DB_HOST'),  # Dirección del servidor donde se encuentra la BD
            user=os.getenv('DB_USERNAME'),       # Usuario para acceder a la BD
            password=os.getenv('DB_PASSWORD'),       # Contraseña para acceder a la BD
            database=os.getenv('DB_DATABASE') # Nombre de la BD
        )
    except mysql.connector.Error as err:
        print(f"Error al conectar con la base de datos: {err}")  # Log para depuración
        return None  # Retornar None en lugar de JSON

# Endpoint de prueba para recuperar datos de la tabla 'favoritos' con validación de API_KEY
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

# Endpoint donde se generan las recomendaciones
@app.route('/recommendations', methods=['GET'])
def get_recommendations():
    # Verificar que la API_KEY proporcionada en el encabezado sea válida
    api_key_from_request = request.headers.get('Authorization')  # Recibir el token de autorización
    if api_key_from_request != f"Bearer {api_key}":
        return jsonify({"error": "Unauthorized: API Key no válida o no proporcionada."}), 401

    # Obtenemos los parámetros recibidos
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

    cursor = None #Inicializar cursor para manejo seguro
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
        favorites = cursor.fetchall()
        print(f"Estos son los favoritos rescatados desde la BD: \n{favorites}")

        if not favorites:
            return jsonify({"error": "No se encontraron favoritos."}), 404
    
        # Obtener todos los datos para entrenar el modelo
        if user_type == "A":
            query = "SELECT * FROM users_b;"
        else:
            query = "SELECT * FROM casas;"

        cursor.execute(query)
        all_data = cursor.fetchall()

        if not all_data:
            return jsonify({"error": "No se encontraron datos suficientes."}), 404
    except mysql.connector.Error as err:
        return jsonify({"error": f"Error en la base de datos: {err}"}), 500
    except Exception as err:
        return jsonify({"error": f"Error inesperado: {str(err)}"}), 500
    finally:
        if cursor:
            cursor.close()
        connection.close()
    
    # Convertir los datos recibidos a df de pandas para su manejo
    df_todo = pd.DataFrame(all_data)
    df_favoritos = pd.DataFrame(favorites)

    # Definir columnas relevantes según tipo de usuario
    if user_type == "A":
        columnas_numericas = ["edad"]
        columnas_categoricas = ["sexo", "carrera", "lifestyle"]
    else:
        columnas_numericas = ["precio"]
        columnas_categoricas = ["ciudad", "colonia", "muebles", "acepta_mascotas", "acepta_visitas"]
    
    # Preprocesamiento
    preprocessor = ColumnTransformer([
        ('num', StandardScaler(), columnas_numericas),
        ('cat', OneHotEncoder(handle_unknown='ignore'), columnas_categoricas)
    ])

    x_todo = preprocessor.fit_transform(df_todo)
    x_favoritos = preprocessor.transform(df_favoritos)

    # Calcular centroide
    centroide = np.asarray(np.mean(x_favoritos, axis=0)).reshape(1, -1)
    
    # Obtener el total de datos
    total_datos = len(all_data)

    # Calcular k como la raíz cuadrada del total de datos
    k = int(np.sqrt(total_datos))

    # Entrenar modelo k-NN
    knn = NearestNeighbors(n_neighbors=k, metric='euclidean')
    knn.fit(x_todo)
    
    distancias, indices = knn.kneighbors(centroide, n_neighbors=k + len(favorites))

    # Filtrar solo los recomendados (evitando favoritos)
    recomendaciones = []
    for idx in indices.flatten():
        recomendado_id = df_todo.iloc[idx]["user_id" if user_type == "A" else "id"]
        if recomendado_id not in df_favoritos["user_id" if user_type == "A" else "id"].values:
            recomendaciones.append(recomendado_id)
    
    # Obtener el total de recomendaciones
    total_recomendaciones = len(recomendaciones)  # Contar la cantidad de recomendaciones

    # Imprimir los resultados correctamente
    print("\nTotal de recomendaciones:", total_recomendaciones)
    print("Usuarios recomendados finales:", recomendaciones)
    print("Distancias:", distancias.flatten().tolist())  # Asegurar que sea una lista

    # Convertir los valores de numpy.int64 a int
    recomendaciones = [int(recomendado_id) for recomendado_id in recomendaciones]

    # Retornar los resultados al controlador
    return jsonify(recomendaciones)


if __name__ == '__main__':
    port = int(os.environ.get("PORT", 5000))
    app.run(debug=True, host=os.getenv('API_PYTHON_URL'), port=port)
