<?php

namespace Truonglv\ThreadGuarder\XF\Pub\Controller;

use XF\Data\Robot;
use XF\Mvc\ParameterBag;

class Thread extends XFCP_Thread
{
    public function actionIndex(ParameterBag $params)
    {
        $visitor = \XF::visitor();
        if ($visitor->user_id <= 0) {
            /** @var Robot $robot */
            $robot = $this->data('XF:Robot');
            $userAgent = $this->request()->getUserAgent();
            if (strlen($userAgent) > 0 && $robot->userAgentMatchesRobot($userAgent) !== '') {
                // allow BOT engine can access to crawl thread content
            } else {
                $this->assertRegistrationRequired();
            }
        }

        return parent::actionIndex($params);
    }
}
