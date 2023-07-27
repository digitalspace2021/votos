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
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_actividad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_actividad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_actividad` date NOT NULL,
  `evidencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `actividades_id_user_foreign` (`id_user`),
  CONSTRAINT `actividades_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barrios`
--

DROP TABLE IF EXISTS `barrios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barrios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `comuna_id` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=442 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrios`
--

LOCK TABLES `barrios` WRITE;
/*!40000 ALTER TABLE `barrios` DISABLE KEYS */;
INSERT INTO `barrios` VALUES (1,'1. Augusto e Medina',1),(2,'2. Baltazar',1),(3,'3. Centro',1),(4,'4. Combeima',1),(5,'5. Estacion',1),(6,'6. Interlaken',1),(7,'7. La Pola',1),(8,'8. Libertador',1),(9,'9. Pola Parte Alta',1),(10,'10. Pueblo Nuevo',1),(11,'11. San Pedro Alejandrino',1),(12,'12. 20 De Julio',2),(13,'13. 7 De Agosto',2),(14,'14. Alaska',2),(15,'15. Ancon',2),(16,'16. Belen',2),(17,'17. Belencito',2),(18,'18. Centenario',2),(19,'19. Cerro Pan de Azucar',2),(20,'20. Clarita Botero',2),(21,'21. La Aurora',2),(22,'22. La Paz',2),(23,'23. La Sofia',2),(24,'24. La Trinidad',2),(25,'25. Malavar',2),(26,'26. Paraiso',2),(27,'27. San Diego',2),(28,'28. Santa Barbara',2),(29,'29. Santa Cruz',2),(30,'30. VI Brigada',2),(31,'31.  Vida De Calambeo',2),(32,'32. Villa Adriana',2),(33,'33. Antonio Nariño',3),(34,'34. Belalcazar',3),(35,'35. Calambeo',3),(36,'36. Carmenza Rocha',3),(37,'37. El Carmen',3),(38,'38. Fenalco',3),(39,'39. Gaitan Parte Alta',3),(40,'40. Inem',3),(41,'41. La Esperanza',3),(42,'42. La Granja',3),(43,'43. Las Acacias',3),(44,'44. San Simon Parte Alta',3),(45,'45. San Simon Parte Baja',3),(46,'46. Villa Ilusion',3),(47,'47. Villa Pinzon',3),(48,'48. Villa Valentina',3),(49,'49. Viveros',3),(50,'50. Alfonzo Lopez',4),(51,'51. Calarca',4),(52,'52. Cambulos',4),(53,'53. Caracoli',4),(54,'54. Castilla',4),(55,'55. Gaitan',4),(56,'56. Jakaranda',4),(57,'57. Jesus Maria Cordoba',4),(58,'58. Jose Maria Cordoba Parte Baja',4),(59,'59. Limonar',4),(60,'60. Limonar V Sector',4),(61,'61. Onzaga',4),(62,'62. Piedra Pintada',4),(63,'63. Pijao',4),(64,'64. Restrepo',4),(65,'65. Rincon Piedra Pintada',4),(66,'66. San Carlos',4),(67,'67. San Luis',4),(68,'68. Sorrento',4),(69,'69. Toscana',4),(70,'70. Triunfo',4),(71,'71. Villa Marle II',4),(72,'72. Villa Marlen I',4),(73,'73. Villa Tereza',4),(74,'74. 4 Etapa Del Jordan',5),(75,'75. 6 Etapa Del Jordan',5),(76,'76. 7 Etapa Del Jordan',5),(77,'77. 8 Etapa Del Jordan',5),(78,'78. 9 Etapa Del Jordan',5),(79,'79. Andalucia',5),(80,'80. Arboleda Margaritas',5),(81,'81. Arkacentro',5),(82,'82. Arkamonica',5),(83,'83. Arrayanes',5),(84,'84. Calatayud',5),(85,'85. Conjunto Residencial La Alameda',5),(86,'86. Cordobita',5),(87,'87. El Eden',5),(88,'88. La Campiña',5),(89,'89. La Ladera',5),(90,'90. Las Margaritas',5),(91,'91. Las Orquideas',5),(92,'92. Macadamia',5),(93,'93. Multifamiliares El Jordan',5),(94,'94. Multifamiliares Las Margaritas',5),(95,'95. Prados Del Norte',5),(96,'96. Rincon De La Campiña',5),(97,'97. San Jacinto',5),(98,'98. Torre Ladera',5),(99,'99. Urb. Aimara I',5),(100,'100. Urb. Aimara II',5),(101,'101. Urb. Rincon de las Margaritas',5),(102,'102. Urb. Los Ocobos',5),(103,'103. Urb. Milenium I y II',5),(104,'104. Urb. Yacaira',5),(105,'105. Urb. Los Parrales',5),(106,'106. Agua Viva',6),(107,'107. Altos de San Francisco',6),(108,'108. Balcones Del Vergel',6),(109,'109. Bosques Del Vergel',6),(110,'110. Brisas Del Pedregal',6),(111,'111. Cadaveral I',6),(112,'112. Cadaveral II',6),(113,'113. Caminos De Juan Pablo II',6),(114,'114. Caminos De San Francisco',6),(115,'115. Caminos Del Vergel',6),(116,'116. Condominio Ronda Del Vergel',6),(117,'117. Condominio Tierra Alta',6),(118,'118. Conjunto Cerrado Ambala',6),(119,'119. Conjunto Cerrado Los Balsos',6),(120,'120. El Mirador',6),(121,'121. El Triunfo',6),(122,'122. Estancia Del Vergel',6),(123,'123. Fuente De Los Rosales',6),(124,'124. Fuente De Los Rosales II',6),(125,'125. La Balsa',6),(126,'126. La Esperanza',6),(127,'127. La Gaviota',6),(128,'128. Las Delicias',6),(129,'129. Los Alpes',6),(130,'130. Los Angeles',6),(131,'131. Los Ciruelos',6),(132,'132. Los Mandarinos',6),(133,'133. Montemadero',6),(134,'134. Monteverde del Vergel',6),(135,'135. Palma Del Vergel',6),(136,'136. Paseo De San Francisco',6),(137,'137. Palzas Del Bosque',6),(138,'138. Portal Del Vergel',6),(139,'139. Primavera De Entre Rios',6),(140,'140. Reservas Del Pedregal',6),(141,'141. Rincon De San Francisco',6),(142,'142. Rincon Del Pedregal I',6),(143,'143. Rincon del Pedregal II',6),(144,'144. Rincon Del Vergel',6),(145,'145. San Antonio',6),(146,'146. Tierra Linda Del Vergel',6),(147,'147. Torre Fuente De Los Rosales',6),(148,'148. Torres De La Calleja',6),(149,'149. Urb. Arkala I',6),(150,'150. Urb. Arkambuco I',6),(151,'151. Urb. Colinas Del Norte',6),(152,'152. Urb. Pedregal',6),(153,'153. Urb. Villa Patricia',6),(154,'154. Urb. Altos De Ambala',6),(155,'155. Urb. Altos De Pedregal',6),(156,'156. Urb. Ambala',6),(157,'157. Urb. Antares I',6),(158,'158. Urb. Antares II',6),(159,'159. Urb. Arkala II',6),(160,'160. Urb. Chicala',6),(161,'161. Urb. Entre Rios',6),(162,'162. Urb. Entre Rios II',6),(163,'163. Urb. Fuente De Los Rosale I',6),(164,'164. Urb. Girasol',6),(165,'165. Urb. Ibague 2000',6),(166,'166. Urb. Los Cambulos',6),(167,'167. Urb. Los Gualandayes',6),(168,'168. Urb. Villa Vanesa',6),(169,'169. Villa Gloria',6),(170,'170. Alamos',7),(171,'171. Chico',7),(172,'172. El Salado',7),(173,'173. Hacienda El Recreo',7),(174,'174. Los Musicos',7),(175,'175. Mirador De Cantabria',7),(176,'176. Modelia I',7),(177,'177. Modelia II',7),(178,'178. Nueva Bilbao',7),(179,'179. Pedro Ignacio Villamarin',7),(180,'180. Rosales De Tahilandia',7),(181,'181. Santa Ana',7),(182,'182. Sector los Alpes',7),(183,'183. Timaka',7),(184,'184. Urb. Santa Coloma',7),(185,'185. Urb. Alameda',7),(186,'186. Urb. Alberto Lleras C.',7),(187,'187. Urb. Ambikaima',7),(188,'188. Urb. Cantabria',7),(189,'189. Urb. Comfatolima',7),(190,'190. Urb. Diana Milaidy',7),(191,'191. Urb. El Dorado',7),(192,'192. Urb. El Limon',7),(193,'193. Urb. EL Palmar',7),(194,'194. Urb. Fuente Del Salado',7),(195,'195. Urb. Fuente Santa',7),(196,'196. Urb. La cabaña',7),(197,'197. Urb. La Candelaria',7),(198,'198. Urb. La Floresta',7),(199,'199. Urb. La Victoria',7),(200,'200. Lady Di',7),(201,'201. Urb. Los Lagos',7),(202,'202. Urb. Monte Carlos II',7),(203,'203. Urb. Oviedo',7),(204,'204. Urb. Pacande',7),(205,'205. Urb. Palma Del Rio',7),(206,'206. Urb. Palo Grande',7),(207,'207. Urb. Portales Del Norte',7),(208,'208. Urb. Praderas Del Norte',7),(209,'209. Urb. Reservas De Cantabria',7),(210,'210. Urb. San Luis',7),(211,'211. Urb. San Luis Gonzaga',7),(212,'212. Urb. San Luisu',7),(213,'213. Urb. San Pablo',7),(214,'214. Urb. San Sebastian',7),(215,'215. Urb. Santa Catalina I',7),(216,'216. Urb. Santa Monica',7),(217,'217. Urb. Shaddi',7),(218,'218. Urb. Territorio De Paz',7),(219,'219. Urb. Tierra Firme',7),(220,'220. Urb. Villa Brasilia',7),(221,'221. Urb. Villa Camila',7),(222,'222. Urb. Villa Cindy',7),(223,'223. Urb. Villa Clara I',7),(224,'224. Urb. Villa Clara II',7),(225,'225. Urb. Villa Julieta',7),(226,'226. Urb. Villa Rocio',7),(227,'227. Urb. Villa Sulay',7),(228,'228. Urb. La Ceiba Norte',7),(229,'229. Villa Martha',7),(230,'230. Villa Salome',7),(231,'231. Villa suiza',7),(232,'232. Atolsure',8),(233,'233. Caminos Del Bosque',8),(234,'234. Ciudadela Simon Bolivar I',8),(235,'235. Ciudadela Simon Boliva II',8),(236,'236. Ciudadela Simon Boliva III',8),(237,'237. Conj. Residencial San Joaquin',8),(238,'238. El Bunde I, II y III',8),(239,'239. German Hurtas',8),(240,'240. Jardin I',8),(241,'241. Jardin III',8),(242,'242. Jardin Parte Baja',8),(243,'243. Jardin Santander I, II y III',8),(244,'244. Jardin Valparaiso',8),(245,'245. La Cima I',8),(246,'246. La Cima II',8),(247,'247. Musicalia',8),(248,'248. Palermo',8),(249,'249. Portal Del Jardin',8),(250,'250. Reservas Del Jardin',8),(251,'251. Roberto Augusto Calderon',8),(252,'252. San Gelato',8),(253,'253. Topacio',8),(254,'254. Tulio Varon',8),(255,'255. Unidad Residencial Carabineros',8),(256,'256. Urb. 2 de Junio',8),(257,'257. Urb. Agua Marina',8),(258,'258. Urb. Altos de Vasconia',8),(259,'259. Urb. Antonio Maria.',8),(260,'260. Urb. Brisas de Vasconia',8),(261,'261. Urb. Buenaventura Garcia',8),(262,'262. Urb. Ciudad Blanca',8),(263,'263. Urb. El Palmar I',8),(264,'264. Urb. El Palmar II',8),(265,'265. Urb. El Prado I',8),(266,'266. Urb. El Prado II',8),(267,'267. Urb. Jardin Atolsure',8),(268,'268. Urb. Jardin Av',8),(269,'269. Urb. Jardin Chipalo',8),(270,'270. Urb. Jardin Chipalo II',8),(271,'271. Urb. Jardin II',8),(272,'272. Urb. Jardin Porvenir',8),(273,'273. Urb. Jardin VI',8),(274,'274. Urb. Jardines Del Campo',8),(275,'275. Urb. La Esmeralda',8),(276,'276. Urb. Las Acacias',8),(277,'277. Urb. Los Comuneros',8),(278,'278. Urb. Los Laureles',8),(279,'279. Urb. Pinos',8),(280,'280. Urb. Nueva Castilla',8),(281,'281. Urb. Nueva Colombia',8),(282,'282. Urb. Nuevo Armero',8),(283,'283. Urb. Nuevo Combeima',8),(284,'284. Urb. Portal de Arkala',8),(285,'285. Urb. Protecho',8),(286,'286. Urb. Quinta Av',8),(287,'287. Urb. Tolima Grande',8),(288,'288. Urb. Vasconia',8),(289,'289. Urb. Vasconia Reservado',8),(290,'290. Urb. Villa Del Norte',8),(291,'291. Urb. Villa Del Palmar',8),(292,'292. Urb. Villa Del Sol',8),(293,'293. Urb. Villa Esperanza',8),(294,'294. Urb. Villa Jardin',8),(295,'295. Urb. Villa La Paz',8),(296,'296. Urb. Magdalena',8),(297,'297. Urb. Villa Marcela',8),(298,'298. Urb. Villa Vicentina',8),(299,'299. Villa Cristales',8),(300,'300. Yerbabuena',8),(301,'301. 2 Etapa del Jordan',9),(302,'302. Alfonso Uribe Badillo',9),(303,'303. Altamira',9),(304,'304. Aparco',9),(305,'305. Arboleda',9),(306,'306. Arkaniza I',9),(307,'307. Arkaniza II',9),(308,'308. Arkaparaiso',9),(309,'309. Bello Horizonte',9),(310,'310. Bosque De La Alameda',9),(311,'311. Carrenales',9),(312,'312. Conj. Las Palmeras',9),(313,'313. Conj. Residencial Valparaiso',9),(314,'314. El Tunal',9),(315,'315. Hacienda Piedra Pintada',9),(316,'316. Jordan 3 Etapa',9),(317,'317. Jordan 1 Etapa',9),(318,'318. La Floresta',9),(319,'319. Los Tunjos',9),(320,'320. Picaleñita',9),(321,'321. Picaleña',9),(322,'322. Portal De Los Tunjos',9),(323,'323. Reservas Del Campestre',9),(324,'324. Rincon De Las Americas',9),(325,'325. Rincon Del Campestre',9),(326,'326. San Francisco',9),(327,'327. San Remo',9),(328,'328. Urb. Bosque De Varsovia',9),(329,'329. Urb. Chaquen',9),(330,'330. Urb. Ciudad Luz',9),(331,'331. Urb. Comfenalco',9),(332,'332. Urb. Coopdiasam',9),(333,'333. Urb. Cutucumay',9),(334,'334. Urb. El Poblado',9),(335,'335. Urb. Las Americas',9),(336,'336. Urb. Las Flores',9),(337,'337. Urb. Los Remansos',9),(338,'338. Urb. Miraflores',9),(339,'339. Urb. Nuevo Horizonte',9),(340,'340. Urb. Portal Campestre',9),(341,'341. Urb. Padreras De Santa Rita',9),(342,'342. Urb. Tahiti',9),(343,'343. Urb. Varsovia',9),(344,'344. Urb. Villa Arkadia',9),(345,'345. Urb. Villa Café',9),(346,'346. Urb. Villa De La Candelaria',9),(347,'347. Urb. Villa Luz',9),(348,'348. Urb. Villa Yuli',9),(349,'349. Valparaiso I',9),(350,'350. Valparaiso  II',9),(351,'351. Valparaiso  III',9),(352,'352. Valparaiso  IV',9),(353,'353. Versalles',9),(354,'354. Villa Carvajalita',9),(355,'355. Villa Del Pilar',9),(356,'356. Villa Maria',9),(357,'357. Villa Natalia',9),(358,'29. Arkalena',10),(359,'358. Bosques De Santa Helena',10),(360,'359. Boyaca',10),(361,'360. Cadiz',10),(362,'361. Casa Club',10),(363,'362. Castellana',10),(364,'363. Claret',10),(365,'364. Departamental',10),(366,'365. Federico Lleras',10),(367,'366. Hipodromo',10),(368,'367. La Francia',10),(369,'368. Las Palmas',10),(370,'369. Laureles',10),(371,'370. Macarena Parte Alta',10),(372,'371. Macarena Parte Baja',10),(373,'372. Magisterio',10),(374,'373. Metaima Alta',10),(375,'374. Metaima Parte Baja',10),(376,'375. Montealegre',10),(377,'376. Nacional',10),(378,'377. Naciones Unidas',10),(379,'378. San Cayetano',10),(380,'379. Santa Helena',10),(381,'380. Santander',10),(382,'381. 12 De Octubre',11),(383,'382. Alto De La Cruz',11),(384,'383. America',11),(385,'384. Arado',11),(386,'385. Bosque Parte Alta',11),(387,'386. Bosque Parte Baja',11),(388,'387. El Refugio II',11),(389,'388. El Refugio II',11),(390,'389. Garzon',11),(391,'390. Independiente',11),(392,'391. La Isla',11),(393,'392. La Martinica',11),(394,'393. Las Brisas',11),(395,'394. Las Ferias',11),(396,'395. Libertad',11),(397,'396. Los Martires',11),(398,'397. Peñon',11),(399,'398. Popular',11),(400,'399. Rodriguez Andrade',11),(401,'400. San Vicente De Paul',11),(402,'401. Uribe Uribe',11),(403,'402. Villa Del Rio',11),(404,'403. Villa Maria',11),(405,'404. Andres Lopez De Galarza',12),(406,'405. Avenida',12),(407,'406. Colonias De Asprovi',12),(408,'407. Galan',12),(409,'408. Industrial',12),(410,'409. Keneddy',12),(411,'410. La Gaitana',12),(412,'411. La Padera',12),(413,'412. La Reforma',12),(414,'413. Las Vegas',12),(415,'414. Matallana',12),(416,'415. Murillo Toro',12),(417,'416. Ricaurte',12),(418,'417. Rosa Badillo',12),(419,'418. Santofimio',12),(420,'419. Urb. Arkaima',12),(421,'420. Urb. Divino Niño',12),(422,'421. Urb. Terrazas Del Tejar',12),(423,'422. Venecia',12),(424,'423. Villa Claudia',12),(425,'424. Villa Luces',12),(426,'425. Yuldaima',12),(427,'426. Albania',13),(428,'427. Boqueron',13),(429,'428. Cerro Granate',13),(430,'429. Colina 1',13),(431,'430. Colina 2',13),(432,'431. Dario Echandia',13),(433,'432. Granada',13),(434,'433. Isla',13),(435,'434. Jazmin',13),(436,'435. La Union',13),(437,'436. Miramar',13),(438,'437. San Isidro',13),(439,'438. Terrazas De Boqueron',13),(440,'439. Villa Mery',13),(441,'440. La Samaria',9);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifcacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_id` int unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Alcalde','es el gobierna y administra un municipio','2023-02-21 08:10:45','2023-02-21 08:25:21'),(2,'Concejal','control politico de un muncipio','2023-02-21 08:10:33','2023-03-15 07:27:20'),(3,'Gorbernador','Gorbernador departamental','2023-04-27 09:36:17','2023-04-27 09:36:17'),(4,'Edil1','edil1 perdro','2023-06-29 10:06:05','2023-06-29 10:06:43');
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
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
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
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
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
-- Table structure for table `ediles`
--

DROP TABLE IF EXISTS `ediles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ediles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `concejo` tinyint NOT NULL,
  `alcaldia` varchar(45) DEFAULT NULL,
  `gobernacion` varchar(45) DEFAULT NULL,
  `edil_id` bigint unsigned NOT NULL,
  `formulario_id` bigint unsigned NOT NULL,
  `asamblea_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ediles_edil_id_foreign_idx` (`edil_id`),
  KEY `ediles_formulario_id_foreign_idx` (`formulario_id`),
  KEY `ediles_asamblea_id_foreign_idx` (`asamblea_id`),
  CONSTRAINT `ediles_asamblea_id_foreign` FOREIGN KEY (`asamblea_id`) REFERENCES `usuarios_ediles` (`id`),
  CONSTRAINT `ediles_edil_id_foreign` FOREIGN KEY (`edil_id`) REFERENCES `usuarios_ediles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ediles_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formularios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ediles`
--

LOCK TABLES `ediles` WRITE;
/*!40000 ALTER TABLE `ediles` DISABLE KEYS */;
/*!40000 ALTER TABLE `ediles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puesto_votacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_zona` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidato_id` bigint unsigned DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesa` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formularios_propietario_id_foreign` (`propietario_id`),
  CONSTRAINT `formularios_propietario_id_foreign` FOREIGN KEY (`propietario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formularios`
--

LOCK TABLES `formularios` WRITE;
/*!40000 ALTER TABLE `formularios` DISABLE KEYS */;
/*!40000 ALTER TABLE `formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_users`
--

DROP TABLE IF EXISTS `info_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona` int NOT NULL,
  `observaciones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referido_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `info_users_referido_id_foreign` (`referido_id`),
  CONSTRAINT `info_users_referido_id_foreign` FOREIGN KEY (`referido_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_users`
--

LOCK TABLES `info_users` WRITE;
/*!40000 ALTER TABLE `info_users` DISABLE KEYS */;
INSERT INTO `info_users` VALUES (12,'Delectus illum nul','848744322','Otro','Corregimiento',3,'Delectus illum nul',NULL,'2023-07-22 01:19:43','2023-07-22 22:24:30');
/*!40000 ALTER TABLE `info_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriz_seguimiento`
--

DROP TABLE IF EXISTS `matriz_seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriz_seguimiento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `formulario_id` bigint unsigned NOT NULL,
  `respuesta_uno` tinyint(1) NOT NULL,
  `respuesta_dos` tinyint(1) NOT NULL,
  `respuesta_tres` tinyint(1) NOT NULL,
  `respuesta_cuatro` tinyint(1) NOT NULL,
  `fechas_cuatro` json DEFAULT NULL,
  `respuesta_cinco` tinyint(1) NOT NULL,
  `fechas_cinco` json DEFAULT NULL,
  `respuesta_seis` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `respuesta_siete` tinyint(1) NOT NULL,
  `fechas_siete` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matriz_seguimiento_formulario_id_foreign` (`formulario_id`),
  CONSTRAINT `matriz_seguimiento_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formularios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriz_seguimiento`
--

LOCK TABLES `matriz_seguimiento` WRITE;
/*!40000 ALTER TABLE `matriz_seguimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `matriz_seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas_votacion`
--

DROP TABLE IF EXISTS `mesas_votacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas_votacion` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numero_mesa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puesto_votacion` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesas_votacion_puesto_votacion_foreign` (`puesto_votacion`),
  CONSTRAINT `mesas_votacion_puesto_votacion_foreign` FOREIGN KEY (`puesto_votacion`) REFERENCES `puestos_votacion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=862 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas_votacion`
--

LOCK TABLES `mesas_votacion` WRITE;
/*!40000 ALTER TABLE `mesas_votacion` DISABLE KEYS */;
INSERT INTO `mesas_votacion` VALUES (1,'Mesa 1','Mesa 1',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(2,'Mesa 2','Mesa 2',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(3,'Mesa 3','Mesa 3',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(4,'Mesa 4','Mesa 4',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(5,'Mesa 5','Mesa 5',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(6,'Mesa 6','Mesa 6',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(7,'Mesa 7','Mesa 7',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(8,'Mesa 8','Mesa 8',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(9,'Mesa 9','Mesa 9',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(10,'Mesa 10','Mesa 10',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(11,'Mesa 11','Mesa 11',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(12,'Mesa 12','Mesa 12',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(13,'Mesa 13','Mesa 13',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(14,'Mesa 14','Mesa 14',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(15,'Mesa 15','Mesa 15',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(16,'Mesa 16','Mesa 16',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(17,'Mesa 17','Mesa 17',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(18,'Mesa 18','Mesa 18',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(19,'Mesa 19','Mesa 19',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(20,'Mesa 20','Mesa 20',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(21,'Mesa 21','Mesa 21',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(22,'Mesa 22','Mesa 22',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(23,'Mesa 23','Mesa 23',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(24,'Mesa 24','Mesa 24',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(25,'Mesa 25','Mesa 25',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(26,'Mesa 26','Mesa 26',1,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(27,'Mesa 1','Mesa 1',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(28,'Mesa 2','Mesa 2',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(29,'Mesa 3','Mesa 3',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(30,'Mesa 4','Mesa 4',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(31,'Mesa 5','Mesa 5',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(32,'Mesa 6','Mesa 6',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(33,'Mesa 7','Mesa 7',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(34,'Mesa 8','Mesa 8',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(35,'Mesa 9','Mesa 9',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(36,'Mesa 10','Mesa 10',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(37,'Mesa 11','Mesa 11',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(38,'Mesa 12','Mesa 12',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(39,'Mesa 13','Mesa 13',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(40,'Mesa 14','Mesa 14',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(41,'Mesa 15','Mesa 15',2,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(42,'Mesa 1','Mesa 1',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(43,'Mesa 2','Mesa 2',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(44,'Mesa 3','Mesa 3',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(45,'Mesa 4','Mesa 4',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(46,'Mesa 5','Mesa 5',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(47,'Mesa 6','Mesa 6',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(48,'Mesa 7','Mesa 7',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(49,'Mesa 8','Mesa 8',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(50,'Mesa 9','Mesa 9',3,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(51,'Mesa 1','Mesa 1',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(52,'Mesa 2','Mesa 2',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(53,'Mesa 3','Mesa 3',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(54,'Mesa 4','Mesa 4',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(55,'Mesa 5','Mesa 5',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(56,'Mesa 6','Mesa 6',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(57,'Mesa 7','Mesa 7',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(58,'Mesa 8','Mesa 8',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(59,'Mesa 9','Mesa 9',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(60,'Mesa 10','Mesa 10',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(61,'Mesa 11','Mesa 11',4,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(62,'Mesa 1','Mesa 1',5,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(63,'Mesa 1','Mesa 1',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(64,'Mesa 2','Mesa 2',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(65,'Mesa 3','Mesa 3',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(66,'Mesa 4','Mesa 4',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(67,'Mesa 5','Mesa 5',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(68,'Mesa 6','Mesa 6',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(69,'Mesa 7','Mesa 7',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(70,'Mesa 8','Mesa 8',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(71,'Mesa 9','Mesa 9',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(72,'Mesa 10','Mesa 10',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(73,'Mesa 11','Mesa 11',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(74,'Mesa 12','Mesa 12',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(75,'Mesa 13','Mesa 13',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(76,'Mesa 14','Mesa 14',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(77,'Mesa 15','Mesa 15',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(78,'Mesa 16','Mesa 16',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(79,'Mesa 17','Mesa 17',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(80,'Mesa 18','Mesa 18',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(81,'Mesa 19','Mesa 19',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(82,'Mesa 20','Mesa 20',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(83,'Mesa 21','Mesa 21',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(84,'Mesa 22','Mesa 22',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(85,'Mesa 23','Mesa 23',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(86,'Mesa 24','Mesa 24',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(87,'Mesa 25','Mesa 25',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(88,'Mesa 26','Mesa 26',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(89,'Mesa 27','Mesa 27',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(90,'Mesa 28','Mesa 28',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(91,'Mesa 29','Mesa 29',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(92,'Mesa 30','Mesa 30',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(93,'Mesa 31','Mesa 31',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(94,'Mesa 32','Mesa 32',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(95,'Mesa 33','Mesa 33',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(96,'Mesa 34','Mesa 34',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(97,'Mesa 35','Mesa 35',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(98,'Mesa 36','Mesa 36',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(99,'Mesa 37','Mesa 37',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(100,'Mesa 38','Mesa 38',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(101,'Mesa 39','Mesa 39',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(102,'Mesa 40','Mesa 40',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(103,'Mesa 41','Mesa 41',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(104,'Mesa 42','Mesa 42',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(105,'Mesa 43','Mesa 43',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(106,'Mesa 44','Mesa 44',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(107,'Mesa 45','Mesa 45',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(108,'Mesa 46','Mesa 46',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(109,'Mesa 47','Mesa 47',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(110,'Mesa 48','Mesa 48',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(111,'Mesa 49','Mesa 49',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(112,'Mesa 50','Mesa 50',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(113,'Mesa 51','Mesa 51',6,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(114,'Mesa 1','Mesa 1',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(115,'Mesa 2','Mesa 2',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(116,'Mesa 3','Mesa 3',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(117,'Mesa 4','Mesa 4',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(118,'Mesa 5','Mesa 5',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(119,'Mesa 6','Mesa 6',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(120,'Mesa 7','Mesa 7',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(121,'Mesa 8','Mesa 8',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(122,'Mesa 9','Mesa 9',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(123,'Mesa 10','Mesa 10',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(124,'Mesa 11','Mesa 11',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(125,'Mesa 12','Mesa 12',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(126,'Mesa 13','Mesa 13',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(127,'Mesa 14','Mesa 14',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(128,'Mesa 15','Mesa 15',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(129,'Mesa 16','Mesa 16',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(130,'Mesa 17','Mesa 17',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(131,'Mesa 18','Mesa 18',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(132,'Mesa 19','Mesa 19',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(133,'Mesa 20','Mesa 20',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(134,'Mesa 21','Mesa 21',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(135,'Mesa 22','Mesa 22',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(136,'Mesa 23','Mesa 23',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(137,'Mesa 24','Mesa 24',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(138,'Mesa 25','Mesa 25',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(139,'Mesa 26','Mesa 26',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(140,'Mesa 27','Mesa 27',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(141,'Mesa 28','Mesa 28',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(142,'Mesa 29','Mesa 29',7,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(143,'Mesa 1','Mesa 1',8,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(144,'Mesa 2','Mesa 2',8,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(145,'Mesa 3','Mesa 3',8,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(146,'Mesa 1','Mesa 1',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(147,'Mesa 2','Mesa 2',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(148,'Mesa 3','Mesa 3',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(149,'Mesa 4','Mesa 4',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(150,'Mesa 5','Mesa 5',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(151,'Mesa 6','Mesa 6',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(152,'Mesa 7','Mesa 7',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(153,'Mesa 8','Mesa 8',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(154,'Mesa 9','Mesa 9',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(155,'Mesa 10','Mesa 10',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(156,'Mesa 11','Mesa 11',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(157,'Mesa 12','Mesa 12',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(158,'Mesa 13','Mesa 13',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(159,'Mesa 14','Mesa 14',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(160,'Mesa 15','Mesa 15',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(161,'Mesa 16','Mesa 16',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(162,'Mesa 17','Mesa 17',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(163,'Mesa 18','Mesa 18',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(164,'Mesa 19','Mesa 19',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(165,'Mesa 20','Mesa 20',9,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(166,'Mesa 1','Mesa 1',10,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(167,'Mesa 2','Mesa 2',10,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(168,'Mesa 1','Mesa 1',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(169,'Mesa 2','Mesa 2',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(170,'Mesa 3','Mesa 3',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(171,'Mesa 4','Mesa 4',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(172,'Mesa 5','Mesa 5',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(173,'Mesa 6','Mesa 6',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(174,'Mesa 7','Mesa 7',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(175,'Mesa 8','Mesa 8',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(176,'Mesa 9','Mesa 9',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(177,'Mesa 10','Mesa 10',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(178,'Mesa 11','Mesa 11',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(179,'Mesa 12','Mesa 12',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(180,'Mesa 13','Mesa 13',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(181,'Mesa 14','Mesa 14',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(182,'Mesa 15','Mesa 15',11,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(183,'Mesa 1','Mesa 1',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(184,'Mesa 2','Mesa 2',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(185,'Mesa 3','Mesa 3',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(186,'Mesa 4','Mesa 4',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(187,'Mesa 5','Mesa 5',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(188,'Mesa 6','Mesa 6',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(189,'Mesa 7','Mesa 7',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(190,'Mesa 8','Mesa 8',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(191,'Mesa 9','Mesa 9',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(192,'Mesa 10','Mesa 10',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(193,'Mesa 11','Mesa 11',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(194,'Mesa 12','Mesa 12',12,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(195,'Mesa 1','Mesa 1',13,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(196,'Mesa 1','Mesa 1',14,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(197,'Mesa 2','Mesa 2',14,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(198,'Mesa 3','Mesa 3',14,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(199,'Mesa 4','Mesa 4',14,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(200,'Mesa 5','Mesa 5',14,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(201,'Mesa 1','Mesa 1',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(202,'Mesa 2','Mesa 2',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(203,'Mesa 3','Mesa 3',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(204,'Mesa 4','Mesa 4',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(205,'Mesa 5','Mesa 5',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(206,'Mesa 6','Mesa 6',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(207,'Mesa 7','Mesa 7',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(208,'Mesa 8','Mesa 8',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(209,'Mesa 9','Mesa 9',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(210,'Mesa 10','Mesa 10',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(211,'Mesa 11','Mesa 11',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(212,'Mesa 12','Mesa 12',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(213,'Mesa 13','Mesa 13',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(214,'Mesa 14','Mesa 14',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(215,'Mesa 15','Mesa 15',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(216,'Mesa 16','Mesa 16',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(217,'Mesa 17','Mesa 17',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(218,'Mesa 18','Mesa 18',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(219,'Mesa 19','Mesa 19',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(220,'Mesa 20','Mesa 20',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(221,'Mesa 21','Mesa 21',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(222,'Mesa 22','Mesa 22',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(223,'Mesa 23','Mesa 23',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(224,'Mesa 24','Mesa 24',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(225,'Mesa 25','Mesa 25',15,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(226,'Mesa 1','Mesa 1',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(227,'Mesa 2','Mesa 2',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(228,'Mesa 3','Mesa 3',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(229,'Mesa 4','Mesa 4',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(230,'Mesa 5','Mesa 5',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(231,'Mesa 6','Mesa 6',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(232,'Mesa 7','Mesa 7',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(233,'Mesa 8','Mesa 8',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(234,'Mesa 9','Mesa 9',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(235,'Mesa 10','Mesa 10',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(236,'Mesa 11','Mesa 11',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(237,'Mesa 12','Mesa 12',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(238,'Mesa 13','Mesa 13',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(239,'Mesa 14','Mesa 14',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(240,'Mesa 15','Mesa 15',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(241,'Mesa 16','Mesa 16',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(242,'Mesa 17','Mesa 17',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(243,'Mesa 18','Mesa 18',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(244,'Mesa 19','Mesa 19',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(245,'Mesa 20','Mesa 20',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(246,'Mesa 21','Mesa 21',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(247,'Mesa 22','Mesa 22',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(248,'Mesa 23','Mesa 23',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(249,'Mesa 24','Mesa 24',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(250,'Mesa 25','Mesa 25',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(251,'Mesa 26','Mesa 26',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(252,'Mesa 27','Mesa 27',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(253,'Mesa 28','Mesa 28',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(254,'Mesa 29','Mesa 29',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(255,'Mesa 30','Mesa 30',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(256,'Mesa 31','Mesa 31',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(257,'Mesa 32','Mesa 32',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(258,'Mesa 33','Mesa 33',16,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(259,'Mesa 1','Mesa 1',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(260,'Mesa 2','Mesa 2',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(261,'Mesa 3','Mesa 3',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(262,'Mesa 4','Mesa 4',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(263,'Mesa 5','Mesa 5',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(264,'Mesa 6','Mesa 6',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(265,'Mesa 7','Mesa 7',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(266,'Mesa 8','Mesa 8',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(267,'Mesa 9','Mesa 9',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(268,'Mesa 10','Mesa 10',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(269,'Mesa 11','Mesa 11',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(270,'Mesa 12','Mesa 12',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(271,'Mesa 13','Mesa 13',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(272,'Mesa 14','Mesa 14',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(273,'Mesa 15','Mesa 15',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(274,'Mesa 16','Mesa 16',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(275,'Mesa 17','Mesa 17',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(276,'Mesa 18','Mesa 18',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(277,'Mesa 19','Mesa 19',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(278,'Mesa 20','Mesa 20',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(279,'Mesa 21','Mesa 21',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(280,'Mesa 22','Mesa 22',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(281,'Mesa 23','Mesa 23',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(282,'Mesa 24','Mesa 24',17,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(283,'Mesa 1','Mesa 1',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(284,'Mesa 2','Mesa 2',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(285,'Mesa 3','Mesa 3',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(286,'Mesa 4','Mesa 4',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(287,'Mesa 5','Mesa 5',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(288,'Mesa 6','Mesa 6',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(289,'Mesa 7','Mesa 7',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(290,'Mesa 8','Mesa 8',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(291,'Mesa 9','Mesa 9',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(292,'Mesa 10','Mesa 10',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(293,'Mesa 11','Mesa 11',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(294,'Mesa 12','Mesa 12',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(295,'Mesa 13','Mesa 13',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(296,'Mesa 14','Mesa 14',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(297,'Mesa 15','Mesa 15',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(298,'Mesa 16','Mesa 16',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(299,'Mesa 17','Mesa 17',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(300,'Mesa 18','Mesa 18',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(301,'Mesa 19','Mesa 19',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(302,'Mesa 20','Mesa 20',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(303,'Mesa 21','Mesa 21',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(304,'Mesa 22','Mesa 22',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(305,'Mesa 23','Mesa 23',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(306,'Mesa 24','Mesa 24',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(307,'Mesa 25','Mesa 25',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(308,'Mesa 26','Mesa 26',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(309,'Mesa 27','Mesa 27',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(310,'Mesa 28','Mesa 28',18,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(311,'Mesa 1','Mesa 1',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(312,'Mesa 2','Mesa 2',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(313,'Mesa 3','Mesa 3',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(314,'Mesa 4','Mesa 4',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(315,'Mesa 5','Mesa 5',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(316,'Mesa 6','Mesa 6',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(317,'Mesa 7','Mesa 7',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(318,'Mesa 8','Mesa 8',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(319,'Mesa 9','Mesa 9',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(320,'Mesa 10','Mesa 10',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(321,'Mesa 11','Mesa 11',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(322,'Mesa 12','Mesa 12',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(323,'Mesa 13','Mesa 13',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(324,'Mesa 14','Mesa 14',19,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(325,'Mesa 1','Mesa 1',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(326,'Mesa 2','Mesa 2',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(327,'Mesa 3','Mesa 3',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(328,'Mesa 4','Mesa 4',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(329,'Mesa 5','Mesa 5',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(330,'Mesa 6','Mesa 6',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(331,'Mesa 7','Mesa 7',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(332,'Mesa 8','Mesa 8',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(333,'Mesa 9','Mesa 9',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(334,'Mesa 10','Mesa 10',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(335,'Mesa 11','Mesa 11',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(336,'Mesa 12','Mesa 12',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(337,'Mesa 13','Mesa 13',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(338,'Mesa 14','Mesa 14',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(339,'Mesa 15','Mesa 15',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(340,'Mesa 16','Mesa 16',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(341,'Mesa 17','Mesa 17',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(342,'Mesa 18','Mesa 18',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(343,'Mesa 19','Mesa 19',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(344,'Mesa 20','Mesa 20',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(345,'Mesa 21','Mesa 21',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(346,'Mesa 22','Mesa 22',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(347,'Mesa 23','Mesa 23',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(348,'Mesa 24','Mesa 24',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(349,'Mesa 25','Mesa 25',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(350,'Mesa 26','Mesa 26',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(351,'Mesa 27','Mesa 27',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(352,'Mesa 28','Mesa 28',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(353,'Mesa 29','Mesa 29',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(354,'Mesa 30','Mesa 30',20,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(355,'Mesa 1','Mesa 1',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(356,'Mesa 2','Mesa 2',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(357,'Mesa 3','Mesa 3',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(358,'Mesa 4','Mesa 4',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(359,'Mesa 5','Mesa 5',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(360,'Mesa 6','Mesa 6',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(361,'Mesa 7','Mesa 7',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(362,'Mesa 8','Mesa 8',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(363,'Mesa 9','Mesa 9',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(364,'Mesa 10','Mesa 10',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(365,'Mesa 11','Mesa 11',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(366,'Mesa 12','Mesa 12',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(367,'Mesa 13','Mesa 13',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(368,'Mesa 14','Mesa 14',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(369,'Mesa 15','Mesa 15',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(370,'Mesa 16','Mesa 16',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(371,'Mesa 17','Mesa 17',21,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(372,'Mesa 1','Mesa 1',22,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(373,'Mesa 2','Mesa 2',22,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(374,'Mesa 3','Mesa 3',22,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(375,'Mesa 4','Mesa 4',22,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(376,'Mesa 1','Mesa 1',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(377,'Mesa 2','Mesa 2',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(378,'Mesa 3','Mesa 3',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(379,'Mesa 4','Mesa 4',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(380,'Mesa 5','Mesa 5',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(381,'Mesa 6','Mesa 6',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(382,'Mesa 7','Mesa 7',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(383,'Mesa 8','Mesa 8',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(384,'Mesa 9','Mesa 9',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(385,'Mesa 10','Mesa 10',23,'2023-07-27 17:13:28','2023-07-27 17:13:28'),(386,'Mesa 11','Mesa 11',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(387,'Mesa 12','Mesa 12',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(388,'Mesa 13','Mesa 13',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(389,'Mesa 14','Mesa 14',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(390,'Mesa 15','Mesa 15',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(391,'Mesa 16','Mesa 16',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(392,'Mesa 17','Mesa 17',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(393,'Mesa 18','Mesa 18',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(394,'Mesa 19','Mesa 19',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(395,'Mesa 20','Mesa 20',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(396,'Mesa 21','Mesa 21',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(397,'Mesa 22','Mesa 22',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(398,'Mesa 23','Mesa 23',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(399,'Mesa 24','Mesa 24',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(400,'Mesa 25','Mesa 25',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(401,'Mesa 26','Mesa 26',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(402,'Mesa 27','Mesa 27',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(403,'Mesa 28','Mesa 28',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(404,'Mesa 29','Mesa 29',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(405,'Mesa 30','Mesa 30',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(406,'Mesa 31','Mesa 31',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(407,'Mesa 32','Mesa 32',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(408,'Mesa 33','Mesa 33',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(409,'Mesa 34','Mesa 34',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(410,'Mesa 35','Mesa 35',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(411,'Mesa 36','Mesa 36',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(412,'Mesa 37','Mesa 37',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(413,'Mesa 38','Mesa 38',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(414,'Mesa 39','Mesa 39',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(415,'Mesa 40','Mesa 40',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(416,'Mesa 41','Mesa 41',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(417,'Mesa 42','Mesa 42',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(418,'Mesa 43','Mesa 43',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(419,'Mesa 44','Mesa 44',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(420,'Mesa 45','Mesa 45',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(421,'Mesa 46','Mesa 46',23,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(422,'Mesa 1','Mesa 1',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(423,'Mesa 2','Mesa 2',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(424,'Mesa 3','Mesa 3',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(425,'Mesa 4','Mesa 4',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(426,'Mesa 5','Mesa 5',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(427,'Mesa 6','Mesa 6',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(428,'Mesa 7','Mesa 7',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(429,'Mesa 8','Mesa 8',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(430,'Mesa 9','Mesa 9',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(431,'Mesa 10','Mesa 10',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(432,'Mesa 11','Mesa 11',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(433,'Mesa 12','Mesa 12',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(434,'Mesa 13','Mesa 13',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(435,'Mesa 14','Mesa 14',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(436,'Mesa 15','Mesa 15',24,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(437,'Mesa 1','Mesa 1',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(438,'Mesa 2','Mesa 2',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(439,'Mesa 3','Mesa 3',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(440,'Mesa 4','Mesa 4',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(441,'Mesa 5','Mesa 5',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(442,'Mesa 6','Mesa 6',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(443,'Mesa 7','Mesa 7',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(444,'Mesa 8','Mesa 8',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(445,'Mesa 9','Mesa 9',25,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(446,'Mesa 1','Mesa 1',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(447,'Mesa 2','Mesa 2',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(448,'Mesa 3','Mesa 3',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(449,'Mesa 4','Mesa 4',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(450,'Mesa 5','Mesa 5',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(451,'Mesa 6','Mesa 6',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(452,'Mesa 7','Mesa 7',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(453,'Mesa 8','Mesa 8',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(454,'Mesa 9','Mesa 9',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(455,'Mesa 10','Mesa 10',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(456,'Mesa 11','Mesa 11',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(457,'Mesa 12','Mesa 12',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(458,'Mesa 13','Mesa 13',26,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(459,'Mesa 1','Mesa 1',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(460,'Mesa 2','Mesa 2',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(461,'Mesa 3','Mesa 3',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(462,'Mesa 4','Mesa 4',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(463,'Mesa 5','Mesa 5',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(464,'Mesa 6','Mesa 6',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(465,'Mesa 7','Mesa 7',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(466,'Mesa 8','Mesa 8',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(467,'Mesa 9','Mesa 9',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(468,'Mesa 10','Mesa 10',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(469,'Mesa 11','Mesa 11',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(470,'Mesa 12','Mesa 12',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(471,'Mesa 13','Mesa 13',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(472,'Mesa 14','Mesa 14',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(473,'Mesa 15','Mesa 15',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(474,'Mesa 16','Mesa 16',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(475,'Mesa 17','Mesa 17',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(476,'Mesa 18','Mesa 18',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(477,'Mesa 19','Mesa 19',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(478,'Mesa 20','Mesa 20',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(479,'Mesa 21','Mesa 21',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(480,'Mesa 22','Mesa 22',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(481,'Mesa 23','Mesa 23',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(482,'Mesa 24','Mesa 24',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(483,'Mesa 25','Mesa 25',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(484,'Mesa 26','Mesa 26',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(485,'Mesa 27','Mesa 27',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(486,'Mesa 28','Mesa 28',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(487,'Mesa 29','Mesa 29',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(488,'Mesa 30','Mesa 30',27,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(489,'Mesa 1','Mesa 1',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(490,'Mesa 2','Mesa 2',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(491,'Mesa 3','Mesa 3',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(492,'Mesa 4','Mesa 4',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(493,'Mesa 5','Mesa 5',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(494,'Mesa 6','Mesa 6',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(495,'Mesa 7','Mesa 7',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(496,'Mesa 8','Mesa 8',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(497,'Mesa 9','Mesa 9',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(498,'Mesa 10','Mesa 10',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(499,'Mesa 11','Mesa 11',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(500,'Mesa 12','Mesa 12',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(501,'Mesa 13','Mesa 13',28,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(502,'Mesa 1','Mesa 1',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(503,'Mesa 2','Mesa 2',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(504,'Mesa 3','Mesa 3',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(505,'Mesa 4','Mesa 4',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(506,'Mesa 5','Mesa 5',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(507,'Mesa 6','Mesa 6',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(508,'Mesa 7','Mesa 7',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(509,'Mesa 8','Mesa 8',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(510,'Mesa 9','Mesa 9',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(511,'Mesa 10','Mesa 10',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(512,'Mesa 11','Mesa 11',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(513,'Mesa 12','Mesa 12',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(514,'Mesa 13','Mesa 13',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(515,'Mesa 14','Mesa 14',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(516,'Mesa 15','Mesa 15',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(517,'Mesa 16','Mesa 16',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(518,'Mesa 17','Mesa 17',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(519,'Mesa 18','Mesa 18',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(520,'Mesa 19','Mesa 19',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(521,'Mesa 20','Mesa 20',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(522,'Mesa 21','Mesa 21',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(523,'Mesa 22','Mesa 22',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(524,'Mesa 23','Mesa 23',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(525,'Mesa 24','Mesa 24',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(526,'Mesa 25','Mesa 25',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(527,'Mesa 26','Mesa 26',29,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(528,'Mesa 1','Mesa 1',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(529,'Mesa 2','Mesa 2',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(530,'Mesa 3','Mesa 3',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(531,'Mesa 4','Mesa 4',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(532,'Mesa 5','Mesa 5',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(533,'Mesa 6','Mesa 6',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(534,'Mesa 7','Mesa 7',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(535,'Mesa 8','Mesa 8',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(536,'Mesa 9','Mesa 9',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(537,'Mesa 10','Mesa 10',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(538,'Mesa 11','Mesa 11',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(539,'Mesa 12','Mesa 12',30,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(540,'Mesa 1','Mesa 1',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(541,'Mesa 2','Mesa 2',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(542,'Mesa 3','Mesa 3',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(543,'Mesa 4','Mesa 4',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(544,'Mesa 5','Mesa 5',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(545,'Mesa 6','Mesa 6',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(546,'Mesa 7','Mesa 7',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(547,'Mesa 8','Mesa 8',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(548,'Mesa 9','Mesa 9',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(549,'Mesa 10','Mesa 10',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(550,'Mesa 11','Mesa 11',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(551,'Mesa 12','Mesa 12',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(552,'Mesa 13','Mesa 13',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(553,'Mesa 14','Mesa 14',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(554,'Mesa 15','Mesa 15',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(555,'Mesa 16','Mesa 16',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(556,'Mesa 17','Mesa 17',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(557,'Mesa 18','Mesa 18',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(558,'Mesa 19','Mesa 19',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(559,'Mesa 20','Mesa 20',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(560,'Mesa 21','Mesa 21',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(561,'Mesa 22','Mesa 22',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(562,'Mesa 23','Mesa 23',31,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(563,'Mesa 1','Mesa 1',32,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(564,'Mesa 2','Mesa 2',32,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(565,'Mesa 3','Mesa 3',32,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(566,'Mesa 1','Mesa 1',33,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(567,'Mesa 2','Mesa 2',33,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(568,'Mesa 3','Mesa 3',33,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(569,'Mesa 4','Mesa 4',33,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(570,'Mesa 1','Mesa 1',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(571,'Mesa 2','Mesa 2',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(572,'Mesa 3','Mesa 3',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(573,'Mesa 4','Mesa 4',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(574,'Mesa 5','Mesa 5',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(575,'Mesa 6','Mesa 6',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(576,'Mesa 7','Mesa 7',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(577,'Mesa 8','Mesa 8',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(578,'Mesa 9','Mesa 9',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(579,'Mesa 10','Mesa 10',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(580,'Mesa 11','Mesa 11',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(581,'Mesa 12','Mesa 12',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(582,'Mesa 13','Mesa 13',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(583,'Mesa 14','Mesa 14',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(584,'Mesa 15','Mesa 15',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(585,'Mesa 16','Mesa 16',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(586,'Mesa 17','Mesa 17',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(587,'Mesa 18','Mesa 18',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(588,'Mesa 19','Mesa 19',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(589,'Mesa 20','Mesa 20',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(590,'Mesa 21','Mesa 21',34,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(591,'Mesa 1','Mesa 1',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(592,'Mesa 2','Mesa 2',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(593,'Mesa 3','Mesa 3',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(594,'Mesa 4','Mesa 4',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(595,'Mesa 5','Mesa 5',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(596,'Mesa 6','Mesa 6',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(597,'Mesa 7','Mesa 7',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(598,'Mesa 8','Mesa 8',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(599,'Mesa 9','Mesa 9',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(600,'Mesa 10','Mesa 10',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(601,'Mesa 11','Mesa 11',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(602,'Mesa 12','Mesa 12',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(603,'Mesa 13','Mesa 13',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(604,'Mesa 14','Mesa 14',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(605,'Mesa 15','Mesa 15',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(606,'Mesa 16','Mesa 16',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(607,'Mesa 17','Mesa 17',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(608,'Mesa 18','Mesa 18',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(609,'Mesa 19','Mesa 19',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(610,'Mesa 20','Mesa 20',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(611,'Mesa 21','Mesa 21',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(612,'Mesa 22','Mesa 22',35,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(613,'Mesa 1','Mesa 1',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(614,'Mesa 2','Mesa 2',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(615,'Mesa 3','Mesa 3',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(616,'Mesa 4','Mesa 4',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(617,'Mesa 5','Mesa 5',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(618,'Mesa 6','Mesa 6',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(619,'Mesa 7','Mesa 7',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(620,'Mesa 8','Mesa 8',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(621,'Mesa 9','Mesa 9',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(622,'Mesa 10','Mesa 10',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(623,'Mesa 11','Mesa 11',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(624,'Mesa 12','Mesa 12',36,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(625,'Mesa 1','Mesa 1',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(626,'Mesa 2','Mesa 2',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(627,'Mesa 3','Mesa 3',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(628,'Mesa 4','Mesa 4',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(629,'Mesa 5','Mesa 5',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(630,'Mesa 6','Mesa 6',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(631,'Mesa 7','Mesa 7',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(632,'Mesa 8','Mesa 8',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(633,'Mesa 9','Mesa 9',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(634,'Mesa 10','Mesa 10',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(635,'Mesa 11','Mesa 11',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(636,'Mesa 12','Mesa 12',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(637,'Mesa 13','Mesa 13',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(638,'Mesa 14','Mesa 14',37,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(639,'Mesa 1','Mesa 1',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(640,'Mesa 2','Mesa 2',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(641,'Mesa 3','Mesa 3',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(642,'Mesa 4','Mesa 4',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(643,'Mesa 5','Mesa 5',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(644,'Mesa 6','Mesa 6',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(645,'Mesa 7','Mesa 7',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(646,'Mesa 8','Mesa 8',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(647,'Mesa 9','Mesa 9',38,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(648,'Mesa 1','Mesa 1',39,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(649,'Mesa 1','Mesa 1',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(650,'Mesa 2','Mesa 2',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(651,'Mesa 3','Mesa 3',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(652,'Mesa 4','Mesa 4',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(653,'Mesa 5','Mesa 5',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(654,'Mesa 6','Mesa 6',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(655,'Mesa 7','Mesa 7',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(656,'Mesa 8','Mesa 8',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(657,'Mesa 9','Mesa 9',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(658,'Mesa 10','Mesa 10',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(659,'Mesa 11','Mesa 11',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(660,'Mesa 12','Mesa 12',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(661,'Mesa 13','Mesa 13',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(662,'Mesa 14','Mesa 14',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(663,'Mesa 15','Mesa 15',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(664,'Mesa 16','Mesa 16',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(665,'Mesa 17','Mesa 17',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(666,'Mesa 18','Mesa 18',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(667,'Mesa 19','Mesa 19',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(668,'Mesa 20','Mesa 20',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(669,'Mesa 21','Mesa 21',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(670,'Mesa 22','Mesa 22',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(671,'Mesa 23','Mesa 23',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(672,'Mesa 24','Mesa 24',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(673,'Mesa 25','Mesa 25',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(674,'Mesa 26','Mesa 26',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(675,'Mesa 27','Mesa 27',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(676,'Mesa 28','Mesa 28',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(677,'Mesa 29','Mesa 29',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(678,'Mesa 30','Mesa 30',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(679,'Mesa 31','Mesa 31',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(680,'Mesa 32','Mesa 32',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(681,'Mesa 33','Mesa 33',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(682,'Mesa 34','Mesa 34',40,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(683,'Mesa 1','Mesa 1',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(684,'Mesa 2','Mesa 2',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(685,'Mesa 3','Mesa 3',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(686,'Mesa 4','Mesa 4',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(687,'Mesa 5','Mesa 5',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(688,'Mesa 6','Mesa 6',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(689,'Mesa 7','Mesa 7',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(690,'Mesa 8','Mesa 8',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(691,'Mesa 9','Mesa 9',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(692,'Mesa 10','Mesa 10',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(693,'Mesa 11','Mesa 11',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(694,'Mesa 12','Mesa 12',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(695,'Mesa 13','Mesa 13',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(696,'Mesa 14','Mesa 14',41,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(697,'Mesa 1','Mesa 1',42,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(698,'Mesa 1','Mesa 1',43,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(699,'Mesa 1','Mesa 1',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(700,'Mesa 2','Mesa 2',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(701,'Mesa 3','Mesa 3',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(702,'Mesa 4','Mesa 4',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(703,'Mesa 5','Mesa 5',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(704,'Mesa 6','Mesa 6',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(705,'Mesa 7','Mesa 7',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(706,'Mesa 8','Mesa 8',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(707,'Mesa 9','Mesa 9',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(708,'Mesa 10','Mesa 10',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(709,'Mesa 11','Mesa 11',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(710,'Mesa 12','Mesa 12',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(711,'Mesa 13','Mesa 13',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(712,'Mesa 14','Mesa 14',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(713,'Mesa 15','Mesa 15',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(714,'Mesa 16','Mesa 16',44,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(715,'Mesa 1','Mesa 1',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(716,'Mesa 2','Mesa 2',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(717,'Mesa 3','Mesa 3',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(718,'Mesa 4','Mesa 4',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(719,'Mesa 5','Mesa 5',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(720,'Mesa 6','Mesa 6',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(721,'Mesa 7','Mesa 7',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(722,'Mesa 8','Mesa 8',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(723,'Mesa 9','Mesa 9',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(724,'Mesa 10','Mesa 10',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(725,'Mesa 11','Mesa 11',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(726,'Mesa 12','Mesa 12',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(727,'Mesa 13','Mesa 13',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(728,'Mesa 14','Mesa 14',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(729,'Mesa 15','Mesa 15',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(730,'Mesa 16','Mesa 16',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(731,'Mesa 17','Mesa 17',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(732,'Mesa 18','Mesa 18',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(733,'Mesa 19','Mesa 19',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(734,'Mesa 20','Mesa 20',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(735,'Mesa 21','Mesa 21',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(736,'Mesa 22','Mesa 22',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(737,'Mesa 23','Mesa 23',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(738,'Mesa 24','Mesa 24',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(739,'Mesa 25','Mesa 25',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(740,'Mesa 26','Mesa 26',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(741,'Mesa 27','Mesa 27',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(742,'Mesa 28','Mesa 28',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(743,'Mesa 29','Mesa 29',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(744,'Mesa 30','Mesa 30',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(745,'Mesa 31','Mesa 31',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(746,'Mesa 32','Mesa 32',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(747,'Mesa 33','Mesa 33',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(748,'Mesa 34','Mesa 34',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(749,'Mesa 35','Mesa 35',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(750,'Mesa 36','Mesa 36',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(751,'Mesa 37','Mesa 37',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(752,'Mesa 38','Mesa 38',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(753,'Mesa 39','Mesa 39',45,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(754,'Mesa 1','Mesa 1',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(755,'Mesa 2','Mesa 2',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(756,'Mesa 3','Mesa 3',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(757,'Mesa 4','Mesa 4',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(758,'Mesa 5','Mesa 5',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(759,'Mesa 6','Mesa 6',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(760,'Mesa 7','Mesa 7',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(761,'Mesa 8','Mesa 8',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(762,'Mesa 9','Mesa 9',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(763,'Mesa 10','Mesa 10',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(764,'Mesa 11','Mesa 11',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(765,'Mesa 12','Mesa 12',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(766,'Mesa 13','Mesa 13',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(767,'Mesa 14','Mesa 14',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(768,'Mesa 15','Mesa 15',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(769,'Mesa 16','Mesa 16',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(770,'Mesa 17','Mesa 17',46,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(771,'Mesa 1','Mesa 1',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(772,'Mesa 2','Mesa 2',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(773,'Mesa 3','Mesa 3',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(774,'Mesa 4','Mesa 4',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(775,'Mesa 5','Mesa 5',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(776,'Mesa 6','Mesa 6',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(777,'Mesa 7','Mesa 7',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(778,'Mesa 8','Mesa 8',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(779,'Mesa 9','Mesa 9',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(780,'Mesa 10','Mesa 10',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(781,'Mesa 11','Mesa 11',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(782,'Mesa 12','Mesa 12',47,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(783,'Mesa 1','Mesa 1',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(784,'Mesa 2','Mesa 2',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(785,'Mesa 3','Mesa 3',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(786,'Mesa 4','Mesa 4',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(787,'Mesa 5','Mesa 5',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(788,'Mesa 6','Mesa 6',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(789,'Mesa 7','Mesa 7',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(790,'Mesa 8','Mesa 8',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(791,'Mesa 9','Mesa 9',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(792,'Mesa 10','Mesa 10',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(793,'Mesa 11','Mesa 11',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(794,'Mesa 12','Mesa 12',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(795,'Mesa 13','Mesa 13',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(796,'Mesa 14','Mesa 14',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(797,'Mesa 15','Mesa 15',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(798,'Mesa 16','Mesa 16',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(799,'Mesa 17','Mesa 17',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(800,'Mesa 18','Mesa 18',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(801,'Mesa 19','Mesa 19',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(802,'Mesa 20','Mesa 20',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(803,'Mesa 21','Mesa 21',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(804,'Mesa 22','Mesa 22',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(805,'Mesa 23','Mesa 23',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(806,'Mesa 24','Mesa 24',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(807,'Mesa 25','Mesa 25',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(808,'Mesa 26','Mesa 26',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(809,'Mesa 27','Mesa 27',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(810,'Mesa 28','Mesa 28',48,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(811,'Mesa 1','Mesa 1',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(812,'Mesa 2','Mesa 2',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(813,'Mesa 3','Mesa 3',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(814,'Mesa 4','Mesa 4',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(815,'Mesa 5','Mesa 5',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(816,'Mesa 6','Mesa 6',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(817,'Mesa 7','Mesa 7',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(818,'Mesa 8','Mesa 8',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(819,'Mesa 9','Mesa 9',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(820,'Mesa 10','Mesa 10',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(821,'Mesa 11','Mesa 11',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(822,'Mesa 12','Mesa 12',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(823,'Mesa 13','Mesa 13',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(824,'Mesa 14','Mesa 14',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(825,'Mesa 15','Mesa 15',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(826,'Mesa 16','Mesa 16',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(827,'Mesa 17','Mesa 17',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(828,'Mesa 18','Mesa 18',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(829,'Mesa 19','Mesa 19',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(830,'Mesa 20','Mesa 20',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(831,'Mesa 21','Mesa 21',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(832,'Mesa 22','Mesa 22',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(833,'Mesa 23','Mesa 23',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(834,'Mesa 24','Mesa 24',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(835,'Mesa 25','Mesa 25',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(836,'Mesa 26','Mesa 26',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(837,'Mesa 27','Mesa 27',49,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(838,'Mesa 1','Mesa 1',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(839,'Mesa 2','Mesa 2',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(840,'Mesa 3','Mesa 3',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(841,'Mesa 4','Mesa 4',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(842,'Mesa 5','Mesa 5',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(843,'Mesa 6','Mesa 6',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(844,'Mesa 7','Mesa 7',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(845,'Mesa 8','Mesa 8',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(846,'Mesa 9','Mesa 9',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(847,'Mesa 10','Mesa 10',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(848,'Mesa 11','Mesa 11',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(849,'Mesa 12','Mesa 12',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(850,'Mesa 13','Mesa 13',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(851,'Mesa 14','Mesa 14',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(852,'Mesa 15','Mesa 15',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(853,'Mesa 16','Mesa 16',50,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(854,'Mesa 1','Mesa 1',51,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(855,'Mesa 2','Mesa 2',51,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(856,'Mesa 1','Mesa 1',52,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(857,'Mesa 1','Mesa 1',53,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(858,'Mesa 2','Mesa 2',53,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(859,'Mesa 1','Mesa 1',54,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(860,'Mesa 1','Mesa 1',55,'2023-07-27 17:13:29','2023-07-27 17:13:29'),(861,'Mesa 1','Mesa 1',56,'2023-07-27 17:13:29','2023-07-27 17:13:29');
/*!40000 ALTER TABLE `mesas_votacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2022_11_25_170534_create_permission_tables',1),(5,'2022_11_26_162556_tabla-formularios',1),(6,'2022_11_30_225629_add_tipo_zona_to_formularios',1),(7,'2023_02_20_030322_create_candidatos_table',1),(8,'2023_02_20_044810_create_cargos_table',1),(9,'2023_02_20_060948_add_candidato_and_cedula_to_users_table',1),(10,'2023_06_30_194636_create_matriz_seguimiento_table',1),(11,'2023_07_07_201650_add_columns_to_formularios_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',4),(2,'App\\Models\\User',5),(1,'App\\Models\\User',10),(1,'App\\Models\\User',11);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pre_formularios`
--

DROP TABLE IF EXISTS `pre_formularios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pre_formularios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `propietario_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puesto_votacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_zona` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidato_id` bigint unsigned DEFAULT NULL,
  `identificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `mesa` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_formularios_propietario_id_foreign` (`propietario_id`),
  CONSTRAINT `pre_formularios_propietario_id_foreign` FOREIGN KEY (`propietario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_formularios`
--

LOCK TABLES `pre_formularios` WRITE;
/*!40000 ALTER TABLE `pre_formularios` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_formularios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos_votacion`
--

DROP TABLE IF EXISTS `puestos_votacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puestos_votacion` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos_votacion`
--

LOCK TABLES `puestos_votacion` WRITE;
/*!40000 ALTER TABLE `puestos_votacion` DISABLE KEYS */;
INSERT INTO `puestos_votacion` VALUES (1,'UNIVERSIDAD COOPERATIVA NUEVA SEDE','CLL 10 N 1 - 64 EDF CENTRAL BRR CENTRO','Comuna',3,'2023-07-21 00:32:11','2023-07-21 00:32:11'),(2,'CONSERVATORIO DE TOLIMA','CL 9 # 1-18','Comuna',4,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(3,'IE NELSY GARCIA OCAMPO SEDE 1','CLL 3 NO 2-40 BARRIO LIBERTADOR','Comuna',8,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(4,'IE SIMON BOLIVAR','CR 3 NO 7-75 BARRIO LA POLA','Comuna',7,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(5,'COLEGIO MARIA INMACULADA','Calle 16 No 6  67 Barrio Interlaken','Comuna',6,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(6,'COLEGIO TOLIMENSE','CRA 7A CALLE 2 BRR AUGUSTO E MEDINA','Comuna',1,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(7,'IE GERMAN PARDO SEDE PRINCIPAL','CLL 10 NO 10-20 BARRIO BELEN','Comuna',16,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(8,'IE JORGE QUEVEDO VELASQUEZ','CLL 6A No 13-118 VEINTE DE JULIO','Comuna',12,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(9,'UNIVERSIDAD ANTONIO NARIÑO','CRA 10 # 17- 35 BARRIO ANCON','Comuna',15,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(10,'IE ROMULO MORALES PARRA','CLL 3 A # 12- 63 BRR STA BARBARA','Comuna',28,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(11,'IE INEM MANUEL MURILLO TORO SE 1','CLL 22 NO 9-02 BARRIO INTERLAKEN','Comuna',6,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(12,'IE JOAQUIN PARIS','CR 9 NO 35-40 BARRIO GAITAN','Comuna',55,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(13,'IE AMINA MELENDRO PULECIO SEDE EL CARMEN','CRA 7 # 7 - 25 BRR EL CARMEN','Comuna',37,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(14,'IE BOYACA SEDE LAS AMERICAS','CALLE 22 CRA 8 BARRIO EL CARMEN','Comuna',37,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(15,'IE JORGE ELIECER GAITAN SEDE 2','CLL 42 AVDA GUABINAL BARRIO CALARCA','Comuna',51,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(16,'IE NIÑO JESUS DE PRAGA SEDE 1','CR 8 CLL 69 BARRIO JORDAN 9 ETAPA','Comuna',78,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(17,'IE CELMIRA HUERTAS','FRENTE MZ 21 CASA 1 BARRIO JORDAN 7 ETAPA','Comuna',76,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(18,'IE SAGRADA FAMILIA','CARRERA 5 N 69 41 BARRIO JORDAN','Comuna',317,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(19,'IE LUIS CARLOS GALAN SARMIENTO','CLL 67 No 26-179 LOS MANDARINOS','Comuna',132,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(20,'IE ISMAEL SANTOFIMIO SEDE PRIN','CRA 2 ENTRE CLL 7 Y 8 BARRIO LA GAVIOTA','Comuna',127,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(21,'IE FCO PAULA SANTANDER SEDE VIL','CLL 128 B CRA 11 BIS URB VILLAMARIN','Comuna',179,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(22,'IE FCO DE PAULA SANTANDER SD PACANDE','CRA 14 CLL 114 B.PACANDE','Comuna',204,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(23,'IE SALADO SEDE 1','CR 14 NO 138-59 BARRIO SALADO','Comuna',172,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(24,'IE CARLOS LLERAS RESTREPO SD SALADO','CLL 143 CRA 10 SECTOR LOS LAGOS BARRIO EL SALADO','Comuna',172,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(25,'IE MODELIA SD EL PAIS','MZ C CASA 3 URBANIZACION STA CATALINA','Comuna',215,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(26,'IE ANA JULIA SUAREZ DE ZORROZA','CRA 8 CON CALLE 123 - 50 VIA SALADO','Comuna',172,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(27,'IE TECNICA ALBERTO CASTILLA SD TOPACIO','CLL 107 CR 3 BARRIO TOPACIO','Comuna',253,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(28,'IE TECNICA ALBERTO CASTILLA SD PRINCIPAL','CLL 107 CRA 2 B. EL TOPACIO','Comuna',253,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(29,'IE RAICES DEL FUTURO SEDE 1','CLL 100 NO 2-121 BARRIO JARDIN SANTANDER','Comuna',243,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(30,'IE OFICIAL EL JARDIN','CR 3 CLL 94 BARRIO EL JARDIN','Comuna',240,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(31,'IE FE Y ALEGRIA SEDE 1','BARRIO CIUDADELA SIMON BOLIVAR 1 ETAPA','Comuna',234,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(32,'IE TULIO VARON','MANZANA K CASA 1  URB TULIO VARON','Comuna',254,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(33,'IE ALFONSO PALACIO RUDAS','MANZANA 41 Etapa 1 CIUD SIMON BOLIVAR','Comuna',234,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(34,'COLEGIO TECNICO CARLOS J HUELGOS','Manzana 1 Casa 3 Barrio el Jardin Etapa 3','Comuna',241,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(35,'IE EXALUMNAS DE LA PRESENTACION','CR 1 NO 62 - 62 BARRIO JORDAN 1 ETP','Comuna',317,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(36,'IE JUAN LOZANO SEDE 1','MZA 38 BARRIO JORDAN 3 ETAPA','Comuna',316,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(37,'IE TECNICA CIUDAD LUZ SEDE 1','CR 3 NO 78-37 BARRIO CIUDAD LUZ','Comuna',330,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(38,'IE AUGUSTO E MEDINA COMFENALCO TOLIMA','CLLE 125 #  18 SUR 96 BRR CIUD COMFENALCO','Comuna',331,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(39,'IE JUAN LOZANO Y L SEDE HERMANO ARSENIO','CRA 2 CLL 63 A 64 BR JORDAN 1 ETP','Comuna',317,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(40,'IE LEONIDAS RUBIO SEDE PRINCIPAL','CLL 30 N 2A -31 BARRIO CLARET','Comuna',364,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(41,'I.E SAN PEDRO ALEJANDRINO','CALLE 23 CON CARRERA 1 ESQUINA BARRIO SAN PEDRO','Comuna',11,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(42,'IE MIGUEL DE CERVANTES SAAVEDRA','CLL 28 # 4C 115 BRR HIPODROMO','Comuna',367,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(43,'IE SAN SIMON SEDE MONTEALEGRE','CRA 4C ESQUINA CON CLL 39 B. MACARENA ALTA','Comuna',371,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(44,'IE GUILLERMO ANGULO GOMEZ SEDE','CR 5 A SUR CLL 19 Y 21 BARRIO YULDAIMA','Comuna',426,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(45,'IE JOSE CELESTINO MUTIS SD PRINCIPAL','CRA 9 CLL 23 SUR BRR KENNEDY','Comuna',410,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(46,'IE LEONIDAS RUBIO VILLEGAS SD MARTIRES','CRA 3 A N 3-11 BARRIO LOS MARTIRES','Comuna',397,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(47,'IE ANTONIO REYES UMAÑA SD ESC CASA H','CRA 2 SUR No 33-01 BARRIO LAS BRISAS','Comuna',394,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(48,'IE LEONIDAS RUBIO SEDE RODRIGU','CR 2 CLL 27 Y 28 BARRIO LAS FERIAS','Comuna',395,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(49,'IE TECNICA CIUDAD IBAGUE SEDE','CLLE 20 SUR NO 36-106 BARRIO BOQUERON','Comuna',428,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(50,'IE SAN ISIDRO SEDE PPAL','CRA 23 N 17 -02 BARRIO SAN ISIDRO','Comuna',438,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(51,'PENITENCIARIA DE PICALEÑA','CR 45 SUR NO 134-95 BARRIO PICALEÑA','Comuna',321,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(52,'IE TEC. AMB.COMBEIMA SD OLAYA HERRERA','VEREDA LLANITOS','Corregimiento',51,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(53,'IE CARLOS LLERAS RESTREPO SEDE CHUCUNI','VEREDA CHUCUNI','Corregimiento',99,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(54,'IE SAN FRANCISCO SEDE CURAL LA TIGRERA','VEREDA EL CURAL LA TIGRERA','Corregimiento',60,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(55,'SALON COMUNAL VEREDA SANTA TERESA','VEREDA SANTA TERESA SALON COMUNAL VIA LIBERTADOR','Corregimiento',66,'2023-07-21 00:33:11','2023-07-21 00:33:11'),(56,'IE TEC AMB COMBEIMA SD PRINCIPAL','VEREDA CHAPETON FRENTE A CARLIMA','Corregimiento',43,'2023-07-21 00:33:11','2023-07-21 00:33:11');
/*!40000 ALTER TABLE `puestos_votacion` ENABLE KEYS */;
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `roles` VALUES (1,'administrador','web','2023-07-08 01:24:36','2023-07-08 01:24:36'),(2,'simple','web','2023-07-08 01:24:36','2023-07-08 01:24:36');
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `info_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_info_id_foreign_idx` (`info_id`),
  CONSTRAINT `users_info_id_foreign` FOREIGN KEY (`info_id`) REFERENCES `info_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@app.com',NULL,'$2y$10$6vMVk2yXYzrRJBxpdYnjFOXees9gBfikpieSNcyaxwNPBxwTd9Qgy',NULL,NULL,NULL,'2023-07-08 01:24:36','2023-07-08 01:24:36',NULL),(2,'simple','simple@app.com',NULL,'$2y$10$Tv2hZ7RXz.QdmK/O9BbTQ.8lWLIYgq1LaqsUkOQHZZ4V8Mleza6LK',NULL,NULL,NULL,'2023-07-08 01:24:36','2023-07-08 01:24:36',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_ediles`
--

DROP TABLE IF EXISTS `usuarios_ediles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_ediles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `tipo_zona` enum('Comuna','Corregimiento') NOT NULL DEFAULT 'Comuna',
  `direccion` varchar(255) DEFAULT NULL,
  `zona` varchar(255) NOT NULL,
  `descripcion` text,
  `genero` varchar(45) NOT NULL,
  `puesto_votacion` varchar(255) DEFAULT NULL,
  `rol` enum('Edil','Asambleista') NOT NULL DEFAULT 'Edil',
  `foto` varchar(255) DEFAULT NULL,
  `mesa` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_ediles`
--

LOCK TABLES `usuarios_ediles` WRITE;
/*!40000 ALTER TABLE `usuarios_ediles` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_ediles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veredas`
--

DROP TABLE IF EXISTS `veredas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veredas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
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

-- Dump completed on 2023-07-27 12:31:46
