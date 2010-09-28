<?
/**
 * @version		0.1.0
 * @package		com_oauthserver
 * @copyright	Copyright (C) 2010 Joocode. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link        http://www.joocode.com
 */

class ComOauthserverControllerCode extends ComDefaultControllerDefault 
{	
	protected function _actionSave($data)
	{
		$data['code'] = rand(); 
		$row = parent::_actionSave($data);

		$redirect_uri = KFactory::get('site::com.oauthserver.model.consumers')->id($row->oauthserver_consumer_id)->getItem()->redirect_uri;
		KFactory::tmp('lib.joomla.application')->redirect($redirect_uri.(strpbrk($redirect_uri, '?') ? '&' : '?').'code='.$row->code);	
	}
}