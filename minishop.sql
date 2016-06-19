-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 19 Juin 2016 à 20:58
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `minishop22`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `name`, `active`) VALUES
(1, 'Chemise', 1),
(2, 'Veste', 1),
(3, 'Bleu', 1),
(4, 'Homme', 1),
(5, 'Manches Longues', 1),
(6, 'Femme', 1),
(7, 'Sport', 1),
(8, 'Coton', 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(6) UNSIGNED NOT NULL,
  `key_panier` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qt` int(6) DEFAULT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `ref_produit` int(6) UNSIGNED DEFAULT NULL,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id`, `key_panier`, `qt`, `user_id`, `ref_produit`, `status`) VALUES
(1, '2016-06-19 20:16:40', 3, 1, 2, 1),
(2, '2016-06-19 20:16:40', 1, 1, 1, 1),
(3, '2016-06-19 20:16:40', 1, 1, 6, 1),
(4, '2016-06-19 20:24:59', 3, 1, 2, 1),
(5, '2016-06-19 20:24:59', 1, 1, 1, 1),
(6, '2016-06-19 20:24:59', 1, 1, 6, 1),
(7, '2016-06-19 20:24:59', 1, 1, 1, 1),
(8, '2016-06-19 20:37:12', 3, 1, 2, 1),
(9, '2016-06-19 20:37:12', 1, 1, 1, 1),
(10, '2016-06-19 20:37:12', 1, 1, 6, 1),
(11, '2016-06-19 20:37:12', 1, 1, 1, 1),
(12, '2016-06-19 20:37:12', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `ref_produit` int(6) UNSIGNED NOT NULL,
  `qt_stock` int(6) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `description` text,
  `link_img` text,
  `product_name` text,
  `categorie` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`ref_produit`, `qt_stock`, `price`, `description`, `link_img`, `product_name`, `categorie`) VALUES
(1, 25, '299.00', 'Chemise coupe Ã©troite en popeline blanche avec boutonniÃ¨re cachÃ©e et petit col.', 'img/shirt1.png', 'Chemise classique Timeless', '#Chemise#Blanche#Manches#longues#Blanc#SoirÃ©e#HabillÃ©#Homme'),
(2, 12, '99.00', 'Chemise pour homme en seersucker bleu clair tissÃ© ample. Poche de poitrine brodÃ©e.', 'http://static5.shop.indiatimes.com/images/products/additional/original/B2236380_View_1/fashion/shirts/us-polo-teal-and-grey-striped-men-shirt-ussh2881.jpg', 'Chemise Seersucker', '#Homme#Classique#DÃ©contractÃ©#Decontract#Chemise#Manches#longues'),
(3, 50, '125.00', 'Chemise traditionnelle Oxford, bleue ciel avec un tissus lourd.', 'http://www.ellensfashion.com/wp-content/uploads/2016/01/oxford-shirt-13.jpg', 'Chemise Oxford bleue clair', '#Chemise#Bleue#Bleu#Homme#Manche#longues#Poche'),
(4, 69, '78.00', 'Chemise en tissus faÃ§on denim. Manches longues et coutures tournantes pour plus de confort.', 'http://charliemenswear.com/wp-content/uploads/2016/03/pepe-teal-plain-men-shirt.jpg', 'Chemise faÃ§on denim', '#Chemise#Bleue#Manches#Longues#Poche#BrodÃ©e#Brodee#CintrÃ©e#Cintree'),
(5, 22, '128.00', 'Chemise de femme en popeline fil Ã  fil avec doublure aux manches et encolures en tartan. Rappel dans la boutonniÃ¨re.', 'http://www.gibbsmenswear.co.uk/images/hackett-bright-check-doubleface-shirt-p28-71_zoom.jpg', 'Chemise doublÃ©e en tartan', '#Chemise#Femme#Feminine#FÃ©minine#Manches#longues#Poche#Popeline#Tartan'),
(6, 52, '29.00', 'Tshirt jaune pour homme, coupe droite.', 'http://www.entripy.com/content/images/thumbs/0021411_jerzees-hidensi-t-adult-t-shirt.jpeg', 'Tshirt jaune poussin', '#Tshirt#Jaune#Homme#Cotton'),
(7, 50, '80.00', 'Chemise femme vert menthe avec manches longues retroussables.', 'http://atmintlstyle.com/sites/default/files/mountain-hardwear-chiller-shirt-upf-40-long-roll-sleeve-for-women-in-aquarium~p~6369r_02~1500.2.jpg', 'Chemise femme cintrÃ©e', '#chemise#femme#verte#manches#longues#decollete#dÃ©colletÃ©'),
(8, 50, '75.00', 'Chemise coupe large Ã  petits carreaux avec des manches longues et un col moyen boutonnÃ©.', 'http://www.kbazaviation.com/wp-content/uploads/2016/04/discontinued-ashworth-ez-tech-check-pattern-woven-dress-shirt-mens-dress-shirt-the-best-mens-dress-shirt.jpg', 'Chemise petits carreaux', '#Chemise#homme#carreaux#manches#longues#ample#large#decontractee#dÃ©contractÃ©e#blanche#bleue'),
(9, 120, '25.00', 'Tshirt de baseball blanc et bleu marine Ã  manches raglan en materiau respirant', 'http://atmintlstyle.com/sites/default/files/tshirts-008-2-1.jpg', 'Tshirt de baseball blanc et bleu marine', '#Tshirt#Contrast#Sport#Homme#Bleue#Blanche#Cotton#Polyester'),
(10, 24, '19.00', 'Tshirt vert pour homme avec inscription ALL DAY EVERY DAY.', 'http://www.worthtex.com/images/T-11.jpg', 'Tshirt vert pour homme', '#Tshirt#verte#homme#manches#courtes#sport'),
(11, 30, '18.00', 'Tshirt bleu moulant pour femme avec logo Superman sur la poitrine.', 'http://www.truffleshuffle.co.uk/store/images_high_res/Mens_Blue_Distressed_Superman_Logo_T_Shirt_hi_res.jpg', 'Tshirt Superwoman', '#Tshirt#Bleue#Femme#FÃ©minine#feminine#manches#courtes'),
(12, 80, '35.00', 'Tshirt blanc pour homme avec manches courtes et logo Adidas sur la poitrine.', 'http://images.champssports.com/is/image/EBFL2/S23125_fr_sc7_copy?hei=1500&amp;wid=1500', 'Tshirt logo blanc et noir', '#Tshirt#Blanche#manches#courtes#adidas#logo#homme#cotton#coton#sport'),
(13, 50, '36.00', 'Tshirt sÃ©rigraphiÃ© bleu pour homme et femme. Avec manches courtes en matÃ©riau synthÃ©tique.', 'http://g04.a.alicdn.com/kf/HTB1u1ESIFXXXXbkaXXXq6xXFXXXO/Nature-Scenery-T-Shirts-Men-Animals-Man-T-Shirt-Spandex-Short-Sleeves-Expression-Mens-tshirt-Casual.jpg', 'Tshirt sÃ©rigraphiÃ©', '#Tshirt#manches#courtes#bleue#homme#femme#unisex#polyamide#tendence#branchÃ©e#branchee'),
(14, 120, '220.00', 'Polo classique piquÃ© Lacoste blanc avec manches courtes. IdÃ©al pour le tennis.', 'http://images.usc.co.uk/images/imgzoom/54/54813001_xxl.jpg', 'Polo piquÃ© Lacost', '#polo#piquÃ©#pique#lacoste#sport#tennis#chic#tendence#coton#cotton#france'),
(15, 50, '180.00', 'Polo de sport marque Lacoste pour homme. Fait en matÃ©riau synthÃ©tique pour une ventilation optimale. Logo crocodile brodÃ©.', 'http://www.richmondclassics.com/images/lacoste-lacoste-team-sport-polo-shirt-yh7662-navy-p1357-14704_zoom.jpg', 'Polo de sport pour homme', '#polo#homme#sport#manches#courtes#fluo#lacoste#polyester#synthetique'),
(16, 25, '250.00', 'Veste en maille sport faÃ§on varsity avec col et bordures en cÃ´tes tricolores. Poitrine brodÃ©e NY.', 'http://www.tendancevetements.com/upfiles/main/Blouson-Homme-Gris-Rouge-Jaune-Sport-Pas-Cher-Tendance-Chic-1505.jpg', 'Veste varsity col tricolor', '#veste#grise#rouge#bleue#NY#homme#manches#longues'),
(17, 20, '360.00', 'Veste beige impermÃ©able pour homme. Bords cÃ´te, noirs.', 'http://www.tendancevetements.com/upfiles/main/Blouson-Homme-Kaki-Clair-Noir-Simple-Nouveau-Automne-Chic-1061.jpg', 'Veste impermÃ©able pour homme', '#veste#bords#cote#impermeable#impermÃ©able#homme#pluie'),
(18, 12, '280.00', 'Vest impermÃ©able faÃ§on blouson bombers avec bords cÃ´tes pour homme', 'http://www.govdenim.com/12197/veste-teddy-homme-gov-denim-bordeaux-88998br.jpg', 'Vest faÃ§on blouson rouge bordeaux', '#veste#homme#rouge#impermeable#impermÃ©able#nylon#synthetique#synthÃ©tique#zip#homme#poches'),
(19, 50, '550.00', 'Vest technique de montagne pour Homme. Bleue en gore tex pour une isolation et une respirabilitÃ© parfaite.', 'http://www.skifolies.com/images/Image/blouson-de-ski-homme-corer-bleu-1.jpg', 'Vest de montagne bleue pour homme', '#veste#homme#manches#longues#sport#bleue#zip#impermÃ©able#impermeable#ski#neige'),
(20, 120, '320.00', 'Vest grise faÃ§on varsity en mÃ©lange laine et coton pour homme. Poitrine BrodÃ©e Stanford.', 'http://www.tendancevetements.com/upfiles/main/Blouson-Homme-Gris-Bleu-Pas-Cher-Tendance-Automne-Vogue-1506.jpg', 'Veste varsity col tricot', '#veste#Brodee#brodÃ©e#homme#sport#laine#coton#tricot#poche#manches#longues');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `login` varchar(30) NOT NULL,
  `passwd` varchar(1000) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `addr` text,
  `postal_code` int(5) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `is_admin`, `login`, `passwd`, `name`, `addr`, `postal_code`, `country`, `city`, `phone`, `mail`, `reg_date`, `active`) VALUES
(1, 1, 'opichou', '1f17e0995b21b06caf7bc096830f9b8c534f934150937d05aa1f07bf8a9305012e792a805c8b883554061320310882d98ab5e23e17c7e6f53953f6a18c0c2531', 'Olivier Pichou', '10 rue neuve popincourt', 75011, 'FRANCE', 'PARIS', '0685456255', 'opichou@student.42.fr', '2016-06-19 20:14:29', 1),
(2, 0, 'jbom', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Jean Bom', '12 impasse de la pigne', 85690, 'France', 'Saint Jean de Bom', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(3, 0, 'arnaud', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Arnaud Bernard', '1 avenue montaigne', 75008, 'France', 'Paris', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(4, 0, 'megacoolxxx', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Jason Tibia', '1 avenue montaigne', 75008, 'France', 'Paris', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(5, 0, 'calbertini', '1f17e0995b21b06caf7bc096830f9b8c534f934150937d05aa1f07bf8a9305012e792a805c8b883554061320310882d98ab5e23e17c7e6f53953f6a18c0c2531', 'Clémentine Albertini', '5 rue de France', 95500, 'FRANCE', 'Monfermeil', '0685456255', 'opichou@student.42.fr', '2016-06-19 20:01:54', 1),
(6, 0, 'jbom', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Jean Bom', '12 impasse de la pigne', 85690, 'France', 'Saint Jean de Bom', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(7, 0, 'arnaud', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Arnaud Bernard', '1 avenue montaigne', 75008, 'France', 'Paris', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(8, 0, 'megacoolxxx', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Jason Tibia', '1 avenue montaigne', 75008, 'France', 'Paris', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(9, 0, 'supercool', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Susane Tabac', '1 avenue montaigne', 75008, 'France', 'Paris', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(10, 0, 'xlsior', '3be63ae3b2e107ac9098d28ad19cffb058585cb53f4055ae7425bded4b1b801e49d516d060dec97b0ec903663c8cf06b80c2d06db5cf5a07378a8c262119a08d', 'Clément Durand', '5 rue de Saint Exupery', 31520, 'France', 'Toulouse', '0985456321', 'jbom@gmail.com', '2016-06-19 19:45:48', 1),
(11, 0, 'olivier', '1f17e0995b21b06caf7bc096830f9b8c534f934150937d05aa1f07bf8a9305012e792a805c8b883554061320310882d98ab5e23e17c7e6f53953f6a18c0c2531', 'Françoise Olivier', '10 rue neuve popincourt', 75011, 'FRANCE', 'PARIS', '0685456255', 'opichou@student.42.fr', '2016-06-19 18:30:36', 1),
(12, 0, 'jeanne', 'bfe34d5cb09494edc1a1e3b7a6d81604983647a55ecd593d759f328f34b4201f4dc5311ee58e159abef478accde2b6fadc3c3e20cfb37c4dfa59c843ad9c3463', 'Jeanne Calmant', '10 rue', 99999, 'Belgique', 'Bruxelles', '0100000000', 'x@hotmail.com', '2016-06-19 20:15:35', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ref_produit` (`ref_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ref_produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `ref_produit` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`ref_produit`) REFERENCES `produit` (`ref_produit`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
