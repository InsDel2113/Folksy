SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `folksy_framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `forum_categories`
--

TRUNCATE TABLE `forum_categories`;
--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `name`) VALUES
(1, 'On-topic');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `content` varchar(512) NOT NULL,
  `reply` int(11) NOT NULL DEFAULT 0,
  `threadid` int(11) NOT NULL DEFAULT 0,
  `poster_id` int(11) NOT NULL,
  `replier_uname` varchar(25) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `forum_posts`
--

TRUNCATE TABLE `forum_posts`;
--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `title`, `content`, `reply`, `threadid`, `poster_id`, `replier_uname`, `cat_id`) VALUES
(1, 'yes this is a post', 'some content here\r\n\r\nsome content there', 0, 0, 2147483647, '', 0),
(999, 'test', '', 1, 1, 0, 'InsDel2113', 0),
(1000, 'testsf', 'testsdfsdfsdf', 0, 0, 2147483647, '', 1),
(1001, 'testsf', 'testsdfsdfsdf', 0, 0, 2147483647, '', 1),
(1002, 'sssss', 'ssssss', 0, 0, 2147483647, '', 1),
(1003, 'test', 'test', 1, 0, 2147483647, 'InsDel2113', 0),
(1004, 'test', 'test', 1, 1002, 2147483647, 'InsDel2113', 0),
(1005, 'test', 'test', 1, 1002, 2147483647, 'InsDel2113', 0),
(1006, 'test', 'test', 1, 1002, 2147483647, 'InsDel2113', 0),
(1007, 'cool', 'cool', 1, 1002, 2147483647, 'InsDel2113', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` bigint(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `ip`, `user_agent`) VALUES
(2147483647, 'InsDel2113', '$2y$10$UBs/1k9HafMKEl.q5adVae2Yb9YxObnbi4KHfVOvmKiMhkpxuTyJ2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
