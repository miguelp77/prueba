    <?php

    ####################################################################################################################################
    ####################################[[[ SCROLL TO BOTTOM OF THIS FILE TO CHANGE THE TEMPLATE ]]]####################################
    ####################################################################################################################################
    error_reporting(1);
	require_once('includes/extras.php');

    /**********************************************************************************************************************************/
    /*******************************************************************************************************************[ SETTINGS ]***/
    // Set sorting properties.
/*
    $sort = array(
       array('key'=>'lname',   'sort'=>'asc'), // ... this sets the initial sort "column" and order ...
       array('key'=>'size',   'sort'=>'asc') // ... for items with the same initial sort value, sort this way.
    );

    /**********************************************************************************************************************************/
    /*********************************************************************************************************************[ IMAGES ]***/
    // Are we requesting an image?
/*    
    if(isset($_GET['image']))
    {
       // Accomidate uppercase & lowercase file extensions
       $image = strtolower($_GET['image']);
       // Set filetypes (most of this list is from http://www.filezed.com)
       $filetype = array(
          'text'      => array('doc', 'docx', 'txt', 'rtf', 'odf', 'text', 'nfo'),
          'audio'      => array('aac', 'mp3', 'wav', 'wma', 'm4p'),
          'graphic'   => array('ai', 'bmp', 'eps', 'gif', 'ico', 'jpg', 'jpeg', 'png', 'psd', 'psp', 'raw', 'tga', 'tif', 'tiff'),
          'video'      => array('mv4', 'bup', 'mkv', 'ifo', 'flv', 'vob', '3g2', 'bik', 'xvid', 'divx', 'wmv', 'avi', '3gp', 'mp4', 'mov', '3gpp', '3gp2', 'swf'),
          'archive'   => array('7z', 'dmg', 'rar', 'sit', 'zip', 'bzip', 'gz', 'tar'),
          'app'      => array('exe', 'msi', 'mse', 'bat'),
          'script'   => array('js', 'html', 'htm', 'xhtml', 'jsp', 'asp', 'aspx', 'php', 'xml', 'css')
       );

       // Set the mimetype and cache the image for a year
       header("Content-type: image/png");
       header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60 * 60 *24 * 365) . ' GMT');

       // Deliver the correct image ...
       if($image == '.')                           echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAk1JREFUeNqMU01oE0EU/mY2u22qMSE2UaFKiwdLD0WE+nPx6MFDQfGmBw9evSmKeBE8C/XixZvowR

    +QXlQQb14KaiAnY9OKjU0Q11hSN012Z8b3JrtJWhBc+JidN+/75nvv7YrKggQ/QuAiLYfwf883Y/CYX1ImjlBgcvLC/bvd5hrC1g+4mSK87ASt+yGkM6A6DioPz91Otiml+0fS230A7tg

    +GGgSqWPLX8Vm9T1yM/PkUPScui6II/skFoghtYqgux2Ybgh3tIDM5Cm021uoN36h+bsFe07g3IQ37MAxSoFhS7J9EWi1/mAsDLFJyKRdSIoRp19TKtohwDf07UmJIOhgJArtXtFqSIA4DvWM

    +0YCaiCgVWiTBgoCId2sYlF7RjHisIOjJFCS7CBGStOJjqIhKBKglUQSGNrP3YxuUP4ltdOBiZtkL6dxtfwGCXBZSQldGqnARruduNgmQA7olrgErr/07hnGD58kYgTPc2wJkr6JZhCwQMrmfVoFb2yAbasY/B5ycCRjRXO7XLsawpWVv

    TafefL6I42PJNKJhNebcxgjQsQ90VEPcXlaK/h+YPOZx19U+tYTnd8IsIfnomnIOv4eNDXJdbxtkBC49ir7/HUJL4iX5jpGCfkPK2gU374sH5k9fjCbL+YEidW+fvlZKt8rc63jGXSSZi030HjwRlWYywJNxud1c/VYdWm

    +vrx0JleYmJ6anpsiM9U7T9Xl0zPSP39C9AUod9D54X+ULC/SfBfXv9dma2u1s1qjQGGf0PnXf/1XgAEADr97lE6is6IAAAAASUVORK5CYII=');
       elseif($image == 'pdf')                        echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHhSURBVDjLjZPLSxtRFIfVZRdWi0oFBf

    +BrhRx5dKVYKG4tLhRqlgXPmIVJQiC60JCCZYqFHQh7rrQlUK7aVUUfCBRG5RkJpNkkswrM5NEf73n6gxpHujAB/fOvefjnHM5VQCqCPa1MNoZnU/Qxqhx4woE7ZZlpXO53F0+n0c52Dl8Pt/nQkmhoJOCdUWBsvQJ2u4ODMOAwvapVAq

    SJHGJKIrw+/2uxAmuJgFdMDUVincSxvEBTNOEpmlIp9OIxWJckMlkoOs6AoHAg6RYYNs2kp4RqOvfuIACVFVFPB4vKYn3pFjAykDSOwVta52vqW6nlEQiwTMRBKGygIh9GEDCMwZH6EgoE

    +qHLMuVBdbfKwjv3yE6Ogjz/PQ/CZVDPSFRRYE4/RHy1y8wry8RGWGSqyC/nM1meX9IQpQV2JKIUH8vrEgYmeAFwuPDCHa9QehtD26HBhCZnYC8ucGzKSsIL8wgsjiH1PYPxL+vQvm5B/3sBMLyIm7GhhCe90BaWykV/Gp

    +VR9oqPVe9vfBTsruM1HtBKVPmFIUNusBrV3B4ev6bsbyXlPdkbr/u+StHUkxruBPY+0KY8f38oWX/byvNAdluHNLeOxDB+uyQQfPCWZ3NT69BYJWkjxjnB1o9Fv/ASQ5s+ABz8i2AAAAAElFTkSuQmCC');
       elseif(in_array($image, $filetype['text']))         echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADoSURBVBgZBcExblNBGAbA2ceegTRBuIKOgiihSZNTcC5LUHAihNJR0kG

    KCDcYJY6D3/77MdOinTvzAgCw8ysThIvn/VojIyMjIyPP+bS1sUQIV2s95pBDDvmbP/mdkft83tpYguZq5Jh/OeaYh+yzy8hTHvNlaxNNczm+la9OTlar1UdA/

    +C2A4trRCnD3jS8BB1obq2Gk6GU6QbQAS4BUaYSQAf4bhhKKTFdAzrAOwAxEUAH+KEM01SY3gM6wBsEAQB0gJ+maZoC3gI6iPYaAIBJsiRmHU0AALOeFC3aK2cWAACUXe7+AwO0lc9eTHYTAAAAAElFTkSuQmCC');
       elseif(in_array($image, $filetype['audio']))      echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAdRJREFUeNqkU89rE1EQ/maz2STbQKTV1AqRWovFBgKCQsFToEfRmxfBP0DwIl56KkUPglfP0lOhBQV

    pDz305EmpeNAWPAQaSBoDTUuz2SabZN97nRdN0uqmFhz49s3Oj+8x82ZIKYX/EbOrPNwYGKNvGGEcdA0rs32ncc6LnulPva5weChPOc5LMMe4f2YJmn2QFAo/c6nU2JIQyPLvZiBBsegPJIhGk3e2t0vriURyzXHkLSBS

    +osgHnMRMsPwpY1crnWKIBIhxzQvZnd3yx8N49IrNj0e2APbNjAxYUEpowfPI/i+0SQafaRU40FgCSclHjcwNWWhst+3xWJAq4WyEJbxT4JfdQNXxoA2t4aIA0MdvdZo4NpZz5hQUrxmbDEUQSjLFAiHBDp6uJOcDyTw2000G

    +6yHXOfT07K9M1p4jIIbnVP1GsHkNInnVxaXQieg/1yUR/ZdCaNvYqeNomjqqPtO9ohvn3AzruXv6PnewTUXSYrlYF9b2Hz6vXU7eHL46hVayjkfsDLf33qfVl

    +0y5+7y/HiQXsERDRBUreyNDdJy9gDc1wWAX5T4vy89v37NaD4TCqDJdz/CCCqJ4Z/QCM0B/NFYwmw9NknNPbqGMBBgDJpb7OvDYMdwAAAABJRU5ErkJggg==');
       elseif(in_array($image, $filetype['graphic']))      echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAdlJREFUeNqkkz9v00AYxp9zzvblLnac0lLiUKpmKFKDqGBgQ0KCoQsDCxJVP0A/RAcGRsTMgtQpEh3

    oF+haNia2qiukCzSlieP4b987d+hIk5Ne2Wf5+d3z/jlWliXmWRbmXPz9wcFrerZn1A94lmXhh+3tz7Oo9/r9XZ6lKSuoDs8/MVgMsGtkiyLJAF0dX1TBKdnuItAjr1kBvH1aQmt5kiTICbB5n8Hl9HMdWFTA2T

    +gbldiEHgYAY9CYLMDRCmMRmv5NEmY3oSNY6zfW0NLhebkh8vAsleBJiTo3qlgU3IWiAqgtXwaxywvChz9+ILvQmLryRu86L00lh1e2daABQmkOX2j9KRLANJorQGktDk5PUHQDPD1ch8Xl7+wsvQA7YUV3PVbqDs6D2mAygEEpRbn14A

    4ji1j56KDPyOO8V8H34Y/URenUFJBKQWv4Zloej6BQ6wtdfBs1YXWagDLyEG3/QqO48B1XUgp4XkKQeCbaLVI3FTwqQhS2rCERZ2INMA4MG28ufR4Z9SrKErA2ITeLYzHJc7PcwghzCGPe2UFOBsMajXbxuHHd/85PjQEmKBmO9Ba5m9s

    7FiNRjjLJBaj0W8aEVBdEeh7cUs9TQSGbN7rfCXAAJNovyFuktgQAAAAAElFTkSuQmCC');
       elseif(in_array($image, $filetype['video']))      echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAdxJREFUeNqMU81KI0EQ7t9EhNU3CHjw4s0nyLKEnLz5HotP4AP4AAp5B2FZ2BxCDsoKQm57yhIU3Bw

    ig2IwEyczY3fVVo2dTUY3uzb0dHfV91V9XdUjEVF0u90zIUS92WyeineMTqezT8t5o9H4aNgAAHVaJM3To6OTndksAw5MAwFQ8B4RsFKx6vDw4CfhGVsA5gFEMHxJkhTG48dnIgUyiPneWsNEBXwIYzkAO78655BnkZTIjKUzjEZR7r1n

    ol5WoPhDDhGcynvgBMgf2mOaZv7q6tfs7m5MATBgPDLnTwBWQAaOqhnE2cmEee7h5maUpqnzWluG4wvGy6B6oSDcS5F6YD

    +Z8Pb2IXNOeGMqgqeUxY3Vizq/qAHdkZySFXR7vW9VWqtRFLnBYCBft5BgGSvA0CYzVxCKcr67u5ckycxvbt5nW1ufYJlsjFbt9rHhIpe6EAJwtu

    +IEvIcnRAWrLWl7EotalB6B3yFYLj0XlMA4a1dW/UQ9b8U9Ki4TkqN1lb/RmaieaMgp5TB8ANR50pxxXGVggrhywomk0nRBSrsNaKKtTYr2YT5EMdxuQv9fv+iVquxIWq1Pm//72+cTqc4HA4vintzIEq+TvuN+cN6x

    +D2xsR9+i3AAEgKanVYjEzGAAAAAElFTkSuQmCC');
       elseif(in_array($image, $filetype['archive']))      echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAEUSURBVCjPXdFNSsMAEIbh0Su4teAdIgEvJB5C14K4UexCEFQEKfivtKI

    IIlYQdKPiDUTRKtb0x6ZJ+volraEJ3+zmycwkMczGzTE3lwkbxeLE5XTqQfTIjhIm6bCy9E/icoOoyR4v7PLDN+8ibxQHxGzE3JBfHrgUalDnQ6BNk1WRFPjs66kDNTxqg0Uh5qYg4IkrjrS9pTWfmvKaBaGaNU4EY

    +Lpkq88eKZKmTAhbd3i5UFZg0+TzV1d1FZy4FCpJCAQ8DUnA86ZpciiXjbQhK7aObDOGnNsUkra/WRAiQXdvSwWpBkGvQpnbHHMRvqRlCgBqkm/dd2745YbtofafsOcPiiMTc1fzNzHma4O/XLHCtgfTLBbxm6KrMIAAAAASUVORK5CYI

    I=');
       elseif(in_array($image, $filetype['app']))         echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFiSURBVBgZpcEhbpRRGIXh99x7IU0asGBJWEIdCLaAqcFiCArFCkjA0KR

    JF0EF26kkFbVVdEj6/985zJ0wBjfp8ygJD6G3n358fP3m5NvtJscJYBObchEHx6QKJ6SKsnn6eLm7urr5/PP76cU4eXVy/ujouD074hDHd5s6By7GZknb3P7mUH

    +WNLZGKnx595JDvf96zTQSM92vRYA4lMEEO5RNraHWUDH3FV48f0K5mAYJk5pQQpqIgixaE1JDKtRDd2OsYfJaTKNcTA2IBIIesMAOPdDUGYJSqGYml5lGHHYkSGhAJBBIkAoWREAT3Z3JLqZhF3uS2EloQCQ8xLBxoAEWO7aZxros7Eg

    ISIIkwlZCY6s1OlAJTWFal5VppMzUgbAlQcIkiT0DXSI2U2ymYZs9AWJL4n+df3pncsI0bn5dX344W05dhctUFbapZcE2ToiLVHBMbGymS7aUhIdoPNBf7Jjw/gQ77u4AAAAASUVORK5CYII=');
       elseif(in_array($image, $filetype['script']))      echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJwSURBVDjLjZPdT1JhHMetvyO3/gfLKy

    +68bLV2qIAq7UyG6IrdRPL5hs2U5FR0MJIAqZlh7BVViI1kkyyiPkCyUtztQYTYbwJE8W+Pc8pjofK1dk+OxfP

    +X3O83srAVBCIc8eQhmh/B/sJezm4niCsvX19cTm5uZWPp/H3yDnUKvVKr6ELyinwWtra8hkMhzJZBLxeBwrKyusJBwOQ6PRcJJC8K4DJ/dXM04DOswNqNOLybsRo9N6LCy7kUgkEIlEWEE2mwX9iVar/Smhglqd8IREKwya3qhg809gP

    LgI/XsrOp/IcXVMhqnFSayurv6RElsT6ZCoov5u1fzUVwvcKRdefVuEKRCA3OFHv2MOxtlBdFuaMf/ZhWg0yt4kFAoVCZS3Hd1gkpOwRt9h0LOES3YvamzPcdF7A6rlPrSbpbhP0kmlUmw9YrHYtoDku2T6pEZ/2ICXEQ8kTz

    +g2TkNceAKKv2nIHachn6qBx1MI5t/Op1mRXzBd31AiRafBp1vZyEcceGCzQ6p24yjEzocGT6LUacS0iExcrkcK6Fsp6AXLRnmFOjyPMIZixPHmAAOGxZQec2OQyo7zpm6cNN6GZ2kK1RAofPAr8GA4oUMrdNNkIw/wPFhDwSjX3Dwlg0

    CQy96HreiTlcFZsaAjY0NNvh3QUXtHeHcoKMNA7NjqLd8xHmzDzXDRvRO1KHtngTyhzL4SHeooAAnKMxBtUYQbGWa0Dc+AsWzSVy3qkjeItLCFsz4XoNMaRFFAm4SyTXbmQa2YHQSGacR/pAXO+zGFif4JdlHCpShBzstEz

    +YfJtmt5cnKKWS/1jnAnT1S38AGTynUFUTzJcAAAAASUVORK5CYII=');
       else                                    echo base64_decode

    ('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABbSURBVCjPzdAxDoAgEERRzsFp95JbGI2ASA2SCOX3Ahtr8tuXTDIO959

    bCxRfpOitWS5vA+lMJg9JbKCTTmMQ1QS3ThqVQbBBlsbgpXLYE8lHCXrqLptf9km7Dzv+FwGTaznIAAAAAElFTkSuQmCC');
       
       // Exit this script when the correct image has been served
       exit();
    }
*/

    /**********************************************************************************************************************************/
    /************************************************************************************************************[ DIRECTORY LOGIC ]***/
       
    /**********************************************************************************************************************************/
    /******************************************************************************************************************[ FUNCTIONS ]***/

    /**
    *   http://us.php.net/manual/en/function.array-multisort.php#83117
    */
 

    /**
    *   @ http://us3.php.net/manual/en/function.filesize.php#84652
    */
/*  
    function bytes_to_string($size, $precision = 0) {
       $sizes = array(' YB', ' ZB', ' EB', ' PB', ' TB', ' GB', ' MB', ' KB', ' Bytes');
       $total = count($sizes);
       while($total-- && $size > 1024) $size /= 1024;
       $return['num'] = round($size, $precision);
       $return['str'] = $sizes[$total];
       return $return;
    }
*/
    /**
    *   @ http://us.php.net/manual/en/function.time.php#71342
    */
/*Anulada
    function time_ago($timestamp, $recursive = 0)
    {
       $current_time = time();
       $difference = $current_time - $timestamp;
       $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
       $lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
       for ($val = sizeof($lengths) - 1; ($val >= 0) && (($number = $difference / $lengths[$val]) <= 1); $val--);
       if ($val < 0) $val = 0;
       $new_time = $current_time - ($difference % $lengths[$val]);
       $number = floor($number);
       if($number != 1)
       {
          $periods[$val] .= "s";
       }
       $text = sprintf("%d %s ", $number, $periods[$val]);   
       
       if (($recursive == 1) && ($val >= 1) && (($current_time - $new_time) > 0))
       {
          $text .= time_ago($new_time);
       }
       return $text;
    }
*/

    /**********************************************************************************************************************************/
    /*******************************************************************************************************************[ TEMPLATE ]***/
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listado del directorio</title>
    <style type="text/css">
    body{font-family: "Lucida Grande",Calibri,Arial;font-size: 9pt;color: #444;background: #f8f8f8;}
    a{color: #00d;font-size: 11pt;font-weight: bold;text-decoration: none;}
    a:hover{color: #b00;}
    img{vertical-align: bottom;padding: 0 3px 0 0;}
    table{margin: 0 auto;padding: 0;width: 700px;}
       table td{padding: 5px;}
       thead td{padding-left: 0;font-family: "Trebuchet MS";font-size: 11pt;font-weight: bold;}
       tbody .folder td{border: solid 1px #f8f8f8;}
       tbody .file td{background: #fff;border: solid 1px #ddd;}
       tbody .file td.size,tbody .file td.time{white-space: nowrap;width: 1%;padding: 5px 10px;}
       tbody .file td.size span{color: #999;font-size: 8pt;}
       tbody .file td.time{color: #555;}
       tfoot td{padding: 5px 0;color: #777;font-size: 8pt;background: #f8f8f8;border-color: #f8f8f8;}
       tfoot td.copy{text-align: right;white-space: nowrap;}
       tfoot td.cc{padding: 40px;text-align: center;}
       tfoot td.cc img{padding: 0;border: none;}
    img{ display:block;margin-left:auto;margin-right:auto;margin-botton:4px; padding:1px;border: solid #333 1px;}
    .wrap{text-align: center;padding:2px;}
    div.pagination {padding: 3px;margin: 3px;text-align:center;}
		div.pagination a {padding: 2px 5px 2px 5px;margin: 2px;border: 1px solid #AAAADD;
			text-decoration: none; /* no underline */
			color: #000099;
		}
		div.pagination a:hover, div.digg a:active {border: 1px solid #000099;color: #000;}
		div.pagination span.current {padding: 2px 5px 2px 5px;margin: 2px;border: 1px solid #000099;font-weight: bold;background-color: #000099;color: red;}
		div.pagination span.disabled {padding: 9px 5px 4px 5px;margin: 2px;border: 1px solid #ccc;color: #ddd;}
    .clear{clear:both;}
    </style>
    </head>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>

    <body>

		<?php
//			echo '<form name="imagenes" action="">';
				$file_list=give_files('img');
				echo '<select class="select" name="img_selected" size="1">';
					foreach($file_list as $item){				
						$cadena=$item['name'].'.'.$item['ext'];
						echo '<option value="'.$cadena.' name="archivo" ">'.$cadena.'</option>';
						if($item['ext']=='png'){
							$total_items++;
							$img_source[]=$cadena;
						}
					}
				echo '</select>';
//			echo '</form>';

			//$last_item=$total_items;
			$current=2;
			echo '<div class="wrap">';
			echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br>'.$img_source[$current].'</div>';
//			echo '<div class="wrap">';
//			echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br />'.$img_source[$current].'</div>';
			echo '<div class="clear"></div>';

/*
//PAGINACION
			$range_pagination=6; //Numero de paginas +1
			$current=2;
			$first_item=$current-3;
			if($first_item<0)$first_item=0;
			$last_item=$current+2;
			echo $num_pages;
			echo '<div class="pagination">';
	//Principio			
			if($current<3) echo '<span class="disabled" ><< Anterior </span>';		
			else{
				echo '<a href="prev" ><< Anterior </a>';
				echo '<a href="img1" >1</a>';
				echo '<span class="disabled" >...</span>';
			}
			
			
			for($i=$first_item;$i<$last_item;$i++){
				if($i == $current) echo '<a href="#"><spam class="current">'.($i+1).'</spam></a>';
				else echo '<a href="#">'.($i+1).'</a>';

			}
	//Final
			if($i<$total_items) echo '<span class="disabled" >...</span>';
			if($current<$total_items){
				echo '<a href="#">'.($total_items+1).'</a>';
				echo '<span class="disabled" >Siguiente >></span>';
			}	
		
		
				echo '</div>';
//Final de la paginacion			
			echo $current;
*/			
			?>
			
    </body>
    	<script type="text/javascript">
    $("select").change(function () {
          var str = "";
          $("select option:selected").each(function () {
                str += $(this).text() + " ";
              		console.log(str);
              });
          //$("div").text(str);
        $('.wrap').empty().html('<img src="'+str+'" alt="Imagen" /><br>');
        
        })
        .change();

	</script>
    </html>
