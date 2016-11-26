<?php

class MyTags extends \Phalcon\Tag {

    private $noIndex        = false;

    private $canonical      = null;

    private $previousLink   = null;
    private $nextLink       = null;

    protected $metaDescription;

    protected $facebookGraphModel;
    protected $twitterCardModel;

    public function getFacebookGraphTags() {

        
    ?>
<?php if ($this->facebookGraphModel) {

    $customProperties = $this->facebookGraphModel->getCustomProperties();

    ob_start();?>
<meta property="fb:app_id" content="132453660716" />
    <?php if ($this->facebookGraphModel->getType() !== null) : ?>
        <meta name="og:type" property="og:type" content="<?=$this->facebookGraphModel->getType()?>" />
    <?php endif; ?>
    <?php if ($this->facebookGraphModel->getUrl() !== null) : ?>
        <meta name="og:url" property="og:url" content="<?=$this->facebookGraphModel->getUrl()?>" />
    <?php endif; ?>
    <?php if ($this->facebookGraphModel->getTitle() !== null) : ?>
        <meta name="og:title" property="og:title" content="<?=$this->facebookGraphModel->getTitle()?>" />
    <?php endif; ?>
    <?php if ($this->facebookGraphModel->getDescription() !== null) : ?>
        <meta name="og:description" property="og:description" content="<?=$this->facebookGraphModel->getDescription()?>" />
    <?php endif; ?>
    <?php if ($this->facebookGraphModel->getImage() !== null) : ?>
        <meta name="og:image" property="og:image" content="<?=$this->facebookGraphModel->getImage()?>"/>
    <?php endif; ?>

    <?php if ($this->facebookGraphModel->getRating() !== null) : ?>
        <meta name="og:rating" property="og:rating" content="<?=$this->facebookGraphModel->getRating()?>"/>
        <meta name="og:rating_scale" property="og:rating_scale" content="10"/>
        <meta name="og:rating_count" property="og:rating_count" content="<?=$this->facebookGraphModel->getRatingCount()?>"/>
    <?php endif; ?>

    <?php if ($this->facebookGraphModel->getAndroidUrl() !== null) : ?>
        <meta property="al:android:url" content="<?=$this->facebookGraphModel->getAndroidUrl()?>"/>
        <meta property="al:android:package" content="com.pubreviews.com"/>
        <meta property="al:android:app_name" content="Pub Reviews"/>
    <?php endif; ?>
    <?php if ($this->facebookGraphModel->getIosUrl() !== null) : ?>
        <meta property="al:ios:url" content="<?=$this->facebookGraphModel->getIosUrl()?>"/>
        <meta property="al:ios:app_store_id" content="987110502"/>
        <meta property="al:ios:app_name" content="Pub Reviews"/>
    <?php endif; ?>
    <?php if (!empty($customProperties)) : ?>
        <?php foreach ($customProperties as $key => $value) : ?>
            <meta name="<?=$key?>"  property="<?=$key?>" content="<?=$value?>" />
        <?php endforeach; ?>
    <?php endif; ?>
<?php return ob_get_clean();
}
    }


    public function setFacebookGraphModel(FacebookGraphModel $model) {

        $this->facebookGraphModel = $model;
    }


    public function getTwitterCardTags() {

        if ($this->twitterCardModel) {

            $code = '<meta name="twitter:card" content="' . $this->twitterCardModel->getType() . '" />';
            $code .= '<meta name="twitter:site" content="@pubreviews" />';
            $code .= '<meta name="twitter:site:id" content="188801499" />';

            return $code;
        }

        return null;
    }

    public function setTwitterCardModel(TwitterCardModel $model) {

        $this->twitterCardModel = $model;
    }


    public function getMetaDescription() {

        $code = "";

        if ($this->metaDescription) {

            $code = "<meta name='description' content='" . $this->metaDescription . "' />";
        }
        
        return $code;
    }


    public function setMetaDescription($description) {

        $this->metaDescription = $description;
    }


    public function setNoIndex() {

        $this->noIndex = true;
    }
    

    public function getMetaRobots() {

        $code = "";

        if ($this->noIndex) {

            $content = "noindex";
            $code    = "<meta name='robots' content='" . $content . "' />";
        }

        return $code;
    }


    public function setCanonicalLink($link) {

        $this->canonical = $link;
    }


    public function getCanonicalLink() {

        $code = "";

        if (!is_null($this->canonical)) {

            $code = "<link rel='canonical' href='" . $this->canonical . "' />";
        }

        return $code;
    }


    public function setLinkRel($baseUrl, $currentPage, $totalPages) {

        if ($currentPage > 1) {

            $this->previousLink = $baseUrl . ($currentPage - 1);
        } 

        if ($currentPage < $totalPages) {

            $this->nextLink = $baseUrl . ($currentPage + 1);
        }
    }


    public function getLinkRel() {

        $code = "";

        if (!is_null($this->previousLink)) {

            $code .= "<link rel='prev' href='" . $this->previousLink . "'>";
        }

        if (!is_null($this->nextLink)) {

            $code .= "<link rel='next' href='" . $this->nextLink . "'>";
        }

        return $code;
    }
}