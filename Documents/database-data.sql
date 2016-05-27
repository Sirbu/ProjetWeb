-- Laboratoires
INSERT INTO Laboratoire VALUES (1, 'IRIT', '118 route narbonne Toulouse', 'Informatique Toulouse', 'Informatique');

-- Équipes
INSERT INTO Equipe VALUES (1, 'Service Integration and Network Administration', 'SIERA', 'Réseaux', 'Our works aim at controlling not only last generation communication infrastructures and services, but also dynamically aggregated, distributed and trans-organizational complex applications and systems. Thus, our researches define and evaluate new management paradigms and bring architectures, platforms, tools or normalization contributions to the community. The target application domains are networks and services, together with e-learning.', 1);
INSERT INTO Equipe VALUES (2, 'Visual Objects : from Reality To EXpression', 'VORTEX', 'Imagerie', 'L’équipe VORTEX (Visual Objects from Reality To Expression) a été créée fin 2006. VORTEX regroupe des compétences recouvrant la chaîne complète de traitement 3D, de l’acquisition au rendu temps réel en passant par la génération et l’animation des mondes et des entités virtuelles', 1);

-- Chercheurs
INSERT INTO Chercheur VALUES (1, 'aoun', 'papaaoun', 1, 'Aoun', 'André', 'aoun@irit.fr', '0534662395', 1);
INSERT INTO Chercheur VALUES (2, 'dave', 'favoris', 2, 'Vanderhaeghe', 'David', 'David.Vanderhaeghe@irit.fr', '0664852677', 2);
INSERT INTO Chercheur VALUES (3, 'toto', 'mdp', 1, 'Barrere', 'Francois', 'Francois.barrere@irit.fr', '0668897516', 1);
INSERT INTO Chercheur VALUES (4, 'jesus', 'christ', 3, 'Rouanet', 'jl', 'jl.rouanet@irit.fr', '0689326547', 2);

-- Calendrier
INSERT INTO Calendrier VALUES (1, '11/05/2016', '30/05/2016');

-- Projet
INSERT INTO Projet VALUES (1, 'SKYNET', '500000', 'Plateforme espionnage téléphonique', 1, 1);

-- Participe
INSERT INTO Participe VALUES (1, 1, 'Coordinateur');

-- Publie
INSERT INTO Publie VALUES (1, 1);

--Documents
INSERT INTO Document VALUES (1, 'Les réseaux', 'Brouillon', 'ftp://serveur.fr');
INSERT INTO Document VALUES (2, ' Protocole MPLS', 'Rapport expérience', 'ftp://serveur.fr');
INSERT INTO Document VALUES (3, 'RIP', 'Brouillon', 'ftp://serveur.fr');
INSERT INTO Document VALUES (4, 'OSPF', 'Brouillon', 'ftp://serveur.fr');
INSERT INTO Document VALUES (5, 'Java', 'Rapport expérience', 'ftp://serveur.fr');
INSERT INTO Document VALUES (6, 'ATM', 'Brouillon', 'ftp://serveuririt.fr');
INSERT INTO Document VALUES (7, 'Gestion', 'Compte rendu réunion', 'ftp://serveuririt.fr');

-- Participe
INSERT INTO Depose VALUES (1, 1);
INSERT INTO Depose VALUES (2, 1);
INSERT INTO Depose VALUES (3, 2);
INSERT INTO Depose VALUES (4, 1);
INSERT INTO Depose VALUES (5, 2);
INSERT INTO Depose VALUES (6, 3);
INSERT INTO Depose VALUES (7, 4);

-- Publications
INSERT INTO Message VALUES (1, 'blabla', 'Salut ma couille', 'coucou comment va tu ?',1998,1,1);
INSERT INTO Message VALUES (2, 'blablabis', 'Salut ma couillasse', 'yoyoyoyoyo ?',2015,2,1);

