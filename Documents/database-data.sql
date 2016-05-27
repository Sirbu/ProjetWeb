-- Laboratoires --OK
INSERT INTO Laboratoire VALUES (1, 'IRIT', '118 route narbonne Toulouse', 'Informatique Toulouse', 'Informatique');
INSERT INTO Laboratoire VALUES (2, 'LAAS', '7 Avenue du Colonel Roche', 'Analyse et Architecture des Systèmes', 'Informatique');
INSERT INTO Laboratoire VALUES (3, 'LAPLACE', 'Avenue de l etudiant', 'Electrique/Electronique', 'Electricité');

-- Équipes -- OK
INSERT INTO Equipe VALUES (1, 'Service Integration and Network Administration', 'SIERA', 'Réseaux', 'Our works aim at controlling not only last generation communication infrastructures and services, but also dynamically aggregated, distributed and trans-organizational complex applications and systems. Thus, our researches define and evaluate new management paradigms and bring architectures, platforms, tools or normalization contributions to the community. The target application domains are networks and services, together with e-learning.', 1);
INSERT INTO Equipe VALUES (2, 'Visual Objects : from Reality To EXpression', 'VORTEX', 'Imagerie', 'L’équipe VORTEX (Visual Objects from Reality To Expression) a été créée fin 2006. VORTEX regroupe des compétences recouvrant la chaîne complète de traitement 3D, de l’acquisition au rendu temps réel en passant par la génération et l’animation des mondes et des entités virtuelles', 1);
INSERT INTO Equipe VALUES (3, 'Verification de Systèmes Temporisés Critiques', 'VERTICS', 'Informatique critique', 'Dans ce contexte, nos études portent sur les modèles permettant d exprimer le parallélisme, la communication, les contraintes temporelles et, depuis peu, les systèmes hybrides. Pour analyser ces modèles, nous proposons des algorithmes de vérification (semi-algorithmes et sur-approximation pour les modèles où l accessibilité est indécidable).', 2);
INSERT INTO Equipe VALUES (4, 'Ingénierie Système et Intégration', 'ISI', 'Ingénierie système', 'L’équipe ISI se positionne dans ce contexte de développement de systèmes complexes dans les applications embarquées principalement dans les domaines de l’aéronautique et de l’automobile et de l’énergie.', 2);
INSERT INTO Equipe VALUES (5, 'Diélectriques Solides et Fiabilité', 'DSF', 'Fiabilité système', 'Les activités de l équipe concernent en premier lieu la fiabilité des systèmes isolés. Les travaux ont pour objectif la compréhension des mécanismes de génération et de transport de charges dans les isolants, ainsi que l identification des processus conduisant au vieillissement et à la rupture de matériaux compte tenu des contraintes fonctionnelles rencontrées dans les dispositifs.', 3);
INSERT INTO Equipe VALUES (6, 'Lumière et Matière', 'LM', 'Lumière/Matière', 'L’objectif est de comprendre le principe de fonctionnement d’un composant et ses interactions au sein d’un système afin d’optimiser le fonctionnement de ce dernier pour une application donnée.', 3);

-- Chercheurs --OK
INSERT INTO Chercheur VALUES (1, 'benzekri', 'mdp', 1, 'Benzekri', 'Abdelmalek', 'benzekri@irit.fr', '0534658545', 1);
INSERT INTO Chercheur VALUES (2, 'aoun', 'mdp', 2, 'Aoun', 'André', 'aoun@irit.fr', '0534662395', 1);
INSERT INTO Chercheur VALUES (3, 'luga', 'mdp', 3, 'Luga', 'Hervé', 'luga@irit.fr', '0534987485', 2);
INSERT INTO Chercheur VALUES (4, 'duthen', 'mdp', 4, 'Duthen', 'Yves', 'duthen@irit.fr', '0534654215', 2);
INSERT INTO Chercheur VALUES (5, 'berthomieu', 'mdp', 6, 'Berthomieu', 'Bernard', 'bertho@laas.fr', '0534121212', 3);
INSERT INTO Chercheur VALUES (6, 'vernadat', 'mdp', 7, 'Vernadat', 'Francois', 'vernadat@laas.fr', '0534987845', 3);
INSERT INTO Chercheur VALUES (7, 'demmou', 'mdp', 8, 'Demmou', 'Hammid', 'demmou@laas.fr', '0534124578', 4);
INSERT INTO Chercheur VALUES (8, 'pascal', 'mdp', 9, 'Pascal', 'Jean-claude', 'pascal@laas.fr', '0534789654', 4);
INSERT INTO Chercheur VALUES (9, 'berquez', 'mdp',11, 'Berquez', 'Laurent', 'berquez@laplace.fr', '0534784512', 5);
INSERT INTO Chercheur VALUES (10, 'dmd', 'mdp', 10, 'Marty-Dessus', 'Didier', 'marty@laplace.fr', '0534962315', 5);
INSERT INTO Chercheur VALUES (11, 'zissis', 'mdp',14, 'Zissis', 'Georges', 'zissis.g@laplace.fr', '0534727572', 6);
INSERT INTO Chercheur VALUES (12, 'buso', 'mdp', 13, 'Buso', 'David', 'buso.d@laplace.fr', '0534789685', 6);



-- Publications --OK a revoir
INSERT INTO Publication VALUES (1, 'Théorie des réseaux !', '12/05/2016', 'Uploads/Publications'); -- SIERA
INSERT INTO Publication VALUES (2, ' Image and Video Processing for Cultural Heritage.', '12/03/2016', 'Uploads/Publications'); --VORTEX
INSERT INTO Publication VALUES (3, 'Fast and tight analysis for AUTOSAR schedule tables', '12/04/2016', 'Uploads/Publications'); --VERTICS
INSERT INTO Publication VALUES (4, 'Emergence in engineering systems', '10/05/2016', 'Uploads/Publications'); --ISI
INSERT INTO Publication VALUES (5, 'A new specification-based qualitative metric for simulation model validity', '17/01/2016', 'Uploads/Publications');--ISI
INSERT INTO Publication VALUES (6, 'PSpice Modeling of the Pulsed Electro-acoustic Signal', '02/12/2015', 'Uploads/Publications'); --DSF
INSERT INTO Publication VALUES (7, 'Silver nanoclusters containing layer as an efficient barrier for charge injection in polyethylene', '01/04/2016', 'Uploads/Publications'); --DSF
INSERT INTO Publication VALUES (8, 'Etude des propriétés électroniques des cristaux liquides discotiques pour applications photovoltaïques', '13/02/2016', 'Uploads/Publications'); --LM


-- Calendrier --OK
INSERT INTO Calendrier VALUES (1, '11/05/2016', '30/08/2016');

-- Projet -- OK
INSERT INTO Projet VALUES (1, 'Skynet', '500000', 'Skynet est une intelligence artificielle qui se préoccupe des métadonnées mobiles.', 1, 1);

-- Participe --OK
INSERT INTO Participe VALUES (1, 1, 'Coordinateur');
INSERT INTO Participe VALUES (2, 1, 'Chercheur');

-- Publie --OK
INSERT INTO Publie VALUES (2, 1);
INSERT INTO Publie VALUES (3, 2);
INSERT INTO Publie VALUES (5, 3);
INSERT INTO Publie VALUES (7, 4);
INSERT INTO Publie VALUES (8, 5);
INSERT INTO Publie VALUES (9, 6);
INSERT INTO Publie VALUES (10, 7);
INSERT INTO Publie VALUES (11, 8);



--Documents -- OK a revoir
INSERT INTO Document VALUES (1, 'Les réseaux', 'Brouillon', 'Uploads/Documents/réseaux');
INSERT INTO Document VALUES (2, ' Protocole MPLS', 'Rapport expérience', 'Uploads/Documents/mpls';
INSERT INTO Document VALUES (3, 'RIP', 'Brouillon','Uploads/Documents/rip');
INSERT INTO Document VALUES (4, 'OSPF', 'Brouillon', 'Uploads/Documents/ospf');

-- Depose -- OK
INSERT INTO Depose VALUES (1, 1);
INSERT INTO Depose VALUES (2, 1);
INSERT INTO Depose VALUES (3, 2);
INSERT INTO Depose VALUES (4, 2);


-- Messages -- OK
INSERT INTO Message VALUES (1, 'Réunion du 03/06/2016', 'Bonjour, vous trouverez les points abordés lors de la réunion du 03/06 dans votre boite mail. ','04/06/2016',1,1);


