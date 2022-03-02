-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Mar 02, 2022 at 04:46 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `amis`
--

CREATE TABLE `amis` (
  `Id_ami` int(11) NOT NULL,
  `Id_utilisateur1` int(11) NOT NULL,
  `Id_utilisateur2` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plantes`
--

CREATE TABLE `plantes` (
  `Id_plante` int(11) NOT NULL,
  `Id_utilisateur` int(11) DEFAULT NULL,
  `Nom_latin` varchar(100) NOT NULL,
  `Nom_fr` varchar(100) NOT NULL,
  `Taille` float NOT NULL,
  `Couleur` enum('Vert','Rouge','Marron','Jaune','Rose','Orange','Blanc','Violet','Bleu','Gris','Noir') NOT NULL,
  `Fleur` tinyint(1) NOT NULL,
  `Fruit` tinyint(1) NOT NULL,
  `Couleur_fleur` enum('Jaune','Rouge','Vert','Violet','Bleu','Marron','Blanc','Rose','Orange','Gris','Noir') NOT NULL,
  `Couleur_fruit` enum('Jaune','Orange','Rouge','Bleu','Violet','Vert','Gris','Noir','Blanc','Rose','Marron') NOT NULL,
  `Régions` varchar(1000) NOT NULL,
  `Photos` varchar(1000) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Type` enum('Arbre','Arbuste','Plante','Algue') NOT NULL,
  `Période_floraison` enum('Printemps','Ete','Automne','Hiver') NOT NULL,
  `Période_fructification` enum('Printemps','Ete','Automne','Hiver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plantes`
--

INSERT INTO `plantes` (`Id_plante`, `Id_utilisateur`, `Nom_latin`, `Nom_fr`, `Taille`, `Couleur`, `Fleur`, `Fruit`, `Couleur_fleur`, `Couleur_fruit`, `Régions`, `Photos`, `Description`, `Type`, `Période_floraison`, `Période_fructification`) VALUES
(1, NULL, 'Ailanthus altissima', 'Ailante', 1500, 'Vert', 1, 1, 'Blanc', 'Vert', 'Partout', 'ailante.jpg', 'L\'ailante est un arbre de taille moyenne qui atteint une hauteur de 17 à 27 mètres avec un diamètre à hauteur de poitrine d\'homme d\'environ 1m 17. L\'écorce est lisse, gris clair, devenant souvent un peu plus rêche avec les fissures de couleur ocre pâle lorsque l\'arbre vieillit. Les rameaux, robustes, lisses à légèrement pubescents, sont rougeâtres ou marron. Ils portent des lenticelles ainsi que des cicatrices foliaires (cicatrices laissées sur le rameau après la chute des feuilles) en forme de cœur. Les bourgeons sont finement pubescents, en forme de dôme, et partiellement cachés derrière le pétiole, mais ils sont bien visibles pendant la période de dormance au-dessus des cicatrices foliaires8. Les branches sont gris pâle à gris foncé, lisses, brillantes et portent des lenticelles boursouflées qui se transforment en fissures avec l\'âge. Les extrémités des branches sont pendantes.', 'Arbre', 'Printemps', 'Printemps'),
(2, NULL, 'Ambrosia artemisiifolia', 'Ambroisie à feuilles d\'armoise', 100, 'Vert', 1, 1, 'Jaune', 'Marron', 'Partout', '', 'L\'ambroisie est une plante rudérale adventice des cultures de printemps pouvant mesurer jusqu\'à 2 m de hauteur.\r\n\r\nSes feuilles sont vert foncé. Elle se distingue par le détail singulier des feuilles : les feuilles de la plantule sont opposées, et plus précisément décussées, mais les feuilles et rameaux supérieurs sont alternes. Les rameaux sont rougeâtres et le dessous de la feuille est du même vert que le dessus. Les cotylédons à la base sont courts et disparaissent rapidement (avant deux ou trois étages de feuilles). Au stage végétatif elle adopte un port buissonnant large.\r\n\r\nLors de la floraison, les fleurs adoptent un port en chandelles également caractéristique, les sujets jeunes pouvant pousser rapidement une tige droite avec une seule chandelle, avec un espace entre les feuilles proche de 10 cm.\r\nLa petite herbe à poux a la particularité d\'être monoïque, ce qui signifie qu\'elle porte les deux sexes sur un même plant, sur des fleurs différentes, ce qui explique la facilité avec', 'Plante', 'Printemps', 'Printemps'),
(3, NULL, 'Amorpha fruticosa', 'Amorphe buissonnante', 300, 'Vert', 1, 1, 'Violet', 'Marron', 'Partout', '', 'Amorpha fruticosa est un arbuste ou arbrisseau pouvant atteindre 1 à 4 mètres de haut, voire 6 mètres. la plante adulte présente une couronne élargie et peut compter de 1 à 10 tiges. C\'est une plante de morphologie très variable. Cette diversité morphologique se reflète dans le fait que l\'espèce a de nombreux synonymes.\r\n\r\nLes feuilles, alternes, caduques, composées imparipennées, sont munies d\'un pétiole de 2,5 cm de long et de stipules membraneuses ou cartacées. Elles mesurent de 10 à 30 cm de long. Les nombreuses folioles (9 à 21) sont de forme elliptique ovale à lancéolée, à l\'extrémité mucronée, et mesurent de 2 à 4 cm de long sur 1 à 2 cm de large. Leur limbe est parsemé de glandes translucides à la face inférieure.\r\nLes fleurs, odorantes, sont groupées en grappes terminales ou axillaires, denses, spiciformes, dressées, de 7 à 15 cm de long. le calice est formé de cinq sépales soudés en tube. La corolle, de couleur bleu-violet foncé, est, cas inhabituel chez les Faboideae, formée', 'Arbuste', 'Ete', 'Ete'),
(4, NULL, 'Symphyotrichum lanceolatum\r\n', 'Aster à feuilles lancéolées', 100, 'Vert', 1, 1, 'Blanc', 'Marron', 'Partout', '', 'C\'est une plante érigée, aux feuilles lancéolées, entières ou légèrement dentées, aux fleurs en capitules avec un disque jaune entouré de ligules blanches ou bleu-violet.', 'Plante', 'Ete', 'Ete'),
(5, NULL, 'Symphyotrichum novi-belgii', 'Aster de Virginie', 100, 'Vert', 1, 1, 'Violet', 'Marron', 'Partout', '', 'L\'inflorescence est un capitule dont les fleurs périphériques, ligulées, sont mauves. Certains cultivars vont vers le bleu-violet (par exemple \'Schöne von Dietlikon\') ou le rouge (\'Septemberrubin\'). Les fleurs centrales sont généralement jaune-orangé.\r\n\r\nLes feuilles sont lisses. La plante peut atteindre une hauteur d\'un mètre à un mètre cinquante.\r\n\r\nEn Europe, notamment en France, les cultivars fleurissent autour du mois d\'octobre, mois des vendanges, ce qui a valu à l\'espèce le nom de « vendangeuse ».', 'Plante', 'Automne', 'Automne'),
(6, NULL, 'Baccharis halimifolia', 'Baccharis à feuille d\'arroche', 400, 'Vert', 1, 1, 'Blanc', 'Blanc', 'Bassin d\'Arcachon, Morbihan', '', 'La Bacchante forme des arbustes à feuillage caduc, de 1 à 4 m de hauteur en moyenne, pouvant atteindre 4 m. Il possède des branches dressées, très rameuses à rameaux glabres, couverts de minuscules écailles. Les feuilles alternes, de couleur vert tendre, sont elliptiques à obovales : les inférieures, de 3 à 7 cm de long et de 1 à 4 cm de large, ont un pétiole court et sont pourvues de trois à cinq dents de chaque côté. Les feuilles supérieures des rameaux florifères sont plus étroites avec une à trois dents de chaque côté. Ces rameaux se terminent par des panicules de capitules. Les capitules dioïques sont formées de 20 à 30 petites fleurs blanchâtres (fleurs femelles) ou jaunâtres (fleurs mâles), à pollinisation entomogame. Les fruits sont des akènes de 1 à 2 mm de long, pourvus d\'une aigrette à leur extrémité, assurant la dissémination par le vent (anémochorie). Chaque pied peur produire jusqu\'à 1 500 000 graines qui se dispersent de plusieurs mètres à quelques kilomètres autour de l', 'Arbuste', 'Ete', 'Ete'),
(7, NULL, 'Heracleum mantegazzianum', 'Berce du Caucase', 500, 'Vert', 1, 1, 'Blanc', 'Marron', 'Partout', '', 'La Berce du Caucase ou Berce de Mantegazzi (Heracleum mantegazzianum), est une espèce de plantes herbacées de la famille des Apiaceae. La sève de cette Berce est phototoxique. De plus, cette espèce est considérée en Europe et en Amérique du Nord (particulièrement au Québec) comme invasive.', 'Plante', 'Printemps', 'Ete'),
(8, NULL, 'Bidens frondosa', 'Bident feuillu', 120, 'Vert', 1, 1, 'Jaune', 'Noir', 'Partout', '', 'Le Bident feuillu, Bidens frondosa est une plante herbacée de la famille des Asteraceae. C\'est une espèce originaire d\'Amérique du Nord, invasive en Europe. Elle est aussi appelée bident feuillé, bident à fruits noirs ou chanvre d\'eau. Elle est utilisée dans les médecines traditionnelles en tant qu’anti-inflammatoire ainsi que comme insecticide.', 'Plante', 'Ete', 'Ete'),
(9, NULL, 'Buddleja davidii', 'Buddleia de David', 500, 'Vert', 1, 1, 'Violet', 'Marron', 'Partout', '', 'Le Buddleia de David (Buddleja davidii), aussi appelé Buddleia du père David ou plus communément Arbre aux papillons, est un arbuste présent dans l\'ensemble des régions tempérées du monde.\r\n\r\nOriginaire de Chine, il s\'est naturalisé progressivement dans le reste de la zone tempérée à partir du xixe siècle et est devenu une espèce exotique envahissante dans de nombreuses régions du monde et notamment en France. La variété fertile type a en effet été commercialisée et implantée dans de nombreux jardins jusqu\'à la fin du xxe siècle. Son caractère expansif s\'explique essentiellement par sa forte résistance à la pollution à l\'ozone qui lui donne un avantage sur les autres espèces pionnières.', 'Arbuste', 'Ete', 'Ete'),
(10, NULL, 'Caulerpa racemosa', 'Caulerpe raisin ', 15, 'Vert', 0, 0, '', '', 'Méditerranée', '', 'La Caulerpe raisin ou Caulerpe à billes, Caulerpa racemosa, est une espèce d\'algues vertes de la famille des Caulerpacées. On la trouve dans les eaux peu profondes de nombreuses mers du monde. Il existe un grand nombre de formes différentes dont une variété apparue en 1990 en Méditerranée dont le caractère invasif est préoccupant.', 'Algue', '', ''),
(11, NULL, 'Caulerpa taxifolia', 'Caulerpe à feuille d\'if ', 300, 'Vert', 0, 0, '', '', 'Méditerrannée', '', 'Caulerpa taxifolia est une espèce d’algues vertes pérennes de type nématothalle d\'origine tropicale appartenant aux Ulvophyceae à structure siphonée. La souche tropicale est présente naturellement au sud de l\'Australie, en Amérique centrale et sur les côtes africaines. Une souche issue de l\'aquarium de Monaco a été introduite accidentellement en Méditerranée. Rejetée comme un déchet, elle y est devenue une espèce envahissante. Elle est connue sous le nom d\'« algue tueuse », en raison de sa toxicité pour la faune, de son impact négatif sur la biodiversité et de sa vitesse de développement inquiétante. Elle est cependant aujourd\'hui en Méditerranée en forte régression et y est peut-être en voie de disparition (voir lutte biologique).', 'Algue', '', ''),
(12, NULL, 'Prunus serotina', 'Cerisier d\'automne', 2000, 'Vert', 1, 1, 'Blanc', 'Rouge', 'Sud-ouest', '', 'e cerisier tardif est un arbre à feuillage caduc pouvant atteindre une hauteur de 20 m en Europe et jusque 35 m aux États-Unis. Son écorce est gris foncé et se fissure avec l\'âge.\r\n\r\nLes feuilles sont de forme elliptique à lancéolée (12 cm de long pour 5 cm de large). Elles sont coriaces et munies d\'une fine dentelure dirigée vers l’avant. Leur face supérieure est de couleur vert foncé luisante et est lisse, tandis que leur face inférieure est plus claire et est pubescente le long de la nervure principale.\r\n\r\nEn automne, elles deviennent jaunes avant de tomber.\r\n\r\nLes fleurs sont blanches et font environ 1 cm. Elles sont légèrement pédicellées (de 3 à 6 mm) et réunies en grappes de 10 à 15 cm2.\r\n\r\nLe fruit est une drupe de couleur rouge foncé à noir et large de 8 à 10 mm. Il est comestible.', 'Arbre', 'Printemps', 'Ete'),
(13, NULL, 'Aegopodium podagraria', 'Égopode podagraire', 100, 'Vert', 1, 1, 'Blanc', 'Marron', 'Partout', '', 'Cette plante à croissance rapide peut atteindre 30 à 100 cm de hauteur1 (60 à 8o cm selon Rodet et Baillet (1872).\r\n\r\nLa tige est dressée, robuste, creuse, fistuleuse, ramifiée vers le haut, rameuse au sommet, glabre et cannelée en surface.\r\n\r\nLes feuilles ont une couleur vert gai au dessus, plus pâles en dessous et présentent une bordure inégalement dentée, parfois lobées, à dents aiguës, mucronées. Les inférieures sont longuement pétiolées, et présentent généralement trois lobes ; celles situées plus haut sur la tige sont disposées par lot de trois qui chacun se divise en trois folioles (feuilles triséquées). Chaque feuille ou segment de feuille a une forme pennée à ovale, à l\'extrémité formant un angle aigu. Les pétioles ont une section triangulaire.\r\n\r\nLes feuilles froissées ont une odeur qui évoque celles du céleri, de la carotte ou du persil.\r\n\r\nSes racines, nombreuses et profondes lui permettent de résister aux conditions de sous-bois, elles ont une odeur de carotte.', 'Plante', 'Printemps', 'Ete'),
(14, NULL, 'Elodea canadensis', 'Élodée du Canada', 0, '', 1, 0, 'Blanc', '', 'Partout', '', 'C’est une plante aquatique vivace. Elle est complètement immergée, à l’exception des petites fleurs blanches qui éclosent à la surface de l’eau, reliées à la plante par un fin pédoncule. C’est une espèce dioïque, c’est-à-dire à sexes séparés. En Europe, il n’existe que des pieds femelles.\r\n\r\nLes tiges grêles (et longues de plusieurs mètres parfois) sont munies de feuilles verticillées par trois.\r\n\r\nLes feuilles sont petites, sessiles, minces (2 à 3 mm de large), de couleur vert foncé, plus pâles à leur face inférieure.\r\n\r\nElles produisent des bourgeons terminaux qui hivernent au fond de l’eau et produisent de nouvelles tiges au printemps.\r\n\r\nLes fleurs de couleur blanche, petites (5 mm de diamètre), comptent trois pétales et trois sépales identiques.\r\n\r\nLa voie végétative est le mode de reproduction le plus important de cette plante, la reproduction par graine ne jouant qu’un rôle mineur.', 'Algue', 'Printemps', ''),
(15, NULL, 'Conyza canadensis', 'Vergerette du Canada', 100, 'Vert', 1, 1, 'Blanc', 'Blanc', 'Partout', '', 'La Vergerette du Canada, Vergerolle du Canada ou encore Érigéron du Canada (Conyza canadensis) est une plante herbacée annuelle rudérale de la famille des Asteraceae.\r\n\r\nOriginaire d\'Amérique centrale et du nord, elle s\'est naturalisée en Europe et est très courante voire localement invasive. C\'est une adventice pionnière, de plus en plus fréquente, commune dans les champs, les vignes et les vergers, en ville et en milieu périurbain, sur les friches industrielles et voies ferrées. Elle se plait dans les endroits chauds et secs et peut se développer dans de petits interstices.\r\n\r\nLa plante est comestible (crue ou cuite) et médicinale (sommités fleuries récoltées en été ou au début de l\'automne).', 'Plante', 'Ete', 'Ete'),
(16, NULL, 'Elodea nuttallii', 'Élodée de Nuttall', 100, 'Vert', 1, 0, 'Blanc', '', 'Partout', '', 'L’élodée de Nuttall (Elodea nuttallii) est une plante aquatique, vivace, de la famille des Hydrocharitaceae, originaire d’Amérique du Nord.\r\n\r\nElle a été utilisée comme plante d\'aquarium et décorative, introduite hors d\'Amérique où elle est localement devenue très envahissante.\r\n\r\nDepuis 2017, cette espèce est inscrite dans la liste des espèces exotiques envahissantes préoccupantes pour l’Union européenne. Cela signifie qu\'elle ne peut pas être importée, cultivée, commercialisée, plantée, ou libérée intentionnellement dans la nature, et ce nulle part dans l’Union européenne.', 'Algue', 'Ete', ''),
(17, NULL, 'Acer negundo', 'Érable negundo', 1500, 'Vert', 1, 1, 'Rouge', 'Marron', 'Partout', '', 'L\'Érable negundo ou Érable négondo (Acer negundo) est une espèce végétale de la famille des Aceraceae. Cet érable d’une dizaine de mètres de hauteur est originaire de l’est de l\'Amérique du Nord. On l\'appelle aussi Érable à giguère, peut-être par déformation du nom « érable argilière » qu\'utilisaient les Français de l\'Illinois, en 1814. Il est appelé parfois Érable à feuilles de frêne, Érable américain ou Érable à feuilles composées. Cette essence peu intéressante pour son bois a été introduite sur d\'autres continents en tant qu\'arbre d\'ornement pour les parcs et jardins. Elle s\'est révélée être localement envahissante.', 'Arbre', 'Printemps', 'Ete'),
(18, NULL, 'Helianthus tuberosus', 'Topinambour', 100, 'Vert', 1, 0, 'Jaune', '', 'Partout', '', 'C\'est une plante vivace, caduque, très rustique, résistante au froid, qui peut devenir envahissante à cause de ses rhizomes tubérisés. Elle peut atteindre jusqu\'à trois mètres de haut, avec de fortes tiges, très robustes. Son cycle est annuel.\r\n\r\nSes feuilles, alternes, dentées, sont de forme ovale, à pointe aiguë, rudes au toucher. Elles sont plus larges chez les topinambours que chez les soleils d\'ornement.\r\n\r\nSes inflorescences sont des capitules entièrement jaunes groupés en panicule terminal, apparaissant de septembre à octobre. Les variétés cultivées ne fleurissent généralement pas.\r\n\r\nSes tubercules, qui sont des rhizomes tubérisés, ont une forme mamelonnée, très irrégulière, arrondie ou ovale, toujours plus amincie à la base et ressemblent à ceux du gingembre. Ils sont recouverts d’écailles brunes rosées entre lesquelles apparaissent des nœuds. Leur couleur varie du jaune au rouge.\r\n\r\nLa substance de réserve n\'est pas l\'amidon comme pour la pomme de terre, mais un glucide qui e', 'Plante', 'Automne', ''),
(19, NULL, 'Carpobrotus acinaciformis', 'Figue des hottentots', 30, 'Vert', 1, 1, 'Violet', 'Jaune', 'Partout', '', 'Cette plante basse présente des tiges rampantes et des feuilles charnues à trois angles (section triangulaire). Les feuilles mesurent de 5 à 8 cm de longueur pour 15 à 18 mm de largeur ; elles sont vertes, rougeâtres ou rouges selon les conditions de leur environnement. Les fleurs rose pourpre sont grandes (de 5 à 12 cm de diamètre), solitaires et portées par l\'extrémité de la tige (\"terminales\"). Le fruit contient un millier de petites graines incluses dans un mucilage.', 'Plante', 'Printemps', 'Ete'),
(20, NULL, 'Soliva sessilis', 'Soliva commune ', 20, 'Vert', 1, 1, 'Vert', 'Jaune', 'Sud-Sud Ouest', '', 'C\'est une petite plante herbacée, annuelle, se développant en rosette basses de feuilles qui échappent aux lames des tondeuses. C\'est une plante considérée comme envahissante dans plusieurs pays. Elle a été signalée en Californie dès 1836, probablement à la suite de livraisons de peaux en provenance d\'Amérique du Sud. En Nouvelle-Zélande, c\'est une mauvaise herbe des plus détestées dans les pelouses.', 'Plante', 'Ete', 'Ete'),
(21, NULL, 'Azolla filiculoides', 'Azolle fausse-filicule', 5, 'Vert', 0, 0, '', '', 'Partout', '', 'Azolla filiculoides, l’Azolle fausse-filicule, Azolla fausse-filicule, Azolla fausse-fougère ou Fougère d\'eau, est une espèce de petite fougère aquatique flottante, originaire des zones tempérées chaudes et tropicales, de la famille des Salviniaceae (anciennement des Azollaceae).\r\nC\'est une plante qui en Europe montre - localement et dans certaines conditions (eaux lentes et plutôt eutrophes) - des capacités invasives, ou au moins de pullulation. Elle s\'est cependant révélée utilisable en tant qu\'engrais vert, et comme agent de détoxification d\'eaux usées ou industrielles, notamment en ce qui concerne les métaux lourds.', 'Plante', '', ''),
(22, NULL, 'Cortaderia selloana', 'Herbe de la pampa', 300, 'Vert', 1, 1, 'Blanc', 'Blanc', 'Partout', '', 'L\'herbe de la pampa est une grande graminée pouvant atteindre trois mètres de haut, poussant en bouquets denses. L\'espèce est dioïque, c\'est-à-dire que les fleurs mâles et femelles sont portées par des individus distincts.\r\n\r\nLes feuilles sont persistantes, élancées et longues de 1 à 2 m de long pour 1 cm de large. Elles contiennent une quantité de phytolithes siliceux représentant jusqu\'à plus de 5% du poids sec, qui, sur les bords de la feuille, agissent comme des dents de scie et lui donne son caractère très coupant. Elles doivent être manipulées avec précaution. Leur couleur va du vert-bleuâtre au gris argent.\r\n\r\nLes fleurs sont groupées dans des panicules blancs très denses, de 20 à 40 cm de long, portés par des tiges hautes de 2 à 3 mètres.', 'Plante', 'Ete', 'Ete'),
(23, NULL, 'Solidago gigantea', 'Solidage géant', 120, 'Vert', 1, 1, 'Jaune', 'Blanc', 'Est', '', 'À ne pas confondre avec le solidage du Canada qui lui ressemble par sa forme.\r\n\r\nLa taille du solidage géant ne dépasse généralement pas 120 cm. Il est plus petit que le solidage du Canada. Le solidage géant a une tige glabre jusqu\'au niveau des fleurs, souvent rougeâtre, alors que la tige du Solidage du Canada est verte dorée et poilue.\r\n\r\nOriginaire d\'Amérique du Nord, le solidage géant est une espèce fortement invasive.', 'Plante', 'Ete', 'Ete'),
(24, NULL, 'Impatiens glandulifera', 'Balsamine de l\'Himalaya', 200, 'Vert', 1, 1, 'Violet', 'Vert', 'Partout', '', 'La Balsamine de l\'Himalaya est une grande plante glabre pouvant atteindre deux mètres de haut, ce qui fait d\'elle la plus grande annuelle d\'Europe. Ses feuilles nettement dentées sont opposées ou verticillées. Les fleurs sont roses, parfois presque blanches, rouges ou pourpres en grappes lâches, odorantes, à éperon court. Les graines sont contenues dans des capsules allongées qui éclatent à maturité par détente de la tige capsulaire, projetant violemment les graines jusqu\'à cinq mètres.', 'Plante', 'Ete', 'Ete'),
(25, NULL, 'Ludwigia peploides', 'Jussie rampante ', 200, 'Vert', 1, 1, 'Jaune', 'Rouge', 'Sud-Ouest, Méditerrannée', '', 'Ludwigia peploides (autrefois aussi nommée Jussiaea peploides) est le nom scientifique de la Jussie rampante (plante aquatique à fleur, amphibie et fixée), souvent improprement nommée Jussie des marais, de la famille des Onagraceae, d\'origine sud-américaine ou australienne.', 'Plante', 'Ete', 'Ete'),
(26, NULL, 'Ludwigia grandiflora', 'Ludwigie à grandes fleurs', 300, 'Vert', 1, 1, 'Jaune', 'Rouge', 'Partout', '', 'Ludwigia grandiflora, la ludwigie à grandes fleurs ou jussie à grandes fleurs, parfois appelée Grande Jussie, est une espèce de plantes aquatiques de la famille des Onagraceae.\r\n\r\nElle est originaire d\'Amérique du Sud et utilisée dans les aquariums d\'eau douce. Introduite en Europe au xixe siècle, elle a colonisé de nombreux étangs et cours d\'eau et est aujourd\'hui considérée comme une espèce de plante envahissante ou invasive dans de nombreux pays, notamment la France (de même que Ludwigia peploides, espèce proche).\r\n\r\nEn Europe, Ludwigia grandiflora est inscrite depuis 2016 dans la liste des espèces exotiques envahissantes préoccupantes pour l’Union européenne. Cela signifie qu\'elle ne peut pas être importée, cultivée, commercialisée, plantée, ou libérée intentionnellement dans la nature, et ce nulle part dans l’Union européenne.', 'Plante', 'Ete', 'Ete'),
(27, NULL, 'Lemna minuta', 'Lentille d’eau minuscule', 0.5, 'Vert', 1, 1, 'Blanc', 'Vert', 'Partout', '', 'Cette lentille d’eau se reconnaît principalement à sa petite taille, ses feuilles souvent allongées et d’un gris bleuâtre.', 'Plante', 'Printemps', 'Ete'),
(28, NULL, 'Acacia dealbata', 'Mimosa d\'hiver', 2500, 'Vert', 1, 1, 'Jaune', 'Marron', 'Partout', '', 'Cet arbre ou arbrisseau, qui peut atteindre 25 m de haut à l\'état sauvage (les variétés domestiques ne dépassant généralement pas les 8 m), possède un tronc lisse de couleur gris-bleu à gris-brun, dont la base se fissure avec l\'âge.\r\n\r\nSes rameaux sans épines, duveteux, portent des feuilles composées dont la longueur est comprise généralement entre 8 et 12 cm (occasionnellement 17 cm) et la largeur entre 1 et 11 cm. Le mimosa a une forte croissance. Son jeune bois demeure ainsi très cassant et coupant.', 'Arbre', 'Hiver', 'Printemps'),
(29, NULL, 'Myriophyllum aquaticum', 'Myriophylle aquatique', 60, 'Vert', 1, 1, 'Rose', 'Vert', 'Partout', '', 'Myriophyllum aquaticum (synonyme Myriophyllum brasiliense), appelé en français Myriophylle aquatique ou Myriophylle du Brésil (en anglais, Parrot\'s Feather), elle est souvent vendue sous le nom Myriophyllum propium. Elle est de la famille des Haloragaceae, c\'est une plante herbacée, vivace et amphibie.\r\n\r\nCette plante se développe de préférence dans les eaux relativement chaudes et stagnantes, mais présente une grande capacité d\'adaptation. Elle est d\'ailleurs considérée comme invasive : originaire d\'Amérique du Sud, on la retrouve aujourd\'hui un peu partout dans le monde. Elle figure sur la liste des espèces exotiques envahissantes préoccupantes pour l’Union européenne adoptée le 13 juillet 2016 par la Commission européenne. Cela signifie qu\'elle ne peut pas être importée, cultivée, commercialisée, plantée, ou libérée intentionnellement dans la nature, et ce nulle part dans l’Union européenne.', 'Plante', 'Printemps', 'Ete'),
(30, NULL, 'Paspalum dilatatum', 'Paspale dilaté', 100, 'Vert', 1, 1, 'Violet', 'Marron', ' Bouches-du-Rhône, la Gironde, la vallée du Rhône, le Lot, l\'Aveyron, Bretagne, Île-de-France', '', 'C\'est une Plante herbacée vivace, cespiteuse, stolonifère, à la tige dressée pouvant atteindre de 40 à 180 cm de long, et aux inflorescences composées de racèmes élancés.', 'Plante', 'Ete', 'Ete'),
(31, NULL, 'Paspalum distichum', 'Paspale distique', 100, 'Vert', 1, 1, 'Noir', 'Marron', 'Partout', '', '\r\nPaspalum distichum, le paspale distique ou paspale à deux épis, est une espèce de plantes monocotylédones de la famille des Poaceae, sous-famille des Panicoideae, probablement originaire d\'Amérique.\r\n\r\nC\'est une plante herbacée, vivace, traçante grâce à ses rhizomes et ses nombreux stolons grêles et allongés, formant souvent des tapis lâches. Elle est considérée en Europe comme une plante envahissante.', 'Plante', 'Ete', 'Ete'),
(32, NULL, 'Fallopia sachalinensis', 'Renouée de Sakhaline', 300, 'Vert', 1, 1, 'Blanc', 'Blanc', 'Partout', '', 'Fallopia sachalinensis, la Renouée de Sakhaline est une espèce de plantes envahissantes de la famille des Polygonacées. Selon les sources, cette espèce est incluse dans le genre Fallopia ou dans le genre Reynoutria.', 'Plante', 'Ete', 'Ete'),
(33, NULL, 'Reynoutria japonica', 'Renouée du Japon ', 300, 'Vert', 1, 1, 'Blanc', 'Marron', 'Partout', '', 'La Renouée du Japon ou Renouée à feuilles pointues (Reynoutria japonica ou Fallopia japonica suivant les sources) est une espèce de plantes herbacées vivaces de la famille des Polygonaceae originaire d’Asie orientale, naturalisée en Europe dans une grande diversité de milieux humides. Il existe un usage local du terme de « Renouée du Japon » au sens large pour désigner les deux espèces Renouée du Japon et Renouée de Sakhaline, et leurs hybrides (R. × bohemica). Mais au sens strict, ce sont deux espèces distinctes.', 'Plante', 'Ete', 'Automne'),
(34, NULL, 'Rhododendron ponticum', 'Rhododendron ', 400, 'Vert', 1, 1, 'Violet', 'Vert', 'Partout', '', 'Rhododendron ponticum est une plante à fleurs du genre Rhododendron de la famille des Éricacées. Elle est originaire d\'Europe méditerranéenne et d\'Asie du sud-ouest. Mais elle est surtout connue pour être devenue invasive dans le Nord-Ouest de l’Europe, notamment en France, Belgique, Pays-Bas et en Grande-Bretagne.', 'Plante', 'Ete', 'Ete'),
(35, NULL, 'Robinia pseudoacacia', 'Robinier faux-acacia', 3000, 'Vert', 1, 1, 'Blanc', 'Marron', 'Partout', '', 'Le robinier faux-acacia ou robinier (Robinia pseudoacacia) est une espèce de la famille des Fabacées (légumineuses de la sous-famille des Viciaceae). Cet arbre présente des fleurs zygomorphes caractéristiques chez les Fabacées. Ses fruits sont des gousses ressemblant à un haricot plat avec des graines à l\'intérieur.', 'Plante', 'Printemps', 'Printemps'),
(36, NULL, 'Senecio inaequidens', 'Séneçon de Mazamet', 100, 'Vert', 1, 1, 'Jaune', 'Blanc', 'Partout', '', 'Senecio inaequidens, le séneçon de Mazamet ou séneçon du Cap, est une espèce de plantes dicotylédones de la famille des Asteraceae (Composées), sous-famille des Asteroideae, originaire d\'Afrique australe. Cette espèce a été introduite en Euope pour la première fois en Allemagne en 1889, et en France dans les années 1930, et s\'est naturalisée dans une grande partie de l\'Europe. La plante est parfois appelée « séneçon sud-africain ». Cette plante offre la particularité de fleurir quasiment toute l\'année, produit des alcaloïdes toxiques pour l\'être humain et le bétail, et représente par là-même un danger pour l\'agriculture.', 'Plante', 'Printemps', 'Printemps');

-- --------------------------------------------------------

--
-- Table structure for table `signalements`
--

CREATE TABLE `signalements` (
  `Id_signalement` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Id_plante` int(11) NOT NULL,
  `Ville` varchar(100) NOT NULL,
  `Coordonnees_GPS` varchar(100) NOT NULL,
  `Date_signalement` date NOT NULL,
  `Commentaire` varchar(1000) NOT NULL,
  `Photos` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signalements`
--

INSERT INTO `signalements` (`Id_signalement`, `Id_utilisateur`, `Id_plante`, `Ville`, `Coordonnees_GPS`, `Date_signalement`, `Commentaire`, `Photos`) VALUES
(1, 1, 1, 'test', 'test', '2022-02-23', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Id_utilisateur` int(10) UNSIGNED NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `Pseudo` varchar(100) NOT NULL,
  `Rang` int(3) NOT NULL DEFAULT '1',
  `Entreprise` tinyint(1) DEFAULT NULL,
  `URL_entreprise` varchar(200) DEFAULT NULL,
  `Photo` varchar(200) NOT NULL DEFAULT 'profil.jpg',
  `Nb_bon_signalement` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id_utilisateur`, `Email`, `Mdp`, `Pseudo`, `Rang`, `Entreprise`, `URL_entreprise`, `Photo`, `Nb_bon_signalement`) VALUES
(1, 'test@test.fr', 'test', 'Claire', 1, 0, NULL, '', 0),
(2, 't', 't', 't', 1, 0, NULL, 'profil.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`Id_ami`);

--
-- Indexes for table `plantes`
--
ALTER TABLE `plantes`
  ADD PRIMARY KEY (`Id_plante`);

--
-- Indexes for table `signalements`
--
ALTER TABLE `signalements`
  ADD PRIMARY KEY (`Id_signalement`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`Id_utilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amis`
--
ALTER TABLE `amis`
  MODIFY `Id_ami` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plantes`
--
ALTER TABLE `plantes`
  MODIFY `Id_plante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `signalements`
--
ALTER TABLE `signalements`
  MODIFY `Id_signalement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
