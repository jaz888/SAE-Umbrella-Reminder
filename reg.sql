-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 07 月 23 日 20:39
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_php4me`
--

-- --------------------------------------------------------

--
-- 表的结构 `reg`
--

CREATE TABLE IF NOT EXISTS `reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `nick` varchar(10) NOT NULL DEFAULT '亲' COMMENT '昵称',
  `cityId` varchar(20) NOT NULL COMMENT '城市ID',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `today` int(11) NOT NULL DEFAULT '0' COMMENT '今天是否已经发送',
  `unsub` int(11) NOT NULL DEFAULT '0' COMMENT '是否取消',
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;
