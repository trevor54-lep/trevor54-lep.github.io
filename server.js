const fs = require("fs");
const https = require("https");
const express = require("express");

const app = express();

// Charger le certificat et la clé
const options = {
    key: fs.readFileSync("key.pem"),
    cert: fs.readFileSync("cert.pem"),
};

app.get("/", (req, res) => {
    res.send("Hello en HTTPS !");
});

https.createServer(options, app).listen(3000, () => {
    console.log("Serveur HTTPS lancé sur https://localhost:3000");
});
