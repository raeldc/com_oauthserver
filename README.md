Credits
========
	/**
	 * com_oauth	Developed using Nooku Framework 0.7  
	 * @package		com_oauthserver
	 * @copyright	Copyright (C) 2010 Joocode. All rights reserved.
	 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
	 * @link        http://www.joocode.com
	 */

Nooku Framework OAuth Authorization Server library
Follows Internet-Draft "The OAuth 2.0 Protocol" rev. 10 http://tools.ietf.org/html/draft-ietf-oauth-v2-10

Manage authentication to a Nooku Framework powered web app. Only the authorization part is covered.
At the end of the process, the client will have an access_token linked to the user id that authorized its usage.

INSTALLATION
------------

Simply download the package and symlink from the Joomla installation

####/components:####
	`ln -s com_oauthserver_directory/site com_oauthserver`
 
USAGE
-----

Must be used on servers that support TSL 1.2 (http://tools.ietf.org/html/rfc5246). Access tokens SHOULD NOT be sent in the clear over an insecure channel.
Configure the OAuth client (e.g. com_oauth http://github.com/beyounic/com_oauth) to use the URL endpoints:

	Authorize URL: http://WEBSITE/index.php?option=com_oauthserver&view=token&layout=authorize
	Access token URL: http://WEBSITE/index.php?option=com_oauthserver&view=token&layout=accesstoken

TODO
----

- Manage user rejecting authorization (and access_denied error code)
- Support required response_type parameter (http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-3)
- The authorization server MUST accept the client credentials using both the request parameter, and the HTTP Basic authentication scheme. (http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-2.1)
- Correctly return error codes (http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-3.2.1, http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-4.3.1)
- The client requests an access token by making an HTTP "POST" request to the token endpoint (http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-4)
- Support parameter grant_type (http://tools.ietf.org/html/draft-ietf-oauth-v2-10#section-4)
- Improve the code / access_token generation algorithms (now created using a simple rand() for demo purposes)