CREATE TABLE IF NOT EXISTS `jos_oauthserver_consumers` (
  `oauthserver_consumer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `consumer_key` varchar(255) NOT NULL,
  `consumer_secret` varchar(255) NOT NULL,
  `redirect_uri` varchar(500) NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  `modified_on` datetime NOT NULL,
  `enabled` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`oauthserver_consumer_id`),
  UNIQUE KEY `consumer_key` (`consumer_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jos_oauthserver_tokens` (
  `oauthserver_token_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `oauthserver_consumer_id` bigint(20) unsigned NOT NULL,
  `access_token` varchar(200) NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`oauthserver_token_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jos_oauthserver_codes` (
  `oauthserver_code_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `oauthserver_consumer_id` bigint(20) unsigned NOT NULL,
  `code` varchar(200) NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`oauthserver_code_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jos_oauthserver_authorizations` (
  `oauthserver_authorization_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `oauthserver_consumer_id` bigint(20) unsigned NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`oauthserver_authorization_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `jos_oauthserver_consumers` (`name`, `consumer_key`, `consumer_secret`, `redirect_uri`) VALUES
('test', '11111', '22222', 'http://WEBSITE/component/oauth/?view=subscrin');