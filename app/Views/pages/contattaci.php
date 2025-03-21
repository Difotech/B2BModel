<style>
.container {
    display: flex;
    justify-content: center; /* Allinea i bottoni orizzontalmente al centro */
    flex-wrap: wrap; /* Permette di andare a capo su schermi piccoli */
    gap: 15px; /* Distanza tra i bottoni */
    padding: 0px;
    width: 80vw;
}

button {
    background-color: #a97c50;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    width: 200px; /* Larghezza uniforme */
    height: 50px; /* Altezza uniforme */
    text-align: center;
    display: inline-block; /* Evita problemi con la dimensione */
}

button:hover {
    background-color: #8c6239;
    transform: scale(1.05);
}

button:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(169, 124, 80, 0.8);
}
    </style>
<div class="container">
    <h1>Contattaci</h1>
    
    <ul>
        <li>Email: info@example.com</li>
        <li>Telefono: +39 123 456 7890</li>
        <li>Indirizzo: Via Esempio, 123, Roma, Italia</li>
    </ul>
</div>