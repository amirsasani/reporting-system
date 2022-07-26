<?php

namespace Amirsasani\ReportingSystem\Details;

use Amirsasani\ReportingSystem\Details\Contracts\Details;

class NicknameDetails extends Details
{
    public function setNickname(string $nickname)
    {
        $this->details['nickname'] = $nickname;
    }
}