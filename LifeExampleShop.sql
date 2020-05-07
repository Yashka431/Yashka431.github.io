-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2012 at 04:55 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `LifeExampleShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `url`, `parent`, `sort`) VALUES
(1, 'Мониторы', 'monitory', 5, 0),
(2, 'Периферия', 'periferiya', 5, 0),
(3, 'Мышки', 'myshki', 2, 0),
(4, 'Разное', 'raznoe', 0, 0),
(5, 'Компьютеры', 'kompyutery', 0, 0),
(8, 'Роликовые', 'rolikovyie', 3, 0),
(14, 'струйные', 'struynyie', 13, 0),
(15, 'лазерные', 'lazernyie', 13, 0),
(18, 'Оптические', 'opticheskie', 39, 0),
(39, 'новая', 'novaya', 0, 0),
(40, 'ppp', 'ppp', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `summ` varchar(255) NOT NULL,
  `order_content` text NOT NULL,
  `delivery` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `paid` varchar(1) NOT NULL DEFAULT 'N',
  `close` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `date`, `name`, `email`, `phone`, `adres`, `summ`, `order_content`, `delivery`, `payment`, `paid`, `close`) VALUES
(105, 1342423748, 'марк', 'avdeev@mail.ru', '123', 'asdffff', '26337', 'a:4:{i:59;a:4:{s:4:\\"name\\";s:21:\\"Клавиатура4\\";s:4:\\"code\\";s:1:\\"k\\";s:5:\\"price\\";s:3:\\"679\\";s:5:\\"count\\";i:3;}i:63;a:4:{s:4:\\"name\\";s:28:\\"системный блок1\\";s:4:\\"code\\";s:2:\\"s7\\";s:5:\\"price\\";s:5:\\"22300\\";s:5:\\"count\\";i:1;}i:61;a:4:{s:4:\\"name\\";s:10:\\"Модем\\";s:4:\\"code\\";s:7:\\"modem-1\\";s:5:\\"price\\";s:4:\\"1200\\";s:5:\\"count\\";i:1;}i:60;a:4:{s:4:\\"name\\";s:14:\\"Колонки\\";s:4:\\"code\\";s:5:\\"kol-1\\";s:5:\\"price\\";s:3:\\"800\\";s:5:\\"count\\";i:1;}}', 'kurier', 'webmoney', 'N', 'N'),
(103, 1342422766, 'Петр иванович', 'petr@mail.ru', '678888', 'sdafsdff', '2800', 'a:2:{i:60;a:2:{s:5:\\"price\\";s:3:\\"800\\";s:5:\\"count\\";i:2;}i:61;a:2:{s:5:\\"price\\";s:4:\\"1200\\";s:5:\\"count\\";i:1;}}', 'kurier', 'webmoney', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `desc` text NOT NULL,
  `price` float NOT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `factory` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `surface` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cat_id`, `name`, `desc`, `price`, `url`, `image_url`, `code`, `material`, `factory`, `color`, `destination`, `size`, `type`, `country`, `surface`, `picture`, `style`) VALUES
(87, 5, 'jkl', 'k', 567, 'jkl', 'none.png', 'lll', 'material ', 'factory2', 'color1', 'destination0', '30x35', 'type4', 'country5', 'surface6', 'picture7', ''),
(88, 1, 'про', 'р', 1324, 'pro', '', 'fghvbhjkghk', '', '', '', '', '30x35', '', '', '', '', ''),
(89, 39, 'новый', 'err', 345, 'novyiy', 'logo_statistiques.png', 'new2', '', '', '', '', '30x35', '', '', '', '', ''),
(61, 3, 'Модем', 'Wi-fi модем1', 1200, 'modem', '6.jpg', 'MOD13', 'Метал', 'Российская Марка', 'Синий', 'Для компьютера', '10x20', 'тип 1', 'страна 1', 'Поверхность 1', 'рисунок 1', 'Стиль 1'),
(63, 5, 'системный блок1', '8', 22300, 'sistemnyiy_blok', 'none.png', 's7', 'Метал', 'Российская Марка', 'Зеленый', 'Назначение 1', '10x20', 'Тип 1', '', '', '', ''),
(64, 1, 'Монитор', 'Монитор', 5, 'monitor', '2.jpg', 'mon1', 'Пластик', 'Русский Завод', 'Красный', '', '', '', '', '', '', 'Клевый'),
(71, 4, 'Тестовый товар', 'Описание для тестового товара', 160, 'testovyiy_tovar', 'page-about-icon.png', 'T1', '', '', '', '', '', '', '', '', '', ''),
(86, 2, 'fgj', 'ghg', 56, 'fgj', '', 'fdg', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'N',
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `option`, `value`, `active`, `name`, `desc`) VALUES
(1, 'sitename', 'lifeexampleshop', 'Y', 'Название сайта', 'Название сайта отображается в title страниц.'),
(2, 'admin-email', 'mark-adeev@mail.ru', 'Y', 'E-mail администратора', 'На указанный email будут уходить все письма от посетителей сайта.\r\nМожно указать несколько адресов через запятую: admin@domen.ru,manager@domen.ru'),
(3, 'template-name', '.default', 'Y', 'Тема', 'Тема определяет внешний вид сайта, укажите название папки с нужной темой в дирректории /mg-templates'),
(4, 'count-catalog-product', '2', 'Y', 'Количество выводимых продуктов на странице каталога', 'Количество выводимых продуктов на странице \r\n'),
(5, 'webmoney-purse', 'R123456789', 'Y', 'Номер Webmoney кошелька', 'Укажите номер Webmoney кошелька если хотите принимаь электронную оплату.'),
(6, 'yandex-purse', '987654321', 'Y', 'Номер Yandex кошелька', 'Укажите номер Yandex кошелька если хотите принимаь электронную оплату.'),
(7, 'order-message', 'Оформлен заказ № #ORDER# на сайте #SITE# ', 'Y', 'Сообщение об оформлении заказа', 'В сообщение об оформлении заказа, можно вставлять дериктивы \r\n #ORDER# - номер заказа \r\n #SITE# - название сайта\r\nДлина сообщения не более 255 символов.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `role`) VALUES
(1, 'admin', '1', 1),
(2, 'mark', '123456', 2);
