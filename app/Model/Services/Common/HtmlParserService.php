<?php

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\HtmlParserServiceInterface;
use duzun\hQuery;
use Strings;
use Media;

class HtmlParserService implements HtmlParserServiceInterface
{

    private $doc;

    public function getSourceMetadata($request)
    {

        $response = Strings::extractLinkFromDescription($request);

        if(!isset($response->source_type)) return []; 

        switch($response->source_type) {
            case 'video':
                return [
                    'iframe' => Media::getVideoEmbedCode($response->video),
                    'type' => 'video'
                ];
                break;
            case 'trading_view':
                $code = Media::getTradingViewCode($response->trading_view);
                return [
                    'type' => 'tradingView',
                    'html' => Media::getTradingViewHtmlCode($code)
                ];
                break;
            case 'link':
                $url = $response->link;
                break;
        }

        try {

            $this->doc = hQuery::fromUrl($url, [
                'Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8;',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0 Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0'
            ]);

            if(!$this->doc) {

                return [
                    'meta_description' => null,
                    'meta_title' => null,
                    'og_image' => null,
                    'link' => $response->link,
                    'doc' => null,
                    'type' => 'link'
                ]; 

            }

            $data = [
                'meta_description' => $this->getMetaDescription($url),
                'meta_title' => $this->getMetaTitle(),
                'og_image' => $this->getImage($url),
                'link' => $url,
                'doc' => $this->doc->headers['CONTENT_TYPE'],
                'type' => 'link'
            ]; 

        }catch(\Exception $e)
        {

            $data = [
                'meta_description' => $url,
                'meta_title' => $url,
                'og_image' => null,
                'link' => $url,
                'doc' => null,
                'type' => 'link'
            ]; 

        }
        
        return $data; 

    }

    private function getImage($url)
    {

        if(isset($this->doc->headers['CONTENT_TYPE']) && $this->doc->headers['CONTENT_TYPE'] == 'image/png' || $this->doc->headers['CONTENT_TYPE'] == 'image/jpeg')
        {

            return strip_tags($url);

        }

        $ogImage = $this->doc->find("meta", 'property=og:image');

        if($ogImage)
        {

            return strip_tags($ogImage->get(0)->attr('content'));

        } else {

            $ogImage = $this->doc->find("img");

            if($ogImage)
            {

                return strip_tags($ogImage->get(0)->attr('src'));

            }
            
        } 

        return '';

    }

    private function getMetaDescription($url)
    {

        $metaDescription = $this->doc->find("meta", 'name=description');

        if($metaDescription)
        {

            return strip_tags($metaDescription->get(0)->attr('content'));

        } else {

            $ogDescription = $this->doc->find("meta", 'property=og:description');

            if($ogDescription)
            {

                return strip_tags($ogDescription->get(0)->attr('content'));

            } else {

                return strip_tags($url); 

            }  

        }

        return '';

    }

    private function getMetaTitle()
    {

        $metaTitle = $this->doc->find("title");

        if($metaTitle)
        {

            return strip_tags($metaTitle->get(0)->text());

        }        

        return '';

    }

}