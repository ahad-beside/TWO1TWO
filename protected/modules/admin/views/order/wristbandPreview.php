<?php
$decoration = CJSON::decode($info->decoration);
$bands = CJSON::decode($decoration['bands']);
print_r($bands);
echo $bands['colortype'];
?>

<div class="front-back-msg" style="background: transparent url(&quot;/upload/1433397826541.jpg&quot;) repeat-y scroll 0% 0%;">
    <div class="frontmessage">
        <img id="front-msg-img" src="/customize/text2img.html?bcolor=undefined &amp; msg=Message&amp;font=arial.ttf&amp;fcolor=000000&amp;bbcolor=undefined&amp;bmsg=Back Message&amp;bfont=arial.ttf&amp;bfcolor=000000&amp;msgType=Wrap Arround">
    </div>
</div>