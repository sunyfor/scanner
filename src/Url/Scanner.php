<?
namespace Hanbit\ModernPHP\Url;

class Scanner{

    protected $urls;

    protected $httpClinet;

    public function __construct(array $urls){
        $this->urls = $urls;
        $this->$httpClinet = new \GuzzleHttp\Client();
    }

    public function getInvalidUrls(){
        $invalidUrls = [];
        foreach ($this->urls as $url) {
            try{
                $statusCode = $this->getStatusCodeForUrl($url);
            }catch(\Exception $e){
                $statusCode = 500;
            }
            if($statusCode >= 400){
                array_push($invalidUrls, ['url'=>$url, 'status'=>$statusCode]);
            }
        }

        return $invalidUrls;
    }

    protected function getStatusCodeForUrl($url){
        $HttpResponse = $this->httpClient->options($url);
        return $HttpResponse->getStatusCode();
    }
}
