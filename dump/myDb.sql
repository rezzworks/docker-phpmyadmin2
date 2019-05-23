-- put in ./dump directory 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `title` varchar(30),
  `phone` varchar(30),
  `addDate` datetime,
  `addUser` varchar(30) NOT NULL,
  `lastLogin` datetime
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `department`, `title`, `phone`, `addDate`, `addUser`) VALUES
(1, 'William', 'Wheaton', 'usa.wwheaton', 'usa.wwheaton@gmail.com', 'Engineering', 'Ensign', '7577771212', NOW(), 'admin');

CREATE TABLE `movies` (
    `movieId` int(11) NOT NULL,
    `movieName` varchar(100) NOT NULL,
    `genre` varchar(20) NOT NULL,
    `rating` int(100),
    `comments` text,
    `instock` int(5),
    `price` int(6),
    `addDate` datetime,
    `addUser` varchar(30) NOT NULL,
    `editDate` datetime,
    `editUser` varchar(30)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `movies` (`movieId`, `movieName`, `genre`, `rating`, `comments`, `instock`, `price`, `addDate`, `addUser`, `editDate`,`editUser`) VALUES (1,'LORD OF THE RINGS','FANTASY', 5,'AN EPIC FILM.',10,20.00,NOW(),'admin',NOW(),'admin');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;