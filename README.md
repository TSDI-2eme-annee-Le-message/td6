Code pour la création de la table sous Mysql (étant donnée que la DB est dèja crée)

CREATE TABLE people (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    job VARCHAR(100) NOT NULL
);

