import CryptoJS from 'crypto-js';

// Leer argumentos del proceso
const args = process.argv.slice(2);
const encryptedMessage = args[0];
const secretKey = args[1];

// Desencriptar el mensaje
const decrypted = CryptoJS.AES.decrypt(encryptedMessage, secretKey).toString(CryptoJS.enc.Utf8);

// Imprimir el resultado para que PHP pueda capturarlo
console.log(decrypted);