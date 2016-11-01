Abbiamo una serie di carte d'imbarco per vari mezzi di trasporto, che porteranno da un punto A a un punto B, con varie fermate lungo il percorso. Le carte d'imbarco non sono in ordine, non si sa dove inizia il viaggio, né dove finisce. Ogni carta d'imbarco contiene informazioni sull'assegnazione del posto e sui mezzi di trasporto (numero di volo, di autobus, ecc). Bisogna scrivere una API che permetta di ordinare questo tipo di lista e presentare una descrizione di come completare il nostro viaggio. Per esempio l'API dovrebbe essere in grado di prendere un insieme non ordinato di carte d'imbarco, fornite in un formato a scelta, e produrre questa lista:
1. Prendere il treno 78A da Milano a Roma. Posto assegnato 45B.
2. Prendere l'autobus da Roma a Fiumicino aeroporto. Nessuna assegnazione del posto.
3. Dall'aeroporto di Fiumicino, prendere il volo SK455 per Parigi. Imbarco 45B, posto 3A. Consegna bagaglio alla biglietteria 344.
4. Da Parigi, prendere il volo SK22 New York JFK. Imbarco 22, posto 7B. Bagaglio trasferito automaticamente dall'ultima tratta.
5. Destinazione finale.
