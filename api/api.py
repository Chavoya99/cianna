import mysql.connector
from flask import Flask, jsonify


app = Flask(__name__)

#Conexión a la BD
def get_db_connection():
    connection = mysql.connector.connect(
        host='localhost',   # Dirección del servidor donde se encuentra la BD
        user ="root",       # Usuario para acceder a la BD
        password='',        # Contraseña para acceder a la BD
        database="cianna"   # Nombre de la BD
    )
    return connection

# Ruta para recuperar datos de la tabla 'favoritos'
@app.route('/favoritos', methods=['GET'])
def get_favoritos():
    try:
        connection = get_db_connection()
        cursor = connection.cursor(dictionary=True) # Manejo de diccionario para facilitar el acceso
        cursor.execute('SELECT * FROM favoritos_casas;') # Consulta
        favoritos = cursor.fetchall() # Datos obtenidos de la consulta
        cursor.close() # Importante cerrar el cursos al terminar
        connection.close() # Importante también cerrar la conexión al terminar

        return jsonify(favoritos) # Retorno de resultados
    except mysql.connector.Error as err:
        return jsonify({"error": f"Algo salió mal: {err}"}), 500


if __name__ == '__main__':
    app.run(debug=True, port=5000)


'''
@app.route('/')
def home():
    return jsonify({"message": "Hola Mundo desde Flask!"})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
'''