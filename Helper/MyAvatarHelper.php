<?php

namespace Kanboard\Plugin\Greenwing\Helper;

class MyAvatarHelper extends \Kanboard\Helper\AvatarHelper
{
    /**
     * Render small user avatar
     *
     * @access public
     * @param  string $user_id
     * @param  string $username
     * @param  string $name
     * @param  string $email
     * @param  string $avatar_path
     * @param  string $css
     * @return string
     */
    public function small($user_id, $username, $name, $email, $avatar_path, $css = '', $size = 38)
    {
        return $this->render($user_id, $username, $name, $email, $avatar_path, $css, $size);
    }
}
