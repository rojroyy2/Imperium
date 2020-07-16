-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 16 2020 г., 17:35
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sports shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `login` varchar(32) NOT NULL COMMENT 'Логин',
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) NOT NULL COMMENT 'Пароль',
  `rights` int(1) NOT NULL COMMENT 'Права'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `access`
--

INSERT INTO `access` (`id`, `login`, `phone`, `email`, `password`, `rights`) VALUES
(1, 'c3284d0f94606de1fd2af172aba15bf3', '', '', 'c3284d0f94606de1fd2af172aba15bf3', 1),
(2, 'f4136177c900cfd6177b766b72f72466', '89085497865', '', 'f4136177c900cfd6177b766b72f72466', 2),
(3, '74be16979710d4c4e7c6647856088456', '89457947184', '', '74be16979710d4c4e7c6647856088456', 2),
(4, '74be16979710d4c4e7c6647856088456', '314234543', '', '74be16979710d4c4e7c6647856088456', 2),
(5, '74be16979710d4c4e7c6647856088456', '89285326312', '8(912)431-42-12', '74be16979710d4c4e7c6647856088456', 2),
(6, '3675ac5c859c806b26e02e6f9fd62192', '89419574851', 'prodavalka@fsaew.re', '3675ac5c859c806b26e02e6f9fd62192', 3),
(7, '74be16979710d4c4e7c6647856088456', '42123215313', '', '74be16979710d4c4e7c6647856088456', 2),
(8, '74be16979710d4c4e7c6647856088456', '89256385562', 'medved@ya.ru', '74be16979710d4c4e7c6647856088456', 3),
(9, '3cb67a56627d79f4c2f0250cd855c5c9', '89453214541', 'salespeople1@mail.ru', '3cb67a56627d79f4c2f0250cd855c5c9', 3),
(10, '239f7980e4059e86d3304942b1c54441', '89043431354', 'buyer1@yandex.ru', '239f7980e4059e86d3304942b1c54441', 4),
(11, 'af99fc071461f61da201cf4191e8a5b4', '42467453215', 'locationreload@fe.tr', 'af99fc071461f61da201cf4191e8a5b4', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `accounting`
--

CREATE TABLE `accounting` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `goods_id` int(11) NOT NULL COMMENT 'ID_товара',
  `options` int(11) NOT NULL,
  `supplier_id` int(3) NOT NULL COMMENT 'ID_поставщика',
  `delivery_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата поставки',
  `production_date` datetime NOT NULL COMMENT 'Дата производства',
  `number` int(4) NOT NULL COMMENT 'Количество',
  `warehouse_id` int(1) NOT NULL COMMENT 'ID_магазина',
  `purchase_price` float DEFAULT NULL COMMENT 'Цена закупки за всю партию',
  `residue` int(11) NOT NULL COMMENT 'Осталось'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounting`
--

INSERT INTO `accounting` (`id`, `goods_id`, `options`, `supplier_id`, `delivery_date`, `production_date`, `number`, `warehouse_id`, `purchase_price`, `residue`) VALUES
(1, 1, 1, 1, '2019-06-04 12:26:19', '2019-05-29 00:00:00', 10, 2, 20000, 8),
(2, 2, 1, 2, '2019-06-04 12:29:44', '2019-05-28 00:00:00', 5, 2, 7500, 4),
(3, 2, 1, 1, '2019-06-04 12:53:48', '2019-05-29 00:00:00', 5, 2, 20000, 5),
(4, 3, 1, 1, '2019-06-04 12:54:23', '2019-06-04 00:00:00', 5, 2, 20000, 4),
(5, 4, 1, 1, '2019-06-04 12:59:42', '2019-06-04 00:00:00', 5, 2, 45000, 4),
(6, 5, 1, 1, '2019-06-04 13:07:03', '2019-05-28 00:00:00', 5, 2, 20000, 4),
(7, 6, 0, 1, '2019-06-04 16:13:51', '2019-05-27 00:00:00', 10, 2, 60000, 9),
(8, 2, 0, 1, '2019-06-06 17:54:52', '2019-06-19 00:00:00', 10, 2, 123213, 10),
(9, 2, 0, 1, '2019-06-06 17:55:32', '2019-06-05 00:00:00', 123, 2, 3213, 123),
(10, 2, 0, 1, '2019-06-06 17:56:20', '2019-06-13 00:00:00', 12, 2, 123, 12),
(11, 2, 0, 1, '2019-06-06 17:56:25', '2019-06-13 00:00:00', 12, 2, 123, 12),
(12, 2, 0, 1, '2019-06-06 17:56:28', '2019-06-13 00:00:00', 12, 2, 123, 12),
(13, 2, 0, 1, '2019-06-06 17:56:28', '2019-06-13 00:00:00', 12, 2, 123, 12),
(14, 2, 0, 1, '2019-06-06 17:56:28', '2019-06-13 00:00:00', 12, 2, 123, 12),
(15, 2, 5, 1, '2019-06-06 17:58:14', '2019-05-29 00:00:00', 123, 2, 123, 0),
(16, 2, 5, 1, '2019-06-06 17:58:15', '2019-05-29 00:00:00', 123, 2, 123, 0),
(17, 2, 5, 1, '2019-06-06 17:58:35', '2019-05-29 00:00:00', 123, 2, 123, 0);

--
-- Триггеры `accounting`
--
DELIMITER $$
CREATE TRIGGER `goods_update` AFTER UPDATE ON `accounting` FOR EACH ROW UPDATE `goods` 
SET `goods`.`residue` = (SELECT SUM(`accounting`.`residue`) FROM `accounting` WHERE `accounting`.`goods_id` = NEW.goods_id)
WHERE `goods`.`id` = NEW.goods_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `new_parti` AFTER INSERT ON `accounting` FOR EACH ROW UPDATE `goods` SET `goods`.`residue` = `goods`.`residue` + NEW.number WHERE `goods`.`id` = NEW.goods_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `access` int(11) NOT NULL COMMENT 'Авторизация',
  `work_book_number` varchar(14) NOT NULL COMMENT 'Номер трудовой книжки',
  `name` varchar(20) NOT NULL COMMENT 'Имя',
  `surname` varchar(20) NOT NULL COMMENT 'Фамилия',
  `patronymic` varchar(20) NOT NULL COMMENT 'Отчество',
  `start_date` date NOT NULL COMMENT 'Дата приёма на работу',
  `residential_address` varchar(90) NOT NULL COMMENT 'Место жительства',
  `base_salary` decimal(10,0) NOT NULL COMMENT 'Базовый оклад',
  `id_shop` int(11) DEFAULT NULL COMMENT 'Магазин'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `administrators`
--

INSERT INTO `administrators` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `base_salary`, `id_shop`) VALUES
(9, 2, 'AT-№543213233', 'Виктор', 'Малиновский', 'Иванович', '0000-00-00', 'г.Ростов на Дону, ул. Мира, 16, кв.3', '30000', 2),
(10, 4, '123', '', '', '', '0000-00-00', '', '0', 1),
(11, 5, '', '', '', '', '2019-05-07', '', '84', 1),
(12, 7, 'AT-№442113233', 'Ирина', 'Скрипонос', 'Вадимовна', '0000-00-00', 'г.Ростов на Дону, ул. Строителей, 112, кв.6', '30000', 2);

--
-- Триггеры `administrators`
--
DELIMITER $$
CREATE TRIGGER `Delete_access_administrators` AFTER DELETE ON `administrators` FOR EACH ROW DELETE FROM `access` WHERE `access`.`id` = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `admin_site`
--

CREATE TABLE `admin_site` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `patronymic` varchar(15) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `work_book` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin_site`
--

INSERT INTO `admin_site` (`id`, `access`, `name`, `surname`, `patronymic`, `adress`, `work_book`) VALUES
(1, 1, 'Константин', 'Страмаус', 'Вячеславович', 'Москва, ул. Солнечная, д. 40, кв. 17', '12345678912345');

-- --------------------------------------------------------

--
-- Структура таблицы `age`
--

CREATE TABLE `age` (
  `id` int(11) NOT NULL,
  `value` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `age`
--

INSERT INTO `age` (`id`, `value`) VALUES
(1, '5-10'),
(2, '10-12'),
(3, '12-15'),
(4, '15-17'),
(5, '17-20'),
(6, '20-40'),
(7, '40+');

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `buyers_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `count` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `buyers_id`, `goods_id`, `count`) VALUES
(24, 1, 1, 1),
(25, 1, 2, 10),
(40, 14, 1, NULL),
(49, 14, 1, NULL),
(50, 14, 3, NULL),
(51, 14, 3, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `access` int(11) NOT NULL COMMENT 'Авторизация',
  `name` varchar(20) NOT NULL COMMENT 'Имя',
  `surname` varchar(20) NOT NULL COMMENT 'Фамилия',
  `patronymic` varchar(20) NOT NULL COMMENT 'Отчество'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buyers`
--

INSERT INTO `buyers` (`id`, `access`, `name`, `surname`, `patronymic`) VALUES
(1, 4, 'buyer1', 'buyer1', 'buyer1'),
(2, 90, '425', '245', '234'),
(3, 91, '425', '245', '234'),
(4, 92, '425', '245', '234'),
(5, 93, '425', '245', '234'),
(6, 94, '425', '245', '234'),
(7, 95, '425', '245', '234'),
(8, 96, 'user1vish', 'user1', 'qwe'),
(9, 97, 'werf', 'eaqfd', 'wref'),
(10, 98, 'erf', 'ewrf', 'rge'),
(11, 99, 'qwd', 'eqw', 'qed'),
(12, 100, 'rewf', 'qwe', 'ewr'),
(13, 101, 'eg', 'sf', 'eg'),
(14, 10, 'buyer1', 'buyer1', 'buyer1'),
(15, 11, 'reg', 'reg', 'erg');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `name` varchar(20) NOT NULL COMMENT 'Название категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Виды спорта'),
(2, 'Распродажа'),
(3, 'Обувь'),
(4, 'Одежда'),
(5, 'Инвентарь'),
(6, 'СпортПит');

-- --------------------------------------------------------

--
-- Структура таблицы `clothes_category`
--

CREATE TABLE `clothes_category` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clothes_category`
--

INSERT INTO `clothes_category` (`id`, `name`) VALUES
(1, 'Шорты'),
(2, 'Футболки'),
(3, 'Шорты'),
(4, 'Куртки');

-- --------------------------------------------------------

--
-- Структура таблицы `clothes_options`
--

CREATE TABLE `clothes_options` (
  `key` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'id',
  `category_clothes` int(11) NOT NULL,
  `size` int(2) NOT NULL COMMENT 'размер',
  `color` int(11) NOT NULL COMMENT 'цвет',
  `floor` int(1) NOT NULL COMMENT 'пол',
  `season` int(11) NOT NULL COMMENT 'сезон',
  `material` int(11) NOT NULL COMMENT 'материал',
  `age` int(2) NOT NULL COMMENT 'возраст'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clothes_options`
--

INSERT INTO `clothes_options` (`key`, `id`, `category_clothes`, `size`, `color`, `floor`, `season`, `material`, `age`) VALUES
(1, 6, 4, 41, 7, 1, 3, 5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL COMMENT 'Индитификатор',
  `name` varchar(15) NOT NULL COMMENT 'Название',
  `hex` varchar(6) NOT NULL COMMENT 'ХЕКС'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`, `hex`) VALUES
(1, 'Чёрный', '000000'),
(2, 'Белый', 'FFFFFF'),
(3, 'Красный', 'FF0000'),
(4, 'Жёлтый', 'FFD500'),
(5, 'Оранжевый', 'FF7400'),
(6, 'Зелёный', '00C322'),
(7, 'Синий', '1240AB'),
(8, 'Голубой', '00E0FF'),
(9, 'Фиолетовый', '8900FF'),
(10, 'Розовый', 'FF0090'),
(11, 'Серый', '888888');

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

CREATE TABLE `discount` (
  `tovarId` int(11) NOT NULL,
  `discount` float NOT NULL,
  `until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `floor`
--

CREATE TABLE `floor` (
  `id` int(1) NOT NULL,
  `name` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `floor`
--

INSERT INTO `floor` (`id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский'),
(3, 'Универсальный');

-- --------------------------------------------------------

--
-- Структура таблицы `footwear_category`
--

CREATE TABLE `footwear_category` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `footwear_category`
--

INSERT INTO `footwear_category` (`id`, `name`) VALUES
(1, 'Кеды'),
(2, 'Бутсы'),
(3, 'Кроссовки');

-- --------------------------------------------------------

--
-- Структура таблицы `footwear_options`
--

CREATE TABLE `footwear_options` (
  `key` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `footwear_category` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `time_year` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `footwear_options`
--

INSERT INTO `footwear_options` (`key`, `id`, `footwear_category`, `age`, `size`, `color`, `time_year`, `floor`, `material`) VALUES
(1, 2, 3, 5, 31, 11, 2, 1, 5),
(2, 2, 3, 5, 30, 11, 2, 1, 5),
(3, 2, 3, 5, 28, 11, 2, 1, 5),
(4, 2, 3, 5, 27, 11, 2, 1, 5),
(5, 2, 3, 5, 26, 11, 2, 1, 5),
(6, 2, 3, 5, 25, 11, 2, 1, 5),
(7, 3, 3, 6, 31, 1, 2, 1, 5),
(8, 4, 3, 5, 31, 5, 2, 1, 5),
(9, 5, 3, 5, 31, 3, 2, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `bar_code` varchar(14) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Название товара',
  `category_id` int(2) NOT NULL COMMENT 'ID подкатегории',
  `sport` int(11) NOT NULL,
  `manufacturer_id` int(3) NOT NULL COMMENT 'ID Производителя',
  `description` text NOT NULL COMMENT 'Описание товара',
  `peculiar_properties` text NOT NULL COMMENT 'особенности',
  `residue` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `bar_code`, `name`, `category_id`, `sport`, `manufacturer_id`, `description`, `peculiar_properties`, `residue`, `price`) VALUES
(1, '1365427849514', 'Рюкзак Outventure CREEK 80', 5, 19, 10, 'Предусмотрена возможность внешней навески снаряжения на фронтальной, верхней и боковой панелях с помощью строп и креплений для трекинговых палок. Также предусмотрены объемные боковые карманы, передний карман и карман в клапане.', '<li>Новая версия популярного туристического рюкзака с улучшенной комплектацией от Outventure.<li>Предусмотрена возможность внешней навески снаряжения на фронтальной, верхней и боковой панелях с помощью строп и креплений для трекинговых палок. Также предусмотрены объемные боковые карманы, передний карман и карман в клапане.</li>\r\n<li>Система подвески настраивается в зависимости от роста. Алюминиевая лата, формирующая профиль спины, вынимается и подгоняется под особенности фигуры.</li>\r\n<li>Непромокаемое дно поможет сохранить вещи сухими.</li>\r\n<li>Нагрудный и поясной ремни позволяют надежно зафиксировать рюкзак.</li>', 8, 3499),
(2, '5412697845327', 'Кроссовки мужские Demix Tsunami II', 3, 20, 2, 'Отличное завершение образа в спортивном стиле - кроссовки Demix Tsunami II.', '<li>Удобная и гибкая подошва из материала ЭВА позволяет двигаться естественно.</li>\n<li>Сетчатый материал верха улучшает воздухообмен.</li>\n<li>Облегченная подошва обеспечивает низкий вес модели.</li>\n', 202, 1700),
(3, '8547962175846', 'Кроссовки мужские Nike Nightgazer', 3, 20, 9, 'Кроссовки Nike Nightgazer в стиле 90-х годов идеально завершат ретро-образ.', '<li>Верх выполнен из сетки с замшевыми накладками, что увеличивает воздухопроницаемость и износостойкость.</li>\n<li>Промежуточная подошва из полиуретана гарантирует хорошую амортизацию.</li>', 4, 4999),
(4, '5249175486248', 'Кроссовки мужские Nike Zoom Zero', 3, 20, 9, 'Теннисные кроссовки NikeCourt Air Zoom Zero с модифицированной подметкой станут отличным выбором для игр и тренировок.', '<li>Верх выполнен из сетки с замшевыми накладками, что увеличивает воздухопроницаемость и износостойкость.</li>\n<li>Промежуточная подошва из полиуретана гарантирует хорошую амортизацию.</li>\n<li>Продуманная система шнуровки для хорошей фиксации.</li>', 4, 9499),
(5, '5719674284659', 'Кроссовки мужские Fila Webbyroll 3.0', 3, 20, 3, 'Благодаря продуманной конструкции, кроссовки Webbyroll 3.0 от Fila станут отличным выбором для пробежки.', '<li>Подошва, выполненная по технологии Energized, хорошо поглощает ударные нагрузки.\n</li>\n<li>Колодка максимально приближена к форме стопы.\n</li>\n<li>Вставки из резины в подошве служат для надежного сцепления с поверхностью.\n</li>\n<li>Легкий вентилируемый материал верха обеспечивает оптимальную циркуляцию воздуха.\n</li>\n<li>Бесшовный верх EnergyKnit в сочетании с облегченной подошвой гарантирует комфорт во время пробежки.\n</li>\n<li>Светоотражающий материал 3M сделает вас заметнее в темное время суток.\n</li>', 4, 5000),
(6, '5741865497154', 'Ветровка мужская The North Face Drew Peak WindWall', 4, 10, 11, 'Компактная ветровка Drew Peak WindWall Jacket от The North Face станет отличным вариантом для активного отдыха на природе в прохладную погоду.', '<li>Ткань с водоотталкивающей обработкой DWR.\n</li>\n<li>Технология WindWall защищает от продувания.\n</li>\n<li>Капюшон защитит голову от ветра.\n</li>\n<li>Ветровка очень легкая и быстро упаковывается в специальный чехол.\n</li>\n<li>В модели предусмотрено 2 вместительных кармана на молнии.\n</li>', 9, 7499);

-- --------------------------------------------------------

--
-- Структура таблицы `inventory_category`
--

CREATE TABLE `inventory_category` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inventory_category`
--

INSERT INTO `inventory_category` (`id`, `name`) VALUES
(1, 'Палатки'),
(2, 'Рюкзаки'),
(3, 'Велосипеды');

-- --------------------------------------------------------

--
-- Структура таблицы `inventory_options`
--

CREATE TABLE `inventory_options` (
  `key` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'id',
  `inventory_category` int(11) NOT NULL,
  `length` int(4) NOT NULL COMMENT 'длина',
  `width` int(4) NOT NULL COMMENT 'ширина',
  `height` int(4) NOT NULL COMMENT 'высота',
  `weight` int(4) NOT NULL COMMENT 'вес',
  `color` int(11) NOT NULL COMMENT 'цвет',
  `material` int(11) NOT NULL COMMENT 'материал',
  `age` int(11) NOT NULL COMMENT 'возраст',
  `floor` int(1) NOT NULL COMMENT 'Пол'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `inventory_options`
--

INSERT INTO `inventory_options` (`key`, `id`, `inventory_category`, `length`, `width`, `height`, `weight`, `color`, `material`, `age`, `floor`) VALUES
(1, 1, 2, 260, 206, 950, 2000, 11, 5, 6, 1),
(2, 1, 2, 260, 206, 950, 2000, 11, 5, 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `name` varchar(20) NOT NULL COMMENT 'Название производителя',
  `information` text NOT NULL COMMENT 'Информация о производителе'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `information`) VALUES
(1, 'Adidas', 'AdidasAdidasAdidasAdidasAdidasAdidasAdidasAdidasAdidasAdidasAdidas'),
(2, 'Demix', 'DemixDemixDemixDemixDemixDemixDemixDemixDemixDemix'),
(3, 'Fila', 'Fila — южнокорейская компания — производитель и поставщик спортивной одежды, обуви и спортивных аксессуаров.'),
(4, 'Asics', 'Asics - это японская корпорация, являющаяся одним из лидеров по производству спортивной обуви и одежды. Также имеет модное направление под названием Onitsuka Tiger.\r\nНа сегодняшний день ASICS занимает 5-ое место в мире среди крупнейших компаний, производящих спортивную одежду и обувь.\r\nНа 31 марта 2011 г. штат компании ASICS насчитывает более 5600 сотрудников по всему миру. За последние годы компания стала самым быстрорастущим брендом спортивной обуви в Европе. Бренд ASICS относится к топовым брендам производителей спортивной одежды и обуви.'),
(5, 'Columbia', 'Columbia Sportswear Company — американская компания, производитель и поставщик одежды и аксессуаров для активного отдыха. Головной офис расположен в городе Портленде, штат Орегон, округ Вашингтон.\r\nПродукция компании продаётся в 13000 магазинах в более, чем в 100 странах мира. Большинство магазинов работает на условиях франчайзинга.\r\n\r\nВ данный момент Columbia Sportswear продает продукцию под четырьмя брендами категории outdoor:\r\n\r\nColumbia\r\nSorel\r\nMountain Hardwear\r\nMontrail'),
(6, 'Converse', 'Converse — американская компания, производящая обувь с начала XX века и наиболее известная своими кедами Chuck Taylor All-Star. Контролируется компанией Nike.\r\n'),
(7, 'K-Swiss', 'K-Swiss - международная компания, занимающаяся производством спортивной обуви класса \"люкс\". Бренд не делает ставки на массовость своей продукции, предпочитая уделять больше внимания качеству и уникальность, сохраняя при этом даже некоторую элитность. Вдохновением для её логотипа послужил герб Швейцарии - пять полос, которые изображаются также и на самой обуви.'),
(8, 'New balance', 'New Balance Athletic Shoe, Inc. (NBAS), более известная как New Balance (\"Нью Бэланс\"), американский производитель спортивной одежды, базирующийся в Брайтоне, одном из районов Бостона, штат Массачуссетс, США. Компания была основана в 1906 году, как \"New Balance Arch Support Company\" и стала одной из мировых фабрик по производству спортивной одежды и инвентаря.'),
(9, 'Nike', 'Nike, Inc.  — американская компания, всемирно известный производитель спортивной одежды и обуви. Штаб-квартира — в городе Бивертон (штат Орегон). По мнению аналитиков, на долю компании Nike приходится почти 95 % рынка баскетбольной обуви в США[4]. В 2012 году в компании было занято более 44 000 человек по всему миру. Бренд оценивается в $ 10,7 млрд и является самой ценной торговой маркой в спортивной индустрии. С 20 сентября 2013 года входит в Промышленный индекс Доу-Джонса.\n\nКомпания была основана 25 января 1964 года под названием Blue Ribbon Sports, и официально стала Nike, Inc. 30 мая 1971 года. Nike продает свою продукцию под собственной торговой маркой, а также Nike Golf, Nike Pro, Nike+, Air Jordan, Nike Skateboarding и в том числе под дочерними брендами Cole Haan, Hurley International и Converse. Nike также принадлежала Bauer Hockey (позже переименована в Nike Bauer) в период между 1995 и 2008 годами. В дополнение к производству одежды и экипировки, компания управляет розничными магазинами под названием NikeTown. Nike является спонсором многих спортсменов и спортивных команд по всему миру.'),
(10, 'Outventure', 'Если вы любите походы в любую погоду, отдых на природе или активные виды спорта, практичные товары Outventure (Аутвенчер) отлично впишутся в ваш арсенал. Канадо-шведский бренд создает одежду, обувь и аксессуары высокого качества, которые не подведут в экстремальных условиях. Дизайнеры компании создали удобные куртки и ботинки для повседневной или спортивной экипировки по приятной цене. Обширный выбор сумок и рюкзаков демонстрирует компактные и вместительные образцы из непромокаемого материала, и с ними не страшно попасть в дождь. Брендовые кроссовки или сандалии повторяют контуры стопы, гарантируя комфортное движение, а амортизирующая подошва уменьшает давление на ногу. Люди стремятся купить товары Outventure (Аутвенчер) за ряд отличных преимуществ: использование высококлассных материалов, продуманный дизайн вещей, долговечность и износостойкость.'),
(11, 'The North Face', 'Американская компания, специализирующаяся на производстве высококачественной технологичной спортивной, горной одежды, туристического инвентаря.');

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(15) NOT NULL COMMENT 'название материала'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id`, `name`) VALUES
(1, 'резина'),
(2, 'Сталь'),
(3, 'Дерево'),
(4, 'Хлопок'),
(5, 'синтетика'),
(6, 'Пластик'),
(7, 'йцу');

-- --------------------------------------------------------

--
-- Структура таблицы `offsTovar`
--

CREATE TABLE `offsTovar` (
  `id` int(11) NOT NULL,
  `accounting_id` int(11) NOT NULL,
  `administratorId` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `offsTovar`
--

INSERT INTO `offsTovar` (`id`, `accounting_id`, `administratorId`, `count`, `date`, `comments`) VALUES
(1, 8, 9, 1, '2019-05-31 00:00:00', 'Сломан'),
(2, 8, 9, 1, '2019-05-31 00:00:00', 'Сломан'),
(3, 8, 9, 1, '2019-05-31 14:52:37', 'ckjvfy'),
(4, 8, 9, 1, '2019-05-31 14:53:32', 'ckjvfy'),
(5, 8, 9, 1, '2019-05-31 14:54:15', 'ckjvfy'),
(6, 8, 9, 1, '2019-05-31 14:55:38', '1'),
(7, 8, 9, 1, '2019-05-31 15:07:12', 'fs'),
(8, 1, 9, 1, '2019-06-04 17:35:56', 'Порван');

--
-- Триггеры `offsTovar`
--
DELIMITER $$
CREATE TRIGGER `offsTovarAdd` AFTER INSERT ON `offsTovar` FOR EACH ROW UPDATE `accounting` SET `accounting`.`residue` = `accounting`.`residue` - NEW.`count` WHERE `accounting`.`id` = NEW.`accounting_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'id заказа',
  `sales` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `price` float NOT NULL,
  `payment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `sales`, `shop_id`, `status`, `price`, `payment`) VALUES
(4, 1, 3, 0, 123, 0),
(5, 2, 1, 0, 123, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ratingGoods`
--

CREATE TABLE `ratingGoods` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `goodsId` int(11) NOT NULL,
  `assessment` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL COMMENT 'Код продажи',
  `accouting_id` int(11) NOT NULL COMMENT 'ID_партии',
  `number` int(3) NOT NULL COMMENT 'Количество купленного',
  `sale_price` float NOT NULL,
  `salespeoplees_id` int(11) DEFAULT NULL COMMENT 'ID_продавца',
  `date_of_sale` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата продажи',
  `buyer_id` int(11) DEFAULT NULL COMMENT 'ID_покупателя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`id`, `accouting_id`, `number`, `sale_price`, `salespeoplees_id`, `date_of_sale`, `buyer_id`) VALUES
(1, 1, 1, 3499, 4, '2019-06-04 15:56:16', 5),
(2, 2, 1, 1700, 4, '2019-06-04 15:56:22', 2),
(3, 4, 1, 4999, 4, '2019-06-04 15:56:29', NULL),
(4, 5, 1, 9499, 4, '2019-06-04 15:56:45', NULL),
(5, 6, 1, 5000, 4, '2019-06-04 15:57:31', NULL),
(6, 7, 1, 7499, 4, '2019-06-04 16:14:13', NULL);

--
-- Триггеры `sales`
--
DELIMITER $$
CREATE TRIGGER `sales_yes_accouting` BEFORE INSERT ON `sales` FOR EACH ROW UPDATE `accounting`
SET `accounting`.`residue` = `accounting`.`residue` - NEW.number
WHERE `accounting`.`id` = NEW.`accouting_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `salespeople`
--

CREATE TABLE `salespeople` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `access` int(11) NOT NULL COMMENT 'Авторизация',
  `work_book_number` varchar(14) NOT NULL COMMENT 'Номер трудовой книжки',
  `name` varchar(20) NOT NULL COMMENT 'Имя',
  `surname` varchar(20) NOT NULL COMMENT 'Фамилия',
  `patronymic` varchar(20) NOT NULL COMMENT 'Отчество',
  `start_date` date NOT NULL COMMENT 'Дата приёма на работу',
  `residential_address` varchar(255) NOT NULL COMMENT 'Адрес продавца',
  `shop_id` int(11) DEFAULT NULL COMMENT 'ID_магазина',
  `base_salary` float NOT NULL COMMENT 'Базовый оклад'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `salespeople`
--

INSERT INTO `salespeople` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `shop_id`, `base_salary`) VALUES
(1, 3, 'AT-№133254233', 'Сергей', 'Климов', 'Игоревич', '2018-12-10', 'Ростов на дону, прю Будённовский, 31, кв.31', 2, 25000),
(2, 6, 'уецкнкен', 'Продавец', 'Продавцов', 'Продавалкович', '2019-05-14', 'хату на тату', 1, 300),
(3, 8, 'AT-№323213253', 'Пётр', 'Медведев', 'Евгеньевич', '2019-06-04', 'Ростов на Дону, Ворошилова, 15, дом 44, кв.325', 2, 25000),
(4, 9, 'AT-№147953233', 'Илья', 'Кравцов', 'Валерьевич', '2019-05-26', 'Ростов на Дону, ул. Копателей, 31, кв. 42', 2, 30000);

-- --------------------------------------------------------

--
-- Структура таблицы `shopping_opportunities`
--

CREATE TABLE `shopping_opportunities` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL COMMENT 'Адрес магазина',
  `phone` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shopping_opportunities`
--

INSERT INTO `shopping_opportunities` (`id`, `address`, `phone`, `status`) VALUES
(1, 'Москва, Мира, 72', '84155246241', 1),
(2, 'Ростов на Дону, Горького, 52', '84155246541', 1),
(3, 'Дача Медведева', '01231231231', 0),
(4, 'dsad', '12354123311', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE `size` (
  `id` int(2) NOT NULL,
  `value` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `value`) VALUES
(1, '15'),
(2, '16'),
(3, '17'),
(4, '18'),
(5, '19'),
(6, '20'),
(7, '21'),
(8, '22'),
(9, '23'),
(10, '24'),
(11, '25'),
(12, '26'),
(13, '27'),
(14, '28'),
(15, '29'),
(16, '30'),
(17, '31'),
(18, '32'),
(19, '33'),
(20, '34'),
(21, '35'),
(22, '36'),
(23, '37'),
(24, '38'),
(25, '39'),
(26, '40'),
(27, '41'),
(28, '42'),
(29, '43'),
(30, '44'),
(31, '45'),
(32, '46'),
(33, '47'),
(34, '48'),
(35, 'XXXS'),
(36, 'XXS'),
(37, 'XS'),
(38, 'S'),
(39, 'M'),
(40, 'L'),
(41, 'XL'),
(42, 'XXL'),
(43, 'XXXL');

-- --------------------------------------------------------

--
-- Структура таблицы `sportpit_category`
--

CREATE TABLE `sportpit_category` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sportpit_category`
--

INSERT INTO `sportpit_category` (`id`, `name`) VALUES
(1, 'Протеин'),
(2, 'Креатин'),
(3, 'Гейнер');

-- --------------------------------------------------------

--
-- Структура таблицы `sportpit_options`
--

CREATE TABLE `sportpit_options` (
  `key` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'id',
  `taste` int(11) NOT NULL COMMENT 'вкус',
  `mass` int(4) NOT NULL COMMENT 'вес',
  `number_servings` int(4) NOT NULL COMMENT 'количество порций',
  `instruction` varchar(500) NOT NULL COMMENT 'инструкиция',
  `sportpit_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sportpit_options`
--

INSERT INTO `sportpit_options` (`key`, `id`, `taste`, `mass`, `number_servings`, `instruction`, `sportpit_category`) VALUES
(1, 2, 2, 312, 1, '2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `name` varchar(35) NOT NULL COMMENT 'Название поставщика',
  `address` varchar(255) NOT NULL COMMENT 'Адрес поставщика',
  `phone` varchar(11) NOT NULL COMMENT 'Телефон поставщика',
  `information` text NOT NULL COMMENT 'Информация о производителе'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `information`) VALUES
(1, 'уепу', 'пцкпцеу', '81254567423', 'ыпвиывпипи1'),
(2, 'qwd', 'asd', '81254567422', '');

-- --------------------------------------------------------

--
-- Структура таблицы `taste`
--

CREATE TABLE `taste` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(15) NOT NULL COMMENT 'Название вкуса'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taste`
--

INSERT INTO `taste` (`id`, `name`) VALUES
(1, 'Клубника'),
(2, 'Шоколад'),
(3, 'Абрикос'),
(4, 'Ягодный микс');

-- --------------------------------------------------------

--
-- Структура таблицы `time_year`
--

CREATE TABLE `time_year` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(5) NOT NULL COMMENT 'Название времени года'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `time_year`
--

INSERT INTO `time_year` (`id`, `name`) VALUES
(1, 'Зима'),
(2, 'Лето'),
(3, 'Осень'),
(4, 'Весна'),
(5, 'Все');

-- --------------------------------------------------------

--
-- Структура таблицы `views_sport`
--

CREATE TABLE `views_sport` (
  `id` int(11) NOT NULL COMMENT 'Код',
  `name` varchar(30) NOT NULL COMMENT 'Название спорта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Виды спорта';

--
-- Дамп данных таблицы `views_sport`
--

INSERT INTO `views_sport` (`id`, `name`) VALUES
(1, 'Альпинизм'),
(2, 'Баскетбол'),
(3, 'Бадминтон'),
(4, 'Бейсбол'),
(5, 'Бокс'),
(6, 'Борьба'),
(7, 'Бодибилдинг'),
(8, 'Бобслей'),
(9, 'Волейбол'),
(10, 'Гимнастика спортивная'),
(11, 'Дзюдо'),
(12, 'Каратэ'),
(13, 'Самбо'),
(14, 'Сноуборд'),
(15, 'Шахматы'),
(16, 'Лёгкая атлетика'),
(17, 'Тяжёлая атлетика'),
(18, 'Футбол'),
(19, 'Туризм'),
(20, 'Бег');

-- --------------------------------------------------------

--
-- Структура таблицы `workerDay`
--

CREATE TABLE `workerDay` (
  `id` int(11) NOT NULL,
  `worker` int(11) NOT NULL,
  `root` int(1) NOT NULL,
  `date` date NOT NULL,
  `begin` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workerDay`
--

INSERT INTO `workerDay` (`id`, `worker`, `root`, `date`, `begin`, `end`) VALUES
(2, 0, 0, '2019-06-02', '00:00:00', '00:00:00'),
(3, 1, 3, '0000-00-00', '10:00:00', '15:00:00'),
(4, 1, 3, '0000-00-00', '10:00:00', '15:00:00'),
(5, 1, 3, '0000-00-00', '02:03:00', '03:56:00'),
(6, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(7, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(8, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(9, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(10, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(11, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(12, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(13, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(14, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(15, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(16, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(17, 1, 3, '2019-06-03', '02:03:00', '03:56:00'),
(18, 1, 3, '2019-06-03', '09:00:00', '21:00:00'),
(19, 9, 2, '2019-06-04', '09:00:00', '21:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Индексы таблицы `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access` (`access`),
  ADD KEY `id_shop` (`id_shop`);

--
-- Индексы таблицы `admin_site`
--
ALTER TABLE `admin_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access` (`access`);

--
-- Индексы таблицы `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_id` (`buyers_id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Индексы таблицы `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access` (`access`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clothes_category`
--
ALTER TABLE `clothes_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clothes_options`
--
ALTER TABLE `clothes_options`
  ADD PRIMARY KEY (`key`),
  ADD KEY `color` (`color`),
  ADD KEY `season` (`season`),
  ADD KEY `material` (`material`),
  ADD KEY `category_clothes` (`category_clothes`),
  ADD KEY `size` (`size`),
  ADD KEY `age` (`age`),
  ADD KEY `clothes_options_ibfk_1` (`id`),
  ADD KEY `floor` (`floor`);

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`tovarId`);

--
-- Индексы таблицы `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `footwear_category`
--
ALTER TABLE `footwear_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `footwear_options`
--
ALTER TABLE `footwear_options`
  ADD PRIMARY KEY (`key`),
  ADD KEY `id` (`id`),
  ADD KEY `footwear_category` (`footwear_category`),
  ADD KEY `age` (`age`),
  ADD KEY `size` (`size`),
  ADD KEY `color` (`color`),
  ADD KEY `time_year` (`time_year`),
  ADD KEY `material` (`material`),
  ADD KEY `floor` (`floor`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `subcategory_id` (`category_id`),
  ADD KEY `sport` (`sport`);

--
-- Индексы таблицы `inventory_category`
--
ALTER TABLE `inventory_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `inventory_options`
--
ALTER TABLE `inventory_options`
  ADD PRIMARY KEY (`key`),
  ADD KEY `color` (`color`),
  ADD KEY `material` (`material`),
  ADD KEY `inventory_options_ibfk_1` (`id`),
  ADD KEY `inventory_category` (`inventory_category`),
  ADD KEY `age` (`age`),
  ADD KEY `floor` (`floor`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `offsTovar`
--
ALTER TABLE `offsTovar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounting_id` (`accounting_id`),
  ADD KEY `administratorId` (`administratorId`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `sales` (`sales`);

--
-- Индексы таблицы `ratingGoods`
--
ALTER TABLE `ratingGoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goodsId` (`goodsId`),
  ADD KEY `userId` (`userId`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accouting_id` (`accouting_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `salespeoplees_id` (`salespeoplees_id`);

--
-- Индексы таблицы `salespeople`
--
ALTER TABLE `salespeople`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access` (`access`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Индексы таблицы `shopping_opportunities`
--
ALTER TABLE `shopping_opportunities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sportpit_category`
--
ALTER TABLE `sportpit_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sportpit_options`
--
ALTER TABLE `sportpit_options`
  ADD PRIMARY KEY (`key`),
  ADD KEY `taste` (`taste`),
  ADD KEY `sportpit_category` (`sportpit_category`),
  ADD KEY `sportpit_options_ibfk_1` (`id`);

--
-- Индексы таблицы `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `taste`
--
ALTER TABLE `taste`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `time_year`
--
ALTER TABLE `time_year`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `views_sport`
--
ALTER TABLE `views_sport`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workerDay`
--
ALTER TABLE `workerDay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker` (`worker`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `admin_site`
--
ALTER TABLE `admin_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `age`
--
ALTER TABLE `age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT для таблицы `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `clothes_category`
--
ALTER TABLE `clothes_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `clothes_options`
--
ALTER TABLE `clothes_options`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Индитификатор', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `floor`
--
ALTER TABLE `floor`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `footwear_category`
--
ALTER TABLE `footwear_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `footwear_options`
--
ALTER TABLE `footwear_options`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `inventory_category`
--
ALTER TABLE `inventory_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `inventory_options`
--
ALTER TABLE `inventory_options`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `offsTovar`
--
ALTER TABLE `offsTovar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id заказа', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `ratingGoods`
--
ALTER TABLE `ratingGoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код продажи', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `salespeople`
--
ALTER TABLE `salespeople`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `shopping_opportunities`
--
ALTER TABLE `shopping_opportunities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `sportpit_category`
--
ALTER TABLE `sportpit_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `sportpit_options`
--
ALTER TABLE `sportpit_options`
  MODIFY `key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `taste`
--
ALTER TABLE `taste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `time_year`
--
ALTER TABLE `time_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `views_sport`
--
ALTER TABLE `views_sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Код', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `workerDay`
--
ALTER TABLE `workerDay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD CONSTRAINT `accounting_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `accounting_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `accounting_ibfk_3` FOREIGN KEY (`warehouse_id`) REFERENCES `shopping_opportunities` (`id`);

--
-- Ограничения внешнего ключа таблицы `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`access`) REFERENCES `access` (`id`),
  ADD CONSTRAINT `administrators_ibfk_2` FOREIGN KEY (`id_shop`) REFERENCES `shopping_opportunities` (`id`);

--
-- Ограничения внешнего ключа таблицы `admin_site`
--
ALTER TABLE `admin_site`
  ADD CONSTRAINT `admin_site_ibfk_1` FOREIGN KEY (`access`) REFERENCES `access` (`id`);

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`buyers_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `buyers_ibfk_1` FOREIGN KEY (`access`) REFERENCES `access` (`id`);

--
-- Ограничения внешнего ключа таблицы `clothes_options`
--
ALTER TABLE `clothes_options`
  ADD CONSTRAINT `clothes_options_ibfk_1` FOREIGN KEY (`id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_2` FOREIGN KEY (`color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_3` FOREIGN KEY (`season`) REFERENCES `time_year` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_4` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_5` FOREIGN KEY (`category_clothes`) REFERENCES `clothes_category` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_6` FOREIGN KEY (`size`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_7` FOREIGN KEY (`age`) REFERENCES `age` (`id`),
  ADD CONSTRAINT `clothes_options_ibfk_8` FOREIGN KEY (`floor`) REFERENCES `floor` (`id`);

--
-- Ограничения внешнего ключа таблицы `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`tovarId`) REFERENCES `goods` (`id`);

--
-- Ограничения внешнего ключа таблицы `footwear_options`
--
ALTER TABLE `footwear_options`
  ADD CONSTRAINT `footwear_options_ibfk_1` FOREIGN KEY (`id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_2` FOREIGN KEY (`footwear_category`) REFERENCES `footwear_category` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_3` FOREIGN KEY (`age`) REFERENCES `age` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_4` FOREIGN KEY (`size`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_5` FOREIGN KEY (`color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_6` FOREIGN KEY (`time_year`) REFERENCES `time_year` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_7` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `footwear_options_ibfk_8` FOREIGN KEY (`floor`) REFERENCES `floor` (`id`);

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`),
  ADD CONSTRAINT `goods_ibfk_3` FOREIGN KEY (`sport`) REFERENCES `views_sport` (`id`),
  ADD CONSTRAINT `goods_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `inventory_options`
--
ALTER TABLE `inventory_options`
  ADD CONSTRAINT `inventory_options_ibfk_1` FOREIGN KEY (`id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `inventory_options_ibfk_2` FOREIGN KEY (`color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `inventory_options_ibfk_3` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `inventory_options_ibfk_4` FOREIGN KEY (`inventory_category`) REFERENCES `inventory_category` (`id`),
  ADD CONSTRAINT `inventory_options_ibfk_5` FOREIGN KEY (`age`) REFERENCES `age` (`id`),
  ADD CONSTRAINT `inventory_options_ibfk_6` FOREIGN KEY (`floor`) REFERENCES `floor` (`id`);

--
-- Ограничения внешнего ключа таблицы `offsTovar`
--
ALTER TABLE `offsTovar`
  ADD CONSTRAINT `offstovar_ibfk_1` FOREIGN KEY (`accounting_id`) REFERENCES `accounting` (`id`),
  ADD CONSTRAINT `offstovar_ibfk_2` FOREIGN KEY (`administratorId`) REFERENCES `administrators` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`shop_id`) REFERENCES `shopping_opportunities` (`id`),
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`sales`) REFERENCES `sales` (`id`);

--
-- Ограничения внешнего ключа таблицы `ratingGoods`
--
ALTER TABLE `ratingGoods`
  ADD CONSTRAINT `ratinggoods_ibfk_1` FOREIGN KEY (`goodsId`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `ratinggoods_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `buyers` (`id`);

--
-- Ограничения внешнего ключа таблицы `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`accouting_id`) REFERENCES `accounting` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`salespeoplees_id`) REFERENCES `salespeople` (`id`);

--
-- Ограничения внешнего ключа таблицы `salespeople`
--
ALTER TABLE `salespeople`
  ADD CONSTRAINT `salespeople_ibfk_1` FOREIGN KEY (`access`) REFERENCES `access` (`id`),
  ADD CONSTRAINT `salespeople_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shopping_opportunities` (`id`);

--
-- Ограничения внешнего ключа таблицы `sportpit_options`
--
ALTER TABLE `sportpit_options`
  ADD CONSTRAINT `sportpit_options_ibfk_1` FOREIGN KEY (`id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `sportpit_options_ibfk_2` FOREIGN KEY (`taste`) REFERENCES `taste` (`id`),
  ADD CONSTRAINT `sportpit_options_ibfk_3` FOREIGN KEY (`sportpit_category`) REFERENCES `sportpit_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
