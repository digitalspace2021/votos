-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: politicosdevjvnt_politicos
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barrios`
--

DROP TABLE IF EXISTS `barrios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barrios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `comuna_id` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=441 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrios`
--

LOCK TABLES `barrios` WRITE;
/*!40000 ALTER TABLE `barrios` DISABLE KEYS */;
INSERT INTO `barrios` VALUES (1,'1. Augusto e Medina',1),(2,'2. Baltazar',1),(3,'3. Centro ',1),(4,'4. Combeima',1),(5,'5. Estacion',1),(6,'6. Interlaken',1),(7,'7. La Pola ',1),(8,'8. Libertador',1),(9,'9. Pola Parte Alta',1),(10,'10. Pueblo Nuevo ',1),(11,'11. San Pedro Alejandrino ',1),(12,'12. 20 De Julio ',2),(13,'13. 7 De Agosto',2),(14,'14. Alaska',2),(15,'15. Ancon ',2),(16,'16. Belen',2),(17,'17. Belencito',2),(18,'18. Centenario',2),(19,'19. Cerro Pan de Azucar',2),(20,'20. Clarita Botero',2),(21,'21. La Aurora',2),(22,'22. La Paz',2),(23,'23. La Sofia',2),(24,'24. La Trinidad',2),(25,'25. Malavar',2),(26,'26. Paraiso',2),(27,'27. San Diego',2),(28,'28. Santa Barbara',2),(29,'29. Santa Cruz ',2),(30,'30. VI Brigada',2),(31,'31.  Vida De Calambeo ',2),(32,'32. Villa Adriana ',2),(33,'33. Antonio Nariño',3),(34,'34. Belalcazar',3),(35,'35. Calambeo',3),(36,'36. Carmenza Rocha ',3),(37,'37. El Carmen',3),(38,'38. Fenalco',3),(39,'39. Gaitan Parte Alta',3),(40,'40. Inem',3),(41,'41. La Esperanza',3),(42,'42. La Granja',3),(43,'43. Las Acacias',3),(44,'44. San Simon Parte Alta',3),(45,'45. San Simon Parte Baja',3),(46,'46. Villa Ilusion',3),(47,'47. Villa Pinzon',3),(48,'48. Villa Valentina',3),(49,'49. Viveros',3),(50,'50. Alfonzo Lopez',4),(51,'51. Calarca',4),(52,'52. Cambulos',4),(53,'53. Caracoli',4),(54,'54. Castilla',4),(55,'55. Gaitan',4),(56,'56. Jakaranda',4),(57,'57. Jesus Maria Cordoba',4),(58,'58. Jose Maria Cordoba Parte Baja',4),(59,'59. Limonar',4),(60,'60. Limonar V Sector',4),(61,'61. Onzaga',4),(62,'62. Piedra Pintada',4),(63,'63. Pijao',4),(64,'64. Restrepo',4),(65,'65. Rincon Piedra Pintada',4),(66,'66. San Carlos ',4),(67,'67. San Luis',4),(68,'68. Sorrento',4),(69,'69. Toscana',4),(70,'70. Triunfo',4),(71,'71. Villa Marle II',4),(72,'72. Villa Marlen I',4),(73,'73. Villa Tereza ',4),(74,'74. 4 Etapa Del Jordan',5),(75,'75. 6 Etapa Del Jordan',5),(76,'76. 7 Etapa Del Jordan',5),(77,'77. 8 Etapa Del Jordan',5),(78,'78. 9 Etapa Del Jordan',5),(79,'79. Andalucia',5),(80,'80. Arboleda Margaritas',5),(81,'81. Arkacentro',5),(82,'82. Arkamonica',5),(83,'83. Arrayanes',5),(84,'84. Calatayud',5),(85,'85. Conjunto Residencial La Alameda',5),(86,'86. Cordobita',5),(87,'87. El Eden',5),(88,'88. La Campiña',5),(89,'89. La Ladera',5),(90,'90. Las Margaritas ',5),(91,'91. Las Orquideas ',5),(92,'92. Macadamia',5),(93,'93. Multifamiliares El Jordan',5),(94,'94. Multifamiliares Las Margaritas',5),(95,'95. Prados Del Norte',5),(96,'96. Rincon De La Campiña',5),(97,'97. San Jacinto',5),(98,'98. Torre Ladera',5),(99,'99. Urb. Aimara I',5),(100,'100. Urb. Aimara II',5),(101,'101. Urb. Rincon de las Margaritas',5),(102,'102. Urb. Los Ocobos ',5),(103,'103. Urb. Milenium I y II',5),(104,'104. Urb. Yacaira',5),(105,'105. Urb. Los Parrales',5),(106,'106. Agua Viva',6),(107,'107. Altos de San Francisco',6),(108,'108. Balcones Del Vergel',6),(109,'109. Bosques Del Vergel ',6),(110,'110. Brisas Del Pedregal ',6),(111,'111. Cadaveral I ',6),(112,'112. Cadaveral II',6),(113,'113. Caminos De Juan Pablo II',6),(114,'114. Caminos De San Francisco',6),(115,'115. Caminos Del Vergel ',6),(116,'116. Condominio Ronda Del Vergel ',6),(117,'117. Condominio Tierra Alta',6),(118,'118. Conjunto Cerrado Ambala',6),(119,'119. Conjunto Cerrado Los Balsos',6),(120,'120. El Mirador',6),(121,'121. El Triunfo',6),(122,'122. Estancia Del Vergel ',6),(123,'123. Fuente De Los Rosales ',6),(124,'124. Fuente De Los Rosales II',6),(125,'125. La Balsa',6),(126,'126. La Esperanza',6),(127,'127. La Gaviota',6),(128,'128. Las Delicias',6),(129,'129. Los Alpes',6),(130,'130. Los Angeles',6),(131,'131. Los Ciruelos ',6),(132,'132. Los Mandarinos',6),(133,'133. Montemadero',6),(134,'134. Monteverde del Vergel ',6),(135,'135. Palma Del Vergel ',6),(136,'136. Paseo De San Francisco',6),(137,'137. Palzas Del Bosque ',6),(138,'138. Portal Del Vergel',6),(139,'139. Primavera De Entre Rios ',6),(140,'140. Reservas Del Pedregal ',6),(141,'141. Rincon De San Francisco ',6),(142,'142. Rincon Del Pedregal I',6),(143,'143. Rincon del Pedregal II',6),(144,'144. Rincon Del Vergel ',6),(145,'145. San Antonio ',6),(146,'146. Tierra Linda Del Vergel ',6),(147,'147. Torre Fuente De Los Rosales ',6),(148,'148. Torres De La Calleja',6),(149,'149. Urb. Arkala I',6),(150,'150. Urb. Arkambuco I',6),(151,'151. Urb. Colinas Del Norte ',6),(152,'152. Urb. Pedregal ',6),(153,'153. Urb. Villa Patricia',6),(154,'154. Urb. Altos De Ambala ',6),(155,'155. Urb. Altos De Pedregal ',6),(156,'156. Urb. Ambala ',6),(157,'157. Urb. Antares I',6),(158,'158. Urb. Antares II',6),(159,'159. Urb. Arkala II',6),(160,'160. Urb. Chicala ',6),(161,'161. Urb. Entre Rios ',6),(162,'162. Urb. Entre Rios II',6),(163,'163. Urb. Fuente De Los Rosale I ',6),(164,'164. Urb. Girasol',6),(165,'165. Urb. Ibague 2000',6),(166,'166. Urb. Los Cambulos ',6),(167,'167. Urb. Los Gualandayes',6),(168,'168. Urb. Villa Vanesa ',6),(169,'169. Villa Gloria ',6),(170,'170. Alamos ',7),(171,'171. Chico',7),(172,'172. El Salado ',7),(173,'173. Hacienda El Recreo',7),(174,'174. Los Musicos',7),(175,'175. Mirador De Cantabria ',7),(176,'176. Modelia I',7),(177,'177. Modelia II',7),(178,'178. Nueva Bilbao',7),(179,'179. Pedro Ignacio Villamarin ',7),(180,'180. Rosales De Tahilandia ',7),(181,'181. Santa Ana',7),(182,'182. Sector los Alpes',7),(183,'183. Timaka',7),(184,'184. Urb. Santa Coloma',7),(185,'185. Urb. Alameda',7),(186,'186. Urb. Alberto Lleras C.',7),(187,'187. Urb. Ambikaima',7),(188,'188. Urb. Cantabria',7),(189,'189. Urb. Comfatolima',7),(190,'190. Urb. Diana Milaidy',7),(191,'191. Urb. El Dorado ',7),(192,'192. Urb. El Limon',7),(193,'193. Urb. EL Palmar',7),(194,'194. Urb. Fuente Del Salado ',7),(195,'195. Urb. Fuente Santa ',7),(196,'196. Urb. La cabaña',7),(197,'197. Urb. La Candelaria ',7),(198,'198. Urb. La Floresta',7),(199,'199. Urb. La Victoria',7),(200,'200. Lady Di',7),(201,'201. Urb. Los Lagos ',7),(202,'202. Urb. Monte Carlos II',7),(203,'203. Urb. Oviedo',7),(204,'204. Urb. Pacande',7),(205,'205. Urb. Palma Del Rio ',7),(206,'206. Urb. Palo Grande',7),(207,'207. Urb. Portales Del Norte ',7),(208,'208. Urb. Praderas Del Norte',7),(209,'209. Urb. Reservas De Cantabria ',7),(210,'210. Urb. San Luis ',7),(211,'211. Urb. San Luis Gonzaga',7),(212,'212. Urb. San Luisu',7),(213,'213. Urb. San Pablo',7),(214,'214. Urb. San Sebastian ',7),(215,'215. Urb. Santa Catalina I',7),(216,'216. Urb. Santa Monica',7),(217,'217. Urb. Shaddi',7),(218,'218. Urb. Territorio De Paz',7),(219,'219. Urb. Tierra Firme',7),(220,'220. Urb. Villa Brasilia',7),(221,'221. Urb. Villa Camila',7),(222,'222. Urb. Villa Cindy',7),(223,'223. Urb. Villa Clara I',7),(224,'224. Urb. Villa Clara II',7),(225,'225. Urb. Villa Julieta ',7),(226,'226. Urb. Villa Rocio ',7),(227,'227. Urb. Villa Sulay ',7),(228,'228. Urb. La Ceiba Norte ',7),(229,'229. Villa Martha',7),(230,'230. Villa Salome ',7),(231,'231. Villa suiza ',7),(232,'232. Atolsure ',8),(233,'233. Caminos Del Bosque ',8),(234,'234. Ciudadela Simon Bolivar I',8),(235,'235. Ciudadela Simon Boliva II',8),(236,'236. Ciudadela Simon Boliva III',8),(237,'237. Conj. Residencial San Joaquin ',8),(238,'238. El Bunde I, II y III',8),(239,'239. German Hurtas ',8),(240,'240. Jardin I',8),(241,'241. Jardin III',8),(242,'242. Jardin Parte Baja',8),(243,'243. Jardin Santander I, II y III',8),(244,'244. Jardin Valparaiso ',8),(245,'245. La Cima I ',8),(246,'246. La Cima II',8),(247,'247. Musicalia ',8),(248,'248. Palermo ',8),(249,'249. Portal Del Jardin ',8),(250,'250. Reservas Del Jardin ',8),(251,'251. Roberto Augusto Calderon ',8),(252,'252. San Gelato ',8),(253,'253. Topacio ',8),(254,'254. Tulio Varon ',8),(255,'255. Unidad Residencial Carabineros ',8),(256,'256. Urb. 2 de Junio',8),(257,'257. Urb. Agua Marina ',8),(258,'258. Urb. Altos de Vasconia ',8),(259,'259. Urb. Antonio Maria. ',8),(260,'260. Urb. Brisas de Vasconia ',8),(261,'261. Urb. Buenaventura Garcia ',8),(262,'262. Urb. Ciudad Blanca ',8),(263,'263. Urb. El Palmar I',8),(264,'264. Urb. El Palmar II',8),(265,'265. Urb. El Prado I ',8),(266,'266. Urb. El Prado II ',8),(267,'267. Urb. Jardin Atolsure ',8),(268,'268. Urb. Jardin Av',8),(269,'269. Urb. Jardin Chipalo ',8),(270,'270. Urb. Jardin Chipalo II',8),(271,'271. Urb. Jardin II',8),(272,'272. Urb. Jardin Porvenir ',8),(273,'273. Urb. Jardin VI',8),(274,'274. Urb. Jardines Del Campo ',8),(275,'275. Urb. La Esmeralda ',8),(276,'276. Urb. Las Acacias ',8),(277,'277. Urb. Los Comuneros ',8),(278,'278. Urb. Los Laureles ',8),(279,'279. Urb. Pinos ',8),(280,'280. Urb. Nueva Castilla',8),(281,'281. Urb. Nueva Colombia ',8),(282,'282. Urb. Nuevo Armero ',8),(283,'283. Urb. Nuevo Combeima ',8),(284,'284. Urb. Portal de Arkala ',8),(285,'285. Urb. Protecho ',8),(286,'286. Urb. Quinta Av ',8),(287,'287. Urb. Tolima Grande ',8),(288,'288. Urb. Vasconia ',8),(289,'289. Urb. Vasconia Reservado ',8),(290,'290. Urb. Villa Del Norte ',8),(291,'291. Urb. Villa Del Palmar ',8),(292,'292. Urb. Villa Del Sol ',8),(293,'293. Urb. Villa Esperanza ',8),(294,'294. Urb. Villa Jardin ',8),(295,'295. Urb. Villa La Paz ',8),(296,'296. Urb. Magdalena ',8),(297,'297. Urb. Villa Marcela ',8),(298,'298. Urb. Villa Vicentina ',8),(299,'299. Villa Cristales ',8),(300,'300. Yerbabuena ',8),(301,'301. 2 Etapa del Jordan ',9),(302,'302. Alfonso Uribe Badillo ',9),(303,'303. Altamira',9),(304,'304. Aparco',9),(305,'305. Arboleda ',9),(306,'306. Arkaniza I',9),(307,'307. Arkaniza II',9),(308,'308. Arkaparaiso ',9),(309,'309. Bello Horizonte ',9),(310,'310. Bosque De La Alameda ',9),(311,'311. Carrenales ',9),(312,'312. Conj. Las Palmeras  ',9),(313,'313. Conj. Residencial Valparaiso ',9),(314,'314. El Tunal ',9),(315,'315. Hacienda Piedra Pintada ',9),(316,'316. Jordan 3 Etapa ',9),(317,'317. Jordan 1 Etapa ',9),(318,'318. La Floresta ',9),(319,'319. Los Tunjos ',9),(320,'320. Picaleñita ',9),(321,'321. Picaleña ',9),(322,'322. Portal De Los Tunjos ',9),(323,'323. Reservas Del Campestre ',9),(324,'324. Rincon De Las Americas ',9),(325,'325. Rincon Del Campestre',9),(326,'326. San Francisco ',9),(327,'327. San Remo ',9),(328,'328. Urb. Bosque De Varsovia ',9),(329,'329. Urb. Chaquen',9),(330,'330. Urb. Ciudad Luz',9),(331,'331. Urb. Comfenalco ',9),(332,'332. Urb. Coopdiasam',9),(333,'333. Urb. Cutucumay ',9),(334,'334. Urb. El Poblado ',9),(335,'335. Urb. Las Americas ',9),(336,'336. Urb. Las Flores',9),(337,'337. Urb. Los Remansos',9),(338,'338. Urb. Miraflores',9),(339,'339. Urb. Nuevo Horizonte ',9),(340,'340. Urb. Portal Campestre ',9),(341,'341. Urb. Padreras De Santa Rita',9),(342,'342. Urb. Tahiti',9),(343,'343. Urb. Varsovia ',9),(344,'344. Urb. Villa Arkadia ',9),(345,'345. Urb. Villa Café ',9),(346,'346. Urb. Villa De La Candelaria ',9),(347,'347. Urb. Villa Luz ',9),(348,'348. Urb. Villa Yuli ',9),(349,'349. Valparaiso I',9),(350,'350. Valparaiso  II',9),(351,'351. Valparaiso  III',9),(352,'352. Valparaiso  IV',9),(353,'353. Versalles ',9),(354,'354. Villa Carvajalita ',9),(355,'355. Villa Del Pilar ',9),(356,'356. Villa Maria ',9),(357,'357. Villa Natalia ',9),(358,'29. Arkalena ',10),(359,'358. Bosques De Santa Helena',10),(360,'359. Boyaca ',10),(361,'360. Cadiz ',10),(362,'361. Casa Club ',10),(363,'362. Castellana ',10),(364,'363. Claret ',10),(365,'364. Departamental ',10),(366,'365. Federico Lleras ',10),(367,'366. Hipodromo ',10),(368,'367. La Francia ',10),(369,'368. Las Palmas ',10),(370,'369. Laureles ',10),(371,'370. Macarena Parte Alta ',10),(372,'371. Macarena Parte Baja ',10),(373,'372. Magisterio ',10),(374,'373. Metaima Alta ',10),(375,'374. Metaima Parte Baja ',10),(376,'375. Montealegre ',10),(377,'376. Nacional ',10),(378,'377. Naciones Unidas ',10),(379,'378. San Cayetano ',10),(380,'379. Santa Helena ',10),(381,'380. Santander ',10),(382,'381. 12 De Octubre ',11),(383,'382. Alto De La Cruz ',11),(384,'383. America ',11),(385,'384. Arado ',11),(386,'385. Bosque Parte Alta ',11),(387,'386. Bosque Parte Baja ',11),(388,'387. El Refugio II ',11),(389,'388. El Refugio II ',11),(390,'389. Garzon ',11),(391,'390. Independiente ',11),(392,'391. La Isla ',11),(393,'392. La Martinica',11),(394,'393. Las Brisas ',11),(395,'394. Las Ferias ',11),(396,'395. Libertad ',11),(397,'396. Los Martires ',11),(398,'397. Peñon ',11),(399,'398. Popular ',11),(400,'399. Rodriguez Andrade ',11),(401,'400. San Vicente De Paul ',11),(402,'401. Uribe Uribe ',11),(403,'402. Villa Del Rio ',11),(404,'403. Villa Maria ',11),(405,'404. Andres Lopez De Galarza ',12),(406,'405. Avenida ',12),(407,'406. Colonias De Asprovi ',12),(408,'407. Galan ',12),(409,'408. Industrial ',12),(410,'409. Keneddy ',12),(411,'410. La Gaitana ',12),(412,'411. La Padera',12),(413,'412. La Reforma ',12),(414,'413. Las Vegas ',12),(415,'414. Matallana ',12),(416,'415. Murillo Toro ',12),(417,'416. Ricaurte ',12),(418,'417. Rosa Badillo ',12),(419,'418. Santofimio ',12),(420,'419. Urb. Arkaima ',12),(421,'420. Urb. Divino Niño ',12),(422,'421. Urb. Terrazas Del Tejar ',12),(423,'422. Venecia ',12),(424,'423. Villa Claudia ',12),(425,'424. Villa Luces ',12),(426,'425. Yuldaima ',12),(427,'426. Albania ',13),(428,'427. Boqueron ',13),(429,'428. Cerro Granate',13),(430,'429. Colina 1',13),(431,'430. Colina 2',13),(432,'431. Dario Echandia ',13),(433,'432. Granada ',13),(434,'433. Isla ',13),(435,'434. Jazmin ',13),(436,'435. La Union ',13),(437,'436. Miramar ',13),(438,'437. San Isidro ',13),(439,'438. Terrazas De Boqueron ',13),(440,'439. Villa Mery ',13);
/*!40000 ALTER TABLE `barrios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidatos`
--

DROP TABLE IF EXISTS `candidatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidatos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifcacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidatos`
--

LOCK TABLES `candidatos` WRITE;
/*!40000 ALTER TABLE `candidatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Alcalde','es el gobierna y administra un municipio','2023-02-21 03:10:45','2023-02-21 03:25:21'),(2,'Concejal','control politico de un muncipio','2023-02-21 03:10:33','2023-03-15 02:27:20'),(3,'Gorbernador','Gorbernador departamental','2023-04-27 04:36:17','2023-04-27 04:36:17');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comunas`
--

DROP TABLE IF EXISTS `comunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comunas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comunas`
--

LOCK TABLES `comunas` WRITE;
/*!40000 ALTER TABLE `comunas` DISABLE KEYS */;
INSERT INTO `comunas` VALUES (1,'comuna  1'),(2,'comuna  2'),(3,'comuna  3'),(4,'comuna  4'),(5,'comuna  5'),(6,'comuna  6'),(7,'comuna  7'),(8,'comuna  8'),(9,'comuna  9'),(10,'comuna  10'),(11,'comuna  11'),(12,'comuna  12');
/*!40000 ALTER TABLE `comunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `corregimientos`
--

DROP TABLE IF EXISTS `corregimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `corregimientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corregimientos`
--

LOCK TABLES `corregimientos` WRITE;
/*!40000 ALTER TABLE `corregimientos` DISABLE KEYS */;
INSERT INTO `corregimientos` VALUES (1,'1 DANTAS '),(2,'2 LAURELES'),(3,'3 COELLO DE COCORA '),(4,'4 GAMBOA'),(5,'5 TAPIAS'),(6,'6 TOCHE'),(7,'7 JUNTAS'),(8,'8 VILLA RESTREPO '),(9,'9 CAY'),(10,'10 CALAMBEO '),(11,'11 SAN JUAN DE LA CHINA'),(12,'12 SAN BERNANDO '),(13,'13 SALADO '),(14,'14 BUENOS AIRES'),(15,'15 CARMEN DE BULIRA'),(16,'16 EL TOTUMO'),(17,'17 LA FLORIDA');
/*!40000 ALTER TABLE `corregimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formularios`
--

DROP TABLE IF EXISTS `formularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formularios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `propietario_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puesto_votacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidato_id` bigint unsigned DEFAULT NULL,
  `identificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formularios`
--

LOCK TABLES `formularios` WRITE;
/*!40000 ALTER TABLE `formularios` DISABLE KEYS */;
/*!40000 ALTER TABLE `formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador','web','2022-12-08 10:12:30','2022-12-08 10:12:30'),(2,'simple','web','2022-12-08 10:12:30','2022-12-08 10:12:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@app.com',NULL,'$2y$10$9GcVE6uLN0K1KmB48rr/YuMnzC9AAfncxSbZ96oZZMWLyittYqVoa','','2022-12-08 10:12:30','2022-12-08 10:12:30'),(9,'test','test@test.com',NULL,'$2y$10$wNpypYVZ3zXL911xtv6jve6ff7ufaNDr4EmXsUL90uZzjPn7OIUEa',NULL,'2023-06-22 04:06:18','2023-06-22 04:07:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veredas`
--

DROP TABLE IF EXISTS `veredas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veredas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `corregimiento_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veredas`
--

LOCK TABLES `veredas` WRITE;
/*!40000 ALTER TABLE `veredas` DISABLE KEYS */;
INSERT INTO `veredas` VALUES (1,'Dantas',1),(2,'Dantas De Las Pavas ',1),(3,'Alaska',1),(4,'Altamira',2),(5,'Laureles',2),(6,'Los Pastos Cocora',2),(7,'Salitre Cocora',2),(8,'San Rafael ',2),(9,'Coello Cocora ',3),(10,'Honduras',3),(11,'La Cima',3),(12,'La Linda',3),(13,'Loma De Cocora',3),(14,'Morrochusco',3),(15,'San Cristobal p/a',3),(16,'San Cristobal p/b',3),(17,'San Francisco ',3),(18,'San Isidro',3),(19,'San Simón alto',3),(20,'San Simón bajo',3),(21,'Santa Ana',3),(22,'Santa Barbara ',3),(23,'Curalito',4),(24,'Gamboa',4),(25,'Los Naranjos',4),(26,'Penaranda Alta',4),(27,'Penaranda Baja',4),(28,'Perico',4),(29,'Tambo',4),(30,'Cataima',5),(31,'Cataimita',5),(32,'El Guaico',5),(33,'El Ingenio',5),(34,'El Moral',5),(35,'Tapias',5),(36,'Alto de Toche ',6),(37,'Coello San Juan ',6),(38,'Quebradas',6),(39,'Toche',6),(40,'Juntas ',7),(41,'Astilleros ',8),(42,'Berlin',8),(43,'Chapeton  Sector Rural',8),(44,'El corazon ',8),(45,'El Retiro ',8),(46,'El secreto ',8),(47,'La Maria Combeima',8),(48,'La Maria piedra Grande la cima ',8),(49,'La Plata del Brillante ',8),(50,'La Platica ',8),(51,'Llanitos',8),(52,'Pastales Viejo y Nuevo ',8),(53,'Pico de Oro ',8),(54,'Puerto Peru Llanitos p/a',8),(55,'Ramos y Astilleros ',8),(56,'Tres Esquinas ',8),(57,'Villa Restrepo ',8),(58,'Cay p/b',9),(59,'Cay p/a',9),(60,'El Cural ',9),(61,'El Gallo ',9),(62,'La Cascada',9),(63,'La Coqueta',9),(64,'La Victoria',9),(65,'Pie de cuestas las amarillas',9),(66,'Santa Teresa',9),(67,'Alaska',10),(68,'Ambala p/a',10),(69,'Ambala Sector el Triunfo',10),(70,'Ancon Tesorito p/a',10),(71,'Ancon Tesorito p/b',10),(72,'Ancon Tesorito Sector Los Pinos',10),(73,'Bellavista',10),(74,'Calambeo ',10),(75,'La pedregoza',10),(76,'San Antonio-Ambala',10),(77,'Aures',11),(78,'China Media',11),(79,'El Rubi',11),(80,'La Isabela',11),(81,'La Pluma',11),(82,'LA Beta ',11),(83,'La Violeta',11),(84,'Puente Tierra',11),(85,'San Juan de la China',11),(86,'El Ecuador',12),(87,'La flor ',12),(88,'Mina Vieja',12),(89,'Rodeito',12),(90,'San Antonio',12),(91,'San Bernando',12),(92,'San Cay Etano Bajo',12),(93,'San Cay Etano Alto',12),(94,'Santa Rita',12),(95,'Yatay',12),(96,'Carrizales',13),(97,'Chembe',13),(98,'China Alta',13),(99,'Chucuni',13),(100,'El Colegio',13),(101,'El Jaguo',13),(102,'La Belleza',13),(103,'La Espereranza',13),(104,'La Helena',13),(105,'La Maria China',13),(106,'La Palmilla',13),(107,'Alto de Gualanday',14),(108,'Briceño',14),(109,'Buenos Aires',14),(110,'Picaleña Sector Rural',14),(111,'Carmen de Bulira',15),(112,'La Cueva ',15),(113,'Los Cauchos p/a',15),(114,'Los Cauchos p/b',15),(115,'Alto del Combeima',16),(116,'Aparco',16),(117,'Canadas Potrerito',16),(118,'Charco Rico Bajo',16),(119,'Cural Combeima',16),(120,'El Rodeo',16),(121,'El Salitre',16),(122,'El Totumo',16),(123,'La Montana',16),(124,'Llano del Combeima',16),(125,'Martinica p/a',16),(126,'Martinica p/b',16),(127,'Potrero Grande ',16),(128,'El Tejar I -II',17),(129,'El Cedral',17),(130,'Charco Rico Alto',17),(131,'La Florida p/a',17),(132,'La Floridap/b',17);
/*!40000 ALTER TABLE `veredas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-07  8:47:12
