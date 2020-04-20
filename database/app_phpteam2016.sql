-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2017 年 03 月 03 日 20:23
-- 服务器版本: 5.6.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_phpteam2016`
--

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseName` varchar(20) NOT NULL,
  `dataTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`courseName`, `dataTime`) VALUES
('数据结构', '2016-10-19'),
('asp.net', '2016-10-18');

-- --------------------------------------------------------

--
-- 表的结构 `qj`
--

CREATE TABLE IF NOT EXISTS `qj` (
  `stuid` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qj`
--

INSERT INTO `qj` (`stuid`, `name`, `class`, `openid`, `course`, `date`, `reason`) VALUES
(1413220412, '王宏超', '软件11403班', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', 'asp.net', '2016-10-18', 'gjihkihkojgjkoojj'),
(1413220412, '王宏超', '软件11403班', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', 'asp.net', '2016-10-18', '8级哈哈哈哈哈哈好好看看14哈哈哈哈'),
(1413220412, '王宏超', '软件11403班', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', 'asp.net', '2016-10-18', '张婆婆婆婆破坏伊尔迷新教学楼鬼望坡自觉同意了请知悉1'),
(1413220412, '王宏超', '软件11403班', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', 'asp.net', '2016-10-18', '生日快乐啦啦啦啦啦啦啦李1间五十客服论据咯哦图记录');

-- --------------------------------------------------------

--
-- 表的结构 `s_lesson`
--

CREATE TABLE IF NOT EXISTS `s_lesson` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水号',
  `l_id` int(11) DEFAULT NULL COMMENT '课程号',
  `class` varchar(255) DEFAULT NULL COMMENT '班级',
  PRIMARY KEY (`Id`),
  KEY `class` (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='课程表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `s_lesson`
--


-- --------------------------------------------------------

--
-- 表的结构 `s_location`
--

CREATE TABLE IF NOT EXISTS `s_location` (
  `wxid` varchar(255) NOT NULL,
  `latitude` double NOT NULL COMMENT '地理位置纬度',
  `longitude` double NOT NULL COMMENT '地理位置经度',
  `dt` varchar(20) NOT NULL COMMENT '位置定位时间',
  KEY `wxid` (`wxid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `s_location`
--

INSERT INTO `s_location` (`wxid`, `latitude`, `longitude`, `dt`) VALUES
('oAMv_syLxAAdhJbqh7Rm_0JN4OMc', 30.376558, 114.333633, '2017-03-03 20:18:06');

-- --------------------------------------------------------

--
-- 表的结构 `s_message`
--

CREATE TABLE IF NOT EXISTS `s_message` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '课程号',
  `coursename` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `l_time` varchar(255) DEFAULT NULL COMMENT '时间',
  `l_week` varchar(255) DEFAULT NULL COMMENT '课程在周几上',
  `l_local` varchar(255) DEFAULT NULL COMMENT '地点',
  `t_id` varchar(255) DEFAULT NULL COMMENT '教师编号',
  `class` varchar(255) NOT NULL,
  `signid` varchar(255) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='课程信息表' AUTO_INCREMENT=2016003 ;

--
-- 转存表中的数据 `s_message`
--

INSERT INTO `s_message` (`l_id`, `coursename`, `l_time`, `l_week`, `l_local`, `t_id`, `class`, `signid`) VALUES
(2016001, 'asp.net', '2016-2017学年第1学期', '1-16', 'YG03-404', '1413220412', '软件11403班', '0'),
(2016002, '数据结构', '2016-2017学年第1学期', '1-16', 'YG03-408', '1413220412', '计算机11503班', '1');

-- --------------------------------------------------------

--
-- 表的结构 `s_notice`
--

CREATE TABLE IF NOT EXISTS `s_notice` (
  `t_id` int(20) NOT NULL,
  `class` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `send_date` varchar(255) NOT NULL,
  `species` varchar(5) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `s_notice`
--

INSERT INTO `s_notice` (`t_id`, `class`, `course`, `send_date`, `species`, `content`) VALUES
(1403280127, '软件11403班', 'asp.net', '2017-03-02 20:18:34', '作业通知', '楼哦了亏了KKK开');

-- --------------------------------------------------------

--
-- 表的结构 `s_sign`
--

CREATE TABLE IF NOT EXISTS `s_sign` (
  `sign_id` int(20) NOT NULL,
  `s_id` int(10) DEFAULT '0' COMMENT '学号',
  `q_time` varchar(255) DEFAULT NULL COMMENT '时间',
  `q_s_wxid` varchar(40) NOT NULL,
  `class` varchar(255) NOT NULL,
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签到表';

--
-- 转存表中的数据 `s_sign`
--

INSERT INTO `s_sign` (`sign_id`, `s_id`, `q_time`, `q_s_wxid`, `class`) VALUES
(0, 0, '0000-00-00', 'oAMv_s1QLE1JxHAJ16sm-AwXmQ1w', ''),
(0, 0, '2017-03-02', 'oAMv_sw3BChLD0NSxa1q61yVkVOQ', ''),
(0, 1413220412, '2017-03-02 21:30:54', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', '软件11403班'),
(0, 1413220412, '2017-03-02 21:31:10', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', '软件11403班');

-- --------------------------------------------------------

--
-- 表的结构 `s_student`
--

CREATE TABLE IF NOT EXISTS `s_student` (
  `s_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '学号',
  `s_sex` varchar(20) NOT NULL,
  `s_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `s_wxid` varchar(255) DEFAULT NULL COMMENT '微信openid',
  `s_class` varchar(255) DEFAULT NULL COMMENT '班级',
  PRIMARY KEY (`s_id`),
  KEY `s_class` (`s_class`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='学生表' AUTO_INCREMENT=1413220413 ;

--
-- 转存表中的数据 `s_student`
--

INSERT INTO `s_student` (`s_id`, `s_sex`, `s_name`, `s_wxid`, `s_class`) VALUES
(1403280127, '男', '曹栋梁', 'oAMv_s2wxbeIRLcqS_IHcH0urdiQ', '软件11403班'),
(1404240602, '女', '袁锦秀', 'oAMv_s1QLE1JxHAJ16sm-AwXmQ1w', '软件11403班'),
(1404240626, '男', '张强龙', 'oAMv_sw3BChLD0NSxa1q61yVkVOQ', '软件11403班'),
(1413220412, '男', '王宏超', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc', '软件11403班');

-- --------------------------------------------------------

--
-- 表的结构 `s_teacher`
--

CREATE TABLE IF NOT EXISTS `s_teacher` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工号',
  `t_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `t_wxid` varchar(255) DEFAULT NULL COMMENT '微信openid',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='教师表' AUTO_INCREMENT=1413220413 ;

--
-- 转存表中的数据 `s_teacher`
--

INSERT INTO `s_teacher` (`t_id`, `t_name`, `t_wxid`) VALUES
(1403280127, '曹栋梁', 'oAMv_s2wxbeIRLcqS_IHcH0urdiQ'),
(1413220412, '王宏超', 'oAMv_syLxAAdhJbqh7Rm_0JN4OMc');
