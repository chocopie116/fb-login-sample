<?php

class Controller
{
    private $app;
    private $request;

    const FACEBOOK_IMAGE_BASE_URL = 'https://graph.facebook.com/%s/picture?width=200&height=200';

    public function __construct(\Slim\Slim $app)
    {
        $this->app = $app;
        $this->request = $app->request;
    }

    /**
     *
     * @param {string} $templateName テンプレート名
     * @param {array}  $data         viewに渡すやつ
     */
    protected function render($templateName, $data)
    {
        return $this->app->render($templateName, $data);
    }

    /**
     * TOPページを表示する
     */
    public function showTop()
    {
        session_start();// depend facebook sdk @see http://case-k.com/blog/2015/08/04/fuelphp%E3%81%A7facebook-sdk-for-php-v5%E3%82%92%E4%BD%BF%E3%81%86/
        $fb = $this->createFacebook();
        $helper = $fb->getRedirectLoginHelper();
        $url = $helper->getLoginUrl(FACEBOOK_APP_CALLBACK_URL);//@see bootstrap

        $this->render('top.php', array('url' => $url));
    }

    /**
     * Facebookからのコールバックを処理する
     */
    public function fbCallback()
    {
        session_start();

        $fb = $this->createFacebook();
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (\Exception $e) {
            throw $e; //ハンドリングしない
        }

        $response = $fb->get('/me?fields=id,name', $accessToken);
        $user = $response->getGraphUser();

        $this->app->setCookie('app_scope_id', $user->getId(), '+ 7day');
        $this->app->setCookie('name', $user->getName(), '+ 7day');
        $this->app->redirect('reply');
    }

    public function reply()
    {
        $userId = $this->app->getCookie('app_scope_id');
        $name = $this->app->getCookie('name');

        if (!($userId && $name)) {
            $this->app->redirect('/');
        }

        $imgUrl = sprintf(self::FACEBOOK_IMAGE_BASE_URL, $userId);

        $this->render('reply.php', array(
            'user_id' => $userId,
            'name' => $name,
            'img_url' => $imgUrl
        ));
    }

    public function saveReply()
    {
        $image = sprintf(self::FACEBOOK_IMAGE_BASE_URL, $this->app->getCookie('app_scope_id'));

        $POST_DATA = array(
            'channel' => SLACK_WEBHOOK_CHANNEL, //@see bootstrap
            'username' => $this->app->getCookie('name'),
            'icon_url' => $image,
            'text' => $message = $this->app->request->post('message'),
            );

        $curl = curl_init(SLACK_WEBHOOK_URL); //@see bootstrap

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type, application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($POST_DATA));
        $output= curl_exec($curl);
        curl_close($curl);

        $this->app->redirect('complete');
    }

    public function complete()
    {
        $this->render('complete.php', array());
    }

    protected function createFacebook()
    {
        $fb = new Facebook\Facebook([
            'app_id' => FACEBOOK_APP_ID, //@see bootstrap
            'app_secret' => FACEBOOK_APP_SECRET,
            'default_graph_version' => 'v2.4',
            ]);

        return $fb;
    }
}
