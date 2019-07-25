<?php

use \Wa72\HtmlPageDom\HtmlPageCrawler;

class eachamps
{

    private $savingPath = "assets/audio/";

    public function LoadSite($url)
    {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt(... other options you want...)
        $html = curl_exec($c);
        if (curl_error($c))
            die(curl_error($c));
        // Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);
        return $html;
    }

    public function Download($url, $path)
    {
        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ($newfname, 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
        }
        return 200;
    }

    public function DownloadSong($url)
    {
        $html = $this->LoadSite($url);
        $c = HtmlPageCrawler::create($html);
        $Link = $c->filter('.gearWrap #gearContainer');
        $jsonLink = $Link->attr('data-gear');
        $json = $this->LoadSite($jsonLink);
        $data = json_decode($json);
        $songurl = $data->entries[0]->media;
        $status = $this->Download($songurl, $this->savingPath . $data->albumTitle . ".mp3");
        if ($status == 200) {
            $proced = new \stdClass();
            $proced->songname = $data->albumTitle;
            $proced->songartist = $data->albumAuthor;
            $proced->coverimage = $data->albumCover;
            return $proced;
        } else {
            return null;
        }
    }

// ========================= Eachamps recently  songs ===========================
    public function Recently_song()
    {
        $html = $this->LoadSite("http://www.eachamps.rw/recentlyadded");
        $c = HtmlPageCrawler::create($html);
        $links = $c->filter('.songs-wid table .sng-img a');
        $data = array();
        for ($i = 0; $i < $links->length; $i++) {
            $link = $links->eq($i)->attr('href');
            array_push($data, $link);
        }
        return $data;
    }
//============================================================================
//============================================================================
//=======================  Eachamps artist =======================================
    public function GetAllArtist()
    {
        $html = $this->LoadSite("http://www.eachamps.rw/audios");
        $c = HtmlPageCrawler::create($html);
        $links = $c->filter('.tabcontents #view2 .scroll-pane .panel-default .list-group .list-group-item a');
        $data = array();
        for ($i = 0; $i < $links->length; $i++) {
            $info = array();
            $info['artist'] = $links->eq($i)->html();
            $info['link'] = $links->eq($i)->attr('href');
            //$info['info']  =  $this->ArtistDetails($links->eq($i)->attr('href'));
            array_push($data, $info);
        }
        return $data;
    }
//============================================================================
//============================================================================
//=================================Artist details =================================
    public function ArtistDetails($url)
    {
        $html = $this->LoadSite($url);
        $c = HtmlPageCrawler::create($html);
        $data = array();
        $profile = $c->filter('.header-avatar-inner-wrap a .avatar')->attr('src');
        $songslink = $c->filter('.songs-wid .table .sng-img-td .sng-img a');
        for ($i = 0; $i < $songslink->length; $i++) {
            $link = $songslink->eq($i)->attr('href');
            array_push($data, $link);
        }
        $proced = new \stdClass();
        $proced->profile = $profile;
        $proced->songs = $data;
        return $proced;
    }
    //=====================================================================
    //=====================================================================
    //========================Download all database ===========================
    //=====================================================================
    //=====================================================================
    public function DownloadAllData()
    {
        $data = $this->ArtistDetails('http://www.eachamps.rw/audios/artist/122/Aime-Bluestone.html');
        $songslink = $data->songs;
        $length = count( $songslink);
        $i = 0;
        while( $i <  $length) {
            $ret = $this->DownloadSong( $songslink[$i]);
            $i++;
        }
    }

    public function run()
    {
        $data = $this->DownloadAllData();
        echo "Downloading successfully";
    }
}
?>