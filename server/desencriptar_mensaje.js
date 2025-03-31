import express from 'express';
import CryptoJS from 'crypto-js';
import dotenv from 'dotenv';

dotenv.config();
const app = express();
const port = 4000; 
const secretKey = process.env.SECRET_KEY;

app.use(express.json());

app.post('/decrypt', (req, res) => {
    const { encryptedMessage } = req.body; 

    if (!encryptedMessage) {
        return res.status(400).json({ error: 'No se proporcionó el mensaje encriptado' });
    }

    try {
        const bytes = CryptoJS.AES.decrypt(encryptedMessage, secretKey);
        const decryptedMessage = bytes.toString(CryptoJS.enc.Utf8);

        if (!decryptedMessage) {
            return res.status(500).json({ error: 'Error al desencriptar el mensaje' });
        }
        console.log('Desencriptado con éxito');
        return res.status(200).json({ decryptedMessage });
    } catch (err) {
        console.error('Error de desencriptación:', err);
        return res.status(500).json({ error: 'Error interno al procesar el mensaje' });
    }
});

app.listen(port, () => {
    console.log(`Servidor de desencriptado corriendo en el puerto ${port}`);
});