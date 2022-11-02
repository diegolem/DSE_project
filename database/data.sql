-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ignite
-- ------------------------------------------------------
-- Server version	5.7.21-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Nissan','JPN'),(2,'Toyota','JPN'),(3,'Honda','JPN'),(4,'Audi','DEU'),(5,'Volkswagen','DEU'),(6,'Mercedes Benz','DEU'),(7,'BMW','DEU'),(8,'Ford','USA'),(9,'Chevrolet','USA'),(10,'Jeep','USA'),(13,'Fiat','ITA'),(14,'Peugeot','FRA'),(15,'Pontiac','USA'),(16,'Mazda','JPN'),(17,'Kia','KOR'),(18,'Hyundai','KOR'),(19,'Jaguar','GBR'),(20,'Volvo','SWE'),(21,'Ferrari','ITA'),(22,'Lamborghini','ITA');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `car_images`
--

LOCK TABLES `car_images` WRITE;
/*!40000 ALTER TABLE `car_images` DISABLE KEYS */;
INSERT INTO `car_images` VALUES (1,1,'public/cars/ROqdcrhOtL8IrWz4Wep6ErkklMZoPfjF1TpFjF7N.jpeg'),(2,2,'public/cars/EAQM3oX2q6F1icTDobxnL9KFwsqIDTOzRTqNicyI.jpeg'),(3,3,'public/cars/kIwBbzQE5GWfuRKLGDQpiaXagbr5cjArsWuCkJCo.jpeg');
/*!40000 ALTER TABLE `car_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'Lineal','5000','P789-632',12356,'Ninguna',2013,18,1,8,'2018-05-10 16:30:32','2018-05-10 16:30:32',NULL),(2,'Lineal','4600','P089-236',78900,'Ninguna',2010,1,2,2,'2018-05-10 16:45:06','2018-05-10 16:45:06',NULL),(3,'Lineal','3200','P780-639',69000,'Recien comprado',2017,20,1,14,'2018-05-10 18:52:25','2018-05-10 18:52:25',NULL);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fallo de motor','Fallo de motor'),(2,'Fallo del sistema electrico','Fallo del sistema electrico'),(3,'Defectos en carroceria','Carroceria en mal estado'),(4,'Llantas en mal estado','Llantas en mal estado');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES ('AFG','Afganistán'),('ALB','Albania'),('DEU','Alemania'),('DZA','Algeria'),('AND','Andorra'),('AGO','Angola'),('AIA','Anguila'),('ATA','Antártida'),('ATG','Antigua y Barbuda'),('ANT','Antillas Neerlandesas'),('SAU','Arabia Saudita'),('ARG','Argentina'),('ARM','Armenia'),('ABW','Aruba'),('AUS','Australia'),('AUT','Austria'),('AZE','Azerbayán'),('BHS','Bahamas'),('BHR','Bahrein'),('BGD','Bangladesh'),('BRB','Barbados'),('BEL','Bélgica'),('BLZ','Belice'),('BEN','Benín'),('BTN','Bhután'),('BLR','Bielorrusia'),('MMR','Birmania'),('BOL','Bolivia'),('BIH','Bosnia y Herzegovina'),('BWA','Botsuana'),('BRA','Brasil'),('BRN','Brunéi'),('BGR','Bulgaria'),('BFA','Burkina Faso'),('BDI','Burundi'),('CPV','Cabo Verde'),('KHM','Camboya'),('CMR','Camerún'),('CAN','Canadá'),('TCD','Chad'),('CHL','Chile'),('CHN','China'),('CYP','Chipre'),('VAT','Ciudad del Vaticano'),('COL','Colombia'),('COM','Comoras'),('COG','Congo'),('PRK','Corea del Norte'),('KOR','Corea del Sur'),('CIV','Costa de Marfil'),('CRI','Costa Rica'),('HRV','Croacia'),('CUB','Cuba'),('DNK','Dinamarca'),('DMA','Dominica'),('ECU','Ecuador'),('EGY','Egipto'),('SLV','El Salvador'),('ARE','Emiratos Árabes Unidos'),('ERI','Eritrea'),('SVK','Eslovaquia'),('SVN','Eslovenia'),('ESP','España'),('USA','Estados Unidos de América'),('EST','Estonia'),('ETH','Etiopía'),('PHL','Filipinas'),('FIN','Finlandia'),('FJI','Fiyi'),('FRA','Francia'),('GAB','Gabón'),('GMB','Gambia'),('GEO','Georgia'),('GHA','Ghana'),('GIB','Gibraltar'),('GRD','Granada'),('GRC','Grecia'),('GRL','Groenlandia'),('GLP','Guadalupe'),('GUM','Guam'),('GTM','Guatemala'),('GUF','Guayana Francesa'),('GGY','Guernsey'),('GIN','Guinea'),('GNQ','Guinea Ecuatorial'),('GNB','Guinea-Bissau'),('GUY','Guyana'),('HTI','Haití'),('HND','Honduras'),('HKG','Hong kong'),('HUN','Hungría'),('IND','India'),('IDN','Indonesia'),('IRQ','Irak'),('IRN','Irán'),('IRL','Irlanda'),('BVT','Isla Bouvet'),('IMN','Isla de Man'),('CXR','Isla de Navidad'),('NFK','Isla Norfolk'),('ISL','Islandia'),('BMU','Islas Bermudas'),('CYM','Islas Caimán'),('CCK','Islas Cocos (Keeling)'),('COK','Islas Cook'),('ALA','Islas de Åland'),('FRO','Islas Feroe'),('SGS','Islas Georgias del Sur y Sandwich del Sur'),('HMD','Islas Heard y McDonald'),('MDV','Islas Maldivas'),('FLK','Islas Malvinas'),('MNP','Islas Marianas del Norte'),('MHL','Islas Marshall'),('PCN','Islas Pitcairn'),('SLB','Islas Salomón'),('TCA','Islas Turcas y Caicos'),('UMI','Islas Ultramarinas Menores de Estados Unidos'),('VG','Islas Vírgenes Británicas'),('VIR','Islas Vírgenes de los Estados Unidos'),('ISR','Israel'),('ITA','Italia'),('JAM','Jamaica'),('JPN','Japón'),('JEY','Jersey'),('JOR','Jordania'),('KAZ','Kazajistán'),('KEN','Kenia'),('KGZ','Kirgizstán'),('KIR','Kiribati'),('KWT','Kuwait'),('LAO','Laos'),('LSO','Lesoto'),('LVA','Letonia'),('LBN','Líbano'),('LBR','Liberia'),('LBY','Libia'),('LIE','Liechtenstein'),('LTU','Lituania'),('LUX','Luxemburgo'),('MAC','Macao'),('MKD','Macedônia'),('MDG','Madagascar'),('MYS','Malasia'),('MWI','Malawi'),('MLI','Mali'),('MLT','Malta'),('MAR','Marruecos'),('MTQ','Martinica'),('MUS','Mauricio'),('MRT','Mauritania'),('MYT','Mayotte'),('MEX','México'),('FSM','Micronesia'),('MDA','Moldavia'),('MCO','Mónaco'),('MNG','Mongolia'),('MNE','Montenegro'),('MSR','Montserrat'),('MOZ','Mozambique'),('NAM','Namibia'),('NRU','Nauru'),('NPL','Nepal'),('NIC','Nicaragua'),('NER','Niger'),('NGA','Nigeria'),('NIU','Niue'),('NOR','Noruega'),('NCL','Nueva Caledonia'),('NZL','Nueva Zelanda'),('OMN','Omán'),('NLD','Países Bajos'),('PAK','Pakistán'),('PLW','Palau'),('PSE','Palestina'),('PAN','Panamá'),('PNG','Papúa Nueva Guinea'),('PRY','Paraguay'),('PER','Perú'),('PYF','Polinesia Francesa'),('POL','Polonia'),('PRT','Portugal'),('PRI','Puerto Rico'),('QAT','Qatar'),('GBR','Reino Unido'),('CAF','República Centroafricana'),('CZE','República Checa'),('DOM','República Dominicana'),('REU','Reunión'),('RWA','Ruanda'),('ROU','Rumanía'),('RUS','Rusia'),('ESH','Sahara Occidental'),('WSM','Samoa'),('ASM','Samoa Americana'),('BLM','San Bartolomé'),('KNA','San Cristóbal y Nieves'),('SMR','San Marino'),('MAF','San Martín (Francia)'),('SPM','San Pedro y Miquelón'),('VCT','San Vicente y las Granadinas'),('SHN','Santa Elena'),('LCA','Santa Lucía'),('STP','Santo Tomé y Príncipe'),('SEN','Senegal'),('SRB','Serbia'),('SYC','Seychelles'),('SLE','Sierra Leona'),('SGP','Singapur'),('SYR','Siria'),('SOM','Somalia'),('LKA','Sri lanka'),('ZAF','Sudáfrica'),('SDN','Sudán'),('SWE','Suecia'),('CHE','Suiza'),('SUR','Surinám'),('SJM','Svalbard y Jan Mayen'),('SWZ','Swazilandia'),('TJK','Tadjikistán'),('THA','Tailandia'),('TWN','Taiwán'),('TZA','Tanzania'),('IOT','Territorio Británico del Océano Índico'),('ATF','Territorios Australes y Antárticas Franceses'),('TLS','Timor Oriental'),('TGO','Togo'),('TKL','Tokelau'),('TON','Tonga'),('TTO','Trinidad y Tobago'),('TUN','Tunez'),('TKM','Turkmenistán'),('TUR','Turquía'),('TUV','Tuvalu'),('UKR','Ucrania'),('UGA','Uganda'),('URY','Uruguay'),('UZB','Uzbekistán'),('VUT','Vanuatu'),('VEN','Venezuela'),('VNM','Vietnam'),('WLF','Wallis y Futuna'),('YEM','Yemen'),('DJI','Yibuti'),('ZMB','Zambia'),('ZWE','Zimbabue');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detail_client_car`
--

LOCK TABLES `detail_client_car` WRITE;
/*!40000 ALTER TABLE `detail_client_car` DISABLE KEYS */;
INSERT INTO `detail_client_car` VALUES (1,7,1,0),(2,8,1,0),(4,8,3,0);
/*!40000 ALTER TABLE `detail_client_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detail_mechanic_repair`
--

LOCK TABLES `detail_mechanic_repair` WRITE;
/*!40000 ALTER TABLE `detail_mechanic_repair` DISABLE KEYS */;
INSERT INTO `detail_mechanic_repair` VALUES (1,5,1,NULL,NULL),(2,3,1,NULL,NULL),(3,9,1,NULL,NULL),(4,5,2,NULL,NULL),(5,5,3,NULL,NULL),(6,3,3,NULL,NULL);
/*!40000 ALTER TABLE `detail_mechanic_repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detail_mechanic_specialty`
--

LOCK TABLES `detail_mechanic_specialty` WRITE;
/*!40000 ALTER TABLE `detail_mechanic_specialty` DISABLE KEYS */;
INSERT INTO `detail_mechanic_specialty` VALUES (1,2,5),(2,2,3),(3,2,9),(4,1,3),(5,1,9);
/*!40000 ALTER TABLE `detail_mechanic_specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'Toyota Corolla',2),(2,'Honda Civic',3),(3,'Nissan Sentra',1),(4,'Ford Focus',8),(5,'Mercedez-AMG',6),(6,'Audi A4',4),(7,'Volkswagen Jetta',5),(8,'BMW X1',7),(9,'Ford Explorer',8),(10,'Chevrolet Tahoe',9),(11,'Jeep Wrangler',10),(12,'Fiat Cronos',13),(13,'Peugeot 307',14),(14,'Pontiac Vibe',15),(15,'Mazda 3',16),(16,'Kia Forte',17),(17,'Hyundai Elantra',18),(18,'Jaguar XE',19),(19,'Volvo XC90',20),(20,'Ferrari F12',21),(21,'Lamborghini Diablo',22);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `repair_details`
--

LOCK TABLES `repair_details` WRITE;
/*!40000 ALTER TABLE `repair_details` DISABLE KEYS */;
INSERT INTO `repair_details` VALUES (1,'Marcas de forcejeo','Hay unas pequeñas marcas de forcejeo en las cerraduras y pequeños golpes por fuera',80.00,'2017-11-03 00:00:00',1,3),(2,'Manchas de líquidos por dentro y por fuera','Se limpó por dentro por que contenía manchas',50.00,'2017-11-04 00:00:00',1,3),(3,'Partes de otro vechículo','Se repararon partes de otro vehículo diferente a las partes de fábrica',60.00,'2018-05-04 00:00:00',2,1);
/*!40000 ALTER TABLE `repair_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `repairs`
--

LOCK TABLES `repairs` WRITE;
/*!40000 ALTER TABLE `repairs` DISABLE KEYS */;
INSERT INTO `repairs` VALUES (1,'R2018-752479','2017-11-02',NULL,0,3),(2,'R2018-704095','2018-05-01',NULL,0,1),(3,'R2018-220305','2018-03-15',NULL,0,2);
/*!40000 ALTER TABLE `repairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `specialties`
--

LOCK TABLES `specialties` WRITE;
/*!40000 ALTER TABLE `specialties` DISABLE KEYS */;
INSERT INTO `specialties` VALUES (1,'Electrico','Sistema electrico en general'),(2,'General','Mecanica general'),(3,'Carroceria','Carroceria en general'),(4,'Especial','Casos especiales, donde la mecanica general no es suficiente');
/*!40000 ALTER TABLE `specialties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `transmissions`
--

LOCK TABLES `transmissions` WRITE;
/*!40000 ALTER TABLE `transmissions` DISABLE KEYS */;
INSERT INTO `transmissions` VALUES (1,'Manual','Manual'),(2,'Automanica','Automatica'),(3,'Secuencial','Secuencial');
/*!40000 ALTER TABLE `transmissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'00000000-0','frank.esquivel115@gmail.com','$2y$10$wxhsHpzqq6U3HwoRGb1IjuOjtWGCjUzhxaqRqhFst3OR3z577Dxtq','Franklin Armando','Esquivel Guevara','1998-09-26',19,'Sta. Lucía','0000-0000','ADM','eg171989','2018-05-10 15:59:03','2018-05-10 15:59:03',NULL),(2,'00000000-1','mojica.lemus@gmail.com','$2y$10$AZZW4ZoqXhqoNbDlEKfVb.hcMTC.cFieTPIt/wgc3pONOHdk9.Lyq','Carlos Alexander','Lemus Guardado','1998-04-01',18,'jepa','0000-0000','CLE','lg171618','2018-05-10 15:59:03','2018-05-10 15:59:03',NULL),(3,'00000000-2','ciegolem7@gmail.com','$2y$10$qsFoZEOyfrLur/J8LhRF9e0kHCKM8EQmJhPIOs8EIkRztNHRI8MMm','Diego Alberto','Lemus Torres','1999-04-07',19,'Por el volcán','0000-0000','MCO','lt171997','2018-05-10 15:59:03','2018-05-10 15:59:03',NULL),(4,'00000000-3','jasson_alex99@hotmail.com','$2y$10$rLPWN6AGem3Wy/mPWfKrhuLpE9WraVCbrDALo61TnSlOhUrBuYom6','Jasson Alexander','López Soriano','1999-07-10',18,'Soyamuerte','0000-0000','ASI','ls172000','2018-05-10 15:59:03','2018-05-10 15:59:03',NULL),(5,'0000000-4','lopezleonardo282@gmail.com','$2y$10$jr5MyLVBRmORI505ad9Jaueja28SCGHEWdnQm42438ozPSxwnHJ3a','Leonardo Elenilson','López Cañas','1999-04-09',18,'Altavista','0000-0000','MCO','lc171998','2018-05-10 15:59:03','2018-05-10 15:59:03',NULL),(6,'02145632-6','juan.molina@gmail.com','$2y$10$.DI8NmOaXOGwlE0/wFQ2iOGv9vooloHSoVxyPxfIKgDg5ETnlQRhi','Juan Carlos','Molina Arias','1988-04-14',30,'Sin especificar','2236-9481','CLE',NULL,'2018-05-10 16:22:49','2018-05-10 16:22:49',NULL),(7,'45981234-9','kevin.pereira@gmail.com','$2y$10$69UbpUbS39NClfMkuP5q.OJPtJNMn3PrjP.Kx83P7RjrD.GlMU/XG','Kevin Ariel','Pereira Najarro','1986-08-21',31,'Sin especificar','2528-9617','CLE',NULL,'2018-05-10 16:23:56','2018-05-10 16:23:56',NULL),(8,'45617829-6','fidel.castro@gmail.com','$2y$10$9IzLSyRb9BqYiVbx5U98IerjabK4X5jOQ0wEHthFNMjLFuv2xdmVa','Fidel Ernesto','Castro Varela','1988-03-24',30,'Sin especificar','2469-6320','CLE',NULL,'2018-05-10 16:25:31','2018-05-10 16:25:31',NULL),(9,'45612358-9','tixa.garcia@gmail.com','$2y$10$Wg6Pl5AneDsuzrmKPsa3gO.KQ6tghhj.g6hl2NjlvUbr3Dro1YBDi','Tixa Armando','Garcia Guevara','1998-05-14',19,'No especificada','2996-6965','MCO',NULL,'2018-05-10 17:54:24','2018-05-10 17:54:24',NULL),(10,'65147819-9','julia.hernandez@gmail.com','$2y$10$9odaYmBXEwtplTG8L070DuTkG6V3H4MlEFZGD6b6CRovYmCG7g6Kq','Julia Maria','Hernadez Belloso','1989-12-28',28,'Sin especificar','2584-9634','CLE',NULL,'2018-05-10 18:39:18','2018-05-10 18:39:18',NULL),(11,'52489317-6','ana.rosales@gmail.com','$2y$10$OSA4/JuvKcJJpWdX30HAZ.9vo5knq.OTAx9VO.S3A0F4JZBn.uS9e','Ana Ruth','Rosales Castaneda','1984-01-18',34,'Sin especificar','2936-4178','CLE',NULL,'2018-05-10 18:40:37','2018-05-10 18:40:37',NULL),(12,'42671938-5','reina.campos@gmail.com','$2y$10$ruyuQCpjGy9ngq57OL3/WuxGbzui0mLKG4TPyPoJMz5bKqzUKR39y','Reina Yaritza','Campos Mejia','1984-06-09',33,'Sin especificar','2478-1482','CLE',NULL,'2018-05-10 18:43:15','2018-05-10 18:43:15',NULL),(13,'16479514-9','walter.corpeno@gmail.com','$2y$10$Vt78Lnae9xPp6nAtMo3Hd.ELBTPdmL7vaCIjJcLSzXZXr.TI5tZa.','Walter Ernesto','Corpeño Parada','1999-09-17',18,'Sin especificar','2784-3692','CLE',NULL,'2018-05-10 18:47:40','2018-05-10 18:47:40',NULL),(14,'45691872-9','kevin.bryan@gmail.com','$2y$10$8Pp2Bbf4r8738yF5puc.X.aNv8yZcSSyU5kT2WdAkYeNhG6nlVwVS','Kevin Bryan','Esquivel Guevara','1993-10-31',24,'Sin especificar','2628-2927','CLE',NULL,'2018-05-10 18:48:58','2018-05-10 18:48:58',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_types`
--

LOCK TABLES `users_types` WRITE;
/*!40000 ALTER TABLE `users_types` DISABLE KEYS */;
INSERT INTO `users_types` VALUES ('ADM','Administrador',''),('ASI','Asistente',''),('CLE','Cliente',''),('MCO','Mecánico','');
/*!40000 ALTER TABLE `users_types` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-10 22:17:31
