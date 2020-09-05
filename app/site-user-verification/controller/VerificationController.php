<?php
/**
 * VerificationController
 * @package site-user-verification
 * @version 0.0.1
 */

namespace SiteUserVerification\Controller;

use LibUser\Library\Fetcher;
use SiteUserVerification\Library\Meta;
use LibUserVerification\Library\Verifier;
use LibUserAuthCookie\Authorizer\Cookie;

class VerificationController extends \Site\Controller
{
	public function verifyAction(){
		$token = $this->req->getQuery('token');
		if(!$token)
			return $this->show404();

		$field = $this->req->getQuery('field', 'email');

		$verif = Verifier::verify($token, $field);
		if(!$verif)
			return $this->show404();

		$params = [
            '_meta' => [
                'title' => 'Verification'
            ],
            'meta' => Meta::single(),
            'next' => $verif->next ?? $this->router->to('siteHome')
        ];

		$user = Fetcher::getOne(['id'=>$verif->user]);
		if(!$user)
			return $this->show404();

		Fetcher::set(['status'=>3], ['id'=>$user->id]);

		Cookie::setKeep(false);
		Cookie::loginById($user->id);

		$this->res->render('me/verification/single', $params);
		return $this->res->send();
	}
}