-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: toolrocks
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `band_id` int(10) unsigned NOT NULL,
  `release_date` datetime NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `albums_band_id_slug_unique` (`band_id`,`slug`),
  CONSTRAINT `albums_band_id_foreign` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'72826','72826',1,'1991-12-21 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(2,'Opiate','opiate',1,'1992-03-10 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(3,'Undertow','undertow',1,'1993-04-06 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(4,'Aenima','aenima',1,'1996-09-17 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(5,'Salival','salival',1,'2000-12-12 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(6,'Lateralus','lateralus',1,'2001-05-15 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(7,'10,000 Days','10000-days',1,'2006-05-02 00:00:00',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bands`
--

DROP TABLE IF EXISTS `bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bands_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bands`
--

LOCK TABLES `bands` WRITE;
/*!40000 ALTER TABLE `bands` DISABLE KEYS */;
INSERT INTO `bands` VALUES (1,'Tool','tool',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(2,'A Perfect Circle','a-perfect-circle',NULL,'2017-08-05 12:18:45','2017-08-05 12:18:45',NULL),(3,'Puscifer','puscifer',NULL,'2017-08-05 12:19:42','2017-08-05 12:19:42',NULL),(4,'Deftones','deftones',NULL,'2017-08-05 12:20:12','2017-08-05 12:20:12',NULL),(5,'3TEETH','3teeth',NULL,'2017-08-05 12:21:05','2017-08-05 12:21:05',NULL),(6,'Poop','poopy',NULL,'2017-08-05 12:39:33','2017-08-05 12:46:21',NULL);
/*!40000 ALTER TABLE `bands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipsums`
--

DROP TABLE IF EXISTS `ipsums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipsums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `band_id` int(10) unsigned NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipsums_band_id_foreign` (`band_id`),
  CONSTRAINT `ipsums_band_id_foreign` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipsums`
--

LOCK TABLES `ipsums` WRITE;
/*!40000 ALTER TABLE `ipsums` DISABLE KEYS */;
INSERT INTO `ipsums` VALUES (1,1,'Cold silence has a tendency to atrophy and sense of compassion between supposed lovers, between supposed brothers.','2017-08-07 16:01:51','2017-08-07 16:01:51',NULL),(2,1,'I know the pieces fit \'cause I watched them fall away.','2017-08-07 16:02:28','2017-08-07 16:02:28',NULL),(3,1,'To bring the pieces back together, rediscover communication.','2017-08-07 16:03:31','2017-08-07 16:03:31',NULL),(4,1,'No fault, none to blame, it doesn\'t mean I don\'t desire to Point the finger, blame the other, watch the temple topple over.','2017-08-07 16:03:47','2017-08-07 16:03:47',NULL),(5,1,'Boredom\'s not a burden anyone should bear.','2017-08-07 16:04:13','2017-08-07 16:04:13',NULL),(6,1,'It\'s not enough. I need more. Nothing seems to satisfy. I said I don\'t want it. I just need it. To breathe, To feel, to know I\'m alive.','2017-08-07 16:04:50','2017-08-07 16:04:50',NULL),(7,1,'How can it mean anything to me if I really don\'t feel anything at all?','2017-08-07 16:08:08','2017-08-07 16:08:08',NULL),(8,1,'Something kinda sad about the way that things have come to be. Desensitized to everything. What became of subtlety?','2017-08-07 16:08:38','2017-08-07 16:08:38',NULL),(9,1,'This may hurt a little but it\'s something you\'ll get used to.','2017-08-07 16:09:06','2017-08-07 16:09:06',NULL),(10,1,'But you\'re pushing and shoving me.','2017-08-07 16:09:47','2017-08-07 16:09:47',NULL),(11,1,'I\'m slipping back into the gap again.','2017-08-07 16:10:50','2017-08-07 16:10:50',NULL),(12,1,'Just remember I will always love you, as I claw your fucking throat away.','2017-08-07 16:11:15','2017-08-07 16:11:15',NULL),(13,1,'Do unto others what has been done to you','2017-08-07 16:11:59','2017-08-07 16:11:59',NULL),(14,1,'And only this one holy medium brings me peace of mind.','2017-08-07 16:12:22','2017-08-07 16:12:22',NULL),(15,1,'I have found some kind of temporary sanity in this shit, blood, and cum on my hands.','2017-08-07 16:12:55','2017-08-07 16:12:55',NULL),(16,1,'Get off your fuckin cross. We need the fuckin space to nail the next fool martyr.','2017-08-07 17:39:08','2017-08-07 17:39:08',NULL),(17,1,'To ascend you must die. You must be crucified.','2017-08-07 17:39:36','2017-08-07 17:39:36',NULL),(18,1,'And I feel this coming over like a storm again.','2017-08-07 17:40:01','2017-08-07 17:40:01',NULL),(19,1,'Change is coming through my shadow.','2017-08-07 17:40:46','2017-08-07 17:40:46',NULL),(20,1,'My shadow\'s shedding skin. I\'ve been picking my scabs again.','2017-08-07 17:41:30','2017-08-07 17:41:30',NULL),(21,1,'I wanna feel the change consume me. Feel the outside turning in. I wanna feel the metamorphosis and cleansing I\'ve endured within.','2017-08-07 17:42:11','2017-08-07 17:42:11',NULL),(22,1,'Well now I\'ve got some advice for you, little buddy.','2017-08-07 17:43:00','2017-08-07 17:43:00',NULL),(23,1,'All you know about me is what I\'ve sold you, dumb fuck. I sold out long before you ever heard my name.','2017-08-07 17:45:43','2017-08-07 17:45:43',NULL),(24,1,'I sold my soul to make a record, dip shit. And you bought one.','2017-08-07 17:50:37','2017-08-07 17:50:37',NULL),(25,1,'What was it like to see the face of your own stability suddenly look away leaving you with the dead and hopeless?','2017-08-07 17:51:37','2017-08-07 17:51:37',NULL),(26,1,'What is this but my reflection? Who am I to judge and strike you down?','2017-08-07 17:52:33','2017-08-07 17:52:33',NULL),(27,1,'Some say the end is near. Some say we\'ll see armageddon soon.','2017-08-07 17:52:57','2017-08-07 17:52:57',NULL),(28,1,'Here in this hopeless fucking hole we call LA. The only way to fix it is to flush it all away.','2017-08-07 17:53:58','2017-08-07 17:53:58',NULL),(29,1,'Learn to swim, I\'ll see you down in Arizona bay.','2017-08-07 17:54:13','2017-08-07 17:54:13',NULL),(30,1,'It\'s a bullshit three ring circus sideshow of freaks.','2017-08-07 17:55:23','2017-08-07 17:55:23',NULL),(31,1,'Mom\'s gonna fix it all soon. Mom\'s comin\' round to put it back the way it ought to be.','2017-08-07 17:55:43','2017-08-07 17:55:43',NULL),(32,1,'Don\'t just call me pessimist. Try and read between the lines.','2017-08-07 17:56:06','2017-08-07 17:56:06',NULL),(33,1,'Dreaming of that face again. It\'s bright and blue and shimmering. Grinning wide and comforting me with it\'s three warm and wild eyes.','2017-08-07 17:56:38','2017-08-07 17:56:38',NULL),(34,1,'Prying open my third eye.','2017-08-07 17:57:10','2017-08-07 17:57:10',NULL),(35,1,'So good to see you once again. I thought that you were hiding from me. And you thought that I had run away. Chasing a trail of smoke and reason.','2017-08-07 17:57:32','2017-08-07 17:57:32',NULL),(36,1,'I don\'t want to be hostile. I don\'t want to be dismal.','2017-08-07 17:58:03','2017-08-07 17:58:03',NULL),(37,1,'I am not innocent. You are not innocent. No one is innocent.','2017-08-07 17:58:33','2017-08-07 17:58:33',NULL),(38,1,'Thought I could make it end. Thought I could wash the stains away. Thought I could break the circle if I slipped right into your skin.','2017-08-07 17:59:10','2017-08-07 17:59:10',NULL),(39,1,'I\'ve come round full circle. My lamb and martyr, this will be over soon. You look so precious.','2017-08-07 17:59:36','2017-08-07 17:59:36',NULL),(40,1,'So sweet was your surrender. We have become one. I have become my terror. And you my precious lamb and martyr.','2017-08-07 18:00:16','2017-08-07 18:00:16',NULL),(41,1,'Jesus, won\'t you fucking whistle something but the past and done?','2017-08-07 18:00:44','2017-08-07 18:00:44',NULL),(42,1,'Why can\'t we not be sober? I just want to start this over.','2017-08-07 18:01:05','2017-08-07 18:01:05',NULL),(43,1,'I will find a center in you. I will chew it up and leave, I will work to elevate you just enough to bring you down.','2017-08-07 18:01:22','2017-08-07 18:01:22',NULL),(44,1,'My compassion is broken now. My will is eroded, and my desire stolen and it makes me feel ugly.','2017-08-07 18:01:46','2017-08-07 18:01:46',NULL),(45,1,'My piss and moans are the fuel that set my head on fire.','2017-08-07 18:02:00','2017-08-07 18:02:00',NULL),(46,1,'Shit adds up at the bottom.','2017-08-07 18:02:12','2017-08-07 18:02:12',NULL),(47,1,'I\'m shameless, nameless, nothing, and no one now.','2017-08-07 18:02:46','2017-08-07 18:02:46',NULL),(48,1,'You crawled away from me. Slipped away from me.','2017-08-07 18:03:05','2017-08-07 18:03:05',NULL),(49,1,'Because I can see your back is turning. If I could I\'d stick the knife in.','2017-08-07 18:03:24','2017-08-07 18:03:24',NULL),(50,1,'My warning meant nothing. You\'re dancing in quicksand.','2017-08-07 18:03:37','2017-08-07 18:03:37',NULL),(51,1,'This bog is thick and easy to get lost in when you\'re a stupid, dumb ass, belligerent fucker.','2017-08-07 18:05:40','2017-08-07 18:05:40',NULL),(52,1,'I hope it sucks you down.','2017-08-07 18:06:05','2017-08-07 18:06:05',NULL),(53,1,'I\'ve been struck dumb by a voice that speaks from deep beneath the cold black water.','2017-08-07 18:06:24','2017-08-07 18:06:24',NULL),(54,1,'The current\'s mouth below me opens up around me. Suggests and beckons all while swallowing. It surrounds and drowns and sweeps me away.','2017-08-07 18:06:57','2017-08-07 18:06:57',NULL),(55,1,'But I\'m so comfortable...Too comfortable.','2017-08-07 18:07:26','2017-08-07 18:07:26',NULL),(56,1,'And it\'s half as high as heaven and half as clear as reason.','2017-08-07 18:07:54','2017-08-07 18:07:54',NULL),(57,1,'I\'m back down. I\'m in the undertow. I\'m helpless and awake in the undertow.','2017-08-07 18:08:13','2017-08-07 18:08:13',NULL),(58,1,'Get up and free yourself from yourself.','2017-08-07 18:08:28','2017-08-07 18:08:28',NULL),(59,1,'Locked up inside you, like the calm beneath castles, is a cavern of treasures that no one has been to.','2017-08-07 18:08:52','2017-08-07 18:08:52',NULL),(60,1,'Lay back and let me show you another way.','2017-08-07 18:09:16','2017-08-07 18:09:16',NULL),(61,1,'Give in now and let me in. You\'ll like this in. Don\'t pull it out.','2017-08-07 18:09:40','2017-08-07 18:09:40',NULL),(62,1,'All I knew and all I believed are crumbling images that no longer comfort me.','2017-08-07 18:10:00','2017-08-07 18:10:00',NULL),(63,1,'I scramble to reach higher ground, some order and sanity, or something to comfort me.','2017-08-07 18:10:24','2017-08-07 18:10:24',NULL),(64,1,'The water is rising up on me. Thought the sun would come deliver me, but the truth has come to punish me instead.','2017-08-07 18:11:01','2017-08-07 18:11:01',NULL),(65,1,'Seems like I\'ve been here before. Seems so familiar. Seems like I\'m slipping into a dream within a dream.','2017-08-07 18:11:31','2017-08-07 18:11:31',NULL),(66,1,'I can\'t say what I want to, even if I\'m not serious.','2017-08-07 18:12:14','2017-08-07 18:12:14',NULL),(67,1,'Things like.... \"Fuck yourself, kill yourself, you piece of shit.\"','2017-08-07 18:12:26','2017-08-07 18:12:26',NULL),(68,1,'People tell me what to say, what to think, and what to play.','2017-08-07 18:12:44','2017-08-07 18:12:44',NULL),(69,1,'Just kidding.','2017-08-07 18:12:58','2017-08-07 18:12:58',NULL),(70,1,'I know you better than I know myself.','2017-08-07 18:13:16','2017-08-07 18:13:16',NULL),(71,1,'You are a part of me.','2017-08-07 18:13:30','2017-08-07 18:13:30',NULL),(72,1,'Trembling at the thought of feeling.','2017-08-07 18:13:52','2017-08-07 18:13:52',NULL),(73,1,'Underneath her skin and jewelry, hidden in her words and eyes is a wall that\'s cold and ugly and she\'s scared as hell.','2017-08-07 18:14:10','2017-08-07 18:14:10',NULL),(74,1,'Someone told me once that there\'s a right and wrong, and that punishment would come to those who dare to cross the line.','2017-08-07 18:15:08','2017-08-07 18:15:08',NULL),(75,1,'Maybe it takes longer to catch a total asshole. but I\'m tired of waiting. Maybe it\'s just bullshit and I should play GOD, and shoot you myself.','2017-08-07 18:15:31','2017-08-07 18:15:31',NULL),(76,1,'Consequences dictate our course of action and it doesn\'t matter what\'s right. It\'s only wrong if you get caught.','2017-08-07 18:16:22','2017-08-07 18:16:22',NULL),(77,1,'Choices always were a problem for you. What you need is someone strong to guide you.','2017-08-07 18:16:49','2017-08-07 18:16:49',NULL),(78,1,'Deaf and blind and dumb and born to follow, what you need is someone strong to use you... like me.','2017-08-07 18:17:12','2017-08-07 18:17:12',NULL),(79,1,'If you want to get your soul to heaven, trust in me. Don\'t judge or question.','2017-08-07 18:18:17','2017-08-07 18:18:17',NULL),(80,1,'We both want to rape you.','2017-08-07 18:18:33','2017-08-07 18:18:33',NULL),(81,1,'Jesus Christ, why don\'t you come save my life?','2017-08-07 18:18:48','2017-08-07 18:18:48',NULL),(82,1,'Slide a mile six inches at a time on Maynard\'s dick.','2017-08-07 18:19:33','2017-08-07 18:19:33',NULL),(83,1,'There\'s a shyness found in reason.','2017-08-07 18:20:00','2017-08-07 18:20:00',NULL),(84,1,'Lock the door, kill the light. No one\'s coming home tonight.','2017-08-07 18:20:22','2017-08-07 18:20:22',NULL),(85,1,'Locked in a place where no one goes.','2017-08-07 18:20:38','2017-08-07 18:20:38',NULL),(86,1,'It\'s getting colder.','2017-08-07 18:20:54','2017-08-07 18:20:54',NULL),(87,1,'Wear the grudge like a crown of negativity. Calculate what we will or will not tolerate. Desperate to control all and everything. Unable to forgive your scarlet lettermen.','2017-08-07 18:21:29','2017-08-07 18:21:29',NULL),(88,1,'Clutch it like a cornerstone. Otherwise it all comes down.','2017-08-07 18:21:47','2017-08-07 18:21:47',NULL),(89,1,'Terrified of being wrong. Ultimatum prison cell.','2017-08-07 18:22:01','2017-08-07 18:22:01',NULL),(90,1,'Defining, confining, controlling, and we\'re sinking deeper.','2017-08-07 18:22:21','2017-08-07 18:22:21',NULL),(91,1,'Saturn ascends, the one, the ten. Ignorant to the damage done.','2017-08-07 18:22:45','2017-08-07 18:22:45',NULL),(92,1,'Give away the stone. Let the oceans take and transmutate this cold and fated anchor.','2017-08-07 18:23:10','2017-08-07 18:23:10',NULL),(93,1,'A groan of tedium escapes me, startling the fearful.','2017-08-07 18:23:29','2017-08-07 18:23:29',NULL),(94,1,'Is this a test? It has to be. Otherwise I can\'t go on.','2017-08-07 18:23:47','2017-08-07 18:23:47',NULL),(95,1,'But I\'m still right here giving blood, keeping faith and I\'m still right here.','2017-08-07 18:24:52','2017-08-07 18:24:52',NULL),(96,1,'If there were no rewards to reap, noo loving embrace to see me through this tedious path I\'ve chosen here, I certainly would\'ve walked away by now. Gonna wait it out.','2017-08-07 18:25:27','2017-08-07 18:25:27',NULL),(97,1,'Be patient. I must keep reminding myself of this.','2017-08-07 18:26:01','2017-08-07 18:26:01',NULL),(98,1,'Gonna wait it out.','2017-08-07 18:26:13','2017-08-07 18:26:13',NULL),(99,1,'So familiar and overwhelmingly warm this one, this form I hold now.','2017-08-07 18:26:49','2017-08-07 18:26:49',NULL),(100,1,'We barely remember what came before this precious moment.','2017-08-07 18:27:50','2017-08-07 18:27:50',NULL),(101,1,'This body makes me feel eternal.','2017-08-07 18:28:09','2017-08-07 18:28:09',NULL),(102,1,'All this pain is an illusion.','2017-08-07 18:28:18','2017-08-07 18:28:18',NULL),(103,1,'In this holy reality, in this holy experience. Choosing to be here in this body.','2017-08-07 18:28:53','2017-08-07 18:28:53',NULL),(104,1,'Twirling round with this familiar parable. Spinning, weaving round each new experience.','2017-08-07 18:29:21','2017-08-07 18:29:21',NULL),(105,1,'Recognize this as a holy gift and celebrate this chance to be alive and breathing.','2017-08-07 18:29:32','2017-08-07 18:29:32',NULL),(106,1,'This body holding me reminds me of my own mortality.','2017-08-07 18:29:49','2017-08-07 18:29:49',NULL),(107,1,'Embrace this moment. Remember. We are eternal.','2017-08-07 18:29:59','2017-08-07 18:29:59',NULL),(108,1,'Suck and suck.','2017-08-07 18:30:17','2017-08-07 18:30:17',NULL),(109,1,'Suckin up all you can, suckin up all you can suck. Workin up under my patience like a little tick. Fat little parasite.','2017-08-07 18:30:40','2017-08-07 18:30:40',NULL),(110,1,'My blood is bruised and borrowed. You thieving bastards. You have turned my blood cold and bitter, beat my compassion black and blue.','2017-08-07 18:30:56','2017-08-07 18:30:56',NULL),(111,1,'I hope you\'re choking. I hope you choke on this.','2017-08-07 18:31:18','2017-08-07 18:31:18',NULL),(112,1,'Suck me dry.','2017-08-07 18:31:41','2017-08-07 18:31:41',NULL),(113,1,'Taken all you can, taken all you can fuckin\' take. Got nothing left to give to you.','2017-08-07 18:32:08','2017-08-07 18:32:08',NULL),(114,1,'Black then white are all I see in my infancy. Red and yellow then came to be, reaching out to me. Lets me see.','2017-08-07 18:32:33','2017-08-07 18:32:33',NULL),(115,1,'Push the envelope. Watch it bend.','2017-08-07 18:33:03','2017-08-07 18:33:03',NULL),(116,1,'Over thinking, over analyzing separates the body from the mind. Withering my intuition, missing opportunities and I must feed my will to feel my moment drawing way outside the lines.','2017-08-07 18:33:43','2017-08-07 18:33:43',NULL),(117,1,'Over thinking, over analyzing separates the body from the mind.','2017-08-07 18:33:51','2017-08-07 18:33:51',NULL),(118,1,'Feed my will to feel this moment urging me to cross the line.','2017-08-07 18:34:14','2017-08-07 18:34:14',NULL),(119,1,'Reaching out to embrace the random. Reaching out to embrace whatever may come.','2017-08-07 18:34:32','2017-08-07 18:34:32',NULL),(120,1,'And following our will and wind we may just go where no one\'s been. We\'ll ride the spiral to the end and may just go where no one\'s been.','2017-08-07 18:35:58','2017-08-07 18:35:58',NULL),(121,1,'Spiral out. Keep going, going...','2017-08-07 18:36:19','2017-08-07 18:36:19',NULL),(122,1,'Mention this to me. Mention something, mention anything... and watch the weather change.','2017-08-07 18:36:47','2017-08-07 18:36:47',NULL),(123,1,'So crucify the ego, before it\'s far too late.','2017-08-07 18:37:23','2017-08-07 18:37:23',NULL),(124,1,'Leave behind this place so negative and blind and cynical, and you will come to find that we are all one mind.','2017-08-07 18:37:46','2017-08-07 18:37:46',NULL),(125,1,'Without her, we are lifeless satellites drifting.','2017-08-07 18:38:17','2017-08-07 18:38:17',NULL),(126,1,'The moon tells me a secret - my confidant As full and bright as I am this light is not my own and a million light reflections pass over me.','2017-08-07 18:38:47','2017-08-07 18:38:47',NULL),(127,1,'Eye on the TV \'cause tragedy thrills me. Whatever flavor it happens to be.','2017-08-07 18:39:26','2017-08-07 18:39:26',NULL),(128,1,'Don\'t look at me like I am a monster. Frown out your one face, but with the other stare like a junkie into the TV.','2017-08-07 18:48:29','2017-08-07 18:48:29',NULL),(129,1,'Vicariously, I live while the whole world dies.','2017-08-07 18:48:50','2017-08-07 18:48:50',NULL),(130,1,'Why can\'t we just admit it?','2017-08-07 18:48:59','2017-08-07 18:48:59',NULL),(131,1,'I need to watch things die from a good safe distance.','2017-08-07 18:49:11','2017-08-07 18:49:11',NULL),(132,1,'Credulous at best your desire to believe in Angels in the hearts of men.','2017-08-07 18:49:34','2017-08-07 18:49:34',NULL),(133,1,'But pull your head on out your hippie haze and give a listen. Shouldn\'t have to say it all again.','2017-08-07 18:50:08','2017-08-07 18:50:08',NULL),(134,1,'The universe is hostile, so impersonal. Devour to survive. So it is, so it\'s always been.','2017-08-07 18:50:33','2017-08-07 18:50:33',NULL),(135,1,'We all feed on tragedy. It\'s like blood to a vampire.','2017-08-07 18:50:52','2017-08-07 18:50:52',NULL),(136,1,'Here from a kings mountain view, here from the wild dream come true. Feast like a sultan I do on treasures and flesh never few.','2017-08-07 18:51:31','2017-08-07 18:51:31',NULL),(137,1,'But I would wish it all away If I thought I\'d lose you just one day.','2017-08-07 18:52:08','2017-08-07 18:52:08',NULL),(138,1,'But I would If I could, I would wish it all away.','2017-08-07 18:52:50','2017-08-07 18:52:50',NULL),(139,1,'You, my piece of mind, my all, my center, just trying to hold on one more day.','2017-08-07 18:53:14','2017-08-07 18:53:14',NULL),(140,1,'Shine on forever. Shine on benevolent sun. Shine down upon the broken. Shine until the two become one.','2017-08-07 18:53:58','2017-08-07 18:53:58',NULL),(141,1,'You believed in movements none could see. You believed in me.','2017-08-07 18:54:16','2017-08-07 18:54:16',NULL),(142,1,'A passionate spirit. Uncompromised, boundless and open. A light in your eyes then immobilized.','2017-08-07 18:54:48','2017-08-07 18:54:48',NULL),(143,1,'So what have I done to be a son to an angel? What have I done To be worthy?','2017-08-07 18:59:06','2017-08-07 18:59:06',NULL),(144,1,'Listen to the tales as we all rationalize our way into the arms of the savior, Feigning all the trials and the tribulations; None of us have actually been there. Not like you.','2017-08-07 19:14:11','2017-08-07 19:14:11',NULL),(145,1,'Ignorant siblings in the congregation gather around spewing sympathy. Spare me.','2017-08-07 19:50:30','2017-08-07 19:50:30',NULL),(146,1,'None of them can even hold a candle up to you. Blinded by choice, these hypocrites won\'t see.','2017-08-07 19:50:42','2017-08-07 19:50:42',NULL),(147,1,'And this little light of mine, a gift you passed on to me; I\'m gonna let it shine to guide you safely on your way, Your way home.','2017-08-07 19:51:10','2017-08-07 19:51:10',NULL),(148,1,'You are the light and way that they will only read about.','2017-08-07 19:51:41','2017-08-07 19:51:41',NULL),(149,1,'Set as I am in my ways and my arrogance, burden of proof tossed upon the believers. You were my witness, my eyes, my evidence, Judith Marie, unconditional one.','2017-08-07 19:52:08','2017-08-07 19:52:08',NULL),(150,1,'Who are you to wave your finger?','2017-08-07 19:53:11','2017-08-07 19:53:11',NULL),(151,1,'Eye hole deep in muddy waters. You practically raised the dead.','2017-08-07 19:53:28','2017-08-07 19:53:28',NULL),(152,1,'You must have been high.','2017-08-07 19:53:37','2017-08-07 19:53:37',NULL),(153,1,'Soapbox house of cards and glass so don\'t go tossin\' your stones around.','2017-08-07 19:53:54','2017-08-07 19:53:54',NULL),(154,1,'Foot in mouth and head up ass. So whatcha talkin\' \'bout?','2017-08-07 19:54:18','2017-08-07 19:54:18',NULL),(155,1,'Liar, lawyer, mirror, show me. What\'s the difference?','2017-08-07 19:54:35','2017-08-07 19:54:35',NULL),(156,1,'Kangaroo done hung the guilty with the innocent.','2017-08-07 19:54:47','2017-08-07 19:54:47',NULL),(157,1,'Who are you to wave your fatty fingers at me?','2017-08-07 19:55:01','2017-08-07 19:55:01',NULL),(158,1,'Holy fucking shit!','2017-08-07 19:55:25','2017-08-07 19:55:25',NULL),(159,1,'He had me crying out, \"Fuck me It\'s gotta be the Deadhead Chemistry. The blotter got on top of me. Got me seein\' E-motherfuckin\'-T!\"','2017-08-07 19:56:04','2017-08-07 19:56:04',NULL),(160,1,'Me. The Chosen One? They chose me!!! And I didn\'t even graduate from fuckin\' high school.','2017-08-07 19:57:33','2017-08-07 19:57:33',NULL),(161,1,'It was so real, like I woke up in Wonderland.','2017-08-07 19:58:13','2017-08-07 19:58:13',NULL),(162,1,'See, my heart is racing \'cause this shit never happens to me.','2017-08-07 19:58:32','2017-08-07 19:58:32',NULL),(163,1,'You believe me, don\'t you? Please believe what I\'ve just said! See the Dead ain\'t touring and this wasn\'t all in my head.','2017-08-07 19:58:55','2017-08-07 19:58:55',NULL),(164,1,'See, they took me by the hand and invited me right in. Then they showed me something I don\'t even know where to begin.','2017-08-07 20:00:16','2017-08-07 20:00:16',NULL),(165,1,'Overwhelmed as one would be, placed in my position. Such a heavy burden now to be the one.','2017-08-07 20:00:54','2017-08-07 20:00:54',NULL),(166,1,'Born to bear and bring to all the details of our ending, to write it down for all the world to see.  But I forgot my pen. Shit the bed again ... Typical.','2017-08-07 20:01:29','2017-08-07 20:01:29',NULL),(167,1,'Can\'t remember what they said to make me out to be the hero.','2017-08-07 20:03:02','2017-08-07 20:03:02',NULL),(168,1,'God damn, shit the bed!','2017-08-07 20:03:18','2017-08-07 20:03:18',NULL),(169,1,'Spark becomes a flame. Flame becomes a fire. Forge a blade to slay the stranger. Take whatever we desire.','2017-08-07 20:03:45','2017-08-07 20:03:45',NULL),(170,1,'Angels on the sideline, Puzzled and amused.','2017-08-07 20:04:04','2017-08-07 20:04:04',NULL),(171,1,'Why did Father give these humans free will? Now they\'re all confused.','2017-08-07 20:04:22','2017-08-07 20:04:22',NULL),(172,1,'Don\'t these talking monkeys know that Eden has enough to go around?','2017-08-07 20:04:35','2017-08-07 20:04:35',NULL),(173,1,'Where there\'s one you\'re bound to divide it right in two.','2017-08-07 20:04:45','2017-08-07 20:04:45',NULL),(174,1,'Angels on the sideline, Baffled and confused. Father blessed them all with reason, and this is what they choose?','2017-08-07 20:05:06','2017-08-07 20:05:06',NULL),(175,1,'Monkey killing monkey killing monkey over pieces of the ground. Silly monkeys.','2017-08-07 20:05:31','2017-08-07 20:05:31',NULL),(176,1,'Silly monkeys. Give them thumbs, they make a club to beat their brother down.','2017-08-07 20:05:56','2017-08-07 20:05:56',NULL),(177,1,'How they\'ve survived so misguided is a mystery.','2017-08-07 20:06:04','2017-08-07 20:06:04',NULL),(178,1,'Repugnant is a creature who would squander the ability to lift an eye to heaven, conscious of his fleeting time here.','2017-08-07 20:06:20','2017-08-07 20:06:20',NULL),(179,1,'Gotta divide it all right in two.','2017-08-07 20:06:54','2017-08-07 20:06:54',NULL),(180,1,'They fight till they die over words, polarizing.','2017-08-07 20:07:24','2017-08-07 20:07:24',NULL);
/*!40000 ALTER TABLE `ipsums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_07_23_180754_create_bands_table',1),(4,'2017_07_23_180812_create_albums_table',1),(5,'2017_07_23_182930_create_videos_table',1),(6,'2017_07_23_182931_create_songs_table',1),(7,'2017_07_23_191848_create_tags_table',1),(8,'2017_07_23_191903_create_videos_tags_table',1),(9,'2017_07_23_191937_create_videos_songs_table',1),(10,'2017_07_23_203937_create_songs_albums_table',1),(11,'2017_07_24_002007_add_order_column_to_songs_albums_table',2),(12,'2017_07_24_010244_add_source_and_video_id_to_videos_table',3),(13,'2017_08_07_143716_create_ipsums_table',4),(14,'2017_08_18_014305_increase_videos_description_column_size',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `songs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `band_id` int(10) unsigned NOT NULL,
  `has_lyrics` tinyint(1) NOT NULL,
  `lyrics` text COLLATE utf8mb4_unicode_ci,
  `lyrics_video_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `songs_band_id_slug_unique` (`band_id`,`slug`),
  KEY `songs_lyrics_video_id_foreign` (`lyrics_video_id`),
  CONSTRAINT `songs_band_id_foreign` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`),
  CONSTRAINT `songs_lyrics_video_id_foreign` FOREIGN KEY (`lyrics_video_id`) REFERENCES `videos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (1,'Sweat','seat',1,1,'I\'m sweating, and breathing and staring and thinking and sinking deeper.\n\nIt\'s almost like I\'m swimming.\nThe sun is burning hot again on the hunter and the fisherman, and he\'s trying to remember when, but it makes him dizzy.\n\nSeems like I\'ve been here before. \nSeems so familiar. \nSeems like I\'m slipping into a dream within a dream. \n\nMust be the way you whisper. \nThe sun is setting cool again. \nI\'m the thinker and the fisherman and I\'m trying to remember when but it makes me dizzy.\n\nAnd I\'m sweating, and breathing, and staring and thinking and sinking deeper and it\'s almost like I\'m swimming.\n\nSeems like I\'ve been here before. \nSeems so familiar. \nSeems like I\'m slipping into a dream within a dream. \n\nIt\'s the way you whisper. \nIt drags me under and takes me home.',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(2,'Hush','hush',1,1,'I can\'t say what I want to, even if I\'m not serious.\n\nThings like.... Fuck yourself, kill yourself, you piece of shit. People tell me what to say, what to think, and what to play.\n\nI say...Go fuck yourself, you piece of shit. Why don\'t you go kill yourself? Just kidding.',NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(3,'Part of Me','part-of-me',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(4,'Cold and Ugly','cold-and-ugly',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(5,'Jerk-Off','jerk-off',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(6,'Opiate','opiate',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(7,'The Gaping Lotus Experience','gaping-lotus-experience',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(8,'Intolerance','intolerance',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(9,'Prison Sex','prison-sex',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(10,'Sober','sober',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(11,'Bottom','bottom',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(12,'Crawl Away','crawl-away',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(13,'Swamp Song','swamp-song',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(14,'Undertow','undertow',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(15,'4 Degrees','4-degrees',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(16,'Flood','flood',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(17,'Disgustipated','disgustipated',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(18,'Stinkfist','stinkfist',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(19,'Eulogy','eulogy',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(20,'H.','h',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(21,'Useful Idiot','useful-idiot',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(22,'Forty Six & 2','fourty-six-and-2',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(23,'Message to Harry Manback','message-to-harry-manback',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(24,'Hooker with a Penis','hooker-with-a-penis',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(25,'intermission','intermission',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(26,'Jimmy','jimmy',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(27,'Die Eier von Satan','die-eier-von-satan',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(28,'Pushit','pushit',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(29,'Cesaro Summability','cesaro-summability',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(30,'Aenema','aenema',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(31,'(-) Ions','ions',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(32,'Third Eye','third-eye',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(33,'Message to Harry Manback II','message-to-harry-manback-ii',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(34,'You Lied','you-lied',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(35,'Merkaba','merkaba',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(36,'No Quarter','no-quarter',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(37,'LAMC','lamc',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(38,'Maynard\'s Dick','maynards-dick',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(39,'The Grudge','the-grudge',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(40,'Eon Blue Apocalypse','eon-blue-apocalypse',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(41,'The Patient','the-patient',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(42,'Mantra','mantra',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(43,'Schism','schism',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(44,'parabol','parabol',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(45,'parabola','parabola',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(46,'Ticks & Leeches','tickes-and-leeches',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(47,'Lateralus','lateralus',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(48,'Disposition','Disposition',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(49,'Reflection','reflection',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(50,'Triad','triad',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(51,'Faaip de Oiad','faaip-de-oiad',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(52,'Vicarious','Vicarious',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(53,'Jambi','Jambi',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(54,'Wings for Marie (Pt 1)','wings-for-marie',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(55,'10,000 Days (Wings Pt 2)','10000-days-part-2',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(56,'The Pot','the-pot',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(57,'Lipan Conjuring','lipan-conjuring',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(58,'Lost Keys (Blame Hofmann)','lost-keys',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(59,'Rosetta Stoned','rosetta-stoned',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(60,'Intension','intension',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(61,'Right in Two','right-in-two',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL),(62,'Virginti Tres','virginit-tres',1,0,NULL,NULL,'2017-07-24 10:47:13','2017-07-24 10:47:13',NULL);
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs_albums`
--

DROP TABLE IF EXISTS `songs_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `songs_albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `song_id` int(10) unsigned NOT NULL,
  `album_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `songs_albums_album_id_song_id_unique` (`album_id`,`song_id`),
  KEY `songs_albums_song_id_foreign` (`song_id`),
  CONSTRAINT `songs_albums_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  CONSTRAINT `songs_albums_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs_albums`
--

LOCK TABLES `songs_albums` WRITE;
/*!40000 ALTER TABLE `songs_albums` DISABLE KEYS */;
INSERT INTO `songs_albums` VALUES (1,1,2,NULL,NULL,NULL,1,0),(2,2,1,NULL,NULL,NULL,2,0),(3,2,2,NULL,NULL,NULL,2,0),(4,3,1,NULL,NULL,NULL,3,0),(5,3,2,NULL,NULL,NULL,3,0),(6,4,1,NULL,NULL,NULL,1,0),(7,4,2,NULL,NULL,NULL,4,0),(8,5,1,NULL,NULL,NULL,6,0),(9,5,2,NULL,NULL,NULL,5,0),(10,6,2,NULL,NULL,NULL,6,0),(11,7,2,NULL,NULL,NULL,7,1),(12,8,3,NULL,NULL,NULL,1,0),(13,9,3,NULL,NULL,NULL,2,0),(14,10,1,NULL,NULL,NULL,5,0),(15,10,3,NULL,NULL,NULL,3,0),(16,11,3,NULL,NULL,NULL,4,0),(17,12,1,NULL,NULL,NULL,4,0),(18,12,3,NULL,NULL,NULL,5,0),(19,13,3,NULL,NULL,NULL,6,0),(20,14,3,NULL,NULL,NULL,7,0),(21,15,3,NULL,NULL,NULL,8,0),(22,16,3,NULL,NULL,NULL,9,0),(23,17,3,NULL,NULL,NULL,10,0),(24,18,4,NULL,NULL,NULL,1,0),(25,19,4,NULL,NULL,NULL,2,0),(26,20,4,NULL,NULL,NULL,3,0),(27,21,4,NULL,NULL,NULL,4,0),(28,22,4,NULL,NULL,NULL,5,0),(29,23,4,NULL,NULL,NULL,6,0),(30,24,4,NULL,NULL,NULL,7,0),(31,25,4,NULL,NULL,NULL,8,0),(32,26,4,NULL,NULL,NULL,9,0),(33,27,4,NULL,NULL,NULL,10,0),(34,28,4,NULL,NULL,NULL,11,0),(35,29,4,NULL,NULL,NULL,12,0),(36,30,4,NULL,NULL,NULL,13,0),(37,31,4,NULL,NULL,NULL,14,0),(38,32,4,NULL,NULL,NULL,15,0),(39,33,5,NULL,NULL,NULL,4,0),(40,34,5,NULL,NULL,NULL,5,0),(41,35,5,NULL,NULL,NULL,6,0),(42,36,5,NULL,NULL,NULL,7,0),(43,37,5,NULL,NULL,NULL,8,0),(44,38,5,NULL,NULL,NULL,9,1),(45,39,6,NULL,NULL,NULL,1,0),(46,40,6,NULL,NULL,NULL,2,0),(47,41,6,NULL,NULL,NULL,3,0),(48,42,6,NULL,NULL,NULL,4,0),(49,43,6,NULL,NULL,NULL,5,0),(50,44,6,NULL,NULL,NULL,6,0),(51,45,6,NULL,NULL,NULL,7,0),(52,46,6,NULL,NULL,NULL,8,0),(53,47,6,NULL,NULL,NULL,9,0),(54,48,6,NULL,NULL,NULL,10,0),(55,49,6,NULL,NULL,NULL,11,0),(56,50,6,NULL,NULL,NULL,13,0),(57,51,6,NULL,NULL,NULL,14,0),(58,52,7,NULL,NULL,NULL,1,0),(59,53,7,NULL,NULL,NULL,2,0),(60,54,7,NULL,NULL,NULL,3,0),(61,55,7,NULL,NULL,NULL,4,0),(62,56,7,NULL,NULL,NULL,5,0),(63,57,7,NULL,NULL,NULL,6,0),(64,58,7,NULL,NULL,NULL,7,0),(65,59,7,NULL,NULL,NULL,8,0),(66,60,7,NULL,NULL,NULL,9,0),(67,61,7,NULL,NULL,NULL,10,0),(68,62,7,NULL,NULL,NULL,11,0);
/*!40000 ALTER TABLE `songs_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Remastered','remastered','2017-08-17 19:53:31','2017-08-17 19:53:31',NULL),(2,'Live DVD','live-dvd','2017-08-17 19:53:48','2017-08-17 19:53:48',NULL),(3,'1991','1991','2017-08-17 19:54:07','2017-08-17 19:54:07',NULL),(4,'1992','1992','2017-08-17 19:55:17','2017-08-17 19:55:17',NULL),(5,'1993','1993','2017-08-17 19:55:24','2017-08-17 19:55:24',NULL),(6,'1994','1994','2017-08-17 19:55:29','2017-08-17 19:55:29',NULL),(7,'1995','1995','2017-08-17 19:55:36','2017-08-17 19:55:36',NULL),(8,'1996','1996','2017-08-17 19:55:42','2017-08-17 19:55:42',NULL),(9,'1997','1997','2017-08-17 19:55:49','2017-08-17 19:55:49',NULL),(10,'1998','1998','2017-08-17 19:55:54','2017-08-17 19:55:54',NULL),(11,'1999','1999','2017-08-17 19:56:00','2017-08-17 19:56:00',NULL),(12,'2000','2000','2017-08-17 19:56:07','2017-08-17 19:56:07',NULL),(13,'2001','2001','2017-08-17 19:56:12','2017-08-17 19:56:12',NULL),(14,'2002','2002','2017-08-17 19:56:20','2017-08-17 19:56:20',NULL),(15,'2003','2003','2017-08-17 19:57:37','2017-08-17 19:57:37',NULL),(16,'2004','2004','2017-08-17 19:57:43','2017-08-17 19:57:43',NULL),(17,'2005','2005','2017-08-17 19:57:48','2017-08-17 19:57:48',NULL),(18,'2006','2006','2017-08-17 19:57:54','2017-08-17 19:57:54',NULL),(19,'2007','2007','2017-08-17 19:58:11','2017-08-17 19:58:11',NULL),(20,'2008','2008','2017-08-17 19:58:17','2017-08-17 19:58:17',NULL),(21,'2009','2009','2017-08-17 19:58:22','2017-08-17 19:58:22',NULL),(22,'2010','2010','2017-08-17 19:58:28','2017-08-17 19:58:28',NULL),(23,'2011','2011','2017-08-17 19:58:34','2017-08-17 19:58:34',NULL),(24,'2012','2012','2017-08-17 19:58:39','2017-08-17 19:58:39',NULL),(25,'2013','2013','2017-08-17 19:58:45','2017-08-17 19:58:45',NULL),(26,'2014','2014','2017-08-17 19:58:49','2017-08-17 19:58:49',NULL),(27,'2015','2015','2017-08-17 19:58:55','2017-08-17 19:58:55',NULL),(28,'2016','2016','2017-08-17 19:59:01','2017-08-17 19:59:01',NULL),(29,'2017','2017','2017-08-17 19:59:06','2017-08-17 19:59:06',NULL),(30,'bacon','bacon','2017-08-17 20:06:05','2017-08-17 20:10:29',NULL),(31,'Full Concert','full-concert','2017-08-19 20:49:13','2017-08-19 20:49:13',NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `band_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `videos_slug_unique` (`slug`),
  KEY `videos_band_id_foreign` (`band_id`),
  CONSTRAINT `videos_band_id_foreign` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Live - Full Show - 1997 - New Jersey (Remastered)','Watch Tool rock out in New Jeresey in one of the most epic captures ever','tool-1997-new-jersey-remastered',1,'2017-07-24 10:47:13','2017-08-20 18:57:40',NULL,'PHy9PSkpiKw','youtube'),(2,'Live - Full Show - 2017 - San Jose','Tool Live San Jose, CA 2017. Full Concert.\r\n\r\nSan Jose, CA. SAP Center. June 21st 2017.\r\n\r\nGreat audio by wilson66. I almost didn\'t want to use any video material since there isn\'t much and some songs aren\'t filmed or are incomplete, but some of the footage has some good closeups, mixed with infuriating camera shaking.\r\n\r\nThe Grudge 00:00\r\nParabola 09:13\r\nSchism 19:25\r\nMaynard\'s Message 27:35\r\nOpiate 28:36\r\nÆnema 39:55\r\nDescending 47:28\r\nJambi 50:55\r\nThird Eye 58:55\r\nForty Six & 2 1:13:56\r\nSynth 1:21:18\r\nDrum Solo 1:24:09\r\nThe Pot 1:28:45\r\nSweat 1:35:45\r\nStinkfist 1:39:57\r\n\r\nMain video source:\r\nhttps://www.youtube.com/user/lachrymistpatient11/videos\r\n\r\nGet Maynard James Keenan\'s wine:\r\nhttps://caduceus.org/\r\nhttp://www.puscifer.com\r\nhttp://www.toolband.com','tool-live-san-jose-2017',1,'2017-08-18 01:50:57','2017-08-20 18:58:32',NULL,'S_M0NtxOT3Y','youtube'),(3,'Live - Vicarious - 2017 - Boston, MA (Boston Calling)','Live from Boston Calling, Sunday May 28th 2017','tool-vicarious-2017-boston-calling',1,'2017-08-20 15:36:14','2017-08-20 19:01:14',NULL,'vWIUASfCzsA','youtube'),(4,'Tool - Stinkfist - 2017 Boston Calling','Live from Boston Calling, Sunday May 28th 2017','tool-stinkfist-2017-bostcon-calling',1,'2017-08-20 15:40:04','2017-08-20 15:40:04',NULL,'6718C04pgS0','youtube'),(5,'Live - Full Show - 1991 - Hollywood, CA (The Jello Loft)','Tool live @ The Jello Loft,Hollywood,CA (05.09.1991)[Full Concert]\r\n  Source:Soundboard\r\n\r\nSetlist:\r\n01 - Cold & Ugly \r\n02 - Undertow \r\n03 - Sober \r\n04 - Crawl Away \r\n05 - Sweat \r\n06 - Swamp Song \r\n07 - 4° \r\n08 - Hush / Opiate (cut) \r\n\r\nThanks to TDP:','tool-live-1991-jello-loft',1,'2017-08-20 18:15:10','2017-08-20 18:15:10',NULL,'xpIJxcSmC4Q','youtube'),(6,'Live - Rosetta Stoned & Lateralus - 2007 - Jacksonville, FL','Tool. Rosetta Stoned & Lateralus. Live 2007. EPIC IEM.\r\n\r\nMy edited HQ IEM matrix mix with 2 sources. Sounds pretty good, the only problem is the IEM cuts out sometimes. Otherwise great quality and great performances.\r\n\r\nRosetta Stoned 00:00\r\nLateralus 11:34\r\n\r\n06.02.07\r\nVeterans Memorial Arena\r\nJacksonville, FL\r\n\r\nGet Maynard James Keenan\'s wine:\r\nhttps://caduceus.org/\r\nhttp://www.puscifer.com\r\nhttp://www.toolband.com','tool-live-rosetta-stoned-lateralus-2007-jacksonville',1,'2017-08-20 19:12:10','2017-08-20 19:12:10',NULL,'VaZYtOJ3oSY','youtube');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_songs`
--

DROP TABLE IF EXISTS `videos_songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_songs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `song_id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `videos_songs_video_id_order_unique` (`video_id`,`order`),
  KEY `videos_songs_song_id_foreign` (`song_id`),
  CONSTRAINT `videos_songs_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  CONSTRAINT `videos_songs_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_songs`
--

LOCK TABLES `videos_songs` WRITE;
/*!40000 ALTER TABLE `videos_songs` DISABLE KEYS */;
INSERT INTO `videos_songs` VALUES (4,4,18,1,NULL,NULL,NULL,NULL,NULL),(5,4,43,2,'7:21','13:52',NULL,NULL,NULL),(6,5,4,1,NULL,NULL,NULL,NULL,NULL),(7,5,14,2,NULL,NULL,NULL,NULL,NULL),(8,5,10,3,NULL,NULL,NULL,NULL,NULL),(9,5,1,4,NULL,NULL,NULL,NULL,NULL),(10,5,13,5,NULL,NULL,NULL,NULL,NULL),(11,5,15,6,NULL,NULL,NULL,NULL,NULL),(12,5,2,7,NULL,NULL,NULL,NULL,NULL),(13,5,6,8,NULL,NULL,NULL,NULL,NULL),(17,1,32,1,'00:00',NULL,NULL,NULL,NULL),(18,1,18,2,'13:39',NULL,NULL,NULL,NULL),(19,1,22,3,'20:18',NULL,NULL,NULL,NULL),(20,3,52,1,NULL,NULL,NULL,NULL,NULL),(21,6,59,1,'00:00',NULL,NULL,NULL,NULL),(22,6,47,2,'11:34',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `videos_songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos_tags`
--

DROP TABLE IF EXISTS `videos_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `videos_tags_video_id_tag_id_unique` (`video_id`,`tag_id`),
  KEY `videos_tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `videos_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  CONSTRAINT `videos_tags_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos_tags`
--

LOCK TABLES `videos_tags` WRITE;
/*!40000 ALTER TABLE `videos_tags` DISABLE KEYS */;
INSERT INTO `videos_tags` VALUES (1,4,29,NULL,NULL,NULL),(2,5,3,NULL,NULL,NULL),(3,5,31,NULL,NULL,NULL),(7,1,9,NULL,NULL,NULL),(8,1,31,NULL,NULL,NULL),(9,1,1,NULL,NULL,NULL),(10,3,29,NULL,NULL,NULL),(11,6,19,NULL,NULL,NULL);
/*!40000 ALTER TABLE `videos_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-11  2:48:01
