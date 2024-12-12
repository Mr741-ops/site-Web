create database filmesWEB;
use filmesWEB;

CREATE TABLE filmes(
id_filmes INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(50),
descr VARCHAR(500),
nome_imagem VARCHAR(200),
url_imagem VARCHAR(200),
rating FLOAT,
PRIMARY KEY(id_filmes)
);

CREATE TABLE users(
id_users INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(50),
username VARCHAR(50),
mail VARCHAR(100),
password VARCHAR(50),
PRIMARY KEY(id_users)
);

CREATE TABLE ratings_users(
id_ratings_users INT NOT NULL AUTO_INCREMENT,
rating FLOAT,
rating_user FLOAT,
filmes_id INT NOT NULL,
users_id INT NOT NULL,
PRIMARY KEY(id_ratings_users),
FOREIGN KEY (filmes_id) REFERENCES filmes (id_filmes),
FOREIGN KEY (users_id) REFERENCES users (id_users)
);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('Star Wars: Episódio III - A Vingança dos Sith',
'As Guerras Clônicas estão em pleno andamento e Anakin Skywalker mantém um elo de lealdade com Palpatine, ao mesmo tempo em que luta para que seu casamento com Padmé Amidala não seja afetado por esta situação. Seduzido por promessas de poder, Anakin se aproxima cada vez mais de Darth Sidious até se tornar o temível Darth Vader. Juntos eles tramam um plano para aniquilar de uma vez por todas com os cavaleiros jedi.',
'Star Wars 3',
'Imagens/STARWARS 3.jpg',
0);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('O Senhor dos Anéis: A Sociedade do Anel',
'Em uma terra fantástica e única, um hobbit recebe de presente de seu tio um anel mágico e maligno que precisa ser destruído antes que caia nas mãos do mal. Para isso, o hobbit Frodo tem um caminho árduo pela frente, onde encontra perigo, medo e seres bizarros. Ao seu lado para o cumprimento desta jornada, ele aos poucos pode contar com outros hobbits, um elfo, um anão, dois humanos e um mago, totalizando nove seres que formam a Sociedade do Anel.',
'O Senhor dos Anéis',
'Imagens/Senhor dos Aneis.jpg',
0);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('Dune',
'Paul Atreides é um jovem brilhante, dono de um destino além de sua compreensão. Ele deve viajar para o planeta mais perigoso do universo para garantir o futuro de seu povo.',
'Dune',
'Imagens/Duna.jpg',
0);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('The Batman',
'Após dois anos espreitando as ruas como Batman, Bruce Wayne se encontra nas profundezas mais sombrias de Gotham City. Com poucos aliados confiáveis, o vigilante solitário se estabelece como a personificação da vingança para a população.',
'Batman',
'Imagens/Batman.jpg',
0);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('Homem-Aranha: No Universo Aranha',
'Após ser atingido por uma teia radioativa, Miles Morales, um jovem negro do Brooklyn, se torna o Homem-Aranha, inspirado no legado do já falecido Peter Parker. Entretanto, ao visitar o túmulo de seu ídolo em uma noite chuvosa, ele é surpreendido com a presença do próprio Peter, vestindo o traje do herói por baixo de um sobretudo. A surpresa fica ainda maior quando Miles descobre que ele veio de uma dimensão paralela, assim como outras versões do Homem-Aranha.',
'SpiderMan',
'Imagens/Spiderman.jpg',
0);

INSERT INTO filmesWEB.filmes(nome, descr, nome_imagem, url_imagem, rating)
VALUES ('Interstellar',
'As reservas naturais da Terra estão chegando ao fim e um grupo de astronautas recebe a missão de verificar possíveis planetas para receberem a população mundial, possibilitando a continuação da espécie. Cooper é chamado para liderar o grupo e aceita a missão sabendo que pode nunca mais ver os filhos. Ao lado de Brand, Jenkins e Doyle, ele seguirá em busca de um novo lar.',
'Interstellar',
'Imagens/Interstellar.jpg',
0);

select * from filmesWEB.filmes;

grant all privileges on filmesWEB.* to 'root'@'localhost';
