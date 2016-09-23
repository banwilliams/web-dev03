------------------------------------------
FRONT-END
------------------------------------------

<div id="fu_instagram">

<div class="fu_headtext">
%FU_INSTA_TITLE%
</div>

<div class="fu_viewprograms">
<a href="%FU_INSTA_URL%">VIEW OUR INSTAGRAM PAGE</a></div>
<div style="clear:both;"></div>

<?php
$fu_insta_name = "%FU_INSTA_NAME%";
$fu_insta_hash = "%FU_INSTA_HASH%";
$fu_insta_hash = str_replace("#",'',$fu_insta_hash);
$fu_insta_msg = false;
$fu_typeisusername = true;

//check: which is filled out, name or hash; if both use none
if (strlen($fu_insta_name) > 0){
  $url = ('https://www.instagram.com/'.$fu_insta_name.'/');
$fu_typeisusername = true;
}
elseif (strlen($fu_insta_hash) > 0){
$url = 'https://www.instagram.com/explore/tags/'. $fu_insta_hash.'/';
$fu_typeisusername = false;
}
else {
  $fu_insta_msg = true;
}
//---------------------------------------

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$html  = curl_exec($ch);
curl_close($ch);


$isavail = strpos($html, 'Sorry, this page'); //check for valid content

//if content exists, then display
if ($isavail <= 0){

$html = strstr($html, 'window._sharedData = ');

$html = strstr($html, '</script>', true);
//$html = substr($html,0,-6);
$html = substr($html, 20, -1);

$data = json_decode($html);
//echo var_dump(json_encode($html));

if ($fu_typeisusername == true){
$thearray=($data->entry_data->ProfilePage[0]->user->media->nodes);
}else{
  $thearray=($data->entry_data->TagPage[0]->tag->media->nodes);
}
$imga = "";
$imgb = "";
$img_link = "";
$fu_count=0;

foreach ($thearray as $obj)
	{ $imga= $obj->thumbnail_src;
	  $img_link = $obj->code;

		$imgb= $imgb."<a href='https://www.instagram.com/p/".$img_link."'><img src='".$imga."' /></a>";
		
		$fu_count++;
		if ($fu_count == 5) break;

	}
echo $imgb;
}
?>




-----------------------------------------
	SETTINGS
-----------------------------------------
<table class="form_table" id="tbl_widget_content">
<input type="hidden" value="<?php print $DOMAIN; ?>" id="DOMAIN" />

<tr>
<td class="label_cell">Instagram Title </td>
<td class="data_cell"><input id="fu_insta_title" value="" size="45" type="text" />
</td></tr>

<tr>
<td class="label_cell">Instagram Page URL</td>
<td class="data_cell"><input id="fu_insta_url" value="" size="45" type="text" />
</td></tr>

<tr>
<td class="label_cell" colspan="2" style="text-align:left;font-weight:bold;">
Enter either Username OR Hashtag below:
</td></tr>

<tr>
<td class="data_cell">User Name <br />
<input id="fu_insta_name" value="" size="30" type="text" />
</td>


<td class="data_cell">Hash Tag<br /> 
<input id="fu_insta_hash" value="" size="30" type="text" />
</td></tr>

</table>







function commitWidgetLinks ()
{
var fu_insta_name = $('$fu_insta_name').value; 
 var fu_insta_hash = $('$fu_insta_hash').value;

    if (fu_insta_name == '' && fu_insta_hash == '') {
        alert('Please enter a User Name OR a Hash Tag ');
        return false;
}

    if (fu_insta_name != '' && fu_insta_hash != '') {
        alert('Please enter EITHER a User Name OR a Hash Tag ');
        return false;
}

widgetItems[activeWidget].settings = new Object();
widgetItems[activeWidget].settings['fu_insta_name'] = fu_insta_name;
widgetItems[activeWidget].settings['fu_insta_hash;'] = fu_insta_hash;

return true;
}