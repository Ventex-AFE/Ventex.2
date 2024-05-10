-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2024 at 02:42 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ventexafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogo_seller`
--

DROP TABLE IF EXISTS `catalogo_seller`;
CREATE TABLE IF NOT EXISTS `catalogo_seller` (
  `Id_pantalla` int(10) NOT NULL AUTO_INCREMENT,
  `Id_vendedor` int(10) NOT NULL,
  `stylePage` int(10) NOT NULL,
  `Product_View_Style` int(10) NOT NULL,
  `Header_Color` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Category_Color` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Product_Box_Color` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`Id_pantalla`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `ID_Cat` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre_Cat` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripción` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Cat`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`ID_Cat`, `Nombre_Cat`, `Descripción`) VALUES
(1, 'Ropa', 'Productos relacionados con ropa y accesorios'),
(2, 'Dulces', 'Productos de confitería y golosinas'),
(3, 'Comida', 'Productos alimenticios y comestibles'),
(4, 'Electronicos', 'Dispositivos electronicos y accesorios'),
(5, 'Hogar y jardin', 'Productos para el hogar y el cuidado del jardin'),
(6, 'Belleza y cuidado personal', 'Productos relacionados con la belleza y el cuidado personal'),
(7, 'Libros y entretenimiento', 'Libros, películas, música y otros productos de entretenimiento'),
(8, 'Deportes y aire libre', 'Equipos deportivos y productos para actividades al aire libre'),
(9, 'Automoviles y motocicletas', 'Productos relacionados con automoviles, motocicletas y accesorios para vehiculos'),
(10, 'Juguetes y juegos', 'Juguetes, juegos y productos para el entretenimiento infantil'),
(11, 'Gatos', 'THINGS CATS');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_product`
--

DROP TABLE IF EXISTS `comentarios_product`;
CREATE TABLE IF NOT EXISTS `comentarios_product` (
  `ID_Cometario` int(12) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(12) NOT NULL,
  `ID_Producto` int(12) NOT NULL,
  `Descripcion` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `fechar` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`ID_Cometario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `comentarios_product`
--

INSERT INTO `comentarios_product` (`ID_Cometario`, `ID_Usuario`, `ID_Producto`, `Descripcion`, `fechar`, `Hora`) VALUES
(1, 2, 2, 'Prueba', '2020-05-13', '23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_seller`
--

DROP TABLE IF EXISTS `comentarios_seller`;
CREATE TABLE IF NOT EXISTS `comentarios_seller` (
  `ID_Comentario_S` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(10) NOT NULL,
  `ID_Seller` int(10) NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`ID_Comentario_S`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `comentarios_seller`
--

INSERT INTO `comentarios_seller` (`ID_Comentario_S`, `ID_Usuario`, `ID_Seller`, `Descripcion`, `Fecha`, `Hora`) VALUES
(1, 1, 3, 'Prueba', '2020-09-12', '23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `ID_pedido` int(10) NOT NULL AUTO_INCREMENT,
  `Id_usser_regristro` int(20) NOT NULL,
  `ID_producto` int(11) NOT NULL,
  `usuario_cliente` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `lugar` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ID_pedido`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `ID_Producto` int(11) NOT NULL AUTO_INCREMENT,
  `Id_usser_regristro` int(20) NOT NULL,
  `Nombre_Prod` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `Precio` float NOT NULL,
  `Categoria` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Subcategoria` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Imagen` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Producto`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Id_usser_regristro`, `Nombre_Prod`, `Descripcion`, `Precio`, `Categoria`, `Subcategoria`, `Imagen`) VALUES
(1, 5, 'q', 'e', 200, '', '', 'WhatsApp Image 2024-05-03 at 3.56.19 PM.jpeg'),
(2, 5, 'qwerty', 'asasasasasa', 123, '', '', 'Alexander_NuÃ±ez_Testing_Backend_Emmanul_Alexander_Gonzalez_NuÃ±ez.jpg'),
(3, 5, 'qwerty', 'asasasasasa', 123, '', '', 'Alexander_NuÃ±ez_Testing_Backend_Emmanul_Alexander_Gonzalez_NuÃ±ez.jpg'),
(4, 5, 'qwerty', 'asasasasasa', 123, '', '', 'Alexander_NuÃ±ez_Testing_Backend_Emmanul_Alexander_Gonzalez_NuÃ±ez.jpg'),
(5, 5, 'qwerty', 'asasasasasa', 123, 'Patos', '', 'Alexander_NuÃ±ez_Testing_Backend_Emmanul_Alexander_Gonzalez_NuÃ±ez.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `regristroventa`
--

DROP TABLE IF EXISTS `regristroventa`;
CREATE TABLE IF NOT EXISTS `regristroventa` (
  `ID_Venta` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(10) NOT NULL,
  `ID_Producto` int(10) NOT NULL,
  `Descripcio` varchar(80) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`ID_Venta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reportes_producto`
--

DROP TABLE IF EXISTS `reportes_producto`;
CREATE TABLE IF NOT EXISTS `reportes_producto` (
  `ID_Reporte_P` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(10) NOT NULL,
  `ID_Producto` int(10) NOT NULL,
  `Motivo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`ID_Reporte_P`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `reportes_producto`
--

INSERT INTO `reportes_producto` (`ID_Reporte_P`, `ID_Usuario`, `ID_Producto`, `Motivo`, `Fecha`, `Hora`) VALUES
(1, 1, 1, 'Prueba', '2020-05-05', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reportes_seller`
--

DROP TABLE IF EXISTS `reportes_seller`;
CREATE TABLE IF NOT EXISTS `reportes_seller` (
  `ID_Reporte_S` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(10) NOT NULL,
  `ID_Seller` int(10) NOT NULL,
  `Motivo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`ID_Reporte_S`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `reportes_seller`
--

INSERT INTO `reportes_seller` (`ID_Reporte_S`, `ID_Usuario`, `ID_Seller`, `Motivo`, `Fecha`, `Hora`) VALUES
(1, 2, 3, 'Prueba', '2022-06-06', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reportes_usuario`
--

DROP TABLE IF EXISTS `reportes_usuario`;
CREATE TABLE IF NOT EXISTS `reportes_usuario` (
  `ID_Reporte` int(10) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Us_Report` int(11) NOT NULL,
  `Motivo` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`ID_Reporte`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `reportes_usuario`
--

INSERT INTO `reportes_usuario` (`ID_Reporte`, `ID_Usuario`, `ID_Us_Report`, `Motivo`, `Fecha`, `Hora`) VALUES
(1, 8, 7, 'Prueba', '2024-09-09', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seller_porfile`
--

DROP TABLE IF EXISTS `seller_porfile`;
CREATE TABLE IF NOT EXISTS `seller_porfile` (
  `Id_sellerP` int(10) NOT NULL AUTO_INCREMENT,
  `Name_Seller` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `profile_Description` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Contact_description` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `x` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`Id_sellerP`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `seller_porfile`
--

INSERT INTO `seller_porfile` (`Id_sellerP`, `Name_Seller`, `profile_Description`, `Contact_description`, `instagram`, `x`, `whatsapp`, `facebook`) VALUES
(1, 'Emmanuel Alexander', '#', '#', '#', '#', '#', ''),
(2, 'Emmanuel Alexander', '#', '#', '#', '#', '#', ''),
(3, 'Emmanuel Alexander', '#', '#', '#', '#', '#', '#'),
(4, 'Emmanuel Alexander', '#', '#', '#', '#', '#', '#'),
(5, 'Thomas', 'Descripcion Nueva', 'JOLA', 'INSTAHRAM', 'Not X is twier', 'WHATTTT', 'BOOKFACE'),
(6, 'Kaxuuuuuuu', '#', '#', '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `ID_Subcat` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre_Subcat` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Categoria` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`ID_Subcat`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `subcategoria`
--

INSERT INTO `subcategoria` (`ID_Subcat`, `Nombre_Subcat`, `Descripcion`, `Categoria`) VALUES
(1, 'Camisetas', 'Camisetas de diferentes estilos y colores', 'Ropa'),
(2, 'Pantalones', 'Pantalones para hombres y mujeres', 'Ropa'),
(3, 'Vestidos', 'Vestidos elegantes y casuales', 'Ropa'),
(4, 'Chaquetas', 'Chaquetas para todas las estaciones', 'Ropa'),
(5, 'Chocolates', 'Variedad de chocolates de diferentes marcas', 'Dulces'),
(6, 'Gomitas', 'Gomitas de diversos sabores y colores', 'Dulces'),
(7, 'Caramelos', 'Caramelos duros y blandos', 'Dulces'),
(8, 'Chicles', 'Chicles de distintos sabores y marcas', 'Dulces'),
(9, 'Frutas y verduras', 'Variedad de frutas y verduras frescas', 'Comida'),
(10, 'Carnes y aves', 'Carne fresca y aves de corral', 'Comida'),
(11, 'Productos lacteos', 'Leche, queso, yogur, etc.', 'Comida'),
(12, 'Panaderia y reposteria', 'Pan fresco, pasteles y postres', 'Comida'),
(13, 'Telefonos moviles', 'Teléfonos inteligentes y dispositivos móviles', 'Electronicos'),
(14, 'Computadoras portatiles', 'Computadoras portátiles de diversas marcas y especificaciones', 'Electronicos'),
(15, 'Televisores', 'Televisores LED, LCD y OLED', 'Electronicos'),
(16, 'Camaras fotograficas', 'Cámaras digitales y accesorios para fotografía', 'Electronicos'),
(17, 'Muebles', 'Muebles para el hogar y la oficina', 'Hogar y jardin'),
(18, 'Electrodomesticos', 'Electrodomésticos para cocina y lavandería', 'Hogar y jardin'),
(19, 'Decoración del hogar', 'Artículos decorativos para el hogar', 'Hogar y jardin'),
(20, 'Herramientas de jardineria', 'Herramientas para el cuidado del jardín', 'Hogar y jardin'),
(21, 'Maquillaje', 'Productos de maquillaje para el rostro, los ojos y los labios', 'Belleza y cuidado personal'),
(22, 'Cuidado del cabello', 'Champús, acondicionadores, tintes, etc.', 'Belleza y cuidado personal'),
(23, 'Cuidado de la piel', 'Cremas, lociones, protectores solares, etc.', 'Belleza y cuidado personal'),
(24, 'Ficcion', 'Libros de ficción de diversos géneros', 'Libros y entretenimiento'),
(25, 'No ficcion', 'Libros de no ficción sobre diversos temas', 'Libros y entretenimiento'),
(26, 'Peliculas', 'Películas en DVD y Blu-ray de distintos géneros', 'Libros y entretenimiento'),
(27, 'Musica', 'CDs y vinilos de música de diferentes artistas y géneros', 'Libros y entretenimiento'),
(28, 'Equipos de gimnasio', 'Equipos de ejercicio para uso en interiores', 'Deportes y aire libre'),
(29, 'Articulos deportivos al aire libre', 'Artículos para deportes al aire libre como camping y senderismo', 'Deportes y aire libre'),
(30, 'Ropa deportiva', 'Ropa diseñada específicamente para actividades deportivas', 'Deportes y aire libre'),
(31, 'Calzado deportivo', 'Zapatos diseñados para actividades deportivas y ejercicio', 'Deportes y aire libre'),
(32, 'Accesorios para automoviles', 'Accesorios para mejorar el rendimiento y la apariencia de los automóviles', 'Automoviles y motocicletas'),
(33, 'Repuestos para automoviles', 'Repuestos y componentes para la reparación y mantenimiento de automóviles', 'Automoviles y motocicletas'),
(34, 'Equipamiento para motocicletas', 'Equipamiento y accesorios para motocicletas', 'Automoviles y motocicletas'),
(35, 'Herramientas para mantenimiento de vehiculos', 'Herramientas para realizar el mantenimiento y reparaciones de vehículos', 'Automoviles y motocicletas'),
(36, 'Juguetes educativos', 'Juguetes diseñados para el aprendizaje y desarrollo infantil', 'Juguetes y juegos'),
(37, 'Juegos de mesa', 'Juegos de mesa clásicos y modernos para toda la familia', 'Juguetes y juegos'),
(38, 'Juguetes de construccion', 'Juguetes que permiten a los niños construir y crear', 'Juguetes y juegos'),
(39, 'kkkk', 'Juguetes que incorporan tecnología electrónica y digital', 'Gatos'),
(40, 'Collar', 'Collar', 'Gatos');

-- --------------------------------------------------------

--
-- Table structure for table `usuarioregistrado`
--

DROP TABLE IF EXISTS `usuarioregistrado`;
CREATE TABLE IF NOT EXISTS `usuarioregistrado` (
  `ID_Usuario` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre_Us` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `Correo` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `Pass` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha_Nac` date NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `Imagen` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Type_usser` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuarioregistrado`
--

INSERT INTO `usuarioregistrado` (`ID_Usuario`, `Nombre_Us`, `Correo`, `Pass`, `Fecha_Nac`, `telefono`, `Imagen`, `Type_usser`) VALUES
(1, 'Kazu', 'kazu@gmail.com', '$2y$15$qblKJT6UjL1soQV3MOxoCO6ykEIQ6eRaq.E7U1EQtv/i/jb6jgk46', '2005-09-05', '333783162', 'imagen.jpg', 3),
(10, 'Thomas', 'Thomas@gmail.com', '$2y$15$GQFBZJ4w5XCHRx/qUQGED.FEiQvvr4D5Q5e9usOYNg1u/gAIRgBnC', '2024-05-17', '3327876137', 'WhatsApp Image 2024-05-03 at 3.56.19 PM.jpeg', 2),
(9, 'Emmanuel Alexander', 'emmanuel.gonzalez1438@alumnos.udg.mx', '$2y$15$qblKJT6UjL1soQV3MOxoCO6ykEIQ6eRaq.E7U1EQtv/i/jb6jgk46', '2024-05-10', '3337831621', 'WhatsApp Image 2024-05-03 at 3.56.19 PM.jpeg', 1),
(11, 'Kaxuuuuuuu', 'Kazu2@gmail.com', '$2y$15$yOrDZSBpXPe4JoVOgPPNFuReq5dk7EhEEEHXnQrA6c.WeysG6StZ.', '2024-05-17', '3337831621', 'WhatsApp Image 2024-05-03 at 3.56.19 PM.jpeg', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
