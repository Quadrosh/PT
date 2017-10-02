<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ParseController extends Controller
{


    public function actionTherapeutic_ru()
    {

        $url = 'http://therapeutic.ru/articles/pages/id_111';
        $getPage = $this->get_remote_data($url);
        $doc = new \DOMDocument();

        libxml_use_internal_errors(true);
        $doc->loadHTML($getPage);
        libxml_use_internal_errors(false);

        $firstLink = null;
        $links = $doc->getElementsByTagName('a');
        foreach($links as $link) {
            $valueID = $link->getAttribute('href');
            if ($valueID == 'http://therapeutic.ru/articles/pages/id_166') {
                $firstLink = $link;
            }
        }

        $parentNode = $firstLink->parentNode;
        $ul = $parentNode->parentNode;
        $localLinks = $ul->getElementsByTagName('a');

        foreach($localLinks as $localLink) {
            $article = new Article();
            $valueHref = $localLink->getAttribute('href');
            $article['link2original'] = $valueHref;


            $getLocalPage = $this->get_remote_data($valueHref);
            $localPageDoc = new \DOMDocument();
            libxml_use_internal_errors(true);
            $localPageDoc->loadHTML($getLocalPage);
            libxml_use_internal_errors(false);

//          replace links with i
            $xpath = new \DOMXPath($localPageDoc);
            $links = $xpath->query('*//a');
            foreach ($links as $link) {
                $name = $link->nodeValue;
                $newLink = $localPageDoc->createElement('i',$name);
                $link->parentNode->replaceChild($newLink,$link);
            }


            $h1s = $localPageDoc->getElementsByTagName('h1');
            $articleParentNode = $h1s->item(1)->parentNode;
            $dirtyString = $this->getInnerHtml($articleParentNode);

//            echo '<meta charset="utf-8"/>' . $dirtyString; die;

            $titleStart = preg_match("/(?P<start>\<h1\>)(.*)(?P<end>\<\/h1\>)/", $dirtyString, $matches);
            $dirtyTitle = $matches[0];

            $dirtyTitleClean1 = str_replace('</h1><h1>', ' - ',$dirtyTitle);
            $dirtyTitleClean2 = str_replace('<h1>', '',$dirtyTitleClean1);
            $cleanTitle = str_replace('</h1>', '',$dirtyTitleClean2);
            $article['list_name'] = $cleanTitle;
            $article['pagehead'] = $cleanTitle;
            $article['title'] = $cleanTitle;
            $article['description'] = 'Психотера - статьи - ' . $cleanTitle;
            if (!preg_match("/Автор\:/i", $dirtyString)) {
                $article['author'] = 'Михаил Викторович Голубев';
            } else {
               preg_match("/(?P<start>Автор\:)(.*)/s", $dirtyString, $authMatches);

                $dirtyAuthor = $authMatches[0];
                $cleanAuthor = str_replace('Автор:', '',$dirtyAuthor);

              $article['author'] = $cleanAuthor;
            }

            $article['keywords'] = 'психотерапия, статьи, ' . $article['author'];


//            echo '<meta charset="utf-8"/>' . var_dump($cleanTitle); die;

//            $startPlace = strpos($dirtyString,'Осенний марафон: как отличить хандру от депрессии</a><br/></li></ul>');
            $startPlace = strpos($dirtyString,'Осенний марафон: как отличить хандру от депрессии</i><br/></li></ul>');

            $cutString = substr($dirtyString,$startPlace+110);

            $clearString1 = str_replace('<h1', '<h3',$cutString);
            $clearString1_1 = str_replace('</h1', '</h3',$clearString1);
            $clearString2_1 = str_replace('<h2', '<h4',$clearString1_1);
            $clearString = str_replace('</h2', '</h4',$clearString2_1);

            $article['text'] = $clearString;
            $article['status'] = 'unread';

//            $article->save();





//            echo '<meta charset="utf-8"/>' . $clearString.'<br><br><br><br>';

            echo '<meta charset="utf-8"/>' .'article->link2original = '. $article['link2original']. '<br>'.
                'article->list_name = '. $article['list_name']. '<br>'.
                'article->author = '. $article['author']. '<br>'.
                $clearString.'<br><br><br><br>';



//            $dirtyString = $parentNode->nodeValue;
//            $startPlace = strpos($dirtyString,'Желать или требоватьОсенний марафон: как отличить хандру от депрессии');
//            $cutString = substr($dirtyString,$startPlace+129);
//
////            var_dump( '<meta charset="utf-8"/>'. nl2br($cutString)); die;
//
//            echo '<meta charset="utf-8"/>' . nl2br($cutString).'<br><br><br>';




//                function get_inner_html( $node )
//                {
//                    $innerHTML= '';
//                    $children = $node->childNodes;
//                    foreach ($children as $child) {
//                        $innerHTML .= $child->ownerDocument->saveXML( $child );
//                    }
//
//                    return $innerHTML;
//                }

//            function innerXML($node)
//            {
//                $doc = $node->ownerDocument;
//                $frag = $doc->createDocumentFragment();
//                foreach ($node->childNodes as $child) {
//                    $frag->appendChild($child->cloneNode(TRUE));
//                }
//                return $doc->saveXML($frag);
//            }


//            '<!doctype html><html lang="ru"><head><meta charset="utf-8"/><head>'



//            var_dump( '<meta charset="utf-8"/>'. $parentNode->nodeValue); die;

//            var_dump('<meta charset="utf-8"/>' . $firstH1); die;

//            echo $localPageDoc->saveHTML(); die;

//            $page = $localPageDoc->saveHTML();

//            var_dump($page); die;


        }


//        http://therapeutic.ru/articles/pages/id_166



//        echo $doc->saveHTML();






    }
    public function getInnerHtml( $node ){
            $innerHTML= '';
            $children = $node->childNodes;
            foreach ($children as $child) {
                $innerHTML .= $child->ownerDocument->saveXML( $child );
            }

            return $innerHTML;
    }
    public function get_remote_data($url, $post_paramtrs = false) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        if ($post_paramtrs) {
            curl_setopt($c, CURLOPT_POST, TRUE);
            curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
        } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
        curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
        curl_setopt($c, CURLOPT_MAXREDIRS, 10);
        $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
        if ($follow_allowed) {
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
        curl_setopt($c, CURLOPT_REFERER, $url);
        curl_setopt($c, CURLOPT_TIMEOUT, 60);
        curl_setopt($c, CURLOPT_AUTOREFERER, true);
        curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
        $data = curl_exec($c);
        $status = curl_getinfo($c);
        curl_close($c);
        preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
        $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
        $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
        if ($status['http_code'] == 200) {
            return $data;
        } elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
            if (!$follow_allowed) {
                if (empty($redirURL)) {
                    if (!empty($status['redirect_url'])) {
                        $redirURL = $status['redirect_url'];
                    }
                } if (empty($redirURL)) {
                    preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);
                    if (!empty($m[2])) {
                        $redirURL = $m[2];
                    }
                } if (empty($redirURL)) {
                    preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si', $data, $m);
                    if (!empty($m[1])) {
                        $redirURL = $m[1];
                    }
                } if (!empty($redirURL)) {
                    $t = debug_backtrace();
                    return call_user_func($t[0]["function"], trim($redirURL), $post_paramtrs);
                }
            }
        } return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
    }


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
