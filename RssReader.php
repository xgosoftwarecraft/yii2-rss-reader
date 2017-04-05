<?php

namespace xgosoftwarecraft\RssFeed;

class RssReader {

    /**
     * @var array
     */
    private $sources;

    /**
     * @var array
     */
    public $items = array();

    public function read($sources) {
        $this->sources = $sources;

        foreach ($sources as $sc) {
            $xml = simplexml_load_file($sc);

            echo '<pre>';

            foreach ($xml->xpath('//item') as $item) {
                array_push($this->items, $item);
            }
        }
        usort($this->items, function($a, $b) {
            return strtotime($b->pubDate) - strtotime($a->pubDate);
        });
    }

}
