drop TABLE if exists articles_users;
drop TABLE if exists articles;
drop TABLE if exists users;
drop TABLE if exists categories;
drop TABLE if exists conferences;
drop TABLE if exists organisations;
drop TABLE if exists equipes;
drop TABLE if exists laboratoires;

-- ------------------------------------------
-- TABLE LABORATOIRES
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratoires` (
    `id_lab`    INT NOT NULL AUTO_INCREMENT,
    `nom_lab`   varchar(250) NOT NULL,
    CONSTRAINT pk_lab PRIMARY KEY (`id_lab`)
);

-- ------------------------------------------
-- TABLE EQUIPES
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `equipes` (
    `id_equipe`     INT NOT NULL AUTO_INCREMENT,
    `nom_equipe`    VARCHAR(250) NOT NULL,
    `label_equipe`  VARCHAR(10) NOT NULL,
    CONSTRAINT pk_equipes PRIMARY KEY (`id_equipe`)
);

-- ------------------------------------------
-- TABLE ORGANISATIONS
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `organisations` (
    `id_orga`       INT NOT NULL AUTO_INCREMENT,
    `nom_orga`      VARCHAR(250) NOT NULL,
    CONSTRAINT pk_orga PRIMARY KEY (`id_orga`)
);

-- ------------------------------------------
-- TABLE CONFERENCES
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `conferences` (
    `id_conf`       INT NOT NULL,
    `nom_conf`      VARCHAR(250) NOT NULL,
    CONSTRAINT pk_conf PRIMARY KEY (`id_conf`)
);

-- ------------------------------------------
-- TABLE CATEGORIES
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
    `id_cat`    INT NOT NULL AUTO_INCREMENT,
    `nom_cat`   VARCHAR(250) NOT NULL,
    `label_cat` VARCHAR(10) NOT NULL,
    CONSTRAINT pk_cat PRIMARY KEY (`id_cat`)
);

-- ------------------------------------------
-- TABLE CHERCHEURS
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id_user`  INT NOT NULL AUTO_INCREMENT,
    `nom`           VARCHAR(250) NOT NULL,
    `prenom`        VARCHAR(250) NOT NULL,
    `username`      VARCHAR(250) NOT NULL,
    `password`      VARCHAR(250) NOT NULL,
    `salt`          VARCHAR(50) NOT NULL,
    `role`          VARCHAR(10) NOT NULL,
    `id_orga`       INT,
    `id_equipe`     INT,
    `id_lab`        INT,
    CONSTRAINT pk_users PRIMARY KEY (`id_user`)
);

-- ------------------------------------------
-- TABLE ARTICLES
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
    `id_articles`   INT NOT NULL AUTO_INCREMENT,
    `titre`         VARCHAR(250) NOT NULL,
    `statut`        INT NOT NULL,
    `texte`         TEXT NOT NULL,
    `annee`         INT NOT NULL,
    `id_conf`       INT,
    `id_cat`        INT,
    CONSTRAINT pk_articles PRIMARY KEY (`id_articles`)
);

-- ------------------------------------------
-- TABLE ARTICLES_CHERCHEURS
-- ------------------------------------------
CREATE TABLE IF NOT EXISTS `articles_users` (
    `id`            INT NOT NULL AUTO_INCREMENT,
    `id_article`    INT NOT NULL,
    `id_user`  INT NOT NULL,
    CONSTRAINT pk_art_cherch PRIMARY KEY (`id`)
);

-- ------------------------------------------
-- ALTER TABLES
-- ------------------------------------------
ALTER TABLE `users` ADD CONSTRAINT fk_user_orga FOREIGN KEY (`id_orga`) REFERENCES `organisations` (`id_orga`);
ALTER TABLE `users` ADD CONSTRAINT fk_user_equipes FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`);
ALTER TABLE `users` ADD CONSTRAINT fk_user_lab FOREIGN KEY (`id_lab`) REFERENCES `laboratoires` (`id_lab`);
ALTER TABLE `articles` ADD CONSTRAINT fk_articles_conf FOREIGN KEY (`id_conf`) REFERENCES `conferences` (`id_conf`);
ALTER TABLE `articles` ADD CONSTRAINT fk_articles_cat FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`);
ALTER TABLE `articles_users` ADD CONSTRAINT fk_articles_user_articles FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`);
ALTER TABLE `articles_users` ADD CONSTRAINT fk_articles_user_users FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

-- -----------------------------------------
-- INSERT DE TEST
-- -----------------------------------------
INSERT INTO `articles`(`titre`, `statut`, `texte`, `annee`) VALUES ('Article 1', '0', 'Ceci est un texte', 2016);
INSERT INTO `users`(`nom`, `prenom`, `username`, `password`, `salt`, `role`) values
('John', 'Doe', 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
INSERT INTO `users`(`nom`, `prenom`, `username`, `password`, `salt`, `role`) VALUES ('Jesuis', 'admin', 'admin', '2NIUNISoVyySNn9l5ntsONo4JFisKQvu/Cq6LLdfarXjRMvkIqRevFDQrbSmbOhrMvojVFlv+MKJccX2hX/ZzQ==', 'admin', 'ROLE_ADMIN');
INSERT INTO `articles_users` (`id_article`, `id_user`) VALUES (0, 0);