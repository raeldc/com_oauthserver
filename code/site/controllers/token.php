<?
/**
 * @version		0.1.0
 * @package		com_oauthserver
 * @copyright	Copyright (C) 2010 Joocode. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link        http://www.joocode.com
 */

class ComOauthserverControllerToken extends ComDefaultControllerDefault 
{	
	protected function _actionRead()
	{
		$layout = KRequest::get('get.layout', 'string');
		
		if ($layout == 'authorize')
		{
			$consumer_key = KRequest::get('get.client_id', 'string');
			$redirect_uri = KRequest::get('get.redirect_uri', 'url');
	
			$consumer = KFactory::get('site::com.oauthserver.model.consumers')->set('consumer_key', $consumer_key)->getItem();
			
			if ($consumer->redirect_uri == $redirect_uri)
			{
				$oauthserver_consumer_id = KFactory::get('site::com.oauthserver.model.consumers')->set('consumer_key', $consumer_key)->getItem()->id;
				
				if (KFactory::get('site::com.oauthserver.model.authorizations')->set('userid', KFactory::get('lib.joomla.user')->id)->set('oauthserver_consumer_id', $oauthserver_consumer_id)->getTotal())
				{			
					$returnCode = 'ri2ri3jirj23';
					$code = KFactory::get('site::com.oauthserver.model.codes')
						->getItem()
						->set('oauthserver_consumer_id', $oauthserver_consumer_id)
						->set('code', $returnCode)
						->save();
					
					KFactory::tmp('lib.joomla.application')->redirect($redirect_uri.(strpbrk($model->accessTokenURL(), '?') ? '&' : '?').'code='.$returnCode);	
				}
				else
				{
					//resource owner must authorize the client
					KFactory::tmp('lib.joomla.application')->redirect('index.php?option=com_oauthserver&view=token&layout=default&client_id='.$consumer_key.'&redirect_uri='.urlencode($redirect_uri));					
				}
			}
			else
			{
				echo 'ERRORCODE redirect_uri_mismatch';
				exit();
			}
		}
		elseif ($layout == 'accesstoken')
		{
			$consumer_key = KRequest::get('get.client_id', 'string');
			$redirect_uri = KRequest::get('get.redirect_uri', 'url');
			$consumer_secret = KRequest::get('get.client_secret', 'string');
			$code= KRequest::get('get.code', 'string');

			$oauthserver_consumer_id = KFactory::get('site::com.oauthserver.model.consumers')->set('consumer_key', $consumer_key)->getItem()->id;
			
			if ($oauthserver_consumer_id) 
			{
				$isThereTheStoredCode = KFactory::get('site::com.oauthserver.model.codes')
					->set('oauthserver_consumer_id', $oauthserver_consumer_id)
					->set('code', $code)
					->getTotal();
	
				//TODO: check that the authorization code is not expired (e.g. 3 minutes old)
				//TODO: purge old authorization codes
				
				if ($isThereTheStoredCode)
				{
					$codeRow = KFactory::get('site::com.oauthserver.model.codes')
					->set('oauthserver_consumer_id', $oauthserver_consumer_id)
					->set('code', $code)
					->getItem();

					$accessToken = rand(); 
					
					KFactory::get('site::com.oauthserver.model.tokens')
						->getItem()	
						->set('oauthserver_consumer_id', $oauthserver_consumer_id)
						->set('access_token', $accessToken)
						->set('created_by', $codeRow->created_by)
						->save();
					
					echo 'access_token='.$accessToken;
					exit();
				}
				else
				{
					echo 'ERRORCODE invalid_request';
					exit();	
				}
			}
			else
			{
				echo 'ERRORCODE invalid_client';
				exit();
			}
		}
		else 
		{
			$consumer_key = KRequest::get('get.client_id', 'string', 'null');

			if (KFactory::get('site::com.oauthserver.model.consumers')->set('consumer_key', $consumer_key)->getTotal())
			{		
				parent::_actionRead();	
			}
			else 
			{
				echo 'ERRORCODE invalid_client';
				exit();
			}
		}
	}
}