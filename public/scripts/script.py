import sys
import json

# Aquí recibes los argumentos (en este caso, los IDs)
if len(sys.argv) > 1:
    json_argumento = sys.argv[1]

    # Decodificar el JSON recibido
    ids_favoritos = json.loads(json_argumento)

    # Realizar el cálculo de KNN o cualquier otra operación
    # Suponiendo que el resultado es un arreglo de IDs similares o algo relacionado
    resultados_knn = {"resultado": ids_favoritos}  # Esto es solo un ejemplo

    # Convertir los resultados a formato JSON y devolverlo
    print(json.dumps(resultados_knn))  # Esto enviará el arreglo como JSON
else:
    print("No se recibió ningún argumento.")