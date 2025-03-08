<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.17.1
*/$ia="4.17.1";function
adminer_errors($Gc,$Ic){return!!preg_match('~^(Trying to access array offset on( value of type)? null|Undefined (array key|property))~',$Ic);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$cd=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($cd||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ei=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ei)$$X=$Ei;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$f;return$f;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($t){if(!preg_match('~^[`\'"[]~',$t))return$t;$pe=substr($t,-1);return
str_replace($pe.$pe,$pe,substr($t,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($pg,$cd=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($pg)){foreach($X
as$he=>$W){unset($pg[$x][$he]);if(is_array($W)){$pg[$x][stripslashes($he)]=$W;$pg[]=&$pg[$x][stripslashes($he)];}else$pg[$x][stripslashes($he)]=($cd?$W:stripslashes($W));}}}}function
bracket_escape($t,$Ma=false){static$pi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($Ma?array_flip($pi):$pi));}function
min_version($Vi,$Be="",$g=null){global$f;if(!$g)$g=$f;$ih=$g->server_info;if($Be&&preg_match('~([\d.]+)-MariaDB~',$ih,$A)){$ih=$A[1];$Vi=$Be;}return$Vi&&version_compare($ih,$Vi)>=0;}function
charset($f){return(min_version("5.5.3",0,$f)?"utf8mb4":"utf8");}function
script($uh,$oi="\n"){return"<script".nonce().">$uh</script>$oi";}function
script_src($Ji){return"<script src='".h($Ji)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($O){return
str_replace("\0","&#0;",htmlspecialchars($O,ENT_QUOTES,'utf-8'));}function
nl_br($O){return
str_replace("\n","<br>",$O);}function
checkbox($B,$Y,$fb,$me="",$tf="",$jb="",$ne=""){$H="<input type='checkbox' name='$B' value='".h($Y)."'".($fb?" checked":"").($ne?" aria-labelledby='$ne'":"").">".($tf?script("qsl('input').onclick = function () { $tf };",""):"");return($me!=""||$jb?"<label".($jb?" class='$jb'":"").">$H".h($me)."</label>":$H);}function
optionlist($C,$ah=null,$Ni=false){$H="";foreach($C
as$he=>$W){$zf=array($he=>$W);if(is_array($W)){$H.='<optgroup label="'.h($he).'">';$zf=$W;}foreach($zf
as$x=>$X)$H.='<option'.($Ni||is_string($x)?' value="'.h($x).'"':'').($ah!==null&&($Ni||is_string($x)?(string)$x:$X)===$ah?' selected':'').'>'.h($X);if(is_array($W))$H.='</optgroup>';}return$H;}function
html_select($B,$C,$Y="",$sf=true,$ne=""){if($sf)return"<select name='".h($B)."'".($ne?" aria-labelledby='$ne'":"").">".optionlist($C,$Y)."</select>".(is_string($sf)?script("qsl('select').onchange = function () { $sf };",""):"");$H="";foreach($C
as$x=>$X)$H.="<label><input type='radio' name='".h($B)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$H;}function
confirm($Me="",$bh="qsl('input')"){return
script("$bh.onclick = function () { return confirm('".($Me?js_escape($Me):'你確定嗎？')."'); };","");}function
print_fieldset($Jd,$ue,$Yi=false){echo"<fieldset><legend>","<a href='#fieldset-$Jd'>$ue</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$Jd');",""),"</legend>","<div id='fieldset-$Jd'".($Yi?"":" class='hidden'").">\n";}function
bold($Ta,$jb=""){return($Ta?" class='active $jb'":($jb?" class='$jb'":""));}function
js_escape($O){return
addcslashes($O,"\r\n'\\/");}function
ini_bool($Ud){$X=ini_get($Ud);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($Ui,$L,$V,$E){$_SESSION["pwds"][$Ui][$L][$V]=($_COOKIE["adminer_key"]&&is_string($E)?array(encrypt_string($E,$_COOKIE["adminer_key"])):$E);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
q($O){global$f;return$f->quote($O);}function
get_vals($F,$d=0){global$f;$H=array();$G=$f->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$d];}return$H;}function
get_key_vals($F,$g=null,$lh=true){global$f;if(!is_object($g))$g=$f;$H=array();$G=$g->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($lh)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$g=null,$l="<p class='error'>"){global$f;$_b=(is_object($g)?$g:$f);$H=array();$G=$_b->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!is_object($g)&&$l&&(defined("PAGE_HEADER")||$l=="-- "))echo$l.error()."\n";return$H;}function
unique_array($I,$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$H=array();foreach($u["columns"]as$x){if(!isset($I[$x]))continue
2;$H[$x]=$I[$x];}return$H;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$A))return$A[1].idf_escape(idf_unescape($A[2])).$A[3];return
idf_escape($x);}function
where($Z,$n=array()){global$f,$w;$H=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$d=escape_key($x);$H[]=$d.($w=="sql"&&$n[$x]["type"]=="json"?" = CAST(".q($X)." AS JSON)":($w=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($w=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($n[$x],q($X)))));if($w=="sql"&&preg_match('~char|text~',$n[$x]["type"])&&preg_match("~[^ -@]~",$X))$H[]="$d = ".q($X)." COLLATE ".charset($f)."_bin";}foreach((array)$Z["null"]as$x)$H[]=escape_key($x)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,$n=array()){parse_str($X,$cb);remove_slashes(array(&$cb));return
where($cb,$n);}function
where_link($s,$d,$Y,$vf="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($d)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$vf:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($e,$n,$K=array()){$H="";foreach($e
as$x=>$X){if($K&&!in_array(idf_escape($x),$K))continue;$Fa=convert_field($n[$x]);if($Fa)$H.=", $Fa AS ".idf_escape($x);}return$H;}function
adm_cookie($B,$Y,$xe=2592000){global$ba;return
header("Set-Cookie: $B=".urlencode($Y).($xe?"; expires=".gmdate("D, d M Y H:i:s",time()+$xe)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($jd=false){$Mi=ini_bool("session.use_cookies");if(!$Mi||$jd){session_write_close();if($Mi&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ui,$L,$V,$j=null){global$nc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($nc))."|username|".($j!==null?"db|":"").session_name()),$A);return"$A[1]?".(sid()?SID."&":"").($Ui!="server"||$L!=""?urlencode($Ui)."=".urlencode($L)."&":"")."username=".urlencode($V).($j!=""?"&db=".urlencode($j):"").($A[2]?"&$A[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
adm_redirect($_,$Me=null){if($Me!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($_!==null?$_:$_SERVER["REQUEST_URI"]))][]=$Me;}if($_!==null){if($_=="")$_=".";header("Location: $_");exit;}}function
query_redirect($F,$_,$Me,$yg=true,$Nc=true,$Wc=false,$ci=""){global$f,$l,$b;if($Nc){$Ch=microtime(true);$Wc=!$f->query($F);$ci=format_time($Ch);}$xh="";if($F)$xh=$b->messageQuery($F,$ci,$Wc);if($Wc){$l=error().$xh.script("messagesPrint();");return
false;}if($yg)adm_redirect($_,$Me.$xh);return
true;}function
queries($F){global$f;static$tg=array();static$Ch;if(!$Ch)$Ch=microtime(true);if($F===null)return
array(implode("\n",$tg),format_time($Ch));$tg[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return$f->query($F);}function
apply_queries($F,$R,$Jc='table'){foreach($R
as$P){if(!queries("$F ".$Jc($P)))return
false;}return
true;}function
queries_redirect($_,$Me,$yg){list($tg,$ci)=queries(null);return
query_redirect($tg,$_,$Me,$yg,false,!$yg,$ci);}function
format_time($Ch){return
sprintf('%.3f 秒',max(0,microtime(true)-$Ch));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Of=""){return
substr(preg_replace("~(?<=[?&])($Of".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$Qb){return" ".($D==$Qb?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($x,$Zb=false){$bd=$_FILES[$x];if(!$bd)return
null;foreach($bd
as$x=>$X)$bd[$x]=(array)$X;$H='';foreach($bd["error"]as$x=>$l){if($l)return$l;$B=$bd["name"][$x];$ki=$bd["tmp_name"][$x];$Eb=file_get_contents($Zb&&preg_match('~\.gz$~',$B)?"compress.zlib://$ki":$ki);if($Zb){$Ch=substr($Eb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Ch,$Dg))$Eb=iconv("utf-16","utf-8",$Eb);elseif($Ch=="\xEF\xBB\xBF")$Eb=substr($Eb,3);$H.=$Eb."\n\n";}else$H.=$Eb;}return$H;}function
upload_error($l){$Ie=($l==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($l?'無法上傳檔案。'.($Ie?" ".sprintf('允許的檔案上限大小為 %sB',$Ie):""):'檔案不存在');}function
repeat_pattern($Yf,$ve){return
str_repeat("$Yf{0,65535}",$ve/65535)."$Yf{0,".($ve%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($O,$ve=80,$Ih=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$ve).")($)?)u",$O,$A))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$ve).")($)?)",$O,$A);return
h($A[1]).$Ih.(isset($A[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($pg,$Ld=array(),$hg=''){$H=false;foreach($pg
as$x=>$X){if(!in_array($x,$Ld)){if(is_array($X))hidden_fields($X,array(),$x);else{$H=true;echo'<input type="hidden" name="'.h($hg?$hg."[$x]":$x).'" value="'.h($X).'">';}}}return$H;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($P,$Xc=false){$H=table_status($P,$Xc);return($H?$H:array("Name"=>$P));}function
column_foreign_keys($P){global$b;$H=array();foreach($b->foreignKeys($P)as$p){foreach($p["source"]as$X)$H[$X][]=$p;}return$H;}function
enum_input($T,$Ha,$m,$Y,$Bc=null){global$b,$w;preg_match_all("~'((?:[^']|'')*)'~",$m["length"],$De);$H=($Bc!==null?"<label><input type='$T'$Ha value='$Bc'".((is_array($Y)?in_array($Bc,$Y):$Y===0)?" checked":"")."><i>".'空值'."</i></label>":"");foreach($De[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$H.=" <label><input type='$T'$Ha value='".($w=="sql"?$s+1:h($X))."'".($fb?' checked':'').'>'.h($b->editVal($X,$m)).'</label>';}return$H;}function
input($m,$Y,$r){global$U,$Fh,$b,$w;$B=h(bracket_escape($m["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$Da=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Da[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Da);$r="json";}$Hg=($w=="mssql"&&$m["auto_increment"]);if($Hg&&!$_POST["save"])$r=null;$rd=(isset($_GET["select"])||$Hg?array("orig"=>'原始'):array())+$b->editFunctions($m);$jc=stripos($m["default"],"GENERATED ALWAYS AS ")===0?" disabled=''":"";$Ha=" name='fields[$B]'$jc";if($w=="pgsql"&&in_array($m["type"],(array)$Fh['使用者類型'])){$Fc=get_vals("SELECT enumlabel FROM pg_enum WHERE enumtypid = ".$U[$m["type"]]." ORDER BY enumsortorder");if($Fc){$m["type"]="enum";$m["length"]="'".implode("','",array_map('addslashes',$Fc))."'";}}if($m["type"]=="enum")echo
h($rd[""])."<td>".$b->editInput($_GET["edit"],$m,$Ha,$Y);else{$Bd=(in_array($r,$rd)||isset($rd[$r]));echo(count($rd)>1?"<select name='function[$B]'$jc>".optionlist($rd,$r===null||$Bd?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($rd))).'<td>';$Wd=$b->editInput($_GET["edit"],$m,$Ha,$Y);if($Wd!="")echo$Wd;elseif(preg_match('~bool~',$m["type"]))echo"<input type='hidden'$Ha value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ha value='1'>";elseif($m["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$m["length"],$De);foreach($De[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$B][$s]' value='".(1<<$s)."'".($fb?' checked':'').">".h($b->editVal($X,$m)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$m["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$B'>";elseif(($Zh=preg_match('~text|lob|memo~i',$m["type"]))||preg_match("~\n~",$Y)){if($Zh&&$w!="sqlite")$Ha.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$Ha.=" cols='30' rows='$J'".($J==1?" style='height: 1.2em;'":"");}echo"<textarea$Ha>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$m["type"]))echo"<textarea$Ha cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Ke=(!preg_match('~int~',$m["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$m["length"],$A)?((preg_match("~binary~",$m["type"])?2:1)*$A[1]+($A[3]?1:0)+($A[2]&&!$m["unsigned"]?1:0)):($U[$m["type"]]?$U[$m["type"]]+($m["unsigned"]?0:1):0));if($w=='sql'&&min_version(5.6)&&preg_match('~time~',$m["type"]))$Ke+=7;echo"<input".((!$Bd||$r==="")&&preg_match('~(?<!o)int(?!er)~',$m["type"])&&!preg_match('~\[\]~',$m["full_type"])?" type='number'":"")." value='".h($Y)."'".($Ke?" data-maxlength='$Ke'":"").(preg_match('~char|binary~',$m["type"])&&$Ke>20?" size='40'":"")."$Ha>";}echo$b->editHint($_GET["edit"],$m,$Y);$dd=0;foreach($rd
as$x=>$X){if($x===""||!$X)break;$dd++;}if($dd)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $dd), oninput: function () { this.onchange(); }});");}}function
process_input($m){global$b,$k;if(stripos($m["default"],"GENERATED ALWAYS AS ")===0)return
null;$t=bracket_escape($m["field"]);$r=$_POST["function"][$t];$Y=$_POST["fields"][$t];if($m["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($m["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?idf_escape($m["field"]):false);if($r=="NULL")return"NULL";if($m["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$m["type"])&&ini_bool("file_uploads")){$bd=get_file("fields-$t");if(!is_string($bd))return
false;return$k->quoteBinary($bd);}return$b->processInput($m,$Y,$r);}function
fields_from_edit(){global$k;$H=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$B=bracket_escape($x,1);$H[$B]=array("field"=>$B,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$k->primary),);}return$H;}function
search_tables(){global$b,$f;$_GET["where"][0]["val"]=$_POST["query"];$dh="<ul>\n";foreach(table_status('',true)as$P=>$Q){$B=$b->tableName($Q);if(isset($Q["Engine"])&&$B!=""&&(!$_POST["tables"]||in_array($P,$_POST["tables"]))){$G=$f->query("SELECT".limit("1 FROM ".table($P)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($P),array())),1));if(!$G||$G->fetch_row()){$lg="<a href='".h(ME."select=".urlencode($P)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$B</a>";echo"$dh<li>".($G?$lg:"<p class='error'>$lg: ".error())."\n";$dh="";}}}echo($dh?"<p class='message'>".'沒有資料表。':"</ul>")."\n";}function
dump_headers($Kd,$Ue=false){global$b;$H=$b->dumpHeaders($Kd,$Ue);$Kf=$_POST["output"];if($Kf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Kd).".$H".($Kf!="file"&&preg_match('~^[0-9a-z]+$~',$Kf)?".$Kf":""));session_write_close();ob_flush();flush();return$H;}function
dump_csv($I){foreach($I
as$x=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($r,$d){return($r?($r=="unixepoch"?"DATETIME($d, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$d)"):$d);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$o=@tempnam("","");if(!$o)return
false;$H=dirname($o);unlink($o);}}return$H;}function
file_open_lock($o){$q=@fopen($o,"r+");if(!$q){$q=@fopen($o,"w");if(!$q)return;chmod($o,0660);}flock($q,LOCK_EX);return$q;}function
file_write_unlock($q,$Sb){rewind($q);fwrite($q,$Sb);ftruncate($q,strlen($Sb));flock($q,LOCK_UN);fclose($q);}function
password_file($h){$o=get_temp_dir()."/adminer.key";$H=@file_get_contents($o);if($H||!$h)return$H;$q=@fopen($o,"w");if($q){chmod($o,0660);$H=rand_string();fwrite($q,$H);fclose($q);}return$H;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$m,$bi){global$b;if(is_array($X)){$H="";foreach($X
as$he=>$W)$H.="<tr>".($X!=array_values($X)?"<th>".h($he):"")."<td>".select_value($W,$z,$m,$bi);return"<table>$H</table>";}if(!$z)$z=$b->selectLink($X,$m);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$H=$b->editVal($X,$m);if($H!==null){if(!is_utf8($H))$H="\0";elseif($bi!=""&&is_shortable($m))$H=shorten_utf8($H,max(0,+$bi));else$H=h($H);}return$b->selectVal($H,$z,$m,$X);}function
is_mail($zc){$Ga='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$mc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Yf="$Ga+(\\.$Ga+)*@($mc?\\.)+$mc";return
is_string($zc)&&preg_match("(^$Yf(,\\s*$Yf)*\$)i",$zc);}function
is_url($O){$mc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($mc?\\.)+$mc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$O);}function
is_shortable($m){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$m["type"]);}function
count_rows($P,$Z,$ce,$vd){global$w;$F=" FROM ".table($P).($Z?" WHERE ".implode(" AND ",$Z):"");return($ce&&($w=="sql"||count($vd)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$vd).")$F":"SELECT COUNT(*)".($ce?" FROM (SELECT 1$F GROUP BY ".implode(", ",$vd).") x":$F));}function
slow_query($F){global$b,$S,$k;$j=$b->database();$di=$b->queryTimeout();$rh=$k->slowQuery($F,$di);if(!$rh&&support("kill")&&is_object($g=connect())&&($j==""||$g->select_db($j))){$ke=$g->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$ke,'&token=',$S,'\');
}, ',1000*$di,');
</script>
';}else$g=null;ob_flush();flush();$H=@get_key_vals(($rh?$rh:$F),$g,false);if($g){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$wg=rand(1,1e6);return($wg^$_SESSION["token"]).":$wg";}function
verify_token(){list($S,$wg)=explode(":",$_POST["token"]);return($wg^$_SESSION["token"])==$S;}function
lzw_decompress($Qa){$ic=256;$Ra=8;$lb=array();$Jg=0;$Kg=0;for($s=0;$s<strlen($Qa);$s++){$Jg=($Jg<<8)+ord($Qa[$s]);$Kg+=8;if($Kg>=$Ra){$Kg-=$Ra;$lb[]=$Jg>>$Kg;$Jg&=(1<<$Kg)-1;$ic++;if($ic>>$Ra)$Ra++;}}$hc=range("\0","\xFF");$H="";foreach($lb
as$s=>$kb){$yc=$hc[$kb];if(!isset($yc))$yc=$jj.$jj[0];$H.=$yc;if($s)$hc[]=$jj.$yc[0];$jj=$yc;}return$H;}function
on_help($tb,$oh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $tb, $oh) }, onmouseout: helpMouseout});","");}function
edit_form($P,$n,$I,$Hi){global$b,$w,$S,$l;$Nh=$b->tableName(table_status1($P,true));page_header(($Hi?'編輯':'新增'),$l,array("select"=>array($P,$Nh)),$Nh);$b->editRowPrint($P,$n,$I,$Hi);if($I===false){echo"<p class='error'>".'沒有資料行。'."\n";return;}echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$n)echo"<p class='error'>".'您沒有許可權更新這個資料表。'."\n";else{echo"<table class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($n
as$B=>$m){echo"<tr><th>".$b->fieldName($m);$ac=$_GET["set"][bracket_escape($B)];if($ac===null){$ac=$m["default"];if($m["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$ac,$Dg))$ac=$Dg[1];}$Y=($I!==null?($I[$B]!=""&&$w=="sql"&&preg_match("~enum|set~",$m["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):(is_bool($I[$B])?+$I[$B]:$I[$B])):(!$Hi&&$m["auto_increment"]?"":(isset($_GET["select"])?false:$ac)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$m);$r=($_POST["save"]?(string)$_POST["function"][$B]:($Hi&&preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Hi&&$Y==$m["default"]&&preg_match('~^[\w.]+\(~',$Y))$r="SQL";if(preg_match("~time~",$m["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}if($m["type"]=="uuid"&&$Y=="uuid()"){$Y="";$r="uuid";}input($m,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($n){echo"<input type='submit' value='".'儲存'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Hi?'儲存並繼續編輯':'儲存並新增下一筆')."' title='Ctrl+Shift+Enter'>\n",($Hi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'保存中'."…', this); };"):"");}}echo($Hi?"<input type='submit' name='delete' value='".'刪除'."'>".confirm()."\n":($_POST||!$n?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$S,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7�����i2\r�1��-�H������GF#a��;:O�!�r0���t~�f�':��h�B�'c͔�:6T\rc�A�zrc�XK�g+��Z�Xk���v��M7����7_�\"��)�����{���}��ƣ���-4N�}:�rf�K)�b{�H(Ɠєt1�)t�}F�p0��8�\\82�D�>��N�Cy��8\0惫\0F��>���(�3�	\n�9)�`v�-Ao\r��&���X������n������*A\0`A�\0��q\0oC��=σ��\r��\\��#{����Ȍ�2��R�;0dBHL+�H�,�!oR�>��N�A�|\"�Kɼ�0�Pb�Jd^�ȑ�d��Р�=<���:J#�¶�ڮ��a�Б��>�Te�F�k�j�#�K6#��9�ET��1K��Ŵ��+C�F�I�	(��L|���jP��pf��EuLQG���Z����2�Υ�2�!sk[:�1�k���6%�Ypkf+W[޷\rr�L1���\0ҝ��8�=�c��T.���-�~����#sO��vG�+�y�O{�J�9C�O��ײ|`�+(�M�r\r�O�5\n�4��8��(	�-l�Cj�2[r5yK�y�)�¬�+A�k������2�g߳3iĔ���HS>��W��<�f�}���jfMiBϹ��84u�L��ZCI\$�2P�\r��߅\"+�2�n-�~C�24����:��2��,��:�ܑ�gcwGҨ��ǃ����h�V���] \\����6`�R�4=#x�^�1��\0�P�م��:�-�8�o��~�o�v>ƣmط�����'��|����C��<�������:G)M&W�YQQi=��\\[ya\r����B�e�\\��B���7Ne}:��l���k\$44r�q}\rP���ALa�C5�s��m\r����Y���έ&��(� � ��\n�\$�jE%�^qx\r����hW�0FuR�m�J:��z@:r�j7F5,wr��\n' ��iP|>�8�W�fm2 9H�@�\$M�\$qX�Թ!��\r��9�0ΣR�:\"��7D� ���r�0�uĢ�܌Jꉼ��FF�<��P�Y�e��^)	8n�Lo2Eʔ�\r�1�伸˩�Cf�,q]N\0�8d8b*4�J���\\Mͺ��4�Hl���R�d̯!a�J	��.�e�5ˀ��I0ђQ\nC��Q.n^���0I������F���7<R3woMѦweD���4�b7+���F���>g�6�4Jj�`�t!�F���x�;��m����d8o�7B�j]�=Sj�¨�*��0A�;���R���QFD1��\"O��n�ɼ�Ϩ4Ê�4e���q\nK�*;9H��9@�Չ#ƹ'�Y���S�cl�an�.Ͷk:h�\$���9����d9�\r��1�P��qʃDy%���sba�Ɵ���ʜ\r����Z�RH���_%\0@S�������w��77ER��jw��M�P��2@\n.�a�W~����JH,��n��J��`o����@zõoN|�L�ڨVK �x	u��3*�qK��`�]����AG���iU����a��ȳ�Qre\$[W\"@b��ĸU�\r���=.E�E�\0��}r��DH�\"Imǌ���utϮGP�P�̗8�\0p�D �;��V�s���(�#���R�uʖ�\$��˖\0c�E��B�\n̎g��\0004��	+�އ��2c��n�f!>��ǟ3�]�J35|G�tTaU �Hi'�K���Zg��	�#����iV��υ���4TW���\0�\"1�ݕQ�Ժ�_>�}��>Q�qr��m�V�!<��d��������9S��,v����'�u��ykb]p���M�y�I��[&���\\���9Gv��i���u7��E��k�^[�%A�a;�H#t,�k�[���Xݑ��5Q^y�I}ۧ�U�(b\rex�%K����\\��œ���+!Y�_�)�e�F`�[[nZ��=�wn��_�\$+\$��#F�Fj��ic̕l��k���6[�Y���m����t\rQ�x��W%�A�z�@������t\r��4\"n�,�4��C�fa�|����va�G��tż���ń�t\$?�Y9�������Ht���y0G�O��(���������<����G�W����j���W�R/��_'� \\z%>j����{���Zs����?����������e�V/�@�0:�h����.�F�Q��4j^/g�]`�	F=n�&�&&��je @p� �����On����H��X*+�5J���\n�����P�uf&�KZ�O��O��̌���PX�f�l(����@ړ����������pH{/��d�K��0����P�������&��&�|�\0οPd�&���NL�M��P��m�	������NU*)h��E�ER��@�	��8�-�<�49\0�\r�� �چ\"����/�6 @�C����\0�\0�~@��[�a�i��g3(gcc�I��A�[�s�6 �q`����Ħ\0fn��ɬѸ	��SG�\r�iq���Ok��IQhU1��\0\r��Qi��\r+������)V��!�uI�\0r�,;�����)��\"�1 Q�\"����N7��Y2%Q�#C1���Q!Q�#�����BiC%јy��D���N!M<0�.-\"�3!1RQ@�iK#�)�i\"B���*�Ɣ�c2���*��+r��\"��eP�2(*���#��g+2�,��*2,R��2�,�0�*2���/2���q���\$����h\0�Ҙ��?2R�2�/��0l���,��B 趒�c%�BҔ8�/�*��4�&�t`�ah{3u7�%����@��n��6Q}93�+�`��r�Ӆ5�[�Fg�S3s�Q�:R'*��&Qa<2u\$��= �B�<RU<���ܡ��6�S����?2)+�?s�<�=�ڔ�>�9�J�@s�=S�A�Re�AS�Bs�B�/>�1�Vq�TI.qR_�3E��\"e��Y�\".3ȑ��\"Jq��BɫD)̝��4#\$�a�� �l�(�S�<4[\"Q����d0��%��A4��_qiC�K�R0��7�HI:Kj� ��2S�A3�t�?��NT�\$��Mos'	\r��N�gPR�&�8��P��OR3Q23 �eHIR:\"�:�R�#F������	�L�KmS���*(��,�v8��2\$35V�D�3c\n0�����B�&\rä+Ҋ9�0��:\r�8qAT�TI*]5J�0J�SH&f���");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO�G#�X�VC��s��Z1.�hp8,�[�H�~Cz���2�l�c3���s���I�b�4\n�F8T��I���U*fz��r0�E����y���f�Y.:��I��(�c��΋!�_l��^�^(��N{S��)r�q�Y��l٦3�3�\n�+G���y���i���xV3w�uh�^r����a۔���c��\r���(.��Ch�<\r)�ѣ�`�7���43'm5���\n�P�:2�P����q ���C�}ī�����38�B�0�hR��r(�0��b\\0�Hr44��B�!�p�\$�rZZ�2܉.Ƀ(\\�5�|\nC(�\"��P���.��N�RT�Γ��>�HN��8HP�\\�7Jp~���2%��OC�1�.��C8·H��*�j����S(�/��6KU����<2�pOI���`���ⳈdO�H��5�-��4��pX25-Ң�ۈ�z7��\"(�P�\\32:]U����߅!]�<�A�ۤ���iڰ�l\r�\0v��#J8��wm��ɤ�<�ɠ��%m;p#�`X�D���iZ��N0����9��占��`��wJ�D��2�9t��*��y��NiIh\\9����:����xﭵyl*�Ȉ��Y�����8�W��?���ޛ3���!\"6�n[��\r�*\$�Ƨ�nzx�9\r�|*3ףp�ﻶ�:(p\\;��mz���9����8N���j2����\r�H�H&��(�z��7i�k� ����c��e���t���2:SH�Ƞ�/)�x�@��t�ri9����8����yҷ���V�+^Wڦ��kZ�Y�l�ʣ���4��Ƌ������\\E�{�7\0�p���D��i�-T����0l�%=���˃9(�5�\n\n�n,4�\0�a}܃.��Rs\02B\\�b1�S�\0003,�XPHJsp�d�K� CA!�2*W����2\$�+�f^\n�1����zE� Iv�\\�2��.*A���E(d���b��܄��9����Dh�&��?�H�s�Q�2�x~nÁJ�T2�&��eR���G�Q��Tw�ݑ��P���\\�)6�����sh\\3�\0R	�'\r+*;R�H�.�!�[�'~�%t< �p�K#�!�l���Le����,���&�\$	��`��CX��ӆ0֭����:M�h	�ڜG��!&3�D�<!�23��?h�J�e ��h�\r�m���Ni�������N�Hl7��v��WI�.��-�5֧ey�\rEJ\ni*�\$@�RU0,\$U�E����ªu)@(t�SJk�p!�~���d`�>��\n�;#\rp9�jɹ�]&Nc(r���TQU��S��\08n`��y�b���L�O5��,��>���x���f䴒���+��\"�I�{kM�[\r%�[	�e�a�1! ���Ԯ�F@�b)R��72��0�\nW���L�ܜҮtd�+���0wgl�0n@��ɢ�i�M��\nA�M5n�\$E�ױN��l�����%�1 A������k�r�iFB���ol,muNx-�_�֤C( ��f�l\r1p[9x(i�BҖ��zQl��8C�	��XU Tb��I�`�p+V\0��;�Cb��X�+ϒ�s��]H��[�k�x�G*�]�awn�!�6�����mS�I��K�~/�ӥ7��eeN��S�/;d�A�>}l~��� �%^�f�آpڜDE��a��t\nx=�kЎ�*d���T����j2��j��\n��� ,�e=��M84���a�j@�T�s���nf��\n�6�\rd��0���Y�'%ԓ��~	�Ҩ�<���AH�G��8���΃\$z��{���u2*��a��>�(w�K.bP�{��o��´�z�#�2�8=�8>���A,�e���+�C�x�*���-b=m���,�a��lzk���\$W�,�m�Ji�ʧ���+���0�[��.R�sK���X��ZL��2�`�(�C�vZ������\$�׹,�D?H��NxX��)��M��\$�,��*\nѣ\$<q�şh!��S����xsA!�:�K��}�������R��A2k�X�p\n<�����l���3�����VV�}�g&Yݍ!�+�;<�Y��YE3r�َ��C�o5����ճ�kk�����ۣ��t��U���)�[����}��u��l�:D��+Ϗ _o��h140���0��b�K�㬒�����lG��#��������|Ud�IK���7�^��@��O\0H��Hi�6\r����\\cg\0���2�B�*e��\n��	�zr�!�nWz&� {H��'\$X �w@�8�DGr*���HV��w8�J�\nm@�O�#P��@�Yp��öw����P\r8�X�\$X� P�d�	�Q\0Rx1\"T]\"�����	��Q����bR`M���-�RSE8Go0��	�d�B^�\0��\":�mN.�j%�@�3(�x �l ���	��W����\n�:\r\0}�@�qm;@�-���Z�g.zF�f@�\r��W��ck�� �<	�0���z'4\r�\0�jELY��(�%�\nM���D��oF�B�q��Kg��#�Z�����\"�\n��Ю��h���2-n�\"jy\"������\"��g�!,�*�T��x����P��5%L���`�L�M��@� Z@����`^Q0R%9&jv�h�X �o����G#���D��H�K¼lX���-��2hWli+�&��s'rz���(�҈��%tK�6�r��r���K�.*�,*v�bgj�#���LȮv�Z��Q\$p܏n*h���v�B����\\FJ�X%x f\$�A4K74�a#��3\n�(|�Z,�e2�l\r|�K�0����W2-m)	)��Z'%��	��7�.�*�*\0O;��C�*��\$�A;�V���(���l��t�K�.Dƛ_>�:�v�3�=d�\$R擠�Sl�7��B[�!@�]�[63zS�e>s�r�Dz��;T0�S�*�C�+o�\\\0��{D��k��z@�= ���D�4V炏ʕ*\0W���t��v��yD�-�5C��3�����D��t��!�_�U�XL�]F�Fn�F��&@%b>c��P��I�)3<�@ `�\r�55�%�/3Q��@G�5\r��ѱT���,��E�N�&j\0�h̾\$��� �353�T�B'FL���'D���U#�Lэ�Pm*Ѡ\\\r@��@�)��E��UUU�]V����`�M���RD�FV�{4�`3U4��5���#�T`�Q(�ߵq7M�*@SVM�Ģ#�~�2 մ�jl�@�\\ �.J|2�U�\\�� �v���\\b;^\0�6x�·]�^u���UL�Z��MP֙�4H�9�\$0�3�'VuT�@�KW�|���/\$J�*D��]�	X��_p���ޕ�ѥ�ղu��I�܅z䢮��r��\n��%�8��i^��U�1�5�n;I\n�R��3��QU45�5`z�ac��b�`qOt�Nu�6)�T���j��X��Re�#�J-�S@�\"U�����C�UU�8��6�-ki�/Y�� R\$�!�\rn�[6Vݭ�qՀ��.��B����cp�pps!\0�Ow\"�ngs�X�wGi�{Z\0Su*k`�Ξ�a!Qo'd �x Ca����c�!���60P�\rʂ�T�Ҝ�����,j�&�@ʃ( OA��P�T�j��Ghλb���\"%�\n�qX�z %������m~@�~�r��JnW�~ �	�]RX�F��r��xNmHp �+@�kl#��\0ˁ�v�X&��,i��d�z��\0�N��~w��������\0�Wၷ��\0�KN�m�	0��p��Bץ�'X)�`Y�e��XyI: �`dѠt�\n�('N\r��HGuK�e�\0���*3��)n3ͤ o�V�}v�����N\\��؍��1i)\".�`t�>\r��c�ߏ�f��oA��\"׭�� � OyY�F�\r�[5B�o*/t�(��%��R[<��8V��\$AM���5��9'*�X������܅�\\��\"jrD�\re���X|��^�n#�dͥl��n����M��t�~\\�͛\0��@ᛂg=�2���.�*\0�@�'9��y� �ߞ9� d�	�zq�6�]�P~\n��P�:��<����DY�:]5[[�'I���F�����\$B�<�P�P�@N�0/E�:^�D�Jw���\0�_Cdz#�zFW4(K�{�U[��{�>\0^�%�M@XSڇ�Z�SlW����wY�� ޔ\"B*R`�	�\n������QCF�*����Y�ͧe���+�H�j�\$�Q �^\0Zk`��V�B%�(X**2�ͺ������N`���| ���-�����~8Z� ƇRz2\"�	J�4�S~J�&t��e�m�V�}��N�ͳ'��r�5f.&1����j������K��m�{��`��w �!�^#5�TK���E�hq��\$��k�x|�m�:sD�d�zA�ڋ?�����[�L�ȬZ�X��:����[(!�k�X��V�y��� ���\$\0C�9�dSi�in��{�`�\n`�	��|K ��:�5���# t}x�N���{�[�)��C��FKZ�j�PFY�B�pFk��0<�@�D<JE��i0�5�����T\"��Vh�����Ň�H�WDeSs���N��\0�xD��L1���<!��\r3���qd��K3�P��y���E/`��Pz���\n���dYϼ���5X��8W��I8�w[7��`�\n@���ۻCp���P����=V\r�Z{*�q��\$ R��֓��eqЬ�+U`�B��Of*�C�L�MC��`_ ����˵O\n�T�5�&C׽�@��\\W�e&_X�_ܻ.��8�4d Yü����p\$ezA��[\$]�<]�|`,\r�ul\r5�qp�du ����������Yi@���z\n��7��;�Ȁ����ܝ7�b'�dmh��@q���Ch�+6.J��W��c��e�]��e�kZ�0�����Z_y���f�pc8&���͂��z\0�E�Ν�7�0�	��\"�\$��=����!>�怂g7B-QƐ/e&�Ƈ�6a��p\r�e3�c�NIjn-�\$*x�-WV�j��@oΏ#w�5�'O�.���M�و\0�H�C�9���-m�P��8S�v!��;gtL�5,	�#�n#��ޏ���x-7�f5`�#\"N�b��g���� �e�b���,7S���Gj��oՋF�?�T�6����m��s����-��m6��q��;�dl����0fE�8�]P'X\n���MG\0��x��\0�5�����*�#�*�1>*]ȖWs\r��,������\0�O�,q2�j��+H ��FG���E�>d@b����Iz�aR��8@7�LB����H� ��A�˳�p�p@�	�d�k�z4E�A�	���߉��WA1\"�2bGk\"�\0��d�h�RD�p�!fPs3`F���e	OkLA���C�/��a@|@���:!���ᘂ��o�T/b������lL8�Djʄ��@2���κ���EN�\"�1��zq�,\\^��)8V��q���1	�<��'4�������C!�F���4��f��t�c�����\r�m�z�*M��(��A������2�)�Pr�Ɗಈ�45	��\0Z[d�9�hY�����t1e�E�\$o`�X� ��g�Ud\0G�~DR<��hUp�y��=�T(�DZ-bH�ȏ���ya�H���lb�b(��HL��8e�sC���e�I�=D��{����]�<��a✊Q=T�\$!C�Oِ�U�G��)��Q�V�Tb\".\r��@<)�o�`�V\r0q�j�s�X��F\"*�bI�ڢ|��A� hp\\	��X�j#�b�#����O>5w�?T���;���l�1�a�c\"t5v�Į��`�x\\CM=�ib��!.�HL�m�H���Ҭ���%+���D4F�ڼ��C��[KX}P� ��>e:V�t�;�#Ѧ��&�R���ȴp�,a�˘�H�Ɯ���Dt\0�\$q����/t���~�J�����`��,㺼��]��`�%3�>ގ��@N��x1,����r�xr)�:�8������0����B�,E�A������B�0(���E��8@��n[	(���h�dD�	HR�Q��^�!� �v<� ����6����E�\"��&����V(GB��U���_���H��s�@�*BN)QH���vTG��0��h�R٥ن+�-�&T�C�?��zd\0\$�bSڡ<��܏�Q���@��P��dpO�>+�>x|�	�Me�E���R�4��k(W{�*-�G\$���	'�j\0��H����	(�љ>A%�Y���ʴ�6�v����^�K� G%2�Ed�͔<�J�#�DE{0\$�T+�2T%�#&��W2�e��\nS䧆L�c�d����h�=��|e�\"' �[���a2#%=�u�k�:6�,��K�\\��d�ȗYGr;·��=�� ���LɴX�yV��h*���O *��F����-bK*�#���:.<�RY\"EU'x3eQ�������q�@>�bK�x��4e�� D�G?!��N�xk�a�4@/��\rc0Ҭ�D��!� @ �;�D9\$:��&� �W�\$���R5�ڗHA�2o=��@=�:���\n%���@og�����]��tT�&�# ���qU��f��c@���|�BW&�_����\r�R\"(L��zr�s5*�T���� -5\"�Z74�%��\\!yΒ�7K� @Z���/v\0/I�Î֯�s��@��11�&�-F����5�D��Au;��@[<�HO.y��@Z�s�	��ӶA�O\0���ʴ��I�Z{��0���rԒǡDP��'����O�v�\n��B?i���@#[H�B�!~P>x!u�E�.\0��(wIE1E��ܠ/�\":\r�u|T Ky�8[N ?�x�gP�!����;u�NBT�΃ɡ�\0�0 6��\r`bhE\r\\�Cp��t@���;�El�{�(�>1���*��\n��)�M�C�|@���`��i\"�\\�KFɥ���	�|�(K4�gJX�iBP�'��\$��>q1B��	�N�xXc�ߧŪ��,Ch�y(B��7S#\r!�H0���9�����MJT.0��)ZD���B�?���-v���q*��,J�<b���&���d�P��KG;� y��	��#>)�iȑi�&Ȝ8]*C�,ô� 9��\nhW\\	�iM 7��!��9���_��,��9���\$T\"�,�)51v\"Lf&�-���9>y� �QBJ�J4��\n�,*0�P����g6yw�/M��\n<�B�i.F�����2d�B�rP����jjwi�����.��pI\0� <�xV��,�\nC�S����0�P����P��r+�Y�x#'IU�e\"�cQ�C��������\0*%Ġ\"��Ph�Ur׬i�c�,5V��W@-�l��_����=������\n4�����rU!��F�������5��Y���O5�!{+4�)O�Fe��ɬUVSh�k�*�V�_�\"��gz����s�jk�/�1Un����aW�[zɈ�\")d�F��R&7��Yfȕ��	-2��r_I<q��8��0�)�p�P	��P�Խ0�rY�BcD#���\"��#�4R:��\$���^U�S�&ZI�n�W�mKĔ\$��+#zD+��6��dv �Bb�a41d@����,1	�n��	��4�)	�t(��-u*�#۴�[N2��P\n_)|4H0�� �L\"��N��0�&\$	`E���ְ,B��_\\x\0Qb�^�&�ro#���i�&�n�%6{��&�L\r�'#�F��`ѠJ��ņl�dR��(h% x\"HC�K�? v8�KCP� Q\0�_���#�P)ia\n�H%�ǩzzVci\0D(DV5QӰ�ob�'�\r�2Q��FO`BD'�x)雽��~,@)}X�r�P�N�7��T���<M���H�\"'�7Vn���!=X����� ��ȶŲ\0�,�x[X,���زŦ��Ȯ����qep5���!>\nSCD�\"A\0��S�Q\n�]��,�-�BdƂ=��ST>Z��(\0/��Vl�.q3��T@\0+�;k�MD���\n����q���4�a�yT���`\"��5����59���|@`&���:R؋�\n2�v���.�mA�`�Tk�|�|2�L��)�\\���<V��3q�#C���D2����h�3�����פ,`�0�:��e�K��]�4R>L��g\\�[0� ˸q���ʨ�*��V��V���]r0�q0�	��t���ޞ�O/\$�����;2ꗁ��L;+\$���l�*��Ř�J���C\rn�{\rՍ��r�;�<Ű8U�!��5`c�-�X��#���\n��k���\0:��^I�§6�!ky���*��AQo@uὖ`N���s���'7�F&�����C���L��:���R���n�(�%ۄ�3��٤�e���px`��Hb�l�*��E��4pɜ�i{�x��s�{�p5Q���Lq�n��&ؙC�\0�7��\0�;[�\$L�j�@:��2�L��{�|pTR�5�M�7_D�\n�b�pP\0]��>ldr5CC�eq2�*]�^0�n�	�nK��@��|i�/ª����o�;MK������Ƹk}y��[��k\rW[��\$���\r�^u�\nw�H7�\0��^a5-R'!e|R�%���\n�pw,�]~����N&;QS\rƗ��iy<���-�-�0�0� m�H#�\n�qF�!�2�N=Av�4W��sP@d<˓*1�*B,�Y�\\��w:H�ǃ���T��U�z��'T����틀e���O���_%�q(oH�(�����q�k̀*o��P�w�5%p�괟�Ծ|h�i=wA��������u�@g1�P\\�\"�F�:2,��}}��ƨ�j��c�XV�i�9H�c���E��NRR�ӓ��jV��rpv��9R?%�Ÿ\nn�.\0�)�?���EX(/%.���v;����Ow+��3�[��B��G��I�{�M��p��er�\$�R�\$o��%)3�W��ذAx�`�*��I1�#�Ԋ���9pR�'c\0���=��)J_,����=�)H��^W4�ϖ���͚��������b1��a��B!:�@�4�#��6�evh��_�(���ǆ�n\nv�Z ��̦e�=��8�n���J>m����G����{��^�Yf+0;w�vP�\$@/��#5/�9�s���8��1��)��0�E+�	�����R�����0l�\"��&�U��7� ��u�iB�2�hX�Fo�+~�P�K���pA�#����V%�oZp6�9�X���͙l^%��`G�A�*����U�\n�\nJ{��D��Ǯq��r�\$8扮с,܆Ձ\n6Ya����Nz�.��(��\$�N�\nG���4Y}�pZ��?�@�����.��6�)f[��Go�%G������Ϩ\r���9r����^����Ұ��m�R�ɱ�\"�V(�ז3�\0�dz�ă*�ZlJf���a~l�@�U|x>8�J�5p]�2U�/�����yk�����ǧ�<�<�q�'}a�����g�gZ'jt�+l�ԡG���A֑{����_k�\r��η3�l���D9�������K�B%\\їVɿ���8�<���K��A�!wV�i�:.L��ܪ_LNg�xZ9�rWy�C��b���q�w#q L�H�����\0C�p��1��.�����\ro>[`j>�(@F6-�@잦�*(>�@Y��Ih�\r멧X�H�>N�b�ctrn�֍x�?X%%�vx��{5�l\\�yϦ�6tta]�w�0��.ݡL�C���6��f�&�%D۾�B0�8�`�m�Gk?����e�ZN���u�ݳ��^q\\��!�+��e��\\Z0�@��f`���B轘�`*z۶�o\\�%�i펚gzA�����^\"V�G�k��uk�f��՘o�7��9�;v��Y�`.��`��{�@P���&	�T�![�\n#�l���Z���F����=a�iHț��6�CS,p7!�{[�B��T͆;��d��\n�N[k��;\0�\"yP�3��`.�N�QP��T(n�T#�����F��o�\"!0и�F�!�]�߂C��#�J?���t[�纐�Vt 	�ߏw.<O k�'kBOpd#���N�ǆ@�����n��d\$�f\0��U%^傍���H����qu(E�U��P����ym+�P�n�@~G�\\�px(�9�~)���	jL�PL��q�bxjx��B)��O��ɫ�\n�萔�o�:N߆��(�]%�P�;�o�)��KFv\njz�Li1���/f�n�ج'0���b7P��Ddc30:�l	S�_n3e�v���-����o�(��!b(&�*w����l��f�g�o��r(w6S�S�am����A�T��b���q,�@�)	�k�ZϺ��ح}�+��ȴ`RNu����pwz^wmt���+\"I�ƞs�!F@�8A�J|Ds��.�;L0\rɣcr�n��!����WR���\\W�q|���~n��w��YE]��`��d�N��{]^�	��Y����rA&Uu�|p��f�u6�Aq�(���MXtGe2�x��S\"��B2	:3z�4\rW&����(���7�\"��P�z��JXV_�Z!��m�to���\r��8 �\r�RZ*��r��D�ZB[T�@l��H�2��Vh�W�L��6\\:r���&�(�e�m�����//���JG��hi��:}I�	E�BQ#ٛ�t�R�Ӏ�Ξ};e��S(��o����Z��Je�,�e��]�>	{F+^��#ԇ�.�f���S�6��l��s���'�k��[��ۼ�v�9eⷱbR��Y-���|�eJK\$�^������jWz{֖�Ew��h��{��\n�w=}ń�q�H���r�!!c����X��]��f&\$l��ڨܞ�1��g)��LD;�w�}�4�'���^W��ܾ�u���ǗԱ��-��Ja*�~!�o�K.��;wP�p�X��o_â_�\0�찐�~��'�����?��BxIG�F��G�����Y����,*^g j\$W|�X���¤oI��D�'�X�X���/���3��%�5��C�Zz��ٹ`�e1�^IWw2��T�]㵵��}�R��a��-�� �ғ��зϬ~�~g{酞�ߤ;��JW�k-�;��3�,g~G�UWx����a\r�	\r/\0��γ���{�B��d��tb_X�a��A��l����	hh�!w��+h1#+h0\r�i(�@�P�Y����Lf�Ml{�(����3�r�e(�\r�*�;�_��Z����T>\n����_6,)&I>B4Id�m�\n^>M�Й�k�xLo(D@�:F���9�YW�Fa�+�\"��\$����/���X~(�\$�����\"0#�1C�k�Q3�_nG��Q��zT)���*��t�m؟T\0��az���B�g�ű������O�~�9�.�����JW*�ف5�0	�C@�P˓��\"�c�:Ѥwm�`O5K��y+�P-��`\0X��9<�c�\r��,��&����@G���)�F��^t��8�n\n�e�	�7��Z�\$��;E�x(¹?��o���� ]'�5m��Kp�PV��\r�f����<��U��?�����*%P҉dH�Ӌ��k�7!�W��-H��+0��>�����m`�6,ACԐ21E����C�|gL�P/�VI��(�SP\n\0��aS.R��Ac�����р�\0�H���hwP�/����\0���; �N+�O��x��c�v����>\$.p��1xh�i�=��Ǝ\r\0kM�6�� :@��\r���Q��'�E�h@`�� ���P�)���C�v5��%��s�5�)��;C\n02@�	UP0�[H.6���a�@�D���&��\"7��P���A\0 ,@:\0e��57���Iz?�!��\r@\"���mx�\\����\n�=�C�\r�ڐVAk����T����	������0d@�`g {�����Q,�I�i��S�dDR��R��}�k�Âh	���@����9N���E����sA�<�>���t�]�mp9����9=�]02�\\�����8r�U�`2�\n����� ҿ�\$�M?FX�Ip���		�x\n\$�i:h2�.�0}���������1t\$m�\n�'C[*�;O�?�k��\n�\n���.0���	�X�N)�)TP��tI{C�1\0V�PM\0WR���h\$Bp\n��T���Z|-�\08\\+���H_�db�@](.���\\-����2��X�4u��Bj	4�B�/&�ރ�������S��\"�D\\2H�4h���8�X���T!\0e��VI�b 1!q���@��d\\@�!�8\0��A/ԅ���:kݕ.�CAS�X�fθ��N������J4�&!�c�/�\r�k\0�81v��CZk�a/�ނ�N/��Jd&\r(��5A���`�جf��!K�:Gr��ܘ�#���x� ��g�ȡ � �(��4��;��?�XxqA���p��T�u�����pؑ�*`u��.VۉA� . hK�D-�C ��N��r����gP\r���	�#�:D#\r��︔�\r\0D*b�B�e���\\���[( <�0B�/tG����\\���P��h%�BÃC�73�B��\\����5C�	t:�ط(c\0�\r@<8�ʷ6��dC C���h���");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0��F����==��FS	��_6MƳ���r:�E�CI��o:�C��Xc��\r�؄J(:=�E���a28�x�?�'�i�SANN���xs�NB��Vl0���S	��Ul�(D|҄��P��>�E�㩶yHch��-3Eb�� �b��pE�p�9.����~\n�?Kb�iw|�`��d.�x8EN��!��2��3���\r���Y���y6GFmY�8o7\n\r�0��\0�Dbc�!�Q7Шd8���~��N)�Eг`�Ns��`�S)�O���/�<�x�9�o�����3n��2�!r�:;�+�9�CȨ���\n<�`��b�\\�?�`�4\r#`�<�Be�B#�N ��\r.D`��j�4���p�ar��㢺�>�8�\$�c��1�c���c����{n7����A�N�RLi\r1���!�(�j´�+��62�X�8+����.\r����!x���h�'��6S�\0R����O�\n��1(W0���7q��:N�E:68n+��մ5_(�s�\r��/m�6P�@�EQ���9\n�V-���\"�.:�J��8we�q�|؇�X�]��Y X�e�zW�� �7��Z1��hQf��u�j�4Z{p\\AU�J<��k��@�ɍ��@�}&���L7U�wuYh��2��@�u� P�7�A�h����3Û��XEͅZ�]�l�@Mplv�)� ��HW���y>�Y�-�Y��/�������hC�[*��F�#~�!�`�\r#0P�C˝�f������\\���^�%B<�\\�f�ޱ�����&/�O��L\\jF��jZ�1�\\:ƴ>�N��XaF�A�������f�h{\"s\n�64������?�8�^p�\"띰�ȸ\\�e(�P�N��q[g��r�&�}Ph���W��*��r_s�P�h���\n���om������#���.�\0@�pdW �\$Һ�Q۽Tl0� ��HdH�)��ۏ��)P���H�g��U����B�e\r�t:��\0)\"�t�,�����[�(D�O\nR8!�Ƭ֚��lA�V��4�h��Sq<��@}���gK�]���]�=90��'����wA<����a�~��W��D|A���2�X�U2��yŊ��=�p)�\0P	�s��n�3�r�f\0�F���v��G��I@�%���+��_I`����\r.��N���KI�[�ʖSJ���aUf�Sz���M��%��\"Q|9��Bc�a�q\0�8�#�<a��:z1Uf��>�Z�l������e5#U@iUG��n�%Ұs���;gxL�pP�?B��Q�\\�b��龒Q�=7�:��ݡQ�\r:�t�:y(� �\n�d)���\n�X;����CaA�\r���P�GH�!���@�9\n\nAl~H���V\ns��ի�Ư�bBr���������3�\r�P�%�ф\r}b/�Α\$�5�P�C�\"w�B_��U�gAt��夅�^Q��U���j���Bvh졄4�)��+�)<�j^�<L��4U*���Bg�����*n�ʖ�-����	9O\$��طzyM�3�\\9���.o�����E(i������7	tߚ�-&�\nj!\r��y�y�D1g���]��yR�7\"������~����)TZ0E9M�YZtXe!�f�@�{Ȭyl	8�;���R{��8�Į�e�+UL�'�F�1���8PE5-	�_!�7��[2�J��;�HR��ǹ�8p痲݇@��0,ծpsK0\r�4��\$sJ���4�DZ��I��'\$cL�R��MpY&����i�z3G�zҚJ%��P�-��[�/x�T�{p��z�C�v���:�V'�\\��KJa��M�&���Ӿ\"�e�o^Q+h^��iT��1�OR�l�,5[ݘ\$��)��jLƁU`�S�`Z^�|��r�=��n登��TU	1Hyk��t+\0v�D�\r	<��ƙ��jG���t�*3%k�YܲT*�|\"C��lhE�(�\r�8r��{��0����D�_��.6и�;����rBj�O'ۜ���>\$��`^6��9�#����4X��mh8:��c��0��;�/ԉ����;�\\'(��t�'+�����̷�^�]��N�v��#�,�v���O�i�ϖ�>��<S�A\\�\\��!�3*tl`�u�\0p'�7�P�9�bs�{�v�{��7�\"{��r�a�(�^��E����g��/���U�9g���/��`�\nL\n�)���(A�a�\" ���	�&�P��@O\n師0�(M&�FJ'�! �0�<�H�������*�|��*�OZ�m*n/b�/�������.��o\0��dn�)����i�:R���P2�m�\0/v�OX���Fʳψ���\"�����0�0�����0b��gj��\$�n�0}�	�@�=MƂ0n�P�/p�ot������.�̽�g\0�)o�\n0���\rF����b�i��o}\n�̯�	NQ�'�x�Fa�J���L������\r��\r����0��'��d	oep��4D��ʐ�q(~�� �\r�E��pr�QVFH�l��Kj���N&�j!�H`�_bh\r1���n!�Ɏ�z�����\\��\r���`V_k��\"\\ׂ'V��\0ʾ`AC������V�`\r%�����\r����k@N����B�횙� �!�\n�\0Z�6�\$d��,%�%la�H�\n�#�S\$!\$@��2���I\$r�{!��J�2H�ZM\\��hb,�'||cj~g�r�`�ļ�\$���+�A1�E���� <�L��\$�Y%-FD��d�L焳��\n@�bVf�;2_(��L�п��<%@ڜ,\"�d��N�er�\0�`��Z��4�'ld9-�#`��Ŗ����j6�ƣ�v���N�͐f��@܆�&�B\$�(�Z&���278I ��P\rk\\���2`�\rdLb@E��2`P( B'�����0�&��{���:��dB�1�^؉*\r\0c<K�|�5sZ�`���O3�5=@�5�C>@�W*	=\0N<g�6s67Sm7u?	{<&L�.3~D��\rŚ�x��),r�in�/��O\0o{0k�]3>m��1\0�I@�9T34+ԙ@e�GFMC�\rE3�Etm!�#1�D @�H(��n ��<g,V`R]@����3Cr7s~�GI�i@\0v��5\rV�'������P��\r�\$<b�%(�Dd��PW����b�fO �x\0�} ��lb�&�vj4�LS��ִԶ5&dsF M�4��\".H�M0�1uL�\"��/J`�{�����xǐYu*\"U.I53Q�3Q��J��g��5�s���&jь��u�٭ЪGQMTmGB�tl-c�*��\r��Z7���*hs/RUV����B�Nˈ�����Ԋ�i�Lk�.���t�龩�rYi���-S��3�\\�T�OM^�G>�ZQj���\"���i��MsS�S\$Ib	f���u����:�SB|i��Y¦��8	v�#�D�4`��.��^�H�M�_ռ�u��U�z`Z�J	e��@Ce��a�\"m�b�6ԯJR���T�?ԣXMZ��І��p����Qv�j�jV�{���C�\r��7�Tʞ� ��5{P��]�\r�?Q�AA������2񾠓V)Ji��-N99f�l Jm��;u�@�<F�Ѡ�e�j��Ħ�I�<+CW@�����Z�l�1�<2�iF�7`KG�~L&+N��YtWH飑w	����l��s'g��q+L�zbiz���Ţ�.Њ�zW�� �zd�W����(�y)v�E4,\0�\"d��\$B�{��!)1U�5bp#�}m=��@�w�	P\0�\r�����`O|���	�ɍ����Y��JՂ�E��Ou�_�\n`F`�}M�.#1��f�*�ա��  �z�uc���� xf�8kZR�s2ʂ-���Z2�+�ʷ�(�sU�cD�ѷ���X!��u�&-vP�ر\0'L�X �L����o	��>�Վ�\r@�P�\rxF��E��ȭ�%����=5N֜��?�7�N�Å�w�`�hX�98 �����q��z��d%6̂t�/������L��l��,�Ka�N~�����,�'�ǀM\rf9�w��!x��x[�ϑ�G�8;�xA��-I�&5\$�D\$���%��xѬ���´���]����&o�-3�9�L��z���y6�;u�zZ ��8�_�ɐx\0D?�X7����y�OY.#3�8��ǀ�e�Q�=؀*��G�wm ���Y�����]YOY�F���)�z#\$e��)�/�z?�z;����^��F�Zg�����������`^�e����#�������?��e��M��3u�偃0�>�\"?��@חXv�\"������*Ԣ\r6v~��OV~�&ר�^g���đٞ�'��f6:-Z~��O6;zx��;&!�+{9M�ٳd� \r,9���W��ݭ:�\r�ٜ��@睂+��]��-�[g��ۇ[s�[i��i�q��y��x�+�|7�{7�|w�}����E��W��Wk�|J؁��xm��q xwyj���#��e��(�������ߞþ��� {��ڏ�y���M���@��ɂ��Y�(g͚-��������J(���@�;�y�#S���Y��p@�%�s��o�9;�������+��	�;����ZNٯº��� k�V��u�[�x��|q��ON?���	�`u��6�|�|X����س|O�x!�:���ϗY]�����c���\r�h�9n�������8'������\rS.1��USȸ��X��+��z]ɵ��?����C�\r��\\����\$�`��)U�|ˤ|Ѩx'՜����<�̙e�|�ͳ����L���M�y�(ۧ�l�к�O]{Ѿ�FD���}�yu��Ē�,XL\\�x��;U��Wt�v��\\OxWJ9Ȓ�R5�WiMi[�K��f(\0�dĚ�迩�\r�M����7�;��������6�KʦI�\r���xv\r�V3���ɱ.��R������|��^2�^0߾\$�Q��[�D��ܣ�>1'^X~t�1\"6L���+��A��e�����I��~����@����pM>�m<��SK��-H���T76�SMfg�=��GPʰ�P�\r��>�����2Sb\$�C[���(�)��%Q#G`u��Gwp\rk�Ke�zhj��zi(��rO�������T=�7���~�4\"ef�~�d���V�Z���U�-�b'V�J�Z7���)T��8.<�RM�\$�����'�by�\n5����_��w����U�`ei޿J�b�g�u�S��?��`���+��� M�g�7`���\0�_�-���_��?�F�\0����X���[��J�8&~D#��{P���4ܗ��\"�\0��������@ғ��\0F ?*��^��w�О:���u��3xK�^�w���߯�y[Ԟ(���#�/zr_�g��?�\0?�1wMR&M���?�St�T]ݴG�:I����)��B�� v����1�<�t��6�:�W{���x:=��ޚ��:�!!\0x�����q&��0}z\"]��o�z���j�w�����6��J�P۞[\\ }��`S�\0�qHM�/7B��P���]FT��8S5�/I�\r�\n ��O�0aQ\n�>�2�j�;=ڬ�dA=�p�VL)X�\n¦`e\$�TƦQJ��k�7�*O�� .����ġ�\r���\$#p�WT>!��v|��}�נ.%��,;�������f*?�焘��\0��pD��! ��#:MRc��B/06���	7@\0V�vg����hZ\nR\"@��F	����+ʚ�E�I�\n8&2�bX�PĬ�ͤ=h[���+�ʉ\r:��F�\0:*��\r}#��!\"�c;hŦ/0��ޒ�Ej�����]�Z�����\0�@iW_���h�;�V��Rb��P%!��b]SB����Ul	����r��\r�-\0��\"�Q=�Ih����	 F���L��FxR�э@�\0*�j5���k\0�0'�	@El�O���H�Cx�@\"G41�`ϼP(G91��\0��\"f:Qʍ�@�`'�>7�Ȏ�d�����R41�>�rI�H�Gt\n�R�H	��bҏ��71���f�h)D��8�B`���(�V<Q�8c? 2���E�4j\0�9��\r�͐�@�\0'F�D��,�!��H�=�*��E�(���?Ѫ&xd_H�ǢE�6�~�u��G\0R�X��Z~P'U=���@����l+A�\n�h�IiƔ���PG�Z`\$�P������.�;�E�\0�}� ��Q�����%���jA�W�إ\$�!��3r1� {Ӊ%i=IfK�!�e\$���8�0!�h#\\�HF|�i8�tl\$���l����l�i*(�G���L	 �\$��x�.�q\"�Wzs{8d`&�W��\0&E����15�jW�b��ć��V�R����-#{\0�Xi���g*��7�VF3�`妏�p@��#7�	�0��[Ү���[�éh˖\\�o{���T���]��Ŧᑀ8l`f@�reh��\n��W2�*@\0�`K(�L�̷\0vT��\0�c'L����:�� 0��@L1�T0b��h�W�|\\�-���DN��\ns3��\"����`Ǣ�肒�2��&��\r�U+�^��R�eS�n�i0�u˚b	J����2s��p�s^n<���♱�Fl�a�\0���\0�mA2�`|؟6	��nr���\0Dټ��7�&m�ߧ-)���\\���݌\n=���;*���b��蓈�T��y7c��|o�/����:���t�P�<��Y:��K�&C��'G/�@��Q�*�8�v�/��&���W�6p.\0�u3����Bq:(eOP�p	�駲���\r���0�(ac>�N�|��	�t��\n6v�_��e�;y���6f���gQ;y�β[S�	��g�ǰ�O�ud�dH�H�=�Z\r�'���qC*�)����g��E�O�� \"��!k�('�`�\nkhT��*�s��5R�E�a\n#�!1�����\0�;��S�iȼ@(�l���I� �v\r�nj~��63��Έ�I:h����\n.��2pl�9Bt�0\$b��p+�ǀ*�tJ����s�JQ8;4P(��ҧѶ!��.Ppk@�)6�5��!�(��\n+��{`=��H,Ɂ\\Ѵ�4�\"[�C���1���-���luo��4�[���E�%�\"��w] �(� ʏTe��)�K�A�E={ \n�`;?���-�G�5I���.%�����q%E���s���gF��s	�����K�G��n4i/,�i0�u�x)73�Szg���V[��h�Dp'�L<TM��jP*o�≴�\nH���\n�4�M-W�N�A/@�8mH��Rp�t�p�V�=h*0��	�1;\0uG��T6�@s�\0)�6��ƣT�\\�(\"���U,�C:��5i�K�l���ۧ�E*�\"�r����.@jR�J�Q��/��L@�SZ���P�)(jj�J������L*���\0���\r�-��Q*�Qڜg��9�~P@���H���\n-e�\0�Qw%^ ET�< 2H�@޴�e�\0� e#;��I�T�l���+A+C*�Y���h/�D\\�!鬚8�»3�AЙ��E��E�/}0t�J|���1Qm��n%(�p��!\n��±U�)\rsEX���5u%B- ��w]�*��E�)<+��qyV�@�mFH ���BN#�]�YQ1��:��V#�\$������<&�X������x��t�@]G��Զ��j)-@�q��L\nc�I�Y?qC�\r�v(@��X\0Ov�<�R�3X���Q�J����9�9�lxCuīd�� vT�Zkl\r�J��\\o�&?�o6E�q������\r���'3��ɪ�J�6�'Y@�6�FZ50�V�T�y���C`\0��VS!���&�6�6���rD�f`ꛨJvqz���F�����@�ݵ��҅Z.\$kXkJ�\\�\"�\"�֝i��:�E���\roX�\0>P��P�mi]\0�����aV��=���I6�����jK3���Z�Q�m�E���b�0:�32�V4N6����!�l�^ڦ�@h�hU��>:�	��E�>j�����0g�\\|�Sh�7y�ބ�\$��,5aė7&��:[WX4��q� ���J���ׂ�c8!�H���VD�Ď�+�D�:����9,DUa!�X\$��Я�ڋG�܌�B�t9-+o�t��L��}ĭ�qK��x6&��%x��tR�����\"�π�R�IWA`c���}l6��~�*�0vk�p���6��8z+�q�X��w*�E��IN�����*qPKFO\0�,�(��|�����k *YF5���;�<6�@�QU�\"��\rb�OAXÎv��v�)H��o`ST�pbj1+ŋ�e��� ʀQx8@�����5\\Q�,���ĉN��ޘb#Y�H��p1����kB�8N�o�X3,#Uک�'�\"�销�eeH#z��q^rG[��:�\r�m�ng����5��V�]��-(�W�0���~kh\\��Z��`��l����k �o�j�W�!�.�hF���[t�A�w�e�M૫��3!����nK_SF�j���-S�[r�̀w��0^�h�f�-����?���X�5�/������IY �V7�a�d �8�bq��b�n\n1YR�vT���,�+!����N�T��2I�߷�����������K`K\"�����O)\nY��4!}K�^����D@��na�\$@� ��\$A��j����\\�D[=�	bHp�SOAG�ho!F@l�U��`Xn\$\\�͈_��˘`���HB��]�2���\"z0i1�\\�����w�.�fy޻K)����� p�0���X�S>1	*,]��\r\"���<cQ��\$t��q��.��	<��+t,�]L�!�{�g���X��\$��6v����� ����%G�H������E����X��*��0ۊ)q�nC�)I���\"�����툳�`�KF����@�d�5��A��p�{�\\���pɾN�r�'�S(+5�Њ+�\"�Ā�U0�iː����!nM��brK���6ú�r���|a����@�x|��ka�9WR4\"?�5��p�ۓ��k�rĘ����ߒ����7Hp��5�YpW���G#�rʶAWD+`��=�\"�}�@H�\\�p���Ѐ�ߋ�)C3�!�sO:)��_F/\r4���<A��\nn�/T�3f7P1�6����OYлϲ���q��;�؁���a�XtS<��9�nws�x@1Ξxs�?��3Ş@���54��o�ȃ0����pR\0���������yq��L&S^:��Q�>\\4OIn��Z�n��v�3�3�+P��L(�������.x�\$�«C��Cn�A�k�c:L�6���r�w���h����nr�Z��=�=j�ђ���6}M�G�u~�3���bg4���s6s�Q��#:�3g~v3���<�+�<���a}ϧ=�e�8�'n)ӞcC�z��4L=h��{i����J�^~��wg�D�jL���^����=6ΧN�Ӕ����\\��D���N���E�?h�:S�*>��+�u�hh҅�W�E1j�x����t�'�t�[��wS���9��T��[�,�j�v����t��A#T���枂9��j�K-��ޠ���Y�i�Qe?��4Ӟ���_Wz����@JkWY�h��pu����j|z4���	�i��m�	�O5�\0>�|�9�ז��轠��gVy��u���=}gs_���V�sծ{�k�@r�^���(�w����H'��a�=i��N�4����_{�6�tϨ��ϗe�[�h-��Ul?J��0O\0^�Hl�\0.��Z������xu���\"<	�/7���� ���i:��\nǠ���;��!�3���_0�`�\0H`���2\0��H�#h�[�P<��עg����m@~�(��\0ߵk�Y�v���#>���\nz\n�@�Q�\n(�G��\n����'k����5�n�5ۨ�@_`Ї_l�1���wp�P�w���\0��c��oEl{�ݾ�7����o0����Ibϝ�n�z����﷛� ���{�8�w�=��|�/y�3a�߼#xq����@��ka�!�\08d�m��R[wvǋRGp8���v�\$Z���m��t��������������ǽ����u�o�p�`2��m|;#x�m�n�~;��V�E�������3O�\r�,~o�w[��N��}�� �cly��O����;��?�~�^j\"�Wz�:�'xW��.�	�u�(��Ý�q��<g��v�hWq��\\;ߟ8��)M\\��5vڷx=h�i�b-���|b���py�DЕHh\rce��y7�p��x��G�@D=� ����1��!4Ra\r�9�!\0'�Y����@>iS>����o��o��fsO 9�.����\"�F��l��20��E!Q���ːD9d�BW4��\0��y`RoF>F�a��0�����0	�2�<�I�P'�\\���I�\0\$��\n R�aU�.�sЄ��\"���1І�e�Y砢�Z�q��1�|��#�G!�P�P\0|�H�Fnp>W�:��`YP%�ď�\n�a8��P>�����`]��4�`<�r\0�Î������z�4����8�����4�`m�h:�Ϊ�HD���j�+p>*����8�ՠ0�8�A��:���с�]w�ú�z>9\n+�������:����ii�PoG0���1��)�Z�ږ�n�����eR֖��g�M�����gs�LC�r�8Ѐ�!�����3R)��0�0��s�I��J�VPpK\n|9e[���ˑ��D0����z4ϑ�o������,N8n��s�#{蓷z3�>�BS�\";�e5VD0���[\$7z0������=8�	T 3���Q�'R������n��L�yŋ��'�\0o��,��\0:[}(���|���X�>xvqW�?tB�E1wG;�!�݋5΀|�0��JI@��#���uņI��\\p8�!'�]߮��l-�l�S�B��,ӗ���]��1�ԕH��N�8%%�	��/�;�FGS���h�\\ل�c�t����2|�W�\$t��<�h�O��+#�B�aN1��{��y�w���2�\\Z&)�d�b'��,Xxm�~�H��@:d	>=-��lK��܏�J�\0���́�@�rϥ�@\"�(A����Z�7�h>����\\����#>���\0��Xr�Y��Yxŝ�q=:��Թ�\rl�o�m�gb��������D_�Tx�C���0.��y��R]�_���Z�ǻW�I��G��	Mɪ(��|@\0SO��s� {��@k}��FXS�b8��=��_����l�\0�=�g��{�H��yG���� s�_�J\$hk�F�q������d4ω����'���>vϏ��!_7�Vq��@1z�uSe��jKdyu���S�.�2�\"�{��K���?�s��˦h��R�d��`:y����Gھ\nQ�����ow��'��hS��>���L�X}��e���G��@9��퟈�W�|��Ϲ�@�_��uZ=��,���!}���\0�I@��#��\"�'�Y`��\\?��p��,G����ל_��'�G����	�T��#�o��H\r��\"���o�}��?��O鼔7�|'���=8�M��Q�y�a�H�?��߮� ���\0���bUd�67���I O����\"-�2_�0�\r�?�������hO׿�t\0\0002�~�° 4���K,��oh��	Pc���z`@��\"�����H; ,=��'S�.b��S����Cc���욌�R,~��X�@ '��8Z0�&�(np<pȣ�32(��.@R3��@^\r�+�@�,���\$	ϟ��E���t�B,���⪀ʰh\r�><6]#���;��C�.Ҏ����8�P�3��;@��L,+>���p(#�-�f1�z���,8�ߠ��ƐP�:9����R�۳����)e\0ڢR��!�\nr{��e����GA@*��n�D��6��������N�\r�R���8QK�0��颽��>PN���IQ=r<�;&��f�NGJ;�UA�����A�P�&������`�����);��!�s\0���p�p\r�����n(��@�%&	S�dY����uC�,��8O�#�����o���R�v,��#�|7�\"Cp����B�`�j�X3�~R�@��v�����9B#���@\n�0�>T�����-�5��/�=� ���E����\n��d\"!�;��p*n��Z�\08/�jX�\r��>F	Pϐe>��O��L����O0�\0�)�k���㦃[	��ϳ���'L��	����1 1\0��C�1T�`����Rʐz�Ě����p��������< .�>�5��\0���>� Bnˊ<\"he�>к�î��s�!�H�{ܐ�!\r�\r�\"��|��>R�1d���\"U@�D6����3���>o\r����v�L:K�2�+�0쾁�>��\0�� ���B�{!r*H��y;�`8\0��د��d����\r�0���2A����?��+�\0�Å\0A����wS��l����\r[ԡ�6�co�=����0�z/J+�ꆌ�W[��~C0��e�30HQP�DPY�}�4#YD���p)	�|�@���&�-��/F�	�T�	����aH5�#��H.�A>��0;.���Y�ġ	�*�D2�=3�	pBnuDw\n�!�z�C�Q \0��HQ4D�*��7\0�J��%ıp�uD�(�O=!�>�u,7��1��TM��+�3�1:\"P�����RQ?���P���+�11= �M\$Z��lT7�,Nq%E!�S�2�&��U*>GDS&����ozh8881\\:��Z0h���T �C+#ʱA%��D!\0�����XDA�3\0�!\\�#�h���9b��T�!d�����Y�j2��S����\nA+ͽ��H�wD`�(AB*��+%�E��X.ˠB�#��ȿ��&��Xe�Eo�\"��|�r��8�W�2�@8Da�|�������N�h����J8[�۳����W�z�{Z\"L\0�\0��Ȇ8�x�۶X@�� �E����h;�af��1��;n��hZ3�E����0|� 옑��A���t�B,~�W�8^�Ǡ׃��<2/	�8�+��۔���O+�%P#ή\n?�߉?��e˔�O\\]�7(#��D۾�(!c)�N����MF�E�#DX�g�)�0�A�\0�:�rB��``  ��Q��H>!\rB��\0��V%ce�HFH��m2�B�2I����`#���D>���n\n:L���9C���0��\0��x(ޏ�(\n����L�\"G�\n@���`[���\ni'\0��)������y)&��(p\0�N�	�\"��N:8��.\r!��'4|ל~����ʀ���\"�c��Dlt����0c��5kQQר+�Z��Gk�!F��c�4��Rx@�&>z=��\$(?���(\n쀨>�	�ҵ���Cqی��t-}�G,t�GW �xq�Hf�b\0�\0z���T9zwЅ�Dmn'�ccb�H\0z���3�!����� H��Hz׀�Iy\",�-�\0�\"<�2���'�#H`�d-�#cl�jĞ`��i(�_���dgȎ�ǂ*�j\r�\0�>� 6���6�2�kj�<�Cq��9�Đ��I\r\$C�AI\$x\r�H��7�8 ܀Z�pZrR����_�U\0�l\r��IR�Xi\0<����r�~�x�S��%��^�%j@^��T3�3ɀGH�z��&\$�(��q\0��f&8+�\rɗ%�2hC�x���I��lbɀ�(h�S�Y&��B������`�f��x�v�n.L+��/\"=I�0�d�\$4�7r����A���(4�2gJ(D��=F�����(����-'Ġ�XG�2�9Z=���,��r`);x\"��8;��>�&�����',�@��2�pl���:0�lI��\rr�JD���������hA�z22p�`O2h��8H��Ąwt�BF���g`7���2{�,Kl���߰%C%�om���������+X����41򹸎\n�2p��	ZB!�=V�ܨ�Ȁ�+H6���*��\0�k���%<� �K',3�r�I�;��8\0Z�+Eܭ�`������+l����W+�Yҵ-t��f�b�Q��_-Ӏޅ�+�� 95�LjJ.Gʩ,\\��ԅ.\$�2�J�\\�-��1�-c���ˇ.l�f�xBqK�,d��ˀ�8�A�Ko-��������3K��r��/|����/\\�r���,��HϤ�!�Y�1�0�@�.�&|����+��J\0�0P3J�-ZQ�	�\r&����\n�L�*���j�ĉ|�����#Ծ�\"˺���A��/���8�)1#�7\$\"�6\n>\n���7L�1���h9�\0�B�Z�d�#�b:\0+A���22��'̕\nt���̜�O��2lʳ.L��HC\0��2���+L�\\��r�Kk+���˳.ꌒ�;(Dƀ���1s����d�s9�����P4�쌜��@�.���A��nhJ�1�3�K�0��3J\$\0��2�Lk3��Q�;3��n\0\0�,�sI�@��u/VA�1���UM�<�Le4D�2��V�% �Ap\nȬ2��35���A-��T�u5�3�۹1+fL~�\n���	��->�� �ҡM�4XL�S��dٲ�͟*\\�@ͨ��Y�k����SDM�5 Xf����D�s���Us%	�̱p+K�6��/���ݒ�8X�ނ=K�6pH����%�3�ͫ7l�I�K0���L��D��u���`��P\r��SO͙&(;�L@��ψN>S��2��8(���`J�E��r�F	2��SE��M��M��\$q�E��\$�ã/I\$\\���ID�\"��\n䱺�w.t�S	���ђP��#\nW��-\0Cҵ�:j�R��^S���8;d�`���5Ԫ�aʖ��E��+(Xr�M�;��3�;���B,��*1&����2X�S���)<� �L9;�RSN����gIs+��ӰK�<��s�LY-Z�:A<���OO*��2v�W7��+|���˻<T���9�h����y\$<��#ρ;����v�\$��O�\0� �,Hk��-���Ϛ\r����ϣ;���O�>�����7>��3@O{.4�pO�?T�b���.�.~O�4��S���>1SS��*4�Pȣ�>�����3�\0�W�>��2��><���P?4��@��t\nN����A�xp��%=P@��C�@�R�˟?x��\n���0N�w�O?�TJC@��#�	.d���M��t�&=�\\�4��A��:L����\$���N��:��\r��I'���A�rግ;\r�/��C���B�Ӯ�i>L��7:9�����|�C\$��)�����z@�tl�:>��C�\n�Bi0G��,\0�FD%p)�o\0����\n>��`)QZI�KG�%M\0#\0�D���Q.H�'\$�E\n �\$ܐ%4I�D�3o�:L�\$��m ��0�	�B�\\(����8��通�h��D��C�sDX4TK���{��x�`\n�,��\nE��:�p\n�'��>��o\0���tI��` -\0�D��/��KP�`/���H�\$\n=���>��U�FP0���UG}4B\$?E����%�T�WD} *�H0�T�\0t������\"!o\0�E�7��R.���tfRFu!ԐD�\n�\0�F-4V�QH�%4��0uN\0�D�QRuE�	)��I\n�&Q�m�)ǚ�m �#\\����D��(\$̓x4��WFM&ԜR5H�%q��[F�+���IF \nT�R3D�L�o���y4TQ/E��[ў<�t^��F��)Q��+4�Q�I�#���IF�'TiѪX��!ѱF�*�nR�>�5�p��Km+�s��������I���R�E�+ԩ��M\0��(R�?�+HҀ�J�\"T�D���\$���	4wQ�}Tz\0�G�8|�x���R��6�R�	4XR6\n�4y�mN��Q�NM�&R�H&�2Q/�7#�қ�{�'�ҍ,|����\n�	.�\0�>�{�o#1D�;��?U��ҕJ�9�*����j����F�N��щJ� #�~%-?C���L�3�@EP�{`>Q�Ȕ��%O�)4�R%I�@��%,�\"���I�<�����\$ԉTP>�\n�\0QP5D��kOF�TY�<�o�Q�=T�\0��x	5�D�,�0?�i�?x�  �mE}>�|����[��\0����&RL���H�S9�G�I��1䀖��M4V�H�oT-S�)Q�G�F [��TQRjN��#x]N(�U�8\nuU\n?5,TmԞ?����?��@�U\n�u-��R�9��U/S \nU3�IESt�QYJu.�Q��F�o\$&���i	��KPC�6�>�5�G\0uR��u)U'R�0�Ѐ�DuIU�J@	��:�V8*�Rf%&�\\�R��MU9R��fUAU[T�UQSe[��\0�KeZUa��Uh��mS<���,R�s�`&Tj@��G�!\\x�^�0>��\0&��p�΂Q�Q�)T�U�Ps�@%\0�W�	`\$��(1�Q?�\$C�Qp\n�O�J��X�#��V7X�u;�!YB��S�c��+V����#MU�W�H��U�R�ǅU-+��VmY}\\���OK�M��\$�S�eToV���HT��!!<{�R��ZA5�R�!=3U��(�{@*Ratz\0)Q�P5H؏���հ�N5+���P�[��9�V%\"����\n����G�SL�����9�����l����\rV�ؤ�[�ou�UIY�R_T�Y�p5O֧\\�q`�U�[�Bu'Uw\\mRU�ԭ\\Es5�K\\���V�\\�S�{�AZ%O��\$��F���>�5E�WVm`��Wd]& \$�Ό����!R�Z}ԅ]}v5���ZUg��Q^y` �!^=F��R�^�v�U�Kex@+��r5�#�@?=�u�Γs���ץY�N�sS!^c�5�\$.�u`��\0�XE~1�9��J�UZ�@�#1_[�4J�2�\n�\$VI�4n�\0�?�4a�R�!U~)&��B>t�R�I�0��_EkTUS��|��Uk_�8�&��E��(‘?�@���J�5���JU�BQT}HV��j��Qx\ne�VsU=���V�N�4ղؗ\\x����R34�G�D\":	KQ�>�[�\r�Y_�#!�#][j<6خX	���c���#KL}>`'\0��5�X�cU�[\0��(���Wt|t�R]p�/�]H2I�QO��1�S�Qj�Z����H���m���)d�^SXCY\r�tu@J�p��%��M������?�UQ�\n�=R�ar:ԿE���-G�\0\$��d���]�meh*��Q�Wt��c��`��A�Y=S\r���	m-���=Mw�H�]J�\"䴏������f�\"�{#9Te����M�c��N�I����D������U�6��g��2��ݝ�e�a�L��Q&&uT�X�51Y�>����S�֊Q#�I���j�\0����W�P��?ub5FU�Ln�)V5R�@��\$!%o��P��'��E�U��P�-����B�p\n�F\$�S4�t�UF|{�q�ȓ0���Umjs�������\$�ڛj��c�ڐ��֫��aZI5X��j�26��&>v��\n\r)2�_k�G��TJ��eQ-c�Z�VM�ֽ�z>�]�a�c��c��`t��H��j�6��+k�M�\0�>���##3l=�'���^6�\0�èv�Z9Se��\"���bΡ�B>�)�/T�=�9\0�`P�\$\0�]�/0ڪ��䵏�k-�6��{k���[�F\r|�SѿJ��MQ�D=�/�WX���V�a�'���a�to��l冶�Xj}C@\"�KP����om�3\0#HV���v��~�{���?gx	n|[�?U��[r�h��G�`�3#Gk%L��\0�I�`C�D��	 \"\0��ŧ��#cN�6�ڹf���zێ�;Ѥ�eeF�7�/N\r:��Q�G�9	\$��I�ռ��]��T��WGs��dW�M�I����f�Bc�ۤ����!#cnu&(�S�_�w��Sf�&T�Z:��0C�S�LN`ܳYj=��>Ų��Z!=�rV]g��	ӣr���Xl��-.�U�'uJuJ\0�s�J�'W%���\\>?�B��V�j4���J}I/-ҝrRL�S�3\0,Rgqӭ��Tf>�1��\0�_���\\V8��Z�t��c耆�<^\\�ll�j\0���T�]C��w�ΓzI��ZwN���pVW�jv�Y�>�2�	o\$|U�W�L%{toX3_���R�J5~6\"��Zl}�`�kc����eR=^UԎ��1�ѽw7e�d��v��b�=��\0�f��,��m�)��Gp��-Ӽ�)9L���>|�� \"�@���5�`�:��\0�,��t@��x���l�J���b�6������a��A\0ػAR�[A���0\$qo�A��S��@���<@�y��\"as.����V^��讥^�����\0��H���[H@�bK����)z�\r����=��^�z�B\0�����N�o<̇t<�x�\0ڬ0*R��I{��^�E�:�{KՐ�1E�0��Y����/��c��\"\0��4���F�7'���\n�0��`U�T��?MP���l��4��r(	��Z�|���&��t\"I����L�w+�m}����Wi\r>�U__u��63�y[�8�T-��V�}�x��_~�%�7��{jM�o_�E�����~]�P\$�J�CaXG�9�\0007Ń5�A#�\0.���\r˴��_������%����\n�\r#<M�x�J���|��2�\0��;o�^a+F���笀Lk��;�_���#��M\\����pr@��õ�����OR���~z��A�NE�Y�O	(1N׉�R��8��C�����n?O)��1�A�Do\0�\r�Ǣ?�kJ��\"�,�OF��a����-b�6]PS�)ƙ�5xC�=@j����L�����L�:\"胻Ί�l#���B�k��������@��N��:�>�|B����9�	���:N��\$��S� �CB:j6����ΉJk��uK�_�W�͢ØI�=@Tv��\n0^o�\\�Ӡ?/��&u�.��_��\r��C��+��c�~�J�b�6���e\0�y�ѡ\0wx�h��8j%S���VH@N'�\\ۯ��N�`n\r��u�n�K�qU�B�+�f>G��\r���=@G���d���\n�)��FO� hʷ��ÈfC�ɅX|��I�]��3auy�Ui^�9y�\no^rt\r8��͇#����N	V��Y�;�c*�%V�<��#�h9r�\rxc�v(\ra���(xja�`g�0�V̼���Q��x(���glհ{��gh`sW<Kj�'�;)�Gnq\$�p�+�Ɍ_��d��^& ���D�x�!b�v�!EjPV�'����(�=�b�\r�\"�b��L�\0���bt�\n>J���1;�����ۈ�4^s�Q�p`�fr`7���x��E<l���	8s��'PT��ֺ�˃��z_�T[>��:��`�1.���;7�@��[��>��6!�*\$`��\0���`,�������@����?�m�>�>\0�LCǸ�R��n��/+�`;C����\0�*�<F���+���q M���;1�K\n�:b�3j1��l�:c>�Y���h���ގ�#�;���3ֺ�8�5�:�\\��\0XH���a�����M1�\\�L[YC��vN��\0+\0��t#�\$�����!@*�l��	F�dhd���F���&��Ƙf�)=��0��4�x\0004ED�6K��䢣���\0�nN�];q�4sj-�=-8���\0�sǨ���D�f5p4����J�^���'Ӕ[��H^�NR F�Kw�z�� ��E����gF|!�c���o�db����x�\0�-��6�,E��_���3u�p ��/�wz�(��ex�Ra�H�Y�ce��5�9d\0�0@2@Ґ�Y�fey��Y�cMו�h����[�ez\rv\\0�e���\\�cʃ��[�ue��NY`��ۖ�]9h姗~^Yqe���]�qe_|6!���u�`�f��J�{�7��M{�Yه��j�e��C��S6\0DuasFL}�\$ȇ�(��Mb���Ƥ,0Buί���т2�gxFљ{�a�n:i\rPj�e��r�r��G�BY��M+q��iY�d˙�`0��,>6�fo�0���o�� �Xf����\0�V�L!��f��l��6� �/��1e��\0�>kbf�\r�!�uf�<%�(r˛�a&	����Y��!���mBg=@��\r�; \r�5phI�9bm�\$BYˋ���g�x�#�@QEO��m9���0\"���!�t���ˉ��Ї�O* ���\0��>%�\$�o�rN&s9�f��4���g��~jM�f�wy�g�y�\\`X1y5x����^z�_,& k���|����1x��A�6� \n�o蔻�&x��gg�{r�?緛�-����|t�3�����}gHgK�9����J�<C�C��1��9�7��g����h6!0H���cdy�f��DA;��9�T���0��\0�p�����!� 6^�.�S²?���E(P�Έ .���5��h���EPJv��.���+�\$�5��>P+�?~��g�6\r��h��p�z(�W��`��\"y���:�FadŬ�6:��f��i\0����A;�e�����^��w�f� >y�����`-\r����\0�hr\r�r�8i\"_�	����9�CI��fXˈ2���\"�Ţ����h�L~�\"���%V�:!%��xy�izyg�vx�]���}qg����Zi��|��`�+ _�g�����٣������譞6PA�ʀ\$�=�9�����h��|p��������!��.�!�����i�^���iˢ�8zVC����Z\"����(�����9�U)��!DgU\0�j��?`��4�LTo@�B����N�a�{�r�:\n̟�E��8æ&=�E�*Z:\n?��g���̊��h��.����N�5(�S�h��i2�*c�f�@����7��z\"�|��rP�.ǀ�L8T'��k���:(�q2&��ED�2~���ر�����9���v���8������@��^X=X`��qZ��Q�֮`9j�5^���@竸�n�qv����3����(I6�j�dT���\\� ��3�,��h�k�3�(�3���P�u�V�|\0阮U�k;��JQ���.��	:J\r��1��n�BI\r\0ɬh@��?�N�\nsh���\"��;�r~7O�\$��(�5�R���	�ʽj����FYF��ܔ��~�x޾�f��\"�vۓo��˨��º#��a�����P���<��h�-3麝/G�x����n�i@\"�G�?��,�Zp�xX`v�4X������[�I��7�åXc	��!�b�}�j�_��9�5qti�6f������ٞ5���Fƹ�iѱ�pX'�2��r���0�ƺ��D,#G�U2��؏�I��\rl(�� �챣��=�A�a�쩳-8�dbS����4~���H;���0�6��b��{��޺R���s3z�����N�ބ��`�ˆ+���4<�^a�y���	}r���y������k�&4@��?~���cE����@�LS@���z^�qqN��</H�j^sC�`��sbgGy����^\n�N�\n:G�N}�c\n���� +���=�p�1��N�TB[d������Ћ��ܹ�`�n�oj;�jěwh����c9��p̡[y4���05�͋N��+ο��`Xda��/zn*�P�����#t�赸~�9W�	�V��~=�#��n)����	2��;�j:��J�k�C�!>x��5��==�2���.��|�'���[��'�;��v�������������;:SA	�&�[�me���n������˵���<��6ma�=Y.神��:g����腀����;�I߻x�[��I�J\0�~�zaY������wT\\`��V\n�~P)�zJ�������Q@��[�{rʉ�D�B�v��|i-�E��K�;^n�{���:Nh;���2��ƀp�Ѵ6����罘9�9����X�hQ�~���iA�@D �j���}�ozLV���ѳ~���	8B?�#F}F�Td����e��zc��F���g�7Η���� 6�#.E£����£��S�.J3��5��Kɥ�J���;���n5��:yS��C�voս.�{��	d\\0�?W\0!)�'����Eg�;�+��\0�Y�Nt�bp+��c�����\0�B=\"�c�T�:B������c��������P�I��D��V0��!ROl�O�N~aF�|%�ߺ�����)O��	�W�o����Q�w��:ٟl�0h@:���օ8�Q�&�[�n�F��p,�æ�@��JT�w�9��(���<�{�ƐO\r�	���ڂ\$m�/HnP\$o^�U��\"���{Ė�<.���n�q8\r�\0;�n������硟�+�޳3��n{�D\$7�,Ez7\0��l!{��8��x҂�.s8�PA�Fx�r����Qۮ���1̅�p+@�d��9OP5�lK�/�����\\m����s�q���v�Q�/���	�!���z�7�o��Eǆ�:q�V�5�?G�HO��O�\$�l��+�,�\r;�����~�Ač錳�{�`7|��Ă���r'��Ji\rc+�|�#+<&қ�<W,��>��^�P�&n�Jh�e�%d������C�i�zX�A�'D�>��Έ�Ek���@�B�w(�.��\n99A�hN�c�kN��d`���p`��%2���3H��b2&�<�9�R(���t�TH�	�z��'�� �o���>4?�\rZ�w�ӂ��4�`��Ї鍆��N���Ӏ�'-I����0(S�r�w,�����K�r��'-2Hlo-�U����_�'W#'/��H֟���j6�̉�����ȫ��\0�<������j1�E�Q�T�T���r�Bcm�16�͈g٫:w6ͯ�h@1�I:������2�p�L/����w�:�ő���K<��E<��J�76Ӏ�s�.̲sZ��/\$�AsEyϜ�r�r:w?Չ�!�?���Ǚ�Z��M�9�՝\0��1?ARͦ%�7>�M�ARr}s��r)\\t-8=����ЎU��,WOCsՆ��#w�5��ERlM*�D��1��>]��gK��V�\n�\\���s�܇8͹seͧ9��so�~����w4x�����f@���D��9����6��\0	@.���@�9\0�C;K��y+�J��٥��u<\\�`�c{Ӌ�E�>�y��J=l����/�-�7����Z46�uC5��P�Ω�RV�������ʳlV��aNx�`մ?U�7(HP�}jV�J�zNQJ�S����s-gQ!a�V�_SwR�O�3am�ZXwZ�o�'�wa���O�oZ���!�[\n<�Z��O�Ҷ'��Omo�[��a�=Q��>�:��T�\n����\0�=��m�j��AT�R�bu(�I���:��\$v�W�����u�S�\\V8��v�\\���g!Mж�u��_�&�is�\\C�R�VM�]tX�T7\\UoT��o_ԯݛS?a�l�S�-LutZGe���i`	}XZ�i}Q�yW[i��T��Yo���(ZE\\�}nٍi�f��ڋ��W�d�%T�pu3u�T�f5)v��]�UR3VEY]�X�\n�^��VqS�S�}X�iGf��v>�S��v�JMQ��vڕ�����\\�g]�QYE��ݵ#1V�l5U�EK]��\0���S��U?\\�BwS�U�7���mZ�V5\\��Wf��է[�eUr�{G\\��U��,�����W�[]x��V�j5mT�V�j�~u7�\0�V�U��'t��w?ms�����5V��vݏq}����u-Uq�]ݗc]�W���]Tt:�f�M�k���e]�[-p}^�I[�XD���Y�V�d���O]	seN����Z�WY�[�t��V?�3�ǵ�M���ݙ`��t^w�d�:qT�L�@@>]�j\rF�qv��-Lv�G�Kwi�LwIPMo��ǹMgv���[��Uss��~	���w:B�A���NE�{�!-��d���o\0��}&����hX��A��5�%٣fzL�H�5d�� Y�_%�v�ә!m��]������%������=B�>E [#^}�hYF�a���>{�gS���p[�F���Da�6n�����x9��8L�I㈫N�a=�S�@�bPk�.��N��H��l\0��:���2#�Θ;��v�O}�9ik]	&�{�� �����2|a��&�������Q��������)��oف�Ǹ:�&.\0�5q\0J�L��64hy�3�ޢ���a�ރ��Iz��O�����ﮈ\"�yB�ʳ{�3�%�5r(m������x.7r�b%���^�e�M���2�\0x��!�b}.��Y6\$qS��\"^|xE����a�������Xǡ5�9��'T�R	�c9���W�1���AΔP��؏h6'�o�-���p��T(\nn\r�Ő��1���R�RUg�������x��Pe#��*��kT<�<�>b;��\0�����gL�.�<k�Zv������z���8~��y7�Y��ȁ��7w��Odn�>�<���E�3��wS�ۆ�@��� o�W�1����Һ�z�e�޽��1��z�\0f=��c㊤g��{��>n�p\0���Α:H�Bn�6F��B�r�W=��C>M.1~@3�G�9�8�q<S�|�Y�8QP��`L[���qz�۫P���N�<{_-ٮ�d�O��d-�NB7��4��B�N��.V���9ƨ�Q�3��{IcP\$���h��<R yy��?��G��:n�����g����;Ah!����&��+>�ˀ�;M�ˌ�	������6S�N��ڌ=#����`�T�#+�n�;��r,�����X|#��\r�#���?\n�D>�|V�S����eϗ~J�m99��\ns�{S|r],~�˹��� �q�I�?\"|w���%|�j�\0rE�,kSn�����qƕ�d8B.��1����\"��/|���؃]�������E�Ϝ�N�l����x��I��� Ic�Ÿ.|\$8D��F������P�K��3��\\j��xU��C/��җ�A{������e�����������ܾ�����\rp�U\n�՟Wlo­Y�{����`]'���s���/|�o����3���r��}��;��[�n��������O�M7���ߣؼq��q(��_l�q�s�N��y������;�i�g�t����:�����ՙ�qk�����{���?z��������Mȗ�o��'�j������c�y�߄���g��gk�w��f8�Vc�7fA��Y���+Kx�=�gKAk�T,95rd�+�G����ٯ����[��%��A�w柞�����7���ଅ�%��{�m��8%_��m��q��V�˨_���%�!�E���i�~���h��~��C�߭~���%�������_�������rLkD�y����~�?p1O!?��v�\\��Pm�\"��<������E�6� �E��V����zk����9�z����~�/��պ��!Q�>��O��Nm��3r�� F��l���e;�M�߷���Ͻ�_a��!~C��f����b}3� K�f���. 	��}.����DX	i5�|��?��=\0��?�?��?��@��Õ��fu~a�^��n��y�Q;�q�����)�s�S�,\"G�\nu%��U�Y�AKl\n��B�I�86VCcO\0�`}.x���,-N�@~��T�G����'��d�J�����y1�zl��æf�g����AB�a�!��M\\<�gʃ�z4ƿ��@/��C�Â�@�	�Qq���)��x��/�.7inD�#=��� *79c�F���d2(��.�V��3����\$g`�A᧋rl|�m����b��/�qE���ô!�bU@��9i�;pp�d���פ=�1�y�x�x�	�=�v=��(v��s_��Bo�ɂ�ց#�K\r n����\\�# �f�PX�u-3&�	��J&,F�(9��v�0�&@khZ�y�g�Cԋ�z ��Á�hi=�s9T�� eT>g��3�d�tF��2b&:��\0�P���B��-�Q��8~�LS�M���ڷcg���Th'�f(���\$�.E���VL����A�I���ߌ���r���g�\r���0�����T��1P`1�d�����\r�4���=6@F���� F���=�ɂ6�A���>�N�AV�	���(\$�A/������;����?�g�f^	�\n�&�KO��n�{]���g˛�8�c��ў���Ϸ�����\n��7L����t:�Ѡ�hF�VO\r��J�)b�(\"OB�m�	o��\$]T�SH�Z^��K����w�\\[A9('�لcۑ���b0���� K�����srB�x\n�*Ba�z6o�\ry&tX1p'���^�M��<�Cg�`�4�8GH��zd?gX��.@,�7w��۞:+�TiUX16��L��s�:�\r�L�6�����f�r\r`�t��67~g�x�gH9�J��O=-\$�4?r٪4����O���:��z��{��D`����21�F�ܵ��(D�M��;����&����́��ڭ��U>�I�6��c���߸@\r/�/��ԕ��_H��\n7z�� ������7�a�ɻ[9D�'����}B��O�R��ݟ�B#s��]z!(D���@L^��	��x��@o��u�O����D���!�e`\na�k>�0`����-*���8E�Z6=f��%����c㛰�K=���F�\r���Sh�yN�[v*v�\r���@�#߸퉁�Ah*�L\$���A�A\\�����%�*	��p�\r*==8�\$W�\r� [��Jx0y��Z�+&Y�HA~A\n,\\(��p�!F����<6S�&IP`6Xz�+�df�\r��J£���i�s�+�&5��/rE���M^\$R(R�Q��Ew3��lH*m\0Bq�a��r��LB����Q��z6~l���B��\rI®G��XٸXVbs�mB�H�����c�_K�\$p�-:8��Nj:�х��-#�F�	\0�aiB�s\\�)�<.�!��\\��N��bIw8�͹t���PjW�`���y\0��&0�i?���Ҕ:�Ia)=��C�,a&�M�apƃ\$�I�IFc���\0!���Y�xa)~�C1�P�ZL3T�j�C\0y����`�\\�W��\\t\$�2�\n�+a�\0aKb���\n��]�C@��?I\r�HヮKs%�N����^���9CL/��=%ۨ�h��:?&P��EY�>5���n[Gْ�%V��*�w<����gJ�]�*�wd�]�B�5^�֢�OQ>%�s{�ԅ畫;�W����z�Gi���*��Rn��G9�E����,(u*��Ւ×��X�s��R���:�5�;��)�R���N���vK�(�R��M���b����_�{�F<<3�:%��HV�YS\n�%L+{�o.>Z(�Qk���N�!��,�:rH}nR�NkI		��[���ӧg��֤;mYҳ�g�%�9V~-J_��g�����\\�ɮ�Q\n��!�t�\\UY-tZn��d:B��ʽ�*�]')t���w���ɫ[BUm*�r4�ؖ�*yv���vZ�չ+GH��Zn�P�܅|\nT� %#\\�AX\0}5b+w�r�Xwܲ1u��%Cg=I��v`�cr�e�0`..<���h�+�H̝^\\j�yF��%�]�B�\0��r��+�>�%Zx�� �%C.����`Vn�1KS���k\r���X|��[�;�6H	U@�D:޻Mj	Ε��?��]ڤ��b�A+��G�\0thxb��L`���64Mޛ��Y#�hfD=e��w=�c�+H��:�.%��^\$�DZrAzj�fLl�7�o�����\0��-���Ed�މyz'V ��Ӟ�W�	Z��K�+�d(A�fy�P?�xR�^h���'���A\0���:p\r�d(V�����d�t	S�FcHȟ��]r�r�CHY	X_�/f���ͽ 4 7e�6D�{,�����<<Z^��j\"	�\n+ƀM�Y9��A�(<Pl�lp	�,>Ѐ�{E9�&�Gh�h{(���Agg8�(@�jT�n�g�Z��Ű�J����x�����@ic��Ջ�(p�'oJ0MnĀ�&���\r'\0Ց��\rq�F�4���)��cL���_�oJ�}5��c�o���|6�m�}Q���4Q��b����[�x�m( �&�@�;�+򘥮��f|I����R�48� {	`���k`u�r`��W㸱`\"��)fI\n��;�8Zj���g�~��AΈ�!j��%��T��E\\�\r3E�j�j��FXZ	��Ay�kH��Xd��gCQ�����΀�0�d����������t�	��zk�`@\0001\0n����H��\0�4\0g&.�\0���\0O(��P@\r��E�\0l\0��X��\r��E��8�x���@�ԋ�\0��^���z@E���\0�.�^��Qq\"�����Y��D_p&���3\0mZ.Pp�\r�Eϋ��s��v\"����0�`��w���,���_�`\rc���/�]x�q���3\0q�.p��q���\0002�_�i���ъ��E�\0a�1�b��wJ \0l\0�1,`��1y\0�9#?0T^��q��\$F6���/\$d�����FD�yJ0b��\0	��W��\0�.�c�{c E�\0s�3l]@\rb�F�\"\0�2�`����\"�7���/�\0������a	^04e��Q{c<�ь�j/_��ѐc\0001��*28BA��\0000�xƔiؾ1��F�5�0ljH���\"�F�30\\_��q�\0�f��T�l_0т�BEČ#3�]���s�ƽ���64_X�1�\0ƽ����d`��`\r�S�_JMV/f����1\0005I6tf���4F����34f����F-���6�d��\"��4�k��\$h�±�#E�̌�\0�6�_01�c@F���/d]X�Q�#G\n���5�g�q��EF\n�m\\�Dn��q��YFv�1/4`��q���4�=�8b�q|�\0004���3�mX�1��e��\0��.�\\��Q�cI�	��.7�\\x�`\"��\0i^3�(籒��\"�Ev4l_��q��\$F���oȾ�\r#UE䍩^9�t�������.�\0�3|r��1�\0����69l^x�ѼPF-�]\n0�v��Qy\"�G��2,sx�Qq#�F+�\0�/Di��q}���8�[6,j��\0cm�o��N5�eh�Qv��GL��H<T_�Q��?Fɋ�..\$f���y�E��C2�l��1s#�E�D�loh�Ѳ�j����8�e�ű�b�F!���9�`x�q�����C�7�hx�٣�Ŏ��7�^x���K<�h���	,u�鱑�G)��;lu��#�Eߎ��<�k���b���\0sR.�w�ֱ�#z�~�w�2|x(����\0001�'�:�v�\0001��G挿�?|`������� .2�X��#�G��8K�@<z�1��ƹ�\"9|j�����	G��/�6�q�����G��s�7�/\0001�b��ߍ��:|�8�Q�#~F��W�4�g���#<F\r�� �2��X�Q�#�Fv�k�7�x�1�#��Ǝ��@�rh�����F���Z;�f��rc�y��!\r	�_x�1�\"�H1���0Tw�ٲc\rF�1 \n8d�X�r���Ԍ��2Db���{d4H��rA<~��1�dBHI�[J?������q�~�k�0�t���#�F\r�#�0\\h��\r�G����Ett���c7�U��!�=D_���cN�\0�y�6a��� Fg��!v1�q��1��KǇ���@�e��ѳcGo��\n/���Ʋ�E��\"�3t`���#cH���<�c��q���F�%�?Tb蹱�d)��� r0����qc�E���>3\$tyQң���E�Cl`9)�VFH�MJ7�f���\$HHQ�� ;�ri�7#F��-F�H�Q�#\0G��!�1�^��&4�vG&��7�g�ృ\$\0G�\rr/�d�R�(��s6@���'RA�Ǭ������&�����g\0k z=�|Hٱ������^J�]��sd��,�\$�1����<cqǦ���J�_���b�G��QvJ���ر��H5��F�p��Ic��[���@�r���vH�%��3D����c<I\$�M.d��r1c=F���.4�c��2b�G.��!�L|{X�ѳ�{I��NF�dx�qsc��ݍ�#�E�a)��#�G����J�m�.��\$=Gh�AN=�s��ŤE͑G�G\\a1�0��H���F.tg8�ä[����Idn���8�F����.T����F3�E�6riq��sF���6�x�r���L�=nFT��od��>�-�3�|�2\$�0��= �:�xc�H�I\"NP\$b��Q�\$F�� �DĂ�����}F�%�?�(����G�3\$�O\$^x�2T������0���R���#�D�:��E�|i/2��XG����8���-�\$H�v���=d�� ��`���:lax�����I���:�X�RJ����R�mx�J#\nGG�9!N���{cI���&�I���R=��I\r��&j:�8��g#�H��'3�_x��b��H}��>7����c��ُ\"&K<x��2���H���\"6@db�뱭e;�)�!�.�]�/�d���m*f6,v��ɪ����L��(q��AI8�7d�9Ttc����UL�X��%H��I*z:�|IXqs��-�B���q^(�R��aq(~e���9J�U�+-eq*nT��>�\$�ѫer��α�p\n�ռ�\$es+�V��I���b��eq:�#]�cc�7r\n�f,gY��TC�%��	�}�\0���\\*�EWP�a�:�E�,&W��p)���xl�M���3\0t\0�/Iip�D'\0	k\$T��F��]f��dM�ȀK\$���H(@�ɔ��(�z�nWҤ�_�Mݔ*�\0�e�lF�^H	W*B���ZPe��֘��R/�dRRʅ\0Ku�,yH)�\"S�XI'��Z�=�L�R�3����\n�'�[k��6@;}R���I����_�)�w�[�� �\n���n����ʓbBr�l,\$v����԰����H����\\���s*����.Qt�B��d�b���@�?3�S�`a@�K�\\.����~�f���)����,?|&ӶK���Z9.�X�+S��|����\0Pʼ��E���e�/�\0V��^K�\0\n-	:��Sز)ת�0j�9TX��B���K\"�ů��²,2�'�2����P,�x���p���Kꗪ����\"�D�#TV��D��1�Ao;ؕ�/9TH%V`WJ<9��aeʰ�K/V^/�Q���\nB�Z\"9���XүM~\$�5����\$0d�I�U���2�^X\n�*�E7I\nV3���+�a��Ii��N�KK�g0�a���z*�V���#bJyMҦe��Z� �V���`����U1�C��.\rF��-j�&LU�p�9s�鹊+Q&1��Rm��ӱgZ���	,.XryZ첰0���3�2�A1�ւ�e�N������(?Al ��,N�ue��\$|r��_%��E05E}�\$���X2�%�Z�e �\n\";<9a�h㶥�a]���8���*�u����L����dR��0����+�Qm.�,G����M��_�2�e�dB��ݸ,�S�2��>U���԰�4vl�~e2��2�eĵ�Yg2nf�=��\$�%��ٖ�Ffa�)����fTƶ�G���g2�W,[����X>)t�A]���R*�&Z��6j2|��\0��(�p	�9� ��uҪ�?��`n��-lZn�!H9����zL��9VLϹy��ݢZ�JhR��g�EfL�U��~`4�Y���x)\$B�QR#ÕS������,6i#�Y��,;C��r��i�&�X��]��\nw54�K�x�\n*&��T���W�������+SлqNc�y��IW��\0W5c��ɫ��&+����Vr�)����Kg����?� ����|�gR���hR�%K��)Z#�5�,ֵ�k�漻`��l:��LsC�[M�UB�6ld�ѓJ������1nl:���j���Lߖ�\0�h� *)�p/��ާ5\\�<9��V��/��ޫ�hT�dj��rMbx\n�]R��W�R� MaU�3=��`0�o��,Z���l��}��m�월�l����mL�S6�\\�tΙ���L���\\�%�J���K��7oѩ��ef�M���oC�Y��v慭NV�4=R��sJ������*h���hn��-m��4��4�y��H�M��|��is�U=����A\$ڭ�i�ϙ������>����p�p��Qf������q,��5s�UL���8}ݬ�٪���#�XH�����I����9U�8�c:�I���f����7�kl�5}��f�LY���N2ް�}&�	i���c,�I�3���R��6r�؉�3b��͍��6>lXY��f�L�)+�S,ى�*�el���U\"ed��\"Z��ږ�6�ZD�E9��%�΂�Y9rmt�E��'.M�[4��^��ɷ�;M�w�5���9���a��v+70l����d%��<��3�_<�lN���(�v+7YRl΅Ӫ]�.��4�I��)��=փN�T�]۹'U^�?�S���7�XC�ũӨ�1�u�9�E�ߙ�k�L;���Nh���S�qNXk;1[����LgpV�B�1_����gs����;�Rl��E���N�T�8�w,���s��1�Pxr�q���3���(��;�Z��	yӾ'{O	_���r�ȪMg|�I��92eL���f�O\rY��nk��u���SN�v9Vk�	�3ǧ.̛v9zyd�)����N�Y�&s\$���jd'6͔�Q<�V��)�e�+���:�ج�Yjt���p�u<��ʖ��3�]qM��Y:9X�S��gI�Ý*�m���C����v�G���R@�֯�jT�=��:�e���(\0_Vn�,?p�	3�'Π���������\r�����|\"�i��gT�n��P皤�\nӔ�q,�Sf�.Y��Q A��A�,Z��eS���sE���\r��v�T��Q�Z�\"p�I�s�UAϛ\0��vZ�}�r��K�tf�P�f9疮�{��^J���ς�������\n0%��NGګ*~l�D.���Ke��6�[,�%����O՘�-�~쵕����j��RO;��@	˨en�b_�%sK�Ŝ����Y����Y�0���L�W���jr�Ր��φ��!B����Pv��fwګ�����M�R2�2�z�4r�h;�#M@�}�\0�|��M�\0�=ځ=��f�-!�6p��g[P4��������C�[5:��\r�Ct��àu@�ۺ<��if��Nu��n[�!u8j{&9Ku�FQlR�i�(�C��A�䮙s4��\0Y��;f�B<�{�嘼R_I�~��6��|MWTA�]4�e@J�e�P|[���r5*���OΠ�Bt�)��%�-\0P�j�m	u�s�}И��Bi^��*��z�0YK.�`[�Y�2��Ы�|�XB�����(?З�.\$�l���,��X�D��\n��j�OD�->_<���֝��\0�������s�h\\����ea\\�\0��e䑙Y�`���7U�\"e��CYT���zt:V9P�_���a�ЕF�;݀\0M�����2�e��HC���Z�?�V��'����}c�Y�a�脬��?Qh8	�0�Q�CM`����6��,���J�eZ�Z\"G�W��u��u\r�>49�K���I%L����V9����։��Z�{VEO�X;�����o�agP�\$\n�RX@}!-Si��R���qz�	��ITH.���\nk\n��\ndϮ�T����>�\n���?�E�`��5D+f�?#z��IZ�7T[��Qs#�D���\$���P���I�	�3��*�:�9YI��H���H��X�0�D�!u7J��m��YB}E������简��r�8Q��\n}'P�S�	Q���������\$��`R�)^��(O�P\0�aK����m�3��\$H.��X�����)�V��`���9 �.�Y��18���eU��`X�9���	����\\Lc�j�IE N鍫��6�W�D�XB�	Z�:�|Ϥ:	E-P-�&���)����*���l�)P�u��y|R���Lh�.p���_*�QA��@ �?,Ƨ�Y��)t�ч�<��P*���j�VuQ�:2\0�L�?J����,TPHL���E%���\0��yP(Y�JZ���TH�X\r	�Q4�hO�;\\�vV�#��T�Ww��\\`��Oҡ��?�JR2��=�F��]����I5TMjI�9�,(ƤDv|t�)��Wy-�]z��e���a,pQ6\$�I-g=%�S�W#�TP�ܐ��)�T&]���X15j��B8���V�ӥ\n�em y���h�*������d�4ς�bd!0��gR�J\\� �Mt��1R\n\n���x�����.�_��u�+Ƽ�;���*4�θ)]�\\�l�(m\"�Q�nT���(*\0�`�1H�@2	6h��Y�c���H_���f�?��a��7=KKde�t�H��2\0/\0�62@b~��`�\0.��\0�v�) !~��JPĝT������������O�{t��\0005���/ீ\r���J^��0�a!�)�8�%KޘPP4��~�H����������\r+�Lb��/24)���GK�e0�e��S1�B�	-0jf���S�wLΙ�i�d ����L��\r1�h�ȩ�S ��MJJ�ht�)��+?L��e5n���|FH��MN��5�j�ɩ�SH��L���4�=T���D��Mn��6Zm@I@S`�)'���7f�z��Sz�x~OU1k����SF��MOU4�p�٣2\0000���7�6�k�#xSl�'K�7�7\nl���xSu�LR7�7�st��xS}�GM7�8*qt�#xS��OM\"7�8�u��)�ӏ\0����9�r�)�Sr��2��;���)��7��Nj�m/�x��ӿ�sNڞ:jy4���S��gO:1�=\ncT���Sͧ����;�{��Sȧ/ORH\r=�tT��Iݧ�O���\\zx4��S�M���>j|T�i�S���O�����~��\$l���O����}t��٧�O��z��*�%�]PP���vU\"��ݧ�K��@\no�j�H�;P�>��1���Fd�P.5Bظ��\r��3�uB�<�L#�<�QPE�Cʁu*\n�ۨyPN��l���\r�6��?K��mBZi�j�H��O2�}1J����M�_M��mD����&�K��Q6��Fzv���6ӹ��Qj��;j��j)�*����mEʌ�9Fd��Qv5eG�ɵd�Ԅ�EM\0+�D�\"j)SD�QҤpZf��Ƃ�mR&��H��U�ہ%�{Rv0m0z��䧟Lƥ@��'���ER�?eJ�>�ԝ��M���I����YT���R�/�Bʕ.�UT��YRΡ�L:�jNԅ��R���L��5ji&,��O�mJD�5,�9����Q����1�hTf��N����ޥQ�'��7��Lih��\rcjԝ��Sz�u��\0n�Ժ�g���9�@c��\rT�%L��A�fT��MT9uQ\n��)��U��S��uD:���j�U	��ƨ�Pږq�*�EڪKSb�l\\ڤ�F���ŪGTz�gJ��H�SF�	\"��Q:�1����;���RꦵL*~EߪoTҦ\\z������:���]Sꕱ����B��U�^J�uR*kE��	��T�Qt��R�g2��Uj��V\$��_��S��mPH�U\\��T��[Uʫ5Jhٵ\\��Up�����V�7a_*����=R�>\0I*����V��X:hU8j�T�KZ��\\:��)j�T��8��	�WZ�Ub��J8�R�=Y�UV�U��R��\\:��-j��ѫiV.��[z��Ҫ��-�{T���Z��uoj�U��3 ��[���>����E �%\\���h#bՅ��WZ�-\\���C�����W>��]ںg4#����KTr��Zʤwj��\$��z�-Rj��tj�U*��W��tp\n�4����'�N�M����xU��X32[x�+���\$B�US*��q�UͪqXZ�}S���x���@�-W\n5�XZ�Յ���J��U2�=\\����F+��V�0]XX�U����0����-VJ��+�/�����Zʮ5sj��D��U޲%b�ɵ������V�%Y�^u@d�բ��W�愔�ŲRk&���YR��\\�ŒRk�Y�cV�O-\\��	kd���KoX��K��/�9�]��V�O-U�<��@��嬥Vγ[����6U�����=e�ϵo�4TݭY�0�eH�դ�\r��9����6�(󮝕+��7�yb�rI �|�\0�:Fz���\n��|��s<�R�%J���]��F�3����j�Σ�Y��Z��^<5�X�IJ��M`�nO\\�B&�r���s��Q�uz��x���	�T���Vw�J5�g	�?v�qF4�9�ӝ����6�zj����OV��\r�u�=�@ʒfT͚����y��	�֫pKaXU9�m����\n�ekMo��5\nhT��ꦦ�V���v���:��s���\\p>��L�:��)�O=nk}j�S��&�֮��~���y��e��ܚ�Zֵ�)j���t�VR�V��s�r�:+a�o��,!T�l�Uϕ�*n��5��\\�U�dv+�M\\�)]B�|�J���l;4��5�pL��ӵئ7Li�[~bmt��Se�\"���B��v��d��@ͧS�4)ؒ�Z���\$)��5ic!������Ό���\\R�*�SD���w\$�9�tS�\n�Gf�Pԛ��ʸ����*�	K���D�Vy��5�uȦJב�\\��C��\$��W,�M\\������5�����k^�V�s��5�k�ֻ�M^��{�u��ϤwFQ��J�H�gWN�k8�����ʉ+�����1br���˕���V�X�]�dL�j�YT��v��6�twy˕�k����vx=�5�h������8�]����˷x\"c|�ufU����\0�ҧ5�jȩ}�Pkn̚Rl��f٪�+���ۣ��>c4��W+T�Do����q���SX���b}}�hn�&<�?�/3��-áh���qn���	�p�%)S�yP\r��͵�m-�f�5���[�\\�=�T�}�y )��Yd�ؤ46#Y>�3��נ�m��\n09h;�4���0��+�a�e\nȃİȞ!�����)�@�x�x}�\$����AF��Ñ�0N� R�	���ӄ�iܥ��U�?���b5�!+׭\0G���w{��Ӥ��lI �)�w-4;p8��ؤ;@\r\n\r���N5�ƅF\\ӹhgPE il0��X�%�)\n��Lk��^���2��<5F��d�I�<�F�j�bM�d'�	�ƲD��Bma������OY�Xgg�8��ZV�%mf��%�F�-�,�\n���a��F�wf��s���0G乑�Z�\n	1�;J��1�\"iP�B�y�C�����t�zӉ���;l�4��ҡ��J��mLX�+lᘪ�{�8�\"�\n�V�����(�\$Y\0�d\\݆6�D9B�H�d%���1����6f �\"�T�J��`/��>�C=�c�쨱��?e!�k*�3l~���i��,�A��z/d���Mo���ڲn�\"ɽ������zTr}eٌ{M�aC�7�fiT����/6W���P����8�Fa`��5��M�f2V]�['}cn4]h���e���Z�ŧ\r��2���XllGa`(����(����\0�����_�lO��f&f�1c8�D{�Q��	S6�p\0�Y�����\0\r�q�3m&*f�;�p�6r^c�ϳ��`ɵ&z�n^ڱ�;D��S�oj^�=�L'g�5���&���Ef&���|\nK 6?bX*�.fψE���~&9�!��d�k@�v\"F�G�x\\�=�E�7�XP2[:��\0�׎��X~��7���X6�4���(�\";B�\n��X��hy��&�Dֈ�Z�l\nKC�������p���`mS�	2�U�;G���8��{��-��WBm��\$F��\r�l&B�Y2\r��mA�ő�w�Z�6�RВ��%d�����_��T�5�``Ba��G��c�XK�\r��\0��gN��\\���;N����s^\n��u����ѲVwz�U�F\"\0T-�,^��\0�����2 /� ����EW�/\0¼��ľ�4;\"�K-NZ���McλRVNe�Z�wj�6��a��ÿ���KV�lN?���jt2���T/[�N���j|0t% #�����\0��`��5F<����X@\nӢ���ZF\\-m���cd2�p5G�v'B�'�7{k�*'�L�A�Z|I�k�\n-.C�6����k�-����S����k�]��_\$��+G�נ[^���z]k��8�\\��F|��?B���^��B��̎|��@����B��zP�W/R?[!bB��k��Ѡ'	(�e:xf�r�7\r_��q�Ma�\0#��7|�Q&\0Ɂ@)���1�뮆LA[Pt�\0���`�6�\\e���zx��S݀vՈπU:�ڱ�T����ϗ>f�\nq�l��+K(|�\\��ѠG��U؋��@(�*�iS�%F�\rR\$��C��L����;�d��ļg�-\$m?�lhʝ��3?P�Y�\0");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0!�����M��*)�o��) q��e���#��L�\0;";break;case"cross.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0#�����#\na�Fo~y�.�_wa��1�J�G�L�6]\0\0;";break;case"up.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����MQN\n�}��a8�y�aŶ�\0��\0;";break;case"down.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����M��*)�[W�\\��L&ٜƶ�\0��\0;";break;case"arrow.gif":echo"GIF89a\0\n\0�\0\0������!�\0\0\0,\0\0\0\0\0\n\0\0�i������Ӳ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$q=file_open_lock(get_temp_dir()."/adminer.version");if($q)file_write_unlock($q,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$f,$k,$nc,$vc,$Ec,$l,$rd,$yd,$ba,$Vd,$w,$ca,$oe,$rf,$ag,$Fh,$Cd,$S,$ri,$U,$Gi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Pf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Pf[]=true;call_user_func_array('session_set_cookie_params',$Pf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$cd);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'zh-tw';}function
lang($qi,$gf=null){if(is_array($qi)){$dg=($gf==1?0:1);$qi=$qi[$dg];}$qi=str_replace("%d","%s",$qi);$gf=format_number($gf);return
sprintf($qi,$gf);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$dg=array_search("SQL",$b->operators);if($dg!==false)unset($b->operators[$dg]);}function
dsn($sc,$V,$E,$C=array()){$C[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$C[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($sc,$V,$E,$C);}catch(Exception$Lc){auth_error(h($Lc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($O){return$this->pdo->quote($O);}function
query($F,$_i=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='未知錯誤。';return
false;}$this->store_result($G);return$G;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result($G=null){if(!$G){$G=$this->_result;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($F,$m=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch();return$I[$m];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=(in_array("blob",(array)$I->flags)?63:0);return$I;}}}$nc=array();function
add_driver($Jd,$B){global$nc;$nc[$Jd]=$B;}function
get_driver($Jd){global$nc;return$nc[$Jd];}class
Min_SQL{var$_conn;function
__construct($f){$this->_conn=$f;}function
select($P,$K,$Z,$vd,$_f=array(),$y=1,$D=0,$lg=false){global$b,$w;$ce=(count($vd)<count($K));$F=$b->selectQueryBuild($K,$Z,$vd,$_f,$y,$D);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$vd&&$ce&&$w=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($P),($Z?"\nWHERE ".implode(" AND ",$Z):"").($vd&&$ce?"\nGROUP BY ".implode(", ",$vd):"").($_f?"\nORDER BY ".implode(", ",$_f):""),($y!=""?+$y:null),($D?$y*$D:0),"\n");$Ch=microtime(true);$H=$this->_conn->query($F);if($lg)echo$b->selectQuery($F,$Ch,!$H);return$H;}function
delete($P,$ug,$y=0){$F="FROM ".table($P);return
queries("DELETE".($y?limit1($P,$F,$ug):" $F$ug"));}function
update($P,$M,$ug,$y=0,$eh="\n"){$Si=array();foreach($M
as$x=>$X)$Si[]="$x = $X";$F=table($P)." SET$eh".implode(",$eh",$Si);return
queries("UPDATE".($y?limit1($P,$F,$ug,$eh):" $F$ug"));}function
insert($P,$M){return
queries("INSERT INTO ".table($P).($M?" (".implode(", ",array_keys($M)).")\nVALUES (".implode(", ",$M).")":" DEFAULT VALUES"));}function
insertUpdate($P,$J,$jg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$di){}function
convertSearch($t,$X,$m){return$t;}function
convertOperator($vf){return$vf;}function
value($X,$m){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$m):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($Ug){return
q($Ug);}function
warnings(){return'';}function
tableHelp($B){}function
hasCStyleEscapes(){return
false;}}$nc["sqlite"]="SQLite 3";$nc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($o){$this->_link=new
SQLite3($o);$Vi=$this->_link->version();$this->server_info=$Vi["versionString"];}function
query($F){$G=@$this->_link->query($F);$this->error="";if(!$G){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Min_Result($G);$this->affected_rows=$this->_link->changes();return
true;}function
quote($O){return(is_utf8($O)?"'".$this->_link->escapeString($O)."'":"x'".reset(unpack('H*',$O))."'");}function
store_result(){return$this->_result;}function
result($F,$m=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetchArray();return$I?$I[$m]:false;}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$d=$this->_offset++;$T=$this->_result->columnType($d);return(object)array("name"=>$this->_result->columnName($d),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($o){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($o);}function
query($F,$_i=false){$Re=($_i?"unbufferedQuery":"query");$G=@$this->_link->$Re($F,SQLITE_BOTH,$l);$this->error="";if(!$G){$this->error=$l;return
false;}elseif($G===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($G);}function
quote($O){return"'".sqlite_escape_string($O)."'";}function
store_result(){return$this->_result;}function
result($F,$m=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetch();return$I[$m];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;if(method_exists($G,'numRows'))$this->num_rows=$G->numRows();}function
fetch_assoc(){$I=$this->_result->fetch(SQLITE_ASSOC);if(!$I)return
false;$H=array();foreach($I
as$x=>$X)$H[idf_unescape($x)]=$X;return$H;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$B=$this->_result->fieldName($this->_offset++);$Yf='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Yf\\.)?$Yf\$~",$B,$A)){$P=($A[3]!=""?$A[3]:idf_unescape($A[2]));$B=($A[5]!=""?$A[5]:idf_unescape($A[4]));}return(object)array("name"=>$B,"orgname"=>$B,"orgtable"=>$P,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($o){$this->dsn(DRIVER.":$o","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($o){if(is_readable($o)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$o)?$o:dirname($_SERVER["SCRIPT_FILENAME"])."/$o")." AS a")){parent::__construct($o);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($F){return$this->_result=$this->query($F);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($P,$J,$jg){$Si=array();foreach($J
as$M)$Si[]="(".implode(", ",$M).")";return
queries("REPLACE INTO ".table($P)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$Si));}function
tableHelp($B){if($B=="sqlite_sequence")return"fileformat2.html#seqtab";if($B=="sqlite_master")return"fileformat2.html#$B";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'資料庫不支援密碼。';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($F,$Z,$y,$jf=0,$eh=" "){return" $F$Z".($y!==null?$eh."LIMIT $y".($jf?" OFFSET $jf":""):"");}function
limit1($P,$F,$Z,$eh="\n"){global$f;return(preg_match('~^INTO~',$F)||$f->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$eh):" $F WHERE rowid = (SELECT rowid FROM ".table($P).$Z.$eh."LIMIT 1)");}function
db_collation($j,$pb){global$f;return$f->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($i){return
array();}function
table_status($B=""){global$f;$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){$I["Rows"]=$f->result("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return($B!=""?$H[$B]:$H);}function
is_view($Q){return$Q["Engine"]=="view";}function
fk_support($Q){global$f;return!$f->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($P){global$f;$H=array();$jg="";foreach(get_rows("PRAGMA table_info(".table($P).")")as$I){$B=$I["name"];$T=strtolower($I["type"]);$ac=$I["dflt_value"];$H[$B]=array("field"=>$B,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~^'(.*)'$~",$ac,$A)?str_replace("''","'",$A[1]):($ac=="NULL"?null:$ac)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($jg!="")$H[$jg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$H[$B]["auto_increment"]=true;$jg=$B;}}$xh=$f->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($P));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$xh,$De,PREG_SET_ORDER);foreach($De
as$A){$B=str_replace('""','"',preg_replace('~^"|"$~','',$A[1]));if($H[$B])$H[$B]["collation"]=trim($A[3],"'");}return$H;}function
indexes($P,$g=null){global$f;if(!is_object($g))$g=$f;$H=array();$xh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($P));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$xh,$A)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$A[1],$De,PREG_SET_ORDER);foreach($De
as$A){$H[""]["columns"][]=idf_unescape($A[2]).$A[4];$H[""]["descs"][]=(preg_match('~DESC~i',$A[5])?'1':null);}}if(!$H){foreach(fields($P)as$B=>$m){if($m["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($B),"lengths"=>array(),"descs"=>array(null));}}$Ah=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($P),$g);foreach(get_rows("PRAGMA index_list(".table($P).")",$g)as$I){$B=$I["name"];$u=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($B).")",$g)as$Tg){$u["columns"][]=$Tg["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($B).' ON '.idf_escape($P),'~').' \((.*)\)$~i',$Ah[$B],$Dg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Dg[2],$De);foreach($De[2]as$x=>$X){if($X)$u["descs"][$x]='1';}}if(!$H[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$H[""]["columns"]||$u["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$B))$H[$B]=$u;}return$H;}function
foreign_keys($P){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($P).")")as$I){$p=&$H[$I["id"]];if(!$p)$p=$I;$p["source"][]=$I["from"];$p["target"][]=$I["to"];}return$H;}function
adm_view($B){global$f;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$f->result("SELECT sql FROM sqlite_master WHERE name = ".q($B))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($j){return
false;}function
error(){global$f;return
h($f->error);}function
check_sqlite_name($B){global$f;$Uc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Uc)\$~",$B)){$f->error=sprintf('請使用下列其中一個擴充模組 %s。',str_replace("|",", ",$Uc));return
false;}return
true;}function
create_database($j,$ob){global$f;if(file_exists($j)){$f->error='檔案已存在。';return
false;}if(!check_sqlite_name($j))return
false;try{$z=new
Min_SQLite($j);}catch(Exception$Lc){$f->error=$Lc->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($i){global$f;$f->__construct(":memory:");foreach($i
as$j){if(!@unlink($j)){$f->error='檔案已存在。';return
false;}}return
true;}function
rename_database($B,$ob){global$f;if(!check_sqlite_name($B))return
false;$f->__construct(":memory:");$f->error='檔案已存在。';return@rename(DB,$B);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){global$f;$Li=($P==""||$kd);foreach($n
as$m){if($m[0]!=""||!$m[1]||$m[2]){$Li=true;break;}}$c=array();$If=array();foreach($n
as$m){if($m[1]){$c[]=($Li?$m[1]:"ADD ".implode($m[1]));if($m[0]!="")$If[$m[0]]=$m[1][0];}}if(!$Li){foreach($c
as$X){if(!queries("ALTER TABLE ".table($P)." $X"))return
false;}if($P!=$B&&!queries("ALTER TABLE ".table($P)." RENAME TO ".table($B)))return
false;}elseif(!recreate_table($P,$B,$c,$If,$kd,$Ka))return
false;if($Ka){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ka WHERE name = ".q($B));if(!$f->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($B).", $Ka)");queries("COMMIT");}return
true;}function
recreate_table($P,$B,$n,$If,$kd,$Ka=0,$v=array()){global$f;if($P!=""){if(!$n){foreach(fields($P)as$x=>$m){if($v)$m["auto_increment"]=0;$n[]=process_field($m,$m);$If[$x]=idf_escape($x);}}$kg=false;foreach($n
as$m){if($m[6])$kg=true;}$qc=array();foreach($v
as$x=>$X){if($X[2]=="DROP"){$qc[$X[1]]=true;unset($v[$x]);}}foreach(indexes($P)as$ie=>$u){$e=array();foreach($u["columns"]as$x=>$d){if(!$If[$d])continue
2;$e[]=$If[$d].($u["descs"][$x]?" DESC":"");}if(!$qc[$ie]){if($u["type"]!="PRIMARY"||!$kg)$v[]=array($u["type"],$ie,$e);}}foreach($v
as$x=>$X){if($X[0]=="PRIMARY"){unset($v[$x]);$kd[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($P)as$ie=>$p){foreach($p["source"]as$x=>$d){if(!$If[$d])continue
2;$p["source"][$x]=idf_unescape($If[$d]);}if(!isset($kd[" $ie"]))$kd[]=" ".format_foreign_key($p);}queries("BEGIN");}foreach($n
as$x=>$m)$n[$x]="  ".implode($m);$n=array_merge($n,array_filter($kd));$Xh=($P==$B?"adminer_$B":$B);if(!queries("CREATE TABLE ".table($Xh)." (\n".implode(",\n",$n)."\n)"))return
false;if($P!=""){if($If&&!queries("INSERT INTO ".table($Xh)." (".implode(", ",$If).") SELECT ".implode(", ",array_map('idf_escape',array_keys($If)))." FROM ".table($P)))return
false;$xi=array();foreach(triggers($P)as$vi=>$ei){$ui=trigger($vi);$xi[]="CREATE TRIGGER ".idf_escape($vi)." ".implode(" ",$ei)." ON ".table($B)."\n$ui[Statement]";}$Ka=$Ka?0:$f->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($P));if(!queries("DROP TABLE ".table($P))||($P==$B&&!queries("ALTER TABLE ".table($Xh)." RENAME TO ".table($B)))||!alter_indexes($B,$v))return
false;if($Ka)queries("UPDATE sqlite_sequence SET seq = $Ka WHERE name = ".q($B));foreach($xi
as$ui){if(!queries($ui))return
false;}queries("COMMIT");}return
true;}function
index_sql($P,$T,$B,$e){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($B!=""?$B:uniqid($P."_"))." ON ".table($P)." $e";}function
alter_indexes($P,$c){foreach($c
as$jg){if($jg[0]=="PRIMARY")return
recreate_table($P,$P,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($P,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($R){return
apply_queries("DELETE FROM",$R);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($R){return
apply_queries("DROP TABLE",$R);}function
move_tables($R,$Xi,$Vh){return
false;}function
trigger($B){global$f;if($B=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$wi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$wi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$f->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($B)),$A);$if=$A[3];return
array("Timing"=>strtoupper($A[1]),"Event"=>strtoupper($A[2]).($if?" OF":""),"Of"=>idf_unescape($if),"Trigger"=>$B,"Statement"=>$A[4],);}function
triggers($P){$H=array();$wi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($P))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$wi["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$A);$H[$I["name"]]=array($A[1],$A[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ROWID()");}function
explain($f,$F){return$f->query("EXPLAIN QUERY PLAN $F");}function
found_rows($Q,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
create_sql($P,$Ka,$Gh){global$f;$H=$f->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($P));foreach(indexes($P)as$B=>$u){if($B=='')continue;$H.=";\n\n".index_sql($P,$u['type'],$B,"(".implode(", ",array_map('idf_escape',$u['columns'])).")");}return$H;}function
truncate_sql($P){return"DELETE FROM ".table($P);}function
use_sql($Ub){}function
trigger_sql($P){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($P)));}function
show_variables(){global$f;$H=array();foreach(get_rows("PRAGMA pragma_list")as$I)$H[$I["name"]]=$f->result("PRAGMA $I[name]");return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$yf){list($x,$X)=explode("=",$yf,2);$H[$x]=$X;}return$H;}function
convert_field($m){}function
unconvert_field($m,$H){return$H;}function
support($Yc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Yc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$nc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Gc,$l){if(ini_bool("html_errors"))$l=html_entity_decode(strip_tags($l));$l=preg_replace('~^[^:]*: ~','',$l);$this->error=$l;}function
connect($L,$V,$E){global$b;$j=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($E,"'\\")."'";$Bh=$b->connectSsl();if(isset($Bh["mode"]))$this->_string.=" sslmode='".$Bh["mode"]."'";$this->_link=@pg_connect("$this->_string dbname='".($j!=""?addcslashes($j,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$j!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Vi=pg_version($this->_link);$this->server_info=$Vi["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($O){return
pg_escape_literal($this->_link,$O);}function
value($X,$m){return($m["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($O){return"'".pg_escape_bytea($this->_link,$O)."'";}function
select_db($Ub){global$b;if($Ub==$b->database())return$this->_database;$H=@pg_connect("$this->_string dbname='".addcslashes($Ub,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->_link=$H;return$H;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($F,$_i=false){$G=@pg_query($this->_link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->_link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Min_Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$m=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
pg_fetch_result($G->_result,0,$m);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$d=$this->_offset++;$H=new
stdClass;if(function_exists('pg_field_table'))$H->orgtable=pg_field_table($this->_result,$d);$H->name=pg_field_name($this->_result,$d);$H->orgname=$H->name;$H->type=pg_field_type($this->_result,$d);$H->charsetnr=($H->type=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($L,$V,$E){global$b;$j=$b->database();$sc="pgsql:host='".str_replace(":","' port='",addcslashes($L,"'\\"))."' client_encoding=utf8 dbname='".($j!=""?addcslashes($j,"'\\"):"postgres")."'";$Bh=$b->connectSsl();if(isset($Bh["mode"]))$sc.=" sslmode='".$Bh["mode"]."'";$this->dsn($sc,$V,$E);return
true;}function
select_db($Ub){global$b;return($b->database()==$Ub);}function
quoteBinary($Ug){return
q($Ug);}function
query($F,$_i=false){$H=parent::query($F,$_i);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($P,$J,$jg){global$f;foreach($J
as$M){$Hi=array();$Z=array();foreach($M
as$x=>$X){$Hi[]="$x = $X";if(isset($jg[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($P)." SET ".implode(", ",$Hi)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($P)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
slowQuery($F,$di){$this->_conn->query("SET statement_timeout = ".(1000*$di));$this->_conn->timeout=1000*$di;return$F;}function
convertSearch($t,$X,$m){$ai="char|text";if(strpos($X["op"],"LIKE")===false)$ai.="|date|time(stamp)?|boolean|uuid|inet|cidr|macaddr|".number_type();return(preg_match("~$ai~",$m["type"])?$t:"CAST($t AS text)");}function
quoteBinary($Ug){return$this->_conn->quoteBinary($Ug);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($B){$ye=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$ye[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$B).".html";}function
hasCStyleEscapes(){static$Xa;if($Xa===null)$Xa=($this->_conn->result("SHOW standard_conforming_strings")=="off");return$Xa;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Fh;$f=new
Min_DB;$Nb=$b->credentials();if($f->connect($Nb[0],$Nb[1],$Nb[2])){if(min_version(9,0,$f)){$f->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$f)){$Fh['字串'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$f)){$Fh['字串'][]="jsonb";$U["jsonb"]=4294967295;}}}return$f;}return$f->error;}function
get_databases(){return
get_vals("SELECT d.datname FROM pg_database d JOIN pg_roles r ON d.datdba = r.oid
WHERE d.datallowconn = TRUE AND has_database_privilege(d.datname, 'CONNECT') AND pg_has_role(r.rolname, 'USAGE')
ORDER BY d.datname");}function
limit($F,$Z,$y,$jf=0,$eh=" "){return" $F$Z".($y!==null?$eh."LIMIT $y".($jf?" OFFSET $jf":""):"");}function
limit1($P,$F,$Z,$eh="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$eh):" $F".(is_view(table_status1($P))?$Z:$eh."WHERE ctid = (SELECT ctid FROM ".table($P).$Z.$eh."LIMIT 1)"));}function
db_collation($j,$pb){global$f;return$f->result("SELECT datcollate FROM pg_database WHERE datname = ".q($j));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support("materializedview"))$F.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($i){return
array();}function
table_status($B=""){$H=array();foreach(get_rows("SELECT
	c.relname AS \"Name\",
	CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\",
	pg_table_size(c.oid) AS \"Data_length\",
	pg_indexes_size(c.oid) AS \"Index_length\",
	obj_description(c.oid, 'pg_class') AS \"Comment\",
	".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\",
	c.reltuples as \"Rows\",
	n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($B!=""?"AND relname = ".q($B):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return($B!=""?$H[$B]:$H);}function
is_view($Q){return
in_array($Q["Engine"],array("view","materialized view"));}function
fk_support($Q){return
true;}function
fields($P){$H=array();$Ba=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($P)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$A);list(,$T,$ve,$I["length"],$wa,$Ea)=$A;$I["length"].=$Ea;$eb=$T.$wa;if(isset($Ba[$eb])){$I["type"]=$Ba[$eb];$I["full_type"]=$I["type"].$ve.$Ea;}else{$I["type"]=$T;$I["full_type"]=$I["type"].$ve.$wa.$Ea;}if(in_array($I['attidentity'],array('a','d')))$I['default']='GENERATED '.($I['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['attidentity']||preg_match('~^nextval\(~i',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$I["default"],$A))$I["default"]=($A[1]=="NULL"?null:idf_unescape($A[1]).$A[2]);$H[$I["field"]]=$I;}return$H;}function
indexes($P,$g=null){global$f;if(!is_object($g))$g=$f;$H=array();$Oh=$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($P));$e=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Oh AND attnum > 0",$g);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Oh AND ci.oid = i.indexrelid",$g)as$I){$Eg=$I["relname"];$H[$Eg]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$Eg]["columns"]=array();foreach(explode(" ",$I["indkey"])as$Rd)$H[$Eg]["columns"][]=$e[$Rd];$H[$Eg]["descs"]=array();foreach(explode(" ",$I["indoption"])as$Sd)$H[$Eg]["descs"][]=($Sd&1?'1':null);$H[$Eg]["lengths"]=array();}return$H;}function
foreign_keys($P){global$rf;$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($P)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$A)){$I['source']=array_map('idf_unescape',array_map('trim',explode(',',$A[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$A[2],$Ce)){$I['ns']=idf_unescape($Ce[2]);$I['table']=idf_unescape($Ce[4]);}$I['target']=array_map('idf_unescape',array_map('trim',explode(',',$A[3])));$I['on_delete']=(preg_match("~ON DELETE ($rf)~",$A[4],$Ce)?$Ce[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE ($rf)~",$A[4],$Ce)?$Ce[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
adm_view($B){global$f;return
array("select"=>trim($f->result("SELECT pg_get_viewdef(".$f->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($B)).")")));}function
collations(){return
array();}function
information_schema($j){return($j=="information_schema");}function
error(){global$f;$H=h($f->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$A))$H=$A[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($A[3]).'})(.*)~','\1<b>\2</b>',$A[2]).$A[4];return
nl_br($H);}function
create_database($j,$ob){return
queries("CREATE DATABASE ".idf_escape($j).($ob?" ENCODING ".idf_escape($ob):""));}function
drop_databases($i){global$f;$f->close();return
apply_queries("DROP DATABASE",$i,'idf_escape');}function
rename_database($B,$ob){global$f;$f->close();return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($B));}function
auto_increment(){return"";}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){$c=array();$tg=array();if($P!=""&&$P!=$B)$tg[]="ALTER TABLE ".table($P)." RENAME TO ".table($B);$fh="";foreach($n
as$m){$d=idf_escape($m[0]);$X=$m[1];if(!$X)$c[]="DROP $d";else{$Ri=$X[5];unset($X[5]);if($m[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($P!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($P!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($d!=$X[0])$tg[]="ALTER TABLE ".table($B)." RENAME $d TO $X[0]";$c[]="ALTER $d TYPE$X[1]";$gh=$P."_".idf_unescape($X[0])."_seq";$c[]="ALTER $d ".($X[3]?"SET$X[3]":(isset($X[6])?"SET DEFAULT nextval(".q($gh).")":"DROP DEFAULT"));if(isset($X[6]))$fh="CREATE SEQUENCE IF NOT EXISTS ".idf_escape($gh)." OWNED BY ".idf_escape($P).".$X[0]";$c[]="ALTER $d ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}if($m[0]!=""||$Ri!="")$tg[]="COMMENT ON COLUMN ".table($B).".$X[0] IS ".($Ri!=""?substr($Ri,9):"''");}}$c=array_merge($c,$kd);if($P=="")array_unshift($tg,"CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($tg,"ALTER TABLE ".table($P)."\n".implode(",\n",$c));if($fh)array_unshift($tg,$fh);if($vb!==null)$tg[]="COMMENT ON TABLE ".table($B)." IS ".q($vb);if($Ka!=""){}foreach($tg
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($P,$c){$h=array();$oc=array();$tg=array();foreach($c
as$X){if($X[0]!="INDEX")$h[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$oc[]=idf_escape($X[1]);else$tg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($P."_"))." ON ".table($P)." (".implode(", ",$X[2]).")";}if($h)array_unshift($tg,"ALTER TABLE ".table($P).implode(",",$h));if($oc)array_unshift($tg,"DROP INDEX ".implode(", ",$oc));foreach($tg
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($R){return
queries("TRUNCATE ".implode(", ",array_map('table',$R)));return
true;}function
drop_views($Xi){return
drop_tables($Xi);}function
drop_tables($R){foreach($R
as$P){$N=table_status($P);if(!queries("DROP ".strtoupper($N["Engine"])." ".table($P)))return
false;}return
true;}function
move_tables($R,$Xi,$Vh){foreach(array_merge($R,$Xi)as$P){$N=table_status($P);if(!queries("ALTER ".strtoupper($N["Engine"])." ".table($P)." SET SCHEMA ".idf_escape($Vh)))return
false;}return
true;}function
trigger($B,$P){if($B=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$e=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($P)." AND trigger_name = ".q($B);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$I)$e[]=$I["event_object_column"];$H=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$I){if($e&&$I["Event"]=="UPDATE")$I["Event"].=" OF";$I["Of"]=implode(", ",$e);if($H)$I["Event"].=" OR $H[Event]";$H=$I;}return$H;}function
triggers($P){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($P))as$I){$ui=trigger($I["trigger_name"],$P);$H[$ui["Trigger"]]=array($ui["Timing"],$ui["Event"]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($B,$T){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($B));$H=$J[0];$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($B).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($B,$I){$H=array();foreach($I["fields"]as$m)$H[]=$m["type"];return
idf_escape($B)."(".implode(", ",$H).")";}function
last_id(){return
0;}function
explain($f,$F){return$f->query("EXPLAIN $F");}function
found_rows($Q,$Z){global$f;if(preg_match("~ rows=([0-9]+)~",$f->result("EXPLAIN SELECT * FROM ".idf_escape($Q["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Dg))return$Dg[1];return
false;}function
types(){return
get_key_vals("SELECT oid, typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$f;return$f->result("SELECT current_schema()");}function
set_schema($Wg,$g=null){global$f,$U,$Fh;if(!$g)$g=$f;$H=$g->query("SET search_path TO ".idf_escape($Wg));foreach(types()as$x=>$T){if(!isset($U[$T])){$U[$T]=$x;$Fh['使用者類型'][]=$T;}}return$H;}function
foreign_keys_sql($P){$H="";$N=table_status($P);$hd=foreign_keys($P);ksort($hd);foreach($hd
as$gd=>$fd)$H.="ALTER TABLE ONLY ".idf_escape($N['nspname']).".".idf_escape($N['Name'])." ADD CONSTRAINT ".idf_escape($gd)." $fd[definition] ".($fd['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($P,$Ka,$Gh){$Mg=array();$hh=array();$N=table_status($P);if(is_view($N)){$Wi=adm_view($P);return
rtrim("CREATE VIEW ".idf_escape($P)." AS $Wi[select]",";");}$n=fields($P);$v=indexes($P);ksort($v);if(!$N||empty($n))return
false;$H="CREATE TABLE ".idf_escape($N['nspname']).".".idf_escape($N['Name'])." (\n    ";foreach($n
as$m){$Rf=idf_escape($m['field']).' '.$m['full_type'].default_value($m).($m['attnotnull']?" NOT NULL":"");$Mg[]=$Rf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$m['default'],$De)){$gh=$De[1];$wh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q(idf_unescape($gh)):"SELECT * FROM $gh"));$hh[]=($Gh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $gh;\n":"")."CREATE SEQUENCE $gh INCREMENT $wh[increment_by] MINVALUE $wh[min_value] MAXVALUE $wh[max_value]".($Ka&&$wh['last_value']?" START ".($wh["last_value"]+1):"")." CACHE $wh[cache_value];";}}if(!empty($hh))$H=implode("\n\n",$hh)."\n\n$H";foreach($v
as$Pd=>$u){switch($u['type']){case'UNIQUE':$Mg[]="CONSTRAINT ".idf_escape($Pd)." UNIQUE (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;case'PRIMARY':$Mg[]="CONSTRAINT ".idf_escape($Pd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;}}$Db=get_key_vals("SELECT conname, ".(min_version(8)?"pg_get_constraintdef(pg_constraint.oid)":"CONCAT('CHECK ', consrc)")."
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($P)."
ORDER BY connamespace, conname");foreach($Db
as$Ab=>$Cb)$Mg[]="CONSTRAINT ".idf_escape($Ab)." $Cb";$H.=implode(",\n    ",$Mg)."\n) WITH (oids = ".($N['Oid']?'true':'false').");";foreach($v
as$Pd=>$u){if($u['type']=='INDEX'){$e=array();foreach($u['columns']as$x=>$X)$e[]=idf_escape($X).($u['descs'][$x]?" DESC":"");$H.="\n\nCREATE INDEX ".idf_escape($Pd)." ON ".idf_escape($N['nspname']).".".idf_escape($N['Name'])." USING btree (".implode(', ',$e).");";}}if($N['Comment'])$H.="\n\nCOMMENT ON TABLE ".idf_escape($N['nspname']).".".idf_escape($N['Name'])." IS ".q($N['Comment']).";";foreach($n
as$ad=>$m){if($m['comment'])$H.="\n\nCOMMENT ON COLUMN ".idf_escape($N['nspname']).".".idf_escape($N['Name']).".".idf_escape($ad)." IS ".q($m['comment']).";";}return
rtrim($H,';');}function
truncate_sql($P){return"TRUNCATE ".table($P);}function
trigger_sql($P){$N=table_status($P);$H="";foreach(triggers($P)as$ti=>$si){$ui=trigger($ti,$N['Name']);$H.="\nCREATE TRIGGER ".idf_escape($ui['Trigger'])." $ui[Timing] $ui[Event] ON ".idf_escape($N["nspname"]).".".idf_escape($N['Name'])." $ui[Type] $ui[Statement];;\n";}return$H;}function
use_sql($Ub){return"\connect ".idf_escape($Ub);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($m){}function
unconvert_field($m,$H){return$H;}function
support($Yc){return
preg_match('~^(check|database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Yc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$f;return$f->result("SHOW max_connections");}function
driver_config(){$U=array();$Fh=array();foreach(array('數字'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'日期時間'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'字串'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'二進位'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'網路'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"macaddr8"=>23,"txid_snapshot"=>0),'幾何'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$U+=$X;$Fh[$x]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("char_length","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$nc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($Gc,$l){if(ini_bool("html_errors"))$l=html_entity_decode(strip_tags($l));$l=preg_replace('~^[^:]*: ~','',$l);$this->error=$l;}function
connect($L,$V,$E){$this->_link=@oci_new_connect($V,$E,$L,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$l=oci_error();$this->error=$l["message"];return
false;}function
quote($O){return"'".str_replace("'","''",$O)."'";}function
select_db($Ub){$this->_current_db=$Ub;return
true;}function
query($F,$_i=false){$G=oci_parse($this->_link,$F);$this->error="";if(!$G){$l=oci_error($this->_link);$this->errno=$l["code"];$this->error=$l["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Min_Result($G);$this->affected_rows=oci_num_rows($G);oci_free_statement($G);}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$m=1){$G=$this->query($F);if(!is_object($G)||!oci_fetch($G->_result))return
false;return
oci_result($G->_result,$m);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$x=>$X){if(is_a($X,'OCI-Lob'))$I[$x]=$X->load();}return$I;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$d=$this->_offset++;$H=new
stdClass;$H->name=oci_field_name($this->_result,$d);$H->orgname=$H->name;$H->type=oci_field_type($this->_result,$d);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($L,$V,$E){$this->dsn("oci:dbname=//$L;charset=AL32UTF8",$V,$E);return
true;}function
select_db($Ub){$this->_current_db=$Ub;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($P,$J,$jg){global$f;foreach($J
as$M){$Hi=array();$Z=array();foreach($M
as$x=>$X){$Hi[]="$x = $X";if(isset($jg[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($P)." SET ".implode(", ",$Hi)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($P)." (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).")")))return
false;}return
true;}function
hasCStyleEscapes(){return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$f=new
Min_DB;$Nb=$b->credentials();if($f->connect($Nb[0],$Nb[1],$Nb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT DISTINCT tablespace_name FROM (
SELECT tablespace_name FROM user_tablespaces
UNION SELECT tablespace_name FROM all_tables WHERE tablespace_name IS NOT NULL
)
ORDER BY 1");}function
limit($F,$Z,$y,$jf=0,$eh=" "){return($jf?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($y+$jf).") WHERE rnum > $jf":($y!==null?" * FROM (SELECT $F$Z) WHERE rownum <= ".($y+$jf):" $F$Z"));}function
limit1($P,$F,$Z,$eh="\n"){return" $F$Z";}function
db_collation($j,$pb){global$f;return$f->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT USER FROM DUAL");}function
get_current_db(){global$f;$j=$f->_current_db?$f->_current_db:DB;unset($f->_current_db);return$j;}function
where_owner($hg,$Lf="owner"){if(!$_GET["ns"])return'';return"$hg$Lf = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($e){$Lf=where_owner('');return"(SELECT $e FROM all_views WHERE ".($Lf?$Lf:"rownum < 0").")";}function
tables_list(){$Wi=views_table("view_name");$Lf=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$Lf
UNION SELECT view_name, 'view' FROM $Wi
ORDER BY 1");}function
count_tables($i){global$f;$H=array();foreach($i
as$j)$H[$j]=$f->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($j));return$H;}function
table_status($B=""){$H=array();$Yg=q($B);$j=get_current_db();$Wi=views_table("view_name");$Lf=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($j).$Lf.($B!=""?" AND table_name = $Yg":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $Wi".($B!=""?" WHERE view_name = $Yg":"")."
ORDER BY 1")as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($Q){return$Q["Engine"]=="view";}function
fk_support($Q){return
true;}function
fields($P){$H=array();$Lf=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($P)."$Lf ORDER BY column_id")as$I){$T=$I["DATA_TYPE"];$ve="$I[DATA_PRECISION],$I[DATA_SCALE]";if($ve==",")$ve=$I["CHAR_COL_DECL_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$T.($ve?"($ve)":""),"type"=>strtolower($T),"length"=>$ve,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$H;}function
indexes($P,$g=null){$H=array();$Lf=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($P)."$Lf
ORDER BY ac.constraint_type, aic.column_position",$g)as$I){$Pd=$I["INDEX_NAME"];$sb=$I["DATA_DEFAULT"];$sb=($sb?trim($sb,'"'):$I["COLUMN_NAME"]);$H[$Pd]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$Pd]["columns"][]=$sb;$H[$Pd]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$Pd]["descs"][]=($I["DESCEND"]&&$I["DESCEND"]=="DESC"?'1':null);}return$H;}function
adm_view($B){$Wi=views_table("view_name, text");$J=get_rows('SELECT text "select" FROM '.$Wi.' WHERE view_name = '.q($B));return
reset($J);}function
collations(){return
array();}function
information_schema($j){return
false;}function
error(){global$f;return
h($f->error);}function
explain($f,$F){$f->query("EXPLAIN PLAN FOR $F");return$f->query("SELECT * FROM plan_table");}function
found_rows($Q,$Z){}function
auto_increment(){return"";}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){$c=$oc=array();$Ff=($P?fields($P):array());foreach($n
as$m){$X=$m[1];if($X&&$m[0]!=""&&idf_escape($m[0])!=$X[0])queries("ALTER TABLE ".table($P)." RENAME COLUMN ".idf_escape($m[0])." TO $X[0]");$Ef=$Ff[$m[0]];if($X&&$Ef){$lf=process_field($Ef,$Ef);if($X[2]==$lf[2])$X[2]="";}if($X)$c[]=($P!=""?($m[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($P!=""?")":"");else$oc[]=idf_escape($m[0]);}if($P=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($P)."\n".implode("\n",$c)))&&(!$oc||queries("ALTER TABLE ".table($P)." DROP (".implode(", ",$oc).")"))&&($P==$B||queries("ALTER TABLE ".table($P)." RENAME TO ".table($B)));}function
alter_indexes($P,$c){$oc=array();$tg=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$h=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($tg,"ALTER TABLE ".table($P).$h);}elseif($X[2]=="DROP")$oc[]=idf_escape($X[1]);else$tg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($P."_"))." ON ".table($P)." (".implode(", ",$X[2]).")";}if($oc)array_unshift($tg,"DROP INDEX ".implode(", ",$oc));foreach($tg
as$F){if(!queries($F))return
false;}return
true;}function
foreign_keys($P){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($P);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($R){return
apply_queries("TRUNCATE TABLE",$R);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($R){return
apply_queries("DROP TABLE",$R);}function
last_id(){return
0;}function
schemas(){$H=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($H?$H:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$f;return$f->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Xg,$g=null){global$f;if(!$g)$g=$f;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Xg));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$J=get_rows('SELECT * FROM v$instance');return
reset($J);}function
convert_field($m){}function
unconvert_field($m,$H){return$H;}function
support($Yc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$Yc);}function
driver_config(){$U=array();$Fh=array();foreach(array('數字'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'日期時間'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'字串'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'二進位'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$U+=$X;$Fh[$x]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$nc["mssql"]="MS SQL";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$l){$this->errno=$l["code"];$this->error.="$l[message]\n";}$this->error=rtrim($this->error);}function
connect($L,$V,$E){global$b;$Bb=array("UID"=>$V,"PWD"=>$E,"CharacterSet"=>"UTF-8");$Bh=$b->connectSsl();if(isset($Bh["Encrypt"]))$Bb["Encrypt"]=$Bh["Encrypt"];if(isset($Bh["TrustServerCertificate"]))$Bb["TrustServerCertificate"]=$Bh["TrustServerCertificate"];$j=$b->database();if($j!="")$Bb["Database"]=$j;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$L),$Bb);if($this->_link){$Td=sqlsrv_server_info($this->_link);$this->server_info=$Td['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($O){$Ai=strlen($O)!=strlen(utf8_decode($O));return($Ai?"N":"")."'".str_replace("'","''",$O)."'";}function
select_db($Ub){return$this->query("USE ".idf_escape($Ub));}function
query($F,$_i=false){$G=sqlsrv_query($this->_link,$F);$this->error="";if(!$G){$this->_get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->_result=sqlsrv_query($this->_link,$F);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->_result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Min_Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($F,$m=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return$I[$m];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$x=>$X){if(is_a($X,'DateTime'))$I[$x]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$m=$this->_fields[$this->_offset++];$H=new
stdClass;$H->name=$m["Name"];$H->orgname=$m["Name"];$H->type=($m["Type"]==1?254:0);return$H;}function
seek($jf){for($s=0;$s<$jf;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($L,$V,$E){$this->_link=@mssql_connect($L,$V,$E);if($this->_link){$G=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($G){$I=$G->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$I[0]] $I[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($O){$Ai=strlen($O)!=strlen(utf8_decode($O));return($Ai?"N":"")."'".str_replace("'","''",$O)."'";}function
select_db($Ub){return
mssql_select_db($Ub);}function
query($F,$_i=false){$G=@mssql_query($F,$this->_link);$this->error="";if(!$G){$this->error=mssql_get_last_message();return
false;}if($G===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($F,$m=0){$G=$this->query($F);if(!is_object($G))return
false;return
mssql_result($G->_result,0,$m);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=mssql_num_rows($G);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$H=mssql_fetch_field($this->_result);$H->orgtable=$H->table;$H->orgname=$H->name;return$H;}function
seek($jf){mssql_data_seek($this->_result,$jf);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($L,$V,$E){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$E);return
true;}function
select_db($Ub){return$this->query("USE ".idf_escape($Ub));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($P,$J,$jg){foreach($J
as$M){$Hi=array();$Z=array();foreach($M
as$x=>$X){$Hi[]="$x = $X";if(isset($jg[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($P)." USING (VALUES(".implode(", ",$M).")) AS source (c".implode(", c",range(1,count($M))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Hi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($M)).") VALUES (".implode(", ",$M).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
connect(){global$b;$f=new
Min_DB;$Nb=$b->credentials();if($Nb[0]=="")$Nb[0]="localhost:1433";if($f->connect($Nb[0],$Nb[1],$Nb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$y,$jf=0,$eh=" "){return($y!==null?" TOP (".($y+$jf).")":"")." $F$Z";}function
limit1($P,$F,$Z,$eh="\n"){return
limit($F,$Z,1,0,$eh);}function
db_collation($j,$pb){global$f;return$f->result("SELECT collation_name FROM sys.databases WHERE name = ".q($j));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($i){global$f;$H=array();foreach($i
as$j){$f->select_db($j);$H[$j]=$f->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($B=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment
FROM sys.all_objects AS ao
WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($Q){return$Q["Engine"]=="VIEW";}function
fk_support($Q){return
true;}function
fields($P){$xb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($P).", 'column', NULL)");$H=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default], d.name default_constraint
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.object_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($P))as$I){$T=$I["type"];$ve=(preg_match("~char|binary~",$T)?$I["max_length"]/($T[0]=='n'?2:1):($T=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$T.($ve?"($ve)":""),"type"=>$T,"length"=>$ve,"default"=>(preg_match("~^\('(.*)'\)$~",$I["default"],$A)?str_replace("''","'",$A[1]):$I["default"]),"default_constraint"=>$I["default_constraint"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$I["is_identity"],"comment"=>$xb[$I["name"]],);}return$H;}function
indexes($P,$g=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($P),$g)as$I){$B=$I["name"];$H[$B]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$B]["lengths"]=array();$H[$B]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$B]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
adm_view($B){global$f;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$f->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($B))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$ob)$H[preg_replace('~_.*~','',$ob)][]=$ob;return$H;}function
information_schema($j){return
false;}function
error(){global$f;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$f->error)));}function
create_database($j,$ob){return
queries("CREATE DATABASE ".idf_escape($j).(preg_match('~^[a-z0-9_]+$~i',$ob)?" COLLATE $ob":""));}function
drop_databases($i){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$i)));}function
rename_database($B,$ob){if(preg_match('~^[a-z0-9_]+$~i',$ob))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $ob");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($B));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){$c=array();$xb=array();$Ff=fields($P);foreach($n
as$m){$d=idf_escape($m[0]);$X=$m[1];if(!$X)$c["DROP"][]=" COLUMN $d";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$xb[$m[0]]=$X[5];unset($X[5]);if($m[0]=="")$c["ADD"][]="\n  ".implode("",$X).($P==""?substr($kd[$X[0]],16+strlen($X[0])):"");else{$ac=$X[3];unset($X[3]);unset($X[6]);if($d!=$X[0])queries("EXEC sp_rename ".q(table($P).".$d").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";$Ef=$Ff[$m[0]];if(default_value($Ef)!=$ac){if($Ef["default"]!==null)$c["DROP"][]=" ".idf_escape($Ef["default_constraint"]);if($ac)$c["ADD"][]="\n $ac FOR $d";}}}}if($P=="")return
queries("CREATE TABLE ".table($B)." (".implode(",",(array)$c["ADD"])."\n)");if($P!=$B)queries("EXEC sp_rename ".q(table($P)).", ".q($B));if($kd)$c[""]=$kd;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".table($B)." $x".implode(",",$X)))return
false;}foreach($xb
as$x=>$X){$vb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$vb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($P,$c){$u=array();$oc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$oc[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($P);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($P."_"))." ON ".table($P):"ALTER TABLE ".table($P)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$oc||queries("ALTER TABLE ".table($P)." DROP ".implode(", ",$oc)));}function
last_id(){global$f;return$f->result("SELECT SCOPE_IDENTITY()");}function
explain($f,$F){$f->query("SET SHOWPLAN_ALL ON");$H=$f->query($F);$f->query("SET SHOWPLAN_ALL OFF");return$H;}function
found_rows($Q,$Z){}function
foreign_keys($P){$H=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($P).", @fktable_owner = ".q(get_schema()))as$I){$p=&$H[$I["FK_NAME"]];$p["db"]=$I["PKTABLE_QUALIFIER"];$p["table"]=$I["PKTABLE_NAME"];$p["source"][]=$I["FKCOLUMN_NAME"];$p["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($R){return
apply_queries("TRUNCATE TABLE",$R);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($R){return
queries("DROP TABLE ".implode(", ",array_map('table',$R)));}function
move_tables($R,$Xi,$Vh){return
apply_queries("ALTER SCHEMA ".idf_escape($Vh)." TRANSFER",array_merge($R,$Xi));}function
trigger($B){if($B=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($B));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($P){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($P))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$f;if($_GET["ns"]!="")return$_GET["ns"];return$f->result("SELECT SCHEMA_NAME()");}function
set_schema($Wg){return
true;}function
use_sql($Ub){return"USE ".idf_escape($Ub);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($m){}function
unconvert_field($m,$H){return$H;}function
support($Yc){return
preg_match('~^(check|comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Yc);}function
driver_config(){$U=array();$Fh=array();foreach(array('數字'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'日期時間'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'字串'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'二進位'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$U+=$X;$Fh[$x]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$nc["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ii,$C){try{$this->_link=new
MongoClient($Ii,$C);if($C["password"]!=""){$C["password"]="";try{new
MongoClient($Ii,$C);$this->error='資料庫不支援密碼。';}catch(Exception$uc){}}}catch(Exception$uc){$this->error=$uc->getMessage();}}function
query($F){return
false;}function
select_db($Ub){try{$this->_db=$this->_link->selectDB($Ub);return
true;}catch(Exception$Lc){$this->error=$Lc->getMessage();return
false;}}function
quote($O){return$O;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$fe){$I=array();foreach($fe
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$I[$x]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$I;foreach($I
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$x=>$X)$H[$x]=$I[$x];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$je=array_keys($this->_rows[0]);$B=$je[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$jg="_id";function
select($P,$K,$Z,$vd,$_f=array(),$y=1,$D=0,$lg=false){$K=($K==array("*")?array():array_fill_keys($K,true));$th=array();foreach($_f
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Jb);$th[$X]=($Jb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($P)->find(array(),$K)->sort($th)->limit($y!=""?+$y:0)->skip($D*$y));}function
insert($P,$M){try{$H=$this->_conn->_db->selectCollection($P)->insert($M);$this->_conn->errno=$H['code'];$this->_conn->error=$H['err'];$this->_conn->last_id=$M['_id'];return!$H['err'];}catch(Exception$Lc){$this->_conn->error=$Lc->getMessage();return
false;}}}function
get_databases($id){global$f;$H=array();$Yb=$f->_link->listDBs();foreach($Yb['databases']as$j)$H[]=$j['name'];return$H;}function
count_tables($i){global$f;$H=array();foreach($i
as$j)$H[$j]=count($f->_link->selectDB($j)->getCollectionNames(true));return$H;}function
tables_list(){global$f;return
array_fill_keys($f->_db->getCollectionNames(true),'table');}function
drop_databases($i){global$f;foreach($i
as$j){$Ig=$f->_link->selectDB($j)->drop();if(!$Ig['ok'])return
false;}return
true;}function
indexes($P,$g=null){global$f;$H=array();foreach($f->_db->selectCollection($P)->getIndexInfo()as$u){$gc=array();foreach($u["key"]as$d=>$T)$gc[]=($T==-1?'1':null);$H[$u["name"]]=array("type"=>($u["name"]=="_id_"?"PRIMARY":($u["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($u["key"]),"lengths"=>array(),"descs"=>$gc,);}return$H;}function
fields($P){return
fields_from_edit();}function
found_rows($Q,$Z){global$f;return$f->_db->selectCollection($_GET["select"])->count($Z);}$wf=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ii,$C){$jb='MongoDB\Driver\Manager';$this->_link=new$jb($Ii,$C);$this->executeCommand($C["db"],array('ping'=>1));}function
executeCommand($j,$tb){$jb='MongoDB\Driver\Command';try{return$this->_link->executeCommand($j,new$jb($tb));}catch(Exception$uc){$this->error=$uc->getMessage();return
array();}}function
executeBulkWrite($Ye,$Wa,$Kb){try{$Lg=$this->_link->executeBulkWrite($Ye,$Wa);$this->affected_rows=$Lg->$Kb();return
true;}catch(Exception$uc){$this->error=$uc->getMessage();return
false;}}function
query($F){return
false;}function
select_db($Ub){$this->_db_name=$Ub;return
true;}function
quote($O){return$O;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$fe){$I=array();foreach($fe
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$I[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$I;foreach($I
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$x=>$X)$H[$x]=$I[$x];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$je=array_keys($this->_rows[0]);$B=$je[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$jg="_id";function
select($P,$K,$Z,$vd,$_f=array(),$y=1,$D=0,$lg=false){global$f;$K=($K==array("*")?array():array_fill_keys($K,1));if(count($K)&&!isset($K['_id']))$K['_id']=0;$Z=where_to_query($Z);$th=array();foreach($_f
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Jb);$th[$X]=($Jb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$qh=$D*$y;$jb='MongoDB\Driver\Query';try{return
new
Min_Result($f->_link->executeQuery("$f->_db_name.$P",new$jb($Z,array('projection'=>$K,'limit'=>$y,'skip'=>$qh,'sort'=>$th))));}catch(Exception$uc){$f->error=$uc->getMessage();return
false;}}function
update($P,$M,$ug,$y=0,$eh="\n"){global$f;$j=$f->_db_name;$Z=sql_query_where_parser($ug);$jb='MongoDB\Driver\BulkWrite';$Wa=new$jb(array());if(isset($M['_id']))unset($M['_id']);$Fg=array();foreach($M
as$x=>$Y){if($Y=='NULL'){$Fg[$x]=1;unset($M[$x]);}}$Hi=array('$set'=>$M);if(count($Fg))$Hi['$unset']=$Fg;$Wa->update($Z,$Hi,array('upsert'=>false));return$f->executeBulkWrite("$j.$P",$Wa,'getModifiedCount');}function
delete($P,$ug,$y=0){global$f;$j=$f->_db_name;$Z=sql_query_where_parser($ug);$jb='MongoDB\Driver\BulkWrite';$Wa=new$jb(array());$Wa->delete($Z,array('limit'=>$y));return$f->executeBulkWrite("$j.$P",$Wa,'getDeletedCount');}function
insert($P,$M){global$f;$j=$f->_db_name;$jb='MongoDB\Driver\BulkWrite';$Wa=new$jb(array());if($M['_id']=='')unset($M['_id']);$Wa->insert($M);return$f->executeBulkWrite("$j.$P",$Wa,'getInsertedCount');}}function
get_databases($id){global$f;$H=array();foreach($f->executeCommand($f->_db_name,array('listDatabases'=>1))as$Yb){foreach($Yb->databases
as$j)$H[]=$j->name;}return$H;}function
count_tables($i){$H=array();return$H;}function
tables_list(){global$f;$qb=array();foreach($f->executeCommand($f->_db_name,array('listCollections'=>1))as$G)$qb[$G->name]='table';return$qb;}function
drop_databases($i){return
false;}function
indexes($P,$g=null){global$f;$H=array();foreach($f->executeCommand($f->_db_name,array('listIndexes'=>$P))as$u){$gc=array();$e=array();foreach(get_object_vars($u->key)as$d=>$T){$gc[]=($T==-1?'1':null);$e[]=$d;}$H[$u->name]=array("type"=>($u->name=="_id_"?"PRIMARY":(isset($u->unique)?"UNIQUE":"INDEX")),"columns"=>$e,"lengths"=>array(),"descs"=>$gc,);}return$H;}function
fields($P){global$k;$n=fields_from_edit();if(!$n){$G=$k->select($P,array("*"),null,null,array(),10);if($G){while($I=$G->fetch_assoc()){foreach($I
as$x=>$X){$I[$x]=null;$n[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$k->primary),"auto_increment"=>($x==$k->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$n;}function
found_rows($Q,$Z){global$f;$Z=where_to_query($Z);$li=$f->executeCommand($f->_db_name,array('count'=>$Q['Name'],'query'=>$Z))->toArray();return$li[0]->n;}function
sql_query_where_parser($ug){$ug=preg_replace('~^\s*WHERE\s*~',"",$ug);while($ug[0]=="(")$ug=preg_replace('~^\((.*)\)$~',"$1",$ug);$hj=explode(' AND ',$ug);$ij=explode(') OR (',$ug);$Z=array();foreach($hj
as$fj)$Z[]=trim($fj);if(count($ij)==1)$ij=array();elseif(count($ij)>1)$Z=array();return
where_to_query($Z,$ij);}function
where_to_query($dj=array(),$ej=array()){global$b;$Sb=array();foreach(array('and'=>$dj,'or'=>$ej)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Rc){list($mb,$uf,$X)=explode(" ",$Rc,3);if($mb=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$A)){list(,$jb,$X)=$A;$X=new$jb($X);}if(!in_array($uf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$uf,$A)){$X=(float)$X;$uf=$A[1];}elseif(preg_match('~^\(date\)(.+)~',$uf,$A)){$Vb=new
DateTime($X);$jb='MongoDB\BSON\UTCDatetime';$X=new$jb($Vb->getTimestamp()*1000);$uf=$A[1];}switch($uf){case'=':$uf='$eq';break;case'!=':$uf='$ne';break;case'>':$uf='$gt';break;case'<':$uf='$lt';break;case'>=':$uf='$gte';break;case'<=':$uf='$lte';break;case'regex':$uf='$regex';break;default:continue
2;}if($T=='and')$Sb['$and'][]=array($mb=>array($uf=>$X));elseif($T=='or')$Sb['$or'][]=array($mb=>array($uf=>$X));}}}return$Sb;}$wf=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($t){return$t;}function
idf_escape($t){return$t;}function
table_status($B="",$Xc=false){$H=array();foreach(tables_list()as$P=>$T){$H[$P]=array("Name"=>$P);if($B==$P)return$H[$P];}return$H;}function
create_database($j,$ob){return
true;}function
last_id(){global$f;return$f->last_id;}function
error(){global$f;return
h($f->error);}function
collations(){return
array();}function
logged_user(){global$b;$Nb=$b->credentials();return$Nb[1];}function
connect(){global$b;$f=new
Min_DB;list($L,$V,$E)=$b->credentials();if($L=="")$L="localhost:27017";$C=array();if($V.$E!=""){$C["username"]=$V;$C["password"]=$E;}$j=$b->database();if($j!="")$C["db"]=$j;if(($Ja=getenv("MONGO_AUTH_SOURCE")))$C["authSource"]=$Ja;$f->connect("mongodb://$L",$C);if($f->error)return$f->error;return$f;}function
alter_indexes($P,$c){global$f;foreach($c
as$X){list($T,$B,$M)=$X;if($M=="DROP")$H=$f->_db->command(array("deleteIndexes"=>$P,"index"=>$B));else{$e=array();foreach($M
as$d){$d=preg_replace('~ DESC$~','',$d,1,$Jb);$e[$d]=($Jb?-1:1);}$H=$f->_db->selectCollection($P)->ensureIndex($e,array("unique"=>($T=="UNIQUE"),"name"=>$B,));}if($H['errmsg']){$f->error=$H['errmsg'];return
false;}}return
true;}function
support($Yc){return
preg_match("~database|indexes|descidx~",$Yc);}function
db_collation($j,$pb){}function
information_schema(){}function
is_view($Q){}function
convert_field($m){}function
unconvert_field($m,$H){return$H;}function
foreign_keys($P){return
array();}function
fk_support($Q){}function
engines(){return
array();}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){global$f;if($P==""){$f->_db->createCollection($B);return
true;}}function
drop_tables($R){global$f;foreach($R
as$P){$Ig=$f->_db->selectCollection($P)->drop();if(!$Ig['ok'])return
false;}return
true;}function
truncate_tables($R){global$f;foreach($R
as$P){$Ig=$f->_db->selectCollection($P)->remove();if(!$Ig['ok'])return
false;}return
true;}function
driver_config(){global$wf;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$wf,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($h=false){return
password_file($h);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($L){return
h($L);}function
database(){return
DB;}function
databases($id=true){return
get_databases($id);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$H=array();$o="adminer.css";if(file_exists($o))$H[]="$o?v=".crc32(file_get_contents($o));return$H;}function
loginForm(){global$nc;echo"<table class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'資料庫系統'.'<td>',html_select("auth[driver]",$nc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'伺服器'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'帳號'.'<td>','<input name="auth[username]" id="username" autofocus value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'密碼'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'資料庫'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'登入'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'永久登入')."\n";}function
loginFormField($B,$Ed,$Y){return$Ed.$Y;}function
login($ze,$E){if($E=="")return
sprintf('Adminer預設不支援訪問沒有密碼的資料庫，<a href="https://www.adminer.org/en/password/"%s>詳情見這裡</a>.',target_blank());return
true;}function
tableName($Mh){return
h($Mh["Name"]);}function
fieldName($m,$_f=0){return'<span title="'.h($m["full_type"]).'">'.h($m["field"]).'</span>';}function
selectLinks($Mh,$M=""){global$w,$k;echo'<p class="links">';$ye=array("select"=>'選擇資料');if(support("table")||support("indexes"))$ye["table"]='顯示結構';if(support("table")){if(is_view($Mh))$ye["view"]='修改檢視表';else$ye["create"]='修改資料表';}if($M!==null)$ye["edit"]='新增項目';$B=$Mh["Name"];foreach($ye
as$x=>$X)echo" <a href='".h(ME)."$x=".urlencode($B).($x=="edit"?$M:"")."'".bold(isset($_GET[$x])).">$X</a>";echo
doc_link(array($w=>$k->tableHelp($B)),"?"),"\n";}function
foreignKeys($P){return
foreign_keys($P);}function
backwardKeys($P,$Lh){return
array();}function
backwardKeysPrint($Na,$I){}function
selectQuery($F,$Ch,$Wc=false){global$w,$k;$H="</p>\n";if(!$Wc&&($aj=$k->warnings())){$Jd="warnings";$H=", <a href='#$Jd'>".'警告'."</a>".script("qsl('a').onclick = partial(toggle, '$Jd');","")."$H<div id='$Jd' class='hidden'>\n$aj</div>\n";}return"<p><code class='jush-$w'>".h(str_replace("\n"," ",$F))."</code> <span class='time'>(".format_time($Ch).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($F)."'>".'編輯'."</a>":"").$H;}function
sqlCommandQuery($F){return
shorten_utf8(trim($F),1000);}function
rowDescription($P){return"";}function
rowDescriptions($J,$ld){return$J;}function
selectLink($X,$m){}function
selectVal($X,$z,$m,$Hf){$H=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$m["type"])&&!preg_match("~var~",$m["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$m["type"])&&!is_utf8($X))$H="<i>".sprintf('%d byte(s)',strlen($Hf))."</i>";if(preg_match('~json~',$m["type"]))$H="<code class='jush-js'>$H</code>";return($z?"<a href='".h($z)."'".(is_url($z)?target_blank():"").">$H</a>":$H);}function
editVal($X,$m){return$X;}function
tableStructurePrint($n){global$Fh;echo"<div class='scrollable'>\n","<table class='nowrap odds'>\n","<thead><tr><th>".'欄位'."<td>".'類型'.(support("comment")?"<td>".'註解':"")."</thead>\n";foreach($n
as$m){echo"<tr><th>".h($m["field"]);$T=h($m["full_type"]);echo"<td><span title='".h($m["collation"])."'>".(in_array($T,(array)$Fh['使用者類型'])?"<a href='".h(ME.'type='.urlencode($T))."'>$T</a>":$T)."</span>",($m["null"]?" <i>NULL</i>":""),($m["auto_increment"]?" <i>".'自動遞增'."</i>":""),(isset($m["default"])?" <span title='".'預設值'."'>[<b>".h($m["default"])."</b>]</span>":""),(support("comment")?"<td>".h($m["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($v){echo"<table>\n";foreach($v
as$B=>$u){ksort($u["columns"]);$lg=array();foreach($u["columns"]as$x=>$X)$lg[]="<i>".h($X)."</i>".($u["lengths"][$x]?"(".$u["lengths"][$x].")":"").($u["descs"][$x]?" DESC":"");echo"<tr title='".h($B)."'><th>$u[type]<td>".implode(", ",$lg)."\n";}echo"</table>\n";}function
selectColumnsPrint($K,$e){global$rd,$yd;print_fieldset("select",'選擇',$K);$s=0;$K[""]=array();foreach($K
as$x=>$X){$X=$_GET["columns"][$x];$d=select_input(" name='columns[$s][col]'",$e,$X["col"],($x!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($rd||$yd?"<select name='columns[$s][fun]'>".optionlist(array(-1=>"")+array_filter(array('函式'=>$rd,'集合'=>$yd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($x!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($d)":$d)."</div>\n";$s++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$e,$v){print_fieldset("search",'搜尋',$Z);foreach($v
as$s=>$u){if($u["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$u["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$s]' value='".h($_GET["fulltext"][$s])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$s]",1,isset($_GET["boolean"][$s]),"BOOL"),"</div>\n";}}$ab="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$s=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$s][col]'",$e,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'任意位置'.")"),html_select("where[$s][op]",$this->operators,$X["op"],$ab),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $ab }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($_f,$e,$v){print_fieldset("sort",'排序',$_f);$s=0;foreach((array)$_GET["order"]as$x=>$X){if($X!=""){echo"<div>".select_input(" name='order[$s]'",$e,$X,"selectFieldChange"),checkbox("desc[$s]",1,isset($_GET["desc"][$x]),'降冪 (遞減)')."</div>\n";$s++;}}echo"<div>".select_input(" name='order[$s]'",$e,"","selectAddRow"),checkbox("desc[$s]",1,false,'降冪 (遞減)')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".'限定'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($y)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($bi){if($bi!==null){echo"<fieldset><legend>".'Text 長度'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($bi)."'>","</div></fieldset>\n";}}function
selectActionPrint($v){echo"<fieldset><legend>".'動作'."</legend><div>","<input type='submit' value='".'選擇'."'>"," <span id='noindex' title='".'全資料表掃描'."'></span>","<script".nonce().">\n","var indexColumns = ";$e=array();foreach($v
as$u){$Rb=reset($u["columns"]);if($u["type"]!="FULLTEXT"&&$Rb)$e[$Rb]=1;}$e[""]=1;foreach($e
as$x=>$X)json_row($x);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($_c,$e){}function
selectColumnsProcess($e,$v){global$rd,$yd;$K=array();$vd=array();foreach((array)$_GET["columns"]as$x=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$rd)||in_array($X["fun"],$yd)))){$K[$x]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$yd))$vd[]=$K[$x];}}return
array($K,$vd);}function
selectSearchProcess($n,$v){global$f,$k;$H=array();foreach($v
as$s=>$u){if($u["type"]=="FULLTEXT"&&$_GET["fulltext"][$s]!="")$H[]="MATCH (".implode(", ",array_map('idf_escape',$u["columns"])).") AGAINST (".q($_GET["fulltext"][$s]).(isset($_GET["boolean"][$s])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$x=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$hg="";$yb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Nd=process_length($X["val"]);$yb.=" ".($Nd!=""?$Nd:"(NULL)");}elseif($X["op"]=="SQL")$yb=" $X[val]";elseif($X["op"]=="LIKE %%")$yb=" LIKE ".$this->processInput($n[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$yb=" ILIKE ".$this->processInput($n[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$hg="$X[op](".q($X["val"]).", ";$yb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$yb.=" ".$this->processInput($n[$X["col"]],$X["val"]);if($X["col"]!="")$H[]=$hg.$k->convertSearch(idf_escape($X["col"]),$X,$n[$X["col"]]).$yb;else{$rb=array();foreach($n
as$B=>$m){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$m["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$m["type"]))&&(!preg_match('~date|timestamp~',$m["type"])||preg_match('~^\d+-\d+-\d+~',$X["val"])))$rb[]=$hg.$k->convertSearch(idf_escape($B),$X,$m).$yb;}$H[]=($rb?"(".implode(" OR ",$rb).")":"1 = 0");}}}return$H;}function
selectOrderProcess($n,$v){$H=array();foreach((array)$_GET["order"]as$x=>$X){if($X!="")$H[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$x])?" DESC":"");}return$H;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$ld){return
false;}function
selectQueryBuild($K,$Z,$vd,$_f,$y,$D){return"";}function
messageQuery($F,$ci,$Wc=false){global$w,$k;restart_session();$Fd=&get_session("queries");if(!$Fd[$_GET["db"]])$Fd[$_GET["db"]]=array();if(strlen($F)>1e6)$F=preg_replace('~[\x80-\xFF]+$~','',substr($F,0,1e6))."\n…";$Fd[$_GET["db"]][]=array($F,time(),$ci);$zh="sql-".count($Fd[$_GET["db"]]);$H="<a href='#$zh' class='toggle'>".'SQL 命令'."</a>\n";if(!$Wc&&($aj=$k->warnings())){$Jd="warnings-".count($Fd[$_GET["db"]]);$H="<a href='#$Jd' class='toggle'>".'警告'."</a>, $H<div id='$Jd' class='hidden'>\n$aj</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $H<div id='$zh' class='hidden'><pre><code class='jush-$w'>".shorten_utf8($F,1000)."</code></pre>".($ci?" <span class='time'>($ci)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($Fd[$_GET["db"]])-1)).'">'.'編輯'.'</a>':'').'</div>';}function
editRowPrint($P,$n,$I,$Hi){}function
editFunctions($m){global$vc;$H=($m["null"]?"NULL/":"");$Hi=isset($_GET["select"])||where($_GET);foreach($vc
as$x=>$rd){if(!$x||(!isset($_GET["call"])&&$Hi)){foreach($rd
as$Yf=>$X){if(!$Yf||preg_match("~$Yf~",$m["type"]))$H.="/$X";}}if($x&&!preg_match('~set|blob|bytea|raw|file|bool~',$m["type"]))$H.="/SQL";}if($m["auto_increment"]&&!$Hi)$H='自動遞增';return
explode("/",$H);}function
editInput($P,$m,$Ha,$Y){if($m["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ha value='-1' checked><i>".'原始'."</i></label> ":"").($m["null"]?"<label><input type='radio'$Ha value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ha,$m,$Y,$Y===0?0:null);return"";}function
editHint($P,$m,$Y){return"";}function
processInput($m,$Y,$r=""){if($r=="SQL")return$Y;$B=$m["field"];$H=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$r))$H="$r()";elseif(preg_match('~^current_(date|timestamp)$~',$r))$H=$r;elseif(preg_match('~^([+-]|\|\|)$~',$r))$H=idf_escape($B)." $r $H";elseif(preg_match('~^[+-] interval$~',$r))$H=idf_escape($B)." $r ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$H);elseif(preg_match('~^(addtime|subtime|concat)$~',$r))$H="$r(".idf_escape($B).", $H)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$r))$H="$r($H)";return
unconvert_field($m,$H);}function
dumpOutput(){$H=array('text'=>'打開','file'=>'儲存');if(function_exists('gzencode'))$H['gz']='gzip';return$H;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($j){}function
dumpTable($P,$Gh,$ee=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Gh)dump_csv(array_keys(fields($P)));}else{if($ee==2){$n=array();foreach(fields($P)as$B=>$m)$n[]=idf_escape($B)." $m[full_type]";$h="CREATE TABLE ".table($P)." (".implode(", ",$n).")";}else$h=create_sql($P,$_POST["auto_increment"],$Gh);set_utf8mb4($h);if($Gh&&$h){if($Gh=="DROP+CREATE"||$ee==1)echo"DROP ".($ee==2?"VIEW":"TABLE")." IF EXISTS ".table($P).";\n";if($ee==1)$h=remove_definer($h);echo"$h;\n\n";}}}function
dumpData($P,$Gh,$F){global$f,$w;if($Gh){$Fe=($w=="sqlite"?0:1048576);$n=array();if($_POST["format"]=="sql"){if($Gh=="TRUNCATE+INSERT")echo
truncate_sql($P).";\n";$n=fields($P);}$G=$f->query($F,1);if($G){$Xd="";$Va="";$je=array();$sd=array();$Ih="";$Zc=($P!=''?'fetch_assoc':'fetch_row');while($I=$G->$Zc()){if(!$je){$Si=array();foreach($I
as$X){$m=$G->fetch_field();if($n[$m->name]['generated']){$sd[$m->name]=true;continue;}$je[]=$m->name;$x=idf_escape($m->name);$Si[]="$x = VALUES($x)";}$Ih=($Gh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Si):"").";\n";}if($_POST["format"]!="sql"){if($Gh=="table"){dump_csv($je);$Gh="INSERT";}dump_csv($I);}else{if(!$Xd)$Xd="INSERT INTO ".table($P)." (".implode(", ",array_map('idf_escape',$je)).") VALUES";foreach($I
as$x=>$X){if($sd[$x]){unset($I[$x]);continue;}$m=$n[$x];$I[$x]=($X!==null?unconvert_field($m,preg_match(number_type(),$m["type"])&&!preg_match('~\[~',$m["full_type"])&&is_numeric($X)?$X:q(($X===false?0:$X))):"NULL");}$Ug=($Fe?"\n":" ")."(".implode(",\t",$I).")";if(!$Va)$Va=$Xd.$Ug;elseif(strlen($Va)+4+strlen($Ug)+strlen($Ih)<$Fe)$Va.=",$Ug";else{echo$Va.$Ih;$Va=$Xd.$Ug;}}}if($Va)echo$Va.$Ih;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$f->error)."\n";}}function
dumpFilename($Kd){return
friendly_url($Kd!=""?$Kd:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Kd,$Ue=false){$Kf=$_POST["output"];$Sc=(preg_match('~sql~',$_POST["format"])?"sql":($Ue?"tar":"csv"));header("Content-Type: ".($Kf=="gz"?"application/x-gzip":($Sc=="tar"?"application/x-tar":($Sc=="sql"||$Kf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Kf=="gz")ob_start('ob_gzencode',1e6);return$Sc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'修改資料庫'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'修改資料表結構':'建立資料表結構')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'資料庫結構'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'權限'."</a>\n":"");return
true;}function
navigation($Te){global$ia,$w,$nc,$f;echo'<h1>
',$this->name(),'<span class="version">
',$ia,' <a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</span>
</h1>
';if($Te=="auth"){$Kf="";foreach((array)$_SESSION["pwds"]as$Ui=>$jh){foreach($jh
as$L=>$Pi){foreach($Pi
as$V=>$E){if($E!==null){$Yb=$_SESSION["db"][$Ui][$L][$V];foreach(($Yb?array_keys($Yb):array(""))as$j)$Kf.="<li><a href='".h(auth_url($Ui,$L,$V,$j))."'>($nc[$Ui]) ".h($V.($L!=""?"@".$this->serverName($L):"").($j!=""?" - $j":""))."</a>\n";}}}}if($Kf)echo"<ul id='logins'>\n$Kf</ul>\n".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");}else{$R=array();if($_GET["ns"]!==""&&!$Te&&DB!=""){$f->select_db(DB);$R=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.17.1");if(support("sql")){echo'<script',nonce(),'>
';if($R){$ye=array();foreach($R
as$P=>$T)$ye[]=preg_quote($P,'/');echo"var jushLinks = { $w: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$ye).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$w;\n";}$ih=$f->server_info;echo'bodyLoad(\'',(is_object($f)?preg_replace('~^(\d\.?\d).*~s','\1',$ih):""),'\'',(preg_match('~MariaDB~',$ih)?", true":""),');
</script>
';}$this->databasesPrint($Te);$va=array();if(DB==""||!$Te){if(support("sql")){$va[]="<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL 命令'."</a>";$va[]="<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'匯入'."</a>";}if(support("dump"))$va[]="<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'匯出'."</a>";}$Od=$_GET["ns"]!==""&&!$Te&&DB!="";if($Od)$va[]='<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'建立資料表'."</a>";echo($va?"<p class='links'>\n".implode("\n",$va)."\n":"");if($Od){if($R)$this->tablesPrint($R);else
echo"<p class='message'>".'沒有資料表。'."</p>\n";}}}function
databasesPrint($Te){global$b,$f;$i=$this->databases();if(DB&&$i&&!in_array(DB,$i))array_unshift($i,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Wb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'資料庫'."'>".'資料庫'."</span>: ".($i?"<select name='db'>".optionlist(array(""=>"")+$i,DB)."</select>$Wb":"<input name='db' value='".h(DB)."' autocapitalize='off' size='19'>\n"),"<input type='submit' value='".'使用'."'".($i?" class='hidden'":"").">\n";if(support("scheme")){if($Te!="db"&&DB!=""&&$f->select_db(DB)){echo"<br>".'資料表結構'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Wb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($R){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($R
as$P=>$N){$B=$this->tableName($N);if($B!=""){echo'<li><a href="'.h(ME).'select='.urlencode($P).'"'.bold($_GET["select"]==$P||$_GET["edit"]==$P,"select")." title='".'選擇資料'."'>".'選擇'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($P).'"'.bold(in_array($P,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($N)?"view":"structure"))." title='".'顯示結構'."'>$B</a>":"<span>$B</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$nc=array("server"=>"MySQL")+$nc;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($L="",$V="",$E="",$Ub=null,$cg=null,$sh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Hd,$cg)=explode(":",$L,2);$Bh=$b->connectSsl();if($Bh)$this->ssl_set($Bh['key'],$Bh['cert'],$Bh['ca'],'','');$H=@$this->real_connect(($L!=""?$Hd:ini_get("mysqli.default_host")),($L.$V!=""?$V:ini_get("mysqli.default_user")),($L.$V.$E!=""?$E:ini_get("mysqli.default_pw")),$Ub,(is_numeric($cg)?$cg:ini_get("mysqli.default_port")),(!is_numeric($cg)?$cg:$sh),($Bh?(empty($Bh['cert'])?2048:64):0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$H;}function
set_charset($bb){if(parent::set_charset($bb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $bb");}function
result($F,$m=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch_array();return$I[$m];}function
quote($O){return"'".$this->escape_string($O)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($L,$V,$E){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('禁用 %s 或啟用 %s 或 %s 擴充模組。',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($L!=""?$L:ini_get("mysql.default_host")),("$L$V"!=""?$V:ini_get("mysql.default_user")),("$L$V$E"!=""?$E:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($bb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($bb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $bb");}function
quote($O){return"'".mysql_real_escape_string($O,$this->_link)."'";}function
select_db($Ub){return
mysql_select_db($Ub,$this->_link);}function
query($F,$_i=false){$G=@($_i?mysql_unbuffered_query($F,$this->_link):mysql_query($F,$this->_link));$this->error="";if(!$G){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$m=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
mysql_result($G->_result,0,$m);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$H=mysql_fetch_field($this->_result,$this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($L,$V,$E){global$b;$C=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Bh=$b->connectSsl();if($Bh){if(!empty($Bh['key']))$C[PDO::MYSQL_ATTR_SSL_KEY]=$Bh['key'];if(!empty($Bh['cert']))$C[PDO::MYSQL_ATTR_SSL_CERT]=$Bh['cert'];if(!empty($Bh['ca']))$C[PDO::MYSQL_ATTR_SSL_CA]=$Bh['ca'];if(!empty($Bh['verify']))$C[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT]=$Bh['verify'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$L)),$V,$E,$C);return
true;}function
set_charset($bb){$this->query("SET NAMES $bb");}function
select_db($Ub){return$this->query("USE ".idf_escape($Ub));}function
query($F,$_i=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$_i);return
parent::query($F,$_i);}}}class
Min_Driver
extends
Min_SQL{function
insert($P,$M){return($M?parent::insert($P,$M):queries("INSERT INTO ".table($P)." ()\nVALUES ()"));}function
insertUpdate($P,$J,$jg){$e=array_keys(reset($J));$hg="INSERT INTO ".table($P)." (".implode(", ",$e).") VALUES\n";$Si=array();foreach($e
as$x)$Si[$x]="$x = VALUES($x)";$Ih="\nON DUPLICATE KEY UPDATE ".implode(", ",$Si);$Si=array();$ve=0;foreach($J
as$M){$Y="(".implode(", ",$M).")";if($Si&&(strlen($hg)+$ve+strlen($Y)+strlen($Ih)>1e6)){if(!queries($hg.implode(",\n",$Si).$Ih))return
false;$Si=array();$ve=0;}$Si[]=$Y;$ve+=strlen($Y)+2;}return
queries($hg.implode(",\n",$Si).$Ih);}function
slowQuery($F,$di){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$di FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$A))return"$A[1] /*+ MAX_EXECUTION_TIME(".($di*1000).") */ $A[2]";}}function
convertSearch($t,$X,$m){return(preg_match('~char|text|enum|set~',$m["type"])&&!preg_match("~^utf8~",$m["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->_conn).")":$t);}function
warnings(){$G=$this->_conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();select($G);return
ob_get_clean();}}function
tableHelp($B){$Ae=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower("information-schema-".($Ae?"$B-table/":str_replace("_","-",$B)."-table.html"));if(DB=="mysql")return($Ae?"mysql$B-table/":"system-schema.html");}function
hasCStyleEscapes(){static$Xa;if($Xa===null){$_h=$this->_conn->result("SHOW VARIABLES LIKE 'sql_mode'",1);$Xa=(strpos($_h,'NO_BACKSLASH_ESCAPES')===false);}return$Xa;}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Fh,$vc;$f=new
Min_DB;$Nb=$b->credentials();if($f->connect($Nb[0],$Nb[1],$Nb[2])){$f->set_charset(charset($f));$f->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$f)){$Fh['字串'][]="json";$U["json"]=4294967295;}if(min_version('',10.7,$f)){$Fh['字串'][]="uuid";$U["uuid"]=128;$vc[0]['uuid']='uuid';}if(min_version(9,'',$f)){$Fh['數字'][]="vector";$U["vector"]=16383;$vc[0]['vector']='string_to_vector';}return$f;}$H=$f->error;if(function_exists('iconv')&&!is_utf8($H)&&strlen($Ug=iconv("windows-1250","utf-8",$H))>strlen($H))$H=$Ug;return$H;}function
get_databases($id){$H=get_session("dbs");if($H===null){$F=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$H=($id?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$y,$jf=0,$eh=" "){return" $F$Z".($y!==null?$eh."LIMIT $y".($jf?" OFFSET $jf":""):"");}function
limit1($P,$F,$Z,$eh="\n"){return
limit($F,$Z,1,0,$eh);}function
db_collation($j,$pb){global$f;$H=null;$h=$f->result("SHOW CREATE DATABASE ".idf_escape($j),1);if(preg_match('~ COLLATE ([^ ]+)~',$h,$A))$H=$A[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$h,$A))$H=$pb[$A[1]][-1];return$H;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
logged_user(){global$f;return$f->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($i){$H=array();foreach($i
as$j)$H[$j]=count(get_vals("SHOW TABLES IN ".idf_escape($j)));return$H;}function
table_status($B="",$Xc=false){$H=array();foreach(get_rows($Xc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($B!=""?"AND TABLE_NAME = ".q($B):"ORDER BY Name"):"SHOW TABLE STATUS".($B!=""?" LIKE ".q(addcslashes($B,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($B!=""){$I["Name"]=$B;return$I;}$H[$I["Name"]]=$I;}return$H;}function
is_view($Q){return$Q["Engine"]===null;}function
fk_support($Q){return
preg_match('~InnoDB|IBMDB2I~i',$Q["Engine"])||(preg_match('~NDB~i',$Q["Engine"])&&min_version(5.6));}function
fields($P){$H=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($P))as$I){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$I["Type"],$A);$H[$I["Field"]]=array("field"=>$I["Field"],"full_type"=>$I["Type"],"type"=>$A[1],"length"=>$A[2],"unsigned"=>ltrim($A[3].$A[4]),"default"=>($I["Default"]!=""||preg_match("~char|set~",$A[1])?(preg_match('~text~',$A[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$I["Default"])):$I["Default"]):null),"null"=>($I["Null"]=="YES"),"auto_increment"=>($I["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$I["Extra"],$A)?$A[1]:""),"collation"=>$I["Collation"],"privileges"=>array_flip(preg_split('~, *~',$I["Privileges"])),"comment"=>$I["Comment"],"primary"=>($I["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$I["Extra"]),);}return$H;}function
indexes($P,$g=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($P),$g)as$I){$B=$I["Key_name"];$H[$B]["type"]=($B=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$B]["columns"][]=$I["Column_name"];$H[$B]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$B]["descs"][]=null;}return$H;}function
foreign_keys($P){global$f,$rf;static$Yf='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$Lb=$f->result("SHOW CREATE TABLE ".table($P),1);if($Lb){preg_match_all("~CONSTRAINT ($Yf) FOREIGN KEY ?\\(((?:$Yf,? ?)+)\\) REFERENCES ($Yf)(?:\\.($Yf))? \\(((?:$Yf,? ?)+)\\)(?: ON DELETE ($rf))?(?: ON UPDATE ($rf))?~",$Lb,$De,PREG_SET_ORDER);foreach($De
as$A){preg_match_all("~$Yf~",$A[2],$uh);preg_match_all("~$Yf~",$A[5],$Vh);$H[idf_unescape($A[1])]=array("db"=>idf_unescape($A[4]!=""?$A[3]:$A[4]),"table"=>idf_unescape($A[4]!=""?$A[4]:$A[3]),"source"=>array_map('idf_unescape',$uh[0]),"target"=>array_map('idf_unescape',$Vh[0]),"on_delete"=>($A[6]?$A[6]:"RESTRICT"),"on_update"=>($A[7]?$A[7]:"RESTRICT"),);}}return$H;}function
adm_view($B){global$f;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$f->result("SHOW CREATE VIEW ".table($B),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$x=>$X)asort($H[$x]);return$H;}function
information_schema($j){return(min_version(5)&&$j=="information_schema")||(min_version(5.5)&&$j=="performance_schema");}function
error(){global$f;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$f->error));}function
create_database($j,$ob){return
queries("CREATE DATABASE ".idf_escape($j).($ob?" COLLATE ".q($ob):""));}function
drop_databases($i){$H=apply_queries("DROP DATABASE",$i,'idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($B,$ob){$H=false;if(create_database($B,$ob)){$R=array();$Xi=array();foreach(tables_list()as$P=>$T){if($T=='VIEW')$Xi[]=$P;else$R[]=$P;}$H=(!$R&&!$Xi)||move_tables($R,$Xi,$B);drop_databases($H?array(DB):array());}return$H;}function
auto_increment(){$La=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$La="";break;}if($u["type"]=="PRIMARY")$La=" UNIQUE";}}return" AUTO_INCREMENT$La";}function
alter_table($P,$B,$n,$kd,$vb,$Cc,$ob,$Ka,$Uf){$c=array();foreach($n
as$m)$c[]=($m[1]?($P!=""?($m[0]!=""?"CHANGE ".idf_escape($m[0]):"ADD"):" ")." ".implode($m[1]).($P!=""?$m[2]:""):"DROP ".idf_escape($m[0]));$c=array_merge($c,$kd);$N=($vb!==null?" COMMENT=".q($vb):"").($Cc?" ENGINE=".q($Cc):"").($ob?" COLLATE ".q($ob):"").($Ka!=""?" AUTO_INCREMENT=$Ka":"");if($P=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$N$Uf");if($P!=$B)$c[]="RENAME TO ".table($B);if($N)$c[]=ltrim($N);return($c||$Uf?queries("ALTER TABLE ".table($P)."\n".implode(",\n",$c).$Uf):true);}function
alter_indexes($P,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($P).implode(",",$c));}function
truncate_tables($R){return
apply_queries("TRUNCATE TABLE",$R);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($R){return
queries("DROP TABLE ".implode(", ",array_map('table',$R)));}function
move_tables($R,$Xi,$Vh){global$f;$Gg=array();foreach($R
as$P)$Gg[]=table($P)." TO ".idf_escape($Vh).".".table($P);if(!$Gg||queries("RENAME TABLE ".implode(", ",$Gg))){$dc=array();foreach($Xi
as$P)$dc[table($P)]=adm_view($P);$f->select_db($Vh);$j=idf_escape(DB);foreach($dc
as$B=>$Wi){if(!queries("CREATE VIEW $B AS ".str_replace(" $j."," ",$Wi["select"]))||!queries("DROP VIEW $j.$B"))return
false;}return
true;}return
false;}function
copy_tables($R,$Xi,$Vh){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($R
as$P){$B=($Vh==DB?table("copy_$P"):idf_escape($Vh).".".table($P));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $B"))||!queries("CREATE TABLE $B LIKE ".table($P))||!queries("INSERT INTO $B SELECT * FROM ".table($P)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($P,"%_\\")))as$I){$ui=$I["Trigger"];if(!queries("CREATE TRIGGER ".($Vh==DB?idf_escape("copy_$ui"):idf_escape($Vh).".".idf_escape($ui))." $I[Timing] $I[Event] ON $B FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($Xi
as$P){$B=($Vh==DB?table("copy_$P"):idf_escape($Vh).".".table($P));$Wi=adm_view($P);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $B"))||!queries("CREATE VIEW $B AS $Wi[select]"))return
false;}return
true;}function
trigger($B){if($B=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($B));return
reset($J);}function
triggers($P){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($P,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($B,$T){global$f,$Ec,$Vd,$U;$Ba=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$vh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$zi="((".implode("|",array_merge(array_keys($U),$Ba)).")\\b(?:\\s*\\(((?:[^'\")]|$Ec)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Yf="$vh*(".($T=="FUNCTION"?"":$Vd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$zi";$h=$f->result("SHOW CREATE $T ".idf_escape($B),2);preg_match("~\\(((?:$Yf\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$zi\\s+":"")."(.*)~is",$h,$A);$n=array();preg_match_all("~$Yf\\s*,?~is",$A[1],$De,PREG_SET_ORDER);foreach($De
as$Of)$n[]=array("field"=>str_replace("``","`",$Of[2]).$Of[3],"type"=>strtolower($Of[5]),"length"=>preg_replace_callback("~$Ec~s",'normalize_enum',$Of[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Of[8] $Of[7]"))),"null"=>1,"full_type"=>$Of[4],"inout"=>strtoupper($Of[1]),"collation"=>strtolower($Of[9]),);return
array("fields"=>$n,"comment"=>$f->result("SELECT ROUTINE_COMMENT FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB)." AND ROUTINE_NAME = ".q($B)),)+($T!="FUNCTION"?array("definition"=>$A[11]):array("returns"=>array("type"=>$A[12],"length"=>$A[13],"unsigned"=>$A[15],"collation"=>$A[16]),"definition"=>$A[17],"language"=>"SQL",));}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($B,$I){return
idf_escape($B);}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ID()");}function
explain($f,$F){return$f->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$F);}function
found_rows($Q,$Z){return($Z||$Q["Engine"]!="InnoDB"?null:$Q["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Wg,$g=null){return
true;}function
create_sql($P,$Ka,$Gh){global$f;$H=$f->result("SHOW CREATE TABLE ".table($P),1);if(!$Ka)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($P){return"TRUNCATE ".table($P);}function
use_sql($Ub){return"USE ".idf_escape($Ub);}function
trigger_sql($P){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($P,"%_\\")),null,"-- ")as$I)$H.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($m){if(preg_match("~binary~",$m["type"]))return"HEX(".idf_escape($m["field"]).")";if($m["type"]=="bit")return"BIN(".idf_escape($m["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$m["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($m["field"]).")";}function
unconvert_field($m,$H){if(preg_match("~binary~",$m["type"]))$H="UNHEX($H)";if($m["type"]=="bit")$H="CONVERT(b$H, UNSIGNED)";if(preg_match("~geometry|point|linestring|polygon~",$m["type"])){$hg=(min_version(8)?"ST_":"");$H=$hg."GeomFromText($H, $hg"."SRID($m[field]))";}return$H;}function
support($Yc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))).(min_version('8.0.16','10.2.1')?"":"|check")."~",$Yc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$f;return$f->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Fh=array();foreach(array('數字'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'日期時間'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'字串'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'列表'=>array("enum"=>65535,"set"=>64),'二進位'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'幾何'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$U+=$X;$Fh[$x]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Fh,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$zb=driver_config();$gg=$zb['possible_drivers'];$w=$zb['jush'];$U=$zb['types'];$Fh=$zb['structured_types'];$Gi=$zb['unsigned'];$wf=$zb['operators'];$rd=$zb['functions'];$yd=$zb['grouping'];$vc=$zb['edit_functions'];if($b->operators===null)$b->operators=$wf;define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));function
page_header($fi,$l="",$Ua=array(),$gi=""){global$ca,$ia,$b,$nc,$w;page_headers();if(is_ajax()&&$l){page_messages($l);exit;}$hi=$fi.($gi!=""?": $gi":"");$ii=strip_tags($hi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="zh-tw" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width">
<title>',$ii,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.17.1"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.17.1");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.17.1"),'">
';foreach($b->css()as$Pb){echo'<link rel="stylesheet" type="text/css" href="',h($Pb),'">
';}}echo'
<body class="ltr nojs">
';$o=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($o)&&filemtime($o)+86400>time()){$Vi=unserialize(file_get_contents($o));$rg="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Vi["version"],base64_decode($Vi["signature"]),$rg)==1)$_COOKIE["adminer_version"]=$Vi["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('您離線了。'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$w,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Ua!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$nc[DRIVER].'</a> » ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$L=$b->serverName(SERVER);$L=($L!=""?$L:'伺服器');if($Ua===false)echo"$L\n";else{echo"<a href='".h($z)."' accesskey='1' title='Alt+Shift+1'>$L</a> » ";if($_GET["ns"]!=""||(DB!=""&&is_array($Ua)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> » ';if(is_array($Ua)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> » ';foreach($Ua
as$x=>$X){$fc=(is_array($X)?$X[1]:h($X));if($fc!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$fc</a> » ";}}echo"$fi\n";}}echo"<h2>$hi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($l);$i=&get_session("dbs");if(DB!=""&&$i&&!in_array(DB,$i,true))$i=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Ob){$Dd=array();foreach($Ob
as$x=>$X)$Dd[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Dd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$df;if(!$df)$df=base64_encode(rand_string());return$df;}function
page_messages($l){$Ii=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Qe=$_SESSION["messages"][$Ii];if($Qe){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Qe)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ii]);}if($l)echo"<div class='error'>$l</div>\n";}function
page_footer($Te=""){global$b,$S;echo'</div>

<div id="menu">
';$b->navigation($Te);echo'</div>

';if($Te!="auth"){echo'<form action="" method="post">
<p class="logout">
',h($_GET["username"])."\n",'<input type="submit" name="logout" value="登出" id="logout">
<input type="hidden" name="token" value="',$S,'">
</p>
</form>
';}echo
script("setupSubmitHighlight(document);");}function
int32($We){while($We>=2147483648)$We-=4294967296;while($We<=-2147483649)$We+=4294967296;return(int)$We;}function
long2str($W,$Zi){$Ug='';foreach($W
as$X)$Ug.=pack('V',$X);if($Zi)return
substr($Ug,0,end($W));return$Ug;}function
str2long($Ug,$Zi){$W=array_values(unpack('V*',str_pad($Ug,4*ceil(strlen($Ug)/4),"\0")));if($Zi)$W[]=strlen($Ug);return$W;}function
xxtea_mx($lj,$kj,$Jh,$he){return
int32((($lj>>5&0x7FFFFFF)^$kj<<2)+(($kj>>3&0x1FFFFFFF)^$lj<<4))^int32(($Jh^$kj)+($he^$lj));}function
encrypt_string($Eh,$x){if($Eh=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Eh,true);$We=count($W)-1;$lj=$W[$We];$kj=$W[0];$sg=floor(6+52/($We+1));$Jh=0;while($sg-->0){$Jh=int32($Jh+0x9E3779B9);$uc=$Jh>>2&3;for($Mf=0;$Mf<$We;$Mf++){$kj=$W[$Mf+1];$Ve=xxtea_mx($lj,$kj,$Jh,$x[$Mf&3^$uc]);$lj=int32($W[$Mf]+$Ve);$W[$Mf]=$lj;}$kj=$W[0];$Ve=xxtea_mx($lj,$kj,$Jh,$x[$Mf&3^$uc]);$lj=int32($W[$We]+$Ve);$W[$We]=$lj;}return
long2str($W,false);}function
decrypt_string($Eh,$x){if($Eh=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Eh,false);$We=count($W)-1;$lj=$W[$We];$kj=$W[0];$sg=floor(6+52/($We+1));$Jh=int32($sg*0x9E3779B9);while($Jh){$uc=$Jh>>2&3;for($Mf=$We;$Mf>0;$Mf--){$lj=$W[$Mf-1];$Ve=xxtea_mx($lj,$kj,$Jh,$x[$Mf&3^$uc]);$kj=int32($W[$Mf]-$Ve);$W[$Mf]=$kj;}$lj=$W[$We];$Ve=xxtea_mx($lj,$kj,$Jh,$x[$Mf&3^$uc]);$kj=int32($W[0]-$Ve);$W[0]=$kj;$Jh=int32($Jh-0x9E3779B9);}return
long2str($W,true);}$f='';$Cd=$_SESSION["token"];if(!$Cd)$_SESSION["token"]=rand(1,1e6);$S=get_token();$ag=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$ag[$x]=$X;}}function
add_invalid_login(){global$b;$q=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$q)return;$ae=unserialize(stream_get_contents($q));$ci=time();if($ae){foreach($ae
as$be=>$X){if($X[0]<$ci)unset($ae[$be]);}}$Zd=&$ae[$b->bruteForceKey()];if(!$Zd)$Zd=array($ci+30*60,0);$Zd[1]++;file_write_unlock($q,serialize($ae));}function
check_invalid_login(){global$b;$ae=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$Zd=($ae?$ae[$b->bruteForceKey()]:array());$cf=($Zd[1]>29?$Zd[0]-time():0);if($cf>0)auth_error(sprintf('登錄失敗次數過多，請 %d 分鐘後重試。',ceil($cf/60)));}$Ia=$_POST["auth"];if($Ia){session_regenerate_id();$Ui=$Ia["driver"];$L=$Ia["server"];$V=$Ia["username"];$E=(string)$Ia["password"];$j=$Ia["db"];set_password($Ui,$L,$V,$E);$_SESSION["db"][$Ui][$L][$V][$j]=true;if($Ia["permanent"]){$x=base64_encode($Ui)."-".base64_encode($L)."-".base64_encode($V)."-".base64_encode($j);$mg=$b->permanentLogin(true);$ag[$x]="$x:".base64_encode($mg?encrypt_string($E,$mg):"");adm_cookie("adminer_permanent",implode(" ",$ag));}if(count($_POST)==1||DRIVER!=$Ui||SERVER!=$L||$_GET["username"]!==$V||DB!=$j)adm_redirect(auth_url($Ui,$L,$V,$j));}elseif($_POST["logout"]&&(!$Cd||verify_token())){foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();adm_redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'成功登出。'.' '.'感謝使用Adminer，請考慮為我們<a href="https://www.adminer.org/en/donation/">捐款（英文網頁）</a>.');}elseif($ag&&!$_SESSION["pwds"]){session_regenerate_id();$mg=$b->permanentLogin();foreach($ag
as$x=>$X){list(,$ib)=explode(":",$X);list($Ui,$L,$V,$j)=array_map('base64_decode',explode("-",$x));set_password($Ui,$L,$V,decrypt_string(base64_decode($ib),$mg));$_SESSION["db"][$Ui][$L][$V][$j]=true;}}function
unset_permanent(){global$ag;foreach($ag
as$x=>$X){list($Ui,$L,$V,$j)=array_map('base64_decode',explode("-",$x));if($Ui==DRIVER&&$L==SERVER&&$V==$_GET["username"]&&$j==DB)unset($ag[$x]);}adm_cookie("adminer_permanent",implode(" ",$ag));}function
auth_error($l){global$b,$Cd;$kh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$kh]||$_GET[$kh])&&!$Cd)$l='Session 已過期，請重新登入。';else{restart_session();add_invalid_login();$E=get_password();if($E!==null){if($E===false)$l.=($l?'<br>':'').sprintf('主密碼已過期。<a href="https://www.adminer.org/en/extension/"%s>請擴展</a> %s 方法讓它永久化。',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$kh]&&$_GET[$kh]&&ini_bool("session.use_only_cookies"))$l='Session 必須被啟用。';$Pf=session_get_cookie_params();adm_cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Pf["lifetime"]);page_header('登入',$l,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'此操作將在成功使用相同的憑據登錄後執行。'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('無擴充模組',sprintf('沒有任何支援的 PHP 擴充模組（%s）。',implode(", ",$gg)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Hd,$cg)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$cg,$A)&&($A[1]<1024||$A[1]>65535))auth_error('不允許連接到特權埠。');check_invalid_login();$f=connect();$k=new
Min_Driver($f);}$ze=null;if(!is_object($f)||($ze=$b->login($_GET["username"],get_password()))!==true){$l=(is_string($f)?nl_br(h($f)):(is_string($ze)?$ze:'無效的憑證。'));auth_error($l.(preg_match('~^ | $~',get_password())?'<br>'.'您輸入的密碼中有一個空格，這可能是導致問題的原因。':''));}if($_POST["logout"]&&$Cd&&!verify_token()){page_header('登出','無效的 CSRF token。請重新發送表單。');page_footer("db");exit;}if($Ia&&$_POST["token"])$_POST["token"]=$S;$l='';if($_POST){if(!verify_token()){$Ud="max_input_vars";$Je=ini_get($Ud);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Je||$X<$Je)){$Ud=$x;$Je=$X;}}}$l=(!$_POST["token"]&&$Je?sprintf('超過允許的字段數量的最大值。請增加 %s。',"'$Ud'"):'無效的 CSRF token。請重新發送表單。'.' '.'如果您並沒有從Adminer發送請求，請關閉此頁面。');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$l=sprintf('POST 資料太大。減少資料或者增加 %s 的設定值。',"'post_max_size'");if(isset($_GET["sql"]))$l.=' '.'您可以通過FTP上傳大型SQL檔並從伺服器導入。';}function
select($G,$g=null,$Cf=array(),$y=0){global$w;$ye=array();$v=array();$e=array();$Sa=array();$U=array();$H=array();for($s=0;(!$y||$s<$y)&&($I=$G->fetch_row());$s++){if(!$s){echo"<div class='scrollable'>\n","<table class='nowrap odds'>\n","<thead><tr>";for($ge=0;$ge<count($I);$ge++){$m=$G->fetch_field();$B=$m->name;$Bf=$m->orgtable;$Af=$m->orgname;$H[$m->table]=$Bf;if($Cf&&$w=="sql")$ye[$ge]=($B=="table"?"table=":($B=="possible_keys"?"indexes=":null));elseif($Bf!=""){if(!isset($v[$Bf])){$v[$Bf]=array();foreach(indexes($Bf,$g)as$u){if($u["type"]=="PRIMARY"){$v[$Bf]=array_flip($u["columns"]);break;}}$e[$Bf]=$v[$Bf];}if(isset($e[$Bf][$Af])){unset($e[$Bf][$Af]);$v[$Bf][$Af]=$ge;$ye[$ge]=$Bf;}}if($m->charsetnr==63)$Sa[$ge]=true;$U[$ge]=$m->type;echo"<th".($Bf!=""||$m->name!=$Af?" title='".h(($Bf!=""?"$Bf.":"").$Af)."'":"").">".h($B).($Cf?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($B),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr>";foreach($I
as$x=>$X){$z="";if(isset($ye[$x])&&!$e[$ye[$x]]){if($Cf&&$w=="sql"){$P=$I[array_search("table=",$ye)];$z=ME.$ye[$x].urlencode($Cf[$P]!=""?$Cf[$P]:$P);}else{$z=ME."edit=".urlencode($ye[$x]);foreach($v[$ye[$x]]as$mb=>$ge)$z.="&where".urlencode("[".bracket_escape($mb)."]")."=".urlencode($I[$ge]);}}elseif(is_url($X))$z=$X;if($X===null)$X="<i>NULL</i>";elseif($Sa[$x]&&!is_utf8($X))$X="<i>".sprintf('%d byte(s)',strlen($X))."</i>";else{$X=h($X);if($U[$x]==254)$X="<code>$X</code>";}if($z)$X="<a href='".h($z)."'".(is_url($z)?target_blank():'').">$X</a>";echo"<td>$X";}}echo($s?"</table>\n</div>":"<p class='message'>".'沒有資料行。')."\n";return$H;}function
referencable_primary($ch){$H=array();foreach(table_status('',true)as$Nh=>$P){if($Nh!=$ch&&fk_support($P)){foreach(fields($Nh)as$m){if($m["primary"]){if($H[$Nh]){unset($H[$Nh]);break;}$H[$Nh]=$m;}}}}return$H;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$mh);return$mh;}function
adminer_setting($x){$mh=adminer_settings();return$mh[$x];}function
set_adminer_settings($mh){return
adm_cookie("adminer_settings",http_build_query($mh+adminer_settings()));}function
textarea($B,$Y,$J=10,$rb=80){global$w;echo"<textarea name='".h($B)."' rows='$J' cols='$rb' class='sqlarea jush-$w' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
select_input($Ha,$C,$Y="",$sf="",$bg=""){$Uh=($C?"select":"input");return"<$Uh$Ha".($C?"><option value=''>$bg".optionlist($C,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$bg'>").($sf?script("qsl('$Uh').onchange = $sf;",""):"");}function
json_row($x,$X=null){static$dd=true;if($dd)echo"{";if($x!=""){echo($dd?"":",")."\n\t\"".addcslashes($x,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$dd=false;}else{echo"\n}\n";$dd=true;}}function
edit_type($x,$m,$pb,$md=array(),$Vc=array()){global$Fh,$U,$Gi,$rf;$T=$m["type"];echo'<td><select name="',h($x),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($md[$T])&&!in_array($T,$Vc))$Vc[]=$T;if($md)$Fh['外來鍵']=$md;echo
optionlist(array_merge($Vc,$Fh),$T),'</select><td><input
	name="',h($x),'[length]"
	value="',h($m["length"]),'"
	size="3"
	',(!$m["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo'	aria-labelledby="label-length"><td class="options">',($pb?"<select name='".h($x)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'校對'.')'.optionlist($pb,$m["collation"]).'</select>':''),($Gi?"<select name='".h($x)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Gi,$m["unsigned"]).'</select>':''),(isset($m['on_update'])?"<select name='".h($x)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?"CURRENT_TIMESTAMP":$m["on_update"])).'</select>':''),($md?"<select name='".h($x)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$rf),$m["on_delete"])."</select> ":" ");}function
get_partitions_info($P){global$f;$qd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($P);$G=$f->query("SELECT PARTITION_METHOD, PARTITION_EXPRESSION, PARTITION_ORDINAL_POSITION $qd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");$H=array();list($H["partition_by"],$H["partition"],$H["partitions"])=$G->fetch_row();$Vf=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $qd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$H["partition_names"]=array_keys($Vf);$H["partition_values"]=array_values($Vf);return$H;}function
process_length($ve){global$Ec;return(preg_match("~^\\s*\\(?\\s*$Ec(?:\\s*,\\s*$Ec)*+\\s*\\)?\\s*\$~",$ve)&&preg_match_all("~$Ec~",$ve,$De)?"(".implode(",",$De[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$ve)));}function
process_type($m,$nb="COLLATE"){global$Gi;return" $m[type]".process_length($m["length"]).(preg_match(number_type(),$m["type"])&&in_array($m["unsigned"],$Gi)?" $m[unsigned]":"").(preg_match('~char|text|enum|set~',$m["type"])&&$m["collation"]?" $nb ".q($m["collation"]):"");}function
process_field($m,$yi){if($m["on_update"])$m["on_update"]=str_ireplace("current_timestamp()","CURRENT_TIMESTAMP",$m["on_update"]);return
array(idf_escape(trim($m["field"])),process_type($yi),($m["null"]?" NULL":" NOT NULL"),default_value($m),(preg_match('~timestamp|datetime~',$m["type"])&&$m["on_update"]?" ON UPDATE $m[on_update]":""),(support("comment")&&$m["comment"]!=""?" COMMENT ".q($m["comment"]):""),($m["auto_increment"]?auto_increment():null),);}function
default_value($m){global$w;$ac=$m["default"];return($ac===null?"":" DEFAULT ".(!preg_match('~^GENERATED ~i',$ac)&&(preg_match('~char|binary|text|enum|set~',$m["type"])||preg_match('~^(?![a-z])~i',$ac))?q($ac):str_ireplace("current_timestamp()","CURRENT_TIMESTAMP",($w=="sqlite"?"($ac)":$ac))));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$x=>$X){if(preg_match("~$x|$X~",$T))return" class='$x'";}}function
edit_fields($n,$pb,$T="TABLE",$md=array()){global$Vd;$n=array_values($n);$bc=(($_POST?$_POST["defaults"]:adminer_setting("defaults"))?"":" class='hidden'");$wb=(($_POST?$_POST["comments"]:adminer_setting("comments"))?"":" class='hidden'");echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'欄位名稱':'參數名稱'),'<td id="label-type">類型<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">長度
<td>','選項';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><abbr id="label-ai" title="自動遞增">AI</abbr>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype-numeric.html#DATATYPE-SERIAL",'mssql'=>"t-sql/statements/create-table-transact-sql-identity-property",)),'<td id="label-default"',$bc,'>預設值
',(support("comment")?"<td id='label-comment'$wb>".'註解':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($n))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.17.1")."' alt='+' title='".'新增下一筆'."'>".script("row_count = ".count($n).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($n
as$s=>$m){$s++;$Df=$m[($_POST?"orig":"field")];$kc=(isset($_POST["add"][$s-1])||(isset($m["field"])&&!$_POST["drop_col"][$s]))&&(support("drop_col")||$Df=="");echo'<tr',($kc?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$s][inout]",explode("|",$Vd),$m["inout"]):""),'<th>';if($kc){echo'<input name="fields[',$s,'][field]" value="',h($m["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">';}echo'<input type="hidden" name="fields[',$s,'][orig]" value="',h($Df),'">';edit_type("fields[$s]",$m,$pb,$md);if($T=="TABLE"){echo'<td>',checkbox("fields[$s][null]",1,$m["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$s,'"';if($m["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td',$bc,'>',checkbox("fields[$s][has_default]",1,$m["has_default"],"","","","label-default"),'<input name="fields[',$s,'][default]" value="',h($m["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td$wb><input name='fields[$s][comment]' value='".h($m["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.17.1")."' alt='+' title='".'新增下一筆'."'> "."<input type='image' class='icon' name='up[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.17.1")."' alt='↑' title='".'上移'."'> "."<input type='image' class='icon' name='down[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.17.1")."' alt='↓' title='".'下移'."'> ":""),($Df==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.17.1")."' alt='x' title='".'移除'."'>":"");}}function
process_fields(&$n){$jf=0;if($_POST["up"]){$pe=0;foreach($n
as$x=>$m){if(key($_POST["up"])==$x){unset($n[$x]);array_splice($n,$pe,0,array($m));break;}if(isset($m["field"]))$pe=$jf;$jf++;}}elseif($_POST["down"]){$od=false;foreach($n
as$x=>$m){if(isset($m["field"])&&$od){unset($n[key($_POST["down"])]);array_splice($n,$jf,0,array($od));break;}if(key($_POST["down"])==$x)$od=$m;$jf++;}}elseif($_POST["add"]){$n=array_values($n);array_splice($n,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($A){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($A[0][0].$A[0][0],$A[0][0],substr($A[0],1,-1))),'\\'))."'";}function
grant($td,$og,$e,$qf){if(!$og)return
true;if($og==array("ALL PRIVILEGES","GRANT OPTION"))return($td=="GRANT"?queries("$td ALL PRIVILEGES$qf WITH GRANT OPTION"):queries("$td ALL PRIVILEGES$qf")&&queries("$td GRANT OPTION$qf"));return
queries("$td ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$e, ",$og).$e).$qf);}function
drop_create($oc,$h,$pc,$Yh,$rc,$_,$Pe,$Ne,$Oe,$nf,$af){if($_POST["drop"])query_redirect($oc,$_,$Pe);elseif($nf=="")query_redirect($h,$_,$Oe);elseif($nf!=$af){$Mb=queries($h);queries_redirect($_,$Ne,$Mb&&queries($oc));if($Mb)queries($pc);}else
queries_redirect($_,$Ne,queries($Yh)&&queries($rc)&&queries($oc)&&queries($h));}function
create_trigger($qf,$I){global$w;$ei=" $I[Timing] $I[Event]".(preg_match('~ OF~',$I["Event"])?" $I[Of]":"");return"CREATE TRIGGER ".idf_escape($I["Trigger"]).($w=="mssql"?$qf.$ei:$ei.$qf).rtrim(" $I[Type]\n$I[Statement]",";").";";}function
create_routine($Qg,$I){global$Vd,$w;$M=array();$n=(array)$I["fields"];ksort($n);foreach($n
as$m){if($m["field"]!="")$M[]=(preg_match("~^($Vd)\$~",$m["inout"])?"$m[inout] ":"").idf_escape($m["field"]).process_type($m,"CHARACTER SET");}$cc=rtrim($I["definition"],";");return"CREATE $Qg ".idf_escape(trim($I["name"]))." (".implode(", ",$M).")".($Qg=="FUNCTION"?" RETURNS".process_type($I["returns"],"CHARACTER SET"):"").($I["language"]?" LANGUAGE $I[language]":"").($w=="pgsql"?" AS ".q($cc):"\n$cc;");}function
check_constraints($P){return
get_key_vals("SELECT c.CONSTRAINT_NAME, CHECK_CLAUSE
FROM INFORMATION_SCHEMA.CHECK_CONSTRAINTS c
JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS t ON c.CONSTRAINT_SCHEMA = t.CONSTRAINT_SCHEMA AND c.CONSTRAINT_NAME = t.CONSTRAINT_NAME
WHERE c.CONSTRAINT_SCHEMA = ".q($_GET["ns"]!=""?$_GET["ns"]:DB)."
AND t.TABLE_NAME = ".q($P)."
AND CHECK_CLAUSE NOT LIKE '% IS NOT NULL'");}function
remove_definer($F){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$F);}function
format_foreign_key($p){global$rf;$j=$p["db"];$ef=$p["ns"];return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$p["source"])).") REFERENCES ".($j!=""&&$j!=$_GET["db"]?idf_escape($j).".":"").($ef!=""&&$ef!=$_GET["ns"]?idf_escape($ef).".":"").table($p["table"])." (".implode(", ",array_map('idf_escape',$p["target"])).")".(preg_match("~^($rf)\$~",$p["on_delete"])?" ON DELETE $p[on_delete]":"").(preg_match("~^($rf)\$~",$p["on_update"])?" ON UPDATE $p[on_update]":"");}function
tar_file($o,$ji){$H=pack("a100a8a8a8a12a12",$o,644,0,0,decoct($ji->size),decoct(time()));$hb=8*32;for($s=0;$s<strlen($H);$s++)$hb+=ord($H[$s]);$H.=sprintf("%06o",$hb)."\0 ";echo$H,str_repeat("\0",512-strlen($H));$ji->send();echo
str_repeat("\0",511-($ji->size+511)%512);}function
ini_bytes($Ud){$X=ini_get($Ud);switch(strtolower(substr($X,-1))){case'g':$X=(int)$X*1024;case'm':$X=(int)$X*1024;case'k':$X=(int)$X*1024;}return$X;}function
doc_link($Xf,$Zh="<sup>?</sup>"){global$w,$f;$ih=$f->server_info;$Vi=preg_replace('~^(\d\.?\d).*~s','\1',$ih);$Ki=array('sql'=>"https://dev.mysql.com/doc/refman/$Vi/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$Vi/",'mssql'=>"https://learn.microsoft.com/en-us/sql/",'oracle'=>"https://www.oracle.com/pls/topic/lookup?ctx=db".preg_replace('~^.* (\d+)\.(\d+)\.\d+\.\d+\.\d+.*~s','\1\2',$ih)."&id=",);if(preg_match('~MariaDB~',$ih)){$Ki['sql']="https://mariadb.com/kb/en/";$Xf['sql']=(isset($Xf['mariadb'])?$Xf['mariadb']:str_replace(".html","/",$Xf['sql']));}return($Xf[$w]?"<a href='".h($Ki[$w].$Xf[$w].($w=='mssql'?"?view=sql-server-ver$Vi":""))."'".target_blank().">$Zh</a>":"");}function
ob_gzencode($O){return
gzencode($O);}function
db_size($j){global$f;if(!$f->select_db($j))return"?";$H=0;foreach(table_status()as$Q)$H+=$Q["Data_length"]+$Q["Index_length"];return
format_number($H);}function
set_utf8mb4($h){global$f;static$M=false;if(!$M&&preg_match('~\butf8mb4~i',$h)){$M=true;echo"SET NAMES ".charset($f).";\n\n";}}function
connect_error(){global$b,$f,$S,$l,$nc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('資料庫'.": ".h(DB),'無效的資料庫。',true);}else{if($_POST["db"]&&!$l)queries_redirect(substr(ME,0,-1),'資料庫已刪除。',drop_databases($_POST["db"]));page_header('選擇資料庫',$l,false);echo"<p class='links'>\n";foreach(array('database'=>'建立資料庫','privileges'=>'權限','processlist'=>'處理程序列表','variables'=>'變數','status'=>'狀態',)as$x=>$X){if(support($x))echo"<a href='".h(ME)."$x='>$X</a>\n";}echo"<p>".sprintf('%s 版本：%s 透過 PHP 擴充模組 %s',$nc[DRIVER],"<b>".h($f->server_info)."</b>","<b>$f->extension</b>")."\n","<p>".sprintf('登錄為： %s',"<b>".h(logged_user())."</b>")."\n";$i=$b->databases();if($i){$Xg=support("scheme");$pb=collations();echo"<form action='' method='post'>\n","<table class='checkable odds'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'資料庫'." - <a href='".h(ME)."refresh=1'>".'重新載入'."</a>"."<td>".'校對'."<td>".'資料表'."<td>".'大小'." - <a href='".h(ME)."dbsize=1'>".'計算'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$i=($_GET["dbsize"]?count_tables($i):array_flip($i));foreach($i
as$j=>$R){$Pg=h(ME)."db=".urlencode($j);$Jd=h("Db-".$j);echo"<tr>".(support("database")?"<td>".checkbox("db[]",$j,in_array($j,(array)$_POST["db"]),"","","",$Jd):""),"<th><a href='$Pg' id='$Jd'>".h($j)."</a>";$ob=h(db_collation($j,$pb));echo"<td>".(support("database")?"<a href='$Pg".($Xg?"&amp;ns=":"")."&amp;database=' title='".'修改資料庫'."'>$ob</a>":$ob),"<td align='right'><a href='$Pg&amp;schema=' id='tables-".h($j)."' title='".'資料庫結構'."'>".($_GET["dbsize"]?$R:"?")."</a>","<td align='right' id='size-".h($j)."'>".($_GET["dbsize"]?db_size($j):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'已選中'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'刪除'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$S'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$f->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")){if(DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))adm_redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('資料表結構'.": ".h($_GET["ns"]),'無效的資料表結構。',true);page_footer("ns");exit;}}}$rf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Fb){$this->size+=strlen($Fb);fwrite($this->handler,$Fb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$Ec="'(?:''|[^'\\\\]|\\\\.)*'";$Vd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$n=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=$k->select($a,$K,array(where($_GET,$n)),$K);$I=($G?$G->fetch_row():array());echo$k->value($I[0],$n[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$n=fields($a);if(!$n)$l=error();$Q=table_status1($a,true);$B=$b->tableName($Q);page_header(($n&&is_view($Q)?$Q['Engine']=='materialized view'?'物化視圖':'檢視表':'資料表').": ".($B!=""?$B:h($a)),$l);$Og=array();foreach($n
as$x=>$m)$Og+=$m["privileges"];$b->selectLinks($Q,(isset($Og["insert"])||!support("table")?"":null));$vb=$Q["Comment"];if($vb!="")echo"<p class='nowrap'>".'註解'.": ".h($vb)."\n";if($n)$b->tableStructurePrint($n);if(!is_view($Q)){if(support("indexes")){echo"<h3 id='indexes'>".'索引'."</h3>\n";$v=indexes($a);if($v)$b->tableIndexesPrint($v);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'修改索引'."</a>\n";}if(fk_support($Q)){echo"<h3 id='foreign-keys'>".'外來鍵'."</h3>\n";$md=foreign_keys($a);if($md){echo"<table>\n","<thead><tr><th>".'來源'."<td>".'目標'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($md
as$B=>$p){echo"<tr title='".h($B)."'>","<th><i>".implode("</i>, <i>",array_map('h',$p["source"]))."</i>","<td><a href='".h($p["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($p["db"]),ME):($p["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($p["ns"]),ME):ME))."table=".urlencode($p["table"])."'>".($p["db"]!=""?"<b>".h($p["db"])."</b>.":"").($p["ns"]!=""?"<b>".h($p["ns"])."</b>.":"").h($p["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$p["target"]))."</i>)","<td>".h($p["on_delete"]),"<td>".h($p["on_update"]),'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($B)).'">'.'修改'.'</a>',"\n";}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'新增外來鍵'."</a>\n";}if(support("check")){echo"<h3 id='checks'>".'Checks'."</h3>\n";$db=check_constraints($a);if($db){echo"<table>\n";foreach($db
as$x=>$X){echo"<tr title='".h($x)."'>","<td><code class='jush-$w'>".h($X),"<td><a href='".h(ME.'check='.urlencode($a).'&name='.urlencode($x))."'>".'修改'."</a>","\n";}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'check='.urlencode($a).'">'.'Create check'."</a>\n";}}if(support(is_view($Q)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'觸發器'."</h3>\n";$xi=triggers($a);if($xi){echo"<table>\n";foreach($xi
as$x=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($x)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($x))."'>".'修改'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'建立觸發器'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('資料庫結構',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Ph=array();$Qh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$De,PREG_SET_ORDER);foreach($De
as$s=>$A){$Ph[$A[1]]=array($A[2],$A[3]);$Qh[]="\n\t'".js_escape($A[1])."': [ $A[2], $A[3] ]";}$mi=0;$Pa=-1;$Wg=array();$Bg=array();$te=array();foreach(table_status('',true)as$P=>$Q){if(is_view($Q))continue;$dg=0;$Wg[$P]["fields"]=array();foreach(fields($P)as$B=>$m){$dg+=1.25;$m["pos"]=$dg;$Wg[$P]["fields"][$B]=$m;}$Wg[$P]["pos"]=($Ph[$P]?$Ph[$P]:array($mi,0));foreach($b->foreignKeys($P)as$X){if(!$X["db"]){$re=$Pa;if($Ph[$P][1]||$Ph[$X["table"]][1])$re=min(floatval($Ph[$P][1]),floatval($Ph[$X["table"]][1]))-1;else$Pa-=.1;while($te[(string)$re])$re-=.0001;$Wg[$P]["references"][$X["table"]][(string)$re]=array($X["source"],$X["target"]);$Bg[$X["table"]][$P][(string)$re]=$X["target"];$te[(string)$re]=true;}}$mi=max($mi,$Wg[$P]["pos"][0]+2.5+$dg);}echo'<div id="schema" style="height: ',$mi,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Qh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$mi,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($Wg
as$B=>$P){echo"<div class='table' style='top: ".$P["pos"][0]."em; left: ".$P["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($B).'"><b>'.h($B)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($P["fields"]as$m){$X='<span'.type_class($m["type"]).' title="'.h($m["full_type"].($m["null"]?" NULL":'')).'">'.h($m["field"]).'</span>';echo"<br>".($m["primary"]?"<i>$X</i>":$X);}foreach((array)$P["references"]as$Wh=>$Cg){foreach($Cg
as$re=>$zg){$se=$re-$Ph[$B][1];$s=0;foreach($zg[0]as$uh)echo"\n<div class='references' title='".h($Wh)."' id='refs$re-".($s++)."' style='left: $se"."em; top: ".$P["fields"][$uh]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$se)."em;'></div></div>";}}foreach((array)$Bg[$B]as$Wh=>$Cg){foreach($Cg
as$re=>$e){$se=$re-$Ph[$B][1];$s=0;foreach($e
as$Vh)echo"\n<div class='references' title='".h($Wh)."' id='refd$re-".($s++)."' style='left: $se"."em; top: ".$P["fields"][$Vh]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.17.1")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$se)."em;'></div></div>";}}echo"\n</div>\n";}foreach($Wg
as$B=>$P){foreach((array)$P["references"]as$Wh=>$Cg){foreach($Cg
as$re=>$zg){$Se=$mi;$He=-10;foreach($zg[0]as$x=>$uh){$eg=$P["pos"][0]+$P["fields"][$uh]["pos"];$fg=$Wg[$Wh]["pos"][0]+$Wg[$Wh]["fields"][$zg[1][$x]]["pos"];$Se=min($Se,$eg,$fg);$He=max($He,$eg,$fg);}echo"<div class='references' id='refl$re' style='left: $re"."em; top: $Se"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($He-$Se)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">永久連結</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$l){$Ib="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$x)$Ib.="&$x=".urlencode($_POST[$x]);adm_cookie("adminer_export",substr($Ib,1));$R=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Sc=dump_headers((count($R)==1?key($R):DB),(DB==""||count($R)>1));$de=preg_match('~sql~',$_POST["format"]);if($de){echo"-- Adminer $ia ".$nc[DRIVER]." ".str_replace("\n"," ",$f->server_info)." dump\n\n";if($w=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
".($_POST["data_style"]?"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$f->query("SET time_zone = '+00:00'");$f->query("SET sql_mode = ''");}}$Gh=$_POST["db_style"];$i=array(DB);if(DB==""){$i=$_POST["databases"];if(is_string($i))$i=explode("\n",rtrim(str_replace("\r","",$i),"\n"));}foreach((array)$i
as$j){$b->dumpDatabase($j);if($f->select_db($j)){if($de&&preg_match('~CREATE~',$Gh)&&($h=$f->result("SHOW CREATE DATABASE ".idf_escape($j),1))){set_utf8mb4($h);if($Gh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($j).";\n";echo"$h;\n";}if($de){if($Gh)echo
use_sql($j).";\n\n";$Jf="";if($_POST["routines"]){foreach(routines()as$I){$B=$I["ROUTINE_NAME"];$Qg=$I["ROUTINE_TYPE"];$h=create_routine($Qg,array("name"=>$B)+routine($I["SPECIFIC_NAME"],$Qg));set_utf8mb4($h);$Jf.=($Gh!='DROP+CREATE'?"DROP $Qg IF EXISTS ".idf_escape($B).";;\n":"")."$h;\n\n";}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$I){$h=remove_definer($f->result("SHOW CREATE EVENT ".idf_escape($I["Name"]),3));set_utf8mb4($h);$Jf.=($Gh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($I["Name"]).";;\n":"")."$h;;\n\n";}}echo($Jf&&$w=='sql'?"DELIMITER ;;\n\n$Jf"."DELIMITER ;\n\n":$Jf);}if($_POST["table_style"]||$_POST["data_style"]){$Xi=array();foreach(table_status('',true)as$B=>$Q){$P=(DB==""||in_array($B,(array)$_POST["tables"]));$Sb=(DB==""||in_array($B,(array)$_POST["data"]));if($P||$Sb){if($Sc=="tar"){$ji=new
TmpFile;ob_start(array($ji,'write'),1e5);}$b->dumpTable($B,($P?$_POST["table_style"]:""),(is_view($Q)?2:0));if(is_view($Q))$Xi[]=$B;elseif($Sb){$n=fields($B);$b->dumpData($B,$_POST["data_style"],"SELECT *".convert_fields($n,$n)." FROM ".table($B));}if($de&&$_POST["triggers"]&&$P&&($xi=trigger_sql($B)))echo"\nDELIMITER ;;\n$xi\nDELIMITER ;\n";if($Sc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$j/")."$B.csv",$ji);}elseif($de)echo"\n";}}if(function_exists('foreign_keys_sql')){foreach(table_status('',true)as$B=>$Q){$P=(DB==""||in_array($B,(array)$_POST["tables"]));if($P&&!is_view($Q))echo
foreign_keys_sql($B);}}foreach($Xi
as$Wi)$b->dumpTable($Wi,$_POST["table_style"],1);if($Sc=="tar")echo
pack("x512");}}}if($de)echo"-- ".$f->result("SELECT NOW()")."\n";exit;}page_header('匯出',$l,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table class="layout">
';$Xb=array('','USE','DROP+CREATE','CREATE');$Rh=array('','DROP+CREATE','CREATE');$Tb=array('','TRUNCATE+INSERT','INSERT');if($w=="sql")$Tb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$I);if(!$I)$I=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($I["events"])){$I["routines"]=$I["events"]=($_GET["dump"]=="");$I["triggers"]=$I["table_style"];}echo"<tr><th>".'輸出'."<td>".html_select("output",$b->dumpOutput(),$I["output"],0)."\n";echo"<tr><th>".'格式'."<td>".html_select("format",$b->dumpFormat(),$I["format"],0)."\n";echo($w=="sqlite"?"":"<tr><th>".'資料庫'."<td>".html_select('db_style',$Xb,$I["db_style"]).(support("routine")?checkbox("routines",1,$I["routines"],'程序'):"").(support("event")?checkbox("events",1,$I["events"],'事件'):"")),"<tr><th>".'資料表'."<td>".html_select('table_style',$Rh,$I["table_style"]).checkbox("auto_increment",1,$I["auto_increment"],'自動遞增').(support("trigger")?checkbox("triggers",1,$I["triggers"],'觸發器'):""),"<tr><th>".'資料'."<td>".html_select('data_style',$Tb,$I["data_style"]),'</table>
<p><input type="submit" value="匯出">
<input type="hidden" name="token" value="',$S,'">

<table>
',script("qsl('table').onclick = dumpClick;");$ig=array();if(DB!=""){$fb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$fb>".'資料表'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'資料'."<input type='checkbox' id='check-data'$fb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$Xi="";$Sh=tables_list();foreach($Sh
as$B=>$T){$hg=preg_replace('~_.*~','',$B);$fb=($a==""||$a==(substr($a,-1)=="%"?"$hg%":$B));$lg="<tr><td>".checkbox("tables[]",$B,$fb,$B,"","block");if($T!==null&&!preg_match('~table~i',$T))$Xi.="$lg\n";else
echo"$lg<td align='right'><label class='block'><span id='Rows-".h($B)."'></span>".checkbox("data[]",$B,$fb)."</label>\n";$ig[$hg]++;}echo$Xi;if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'資料庫'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$i=$b->databases();if($i){foreach($i
as$j){if(!information_schema($j)){$hg=preg_replace('~_.*~','',$j);echo"<tr><td>".checkbox("databases[]",$j,$a==""||$a=="$hg%",$j,"","block")."\n";$ig[$hg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$dd=true;foreach($ig
as$x=>$X){if($x!=""&&$X>1){echo($dd?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$x%")."'>".h($x)."</a>";$dd=false;}}}elseif(isset($_GET["privileges"])){page_header('權限');echo'<p class="links"><a href="'.h(ME).'user=">'.'建立使用者'."</a>";$G=$f->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$td=$G;if(!$G)$G=$f->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($td?"":"<input type='hidden' name='grant' value=''>\n"),"<table class='odds'>\n","<thead><tr><th>".'帳號'."<th>".'伺服器'."<th></thead>\n";while($I=$G->fetch_assoc())echo'<tr><td>'.h($I["User"])."<td>".h($I["Host"]).'<td><a href="'.h(ME.'user='.urlencode($I["User"]).'&host='.urlencode($I["Host"])).'">'.'編輯'."</a>\n";if(!$td||DB!="")echo"<tr><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'編輯'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$l&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$Gd=&get_session("queries");$Fd=&$Gd[DB];if(!$l&&$_POST["clear"]){$Fd=array();adm_redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'匯入':'SQL 命令'),$l);if(!$l&&$_POST){$q=false;if(!isset($_GET["import"]))$F=$_POST["query"];elseif($_POST["webfile"]){$yh=$b->importServerPath();$q=@fopen((file_exists($yh)?$yh:"compress.zlib://$yh.gz"),"rb");$F=($q?fread($q,1e6):false);}else$F=get_file("sql_file",true);if(is_string($F)){if(function_exists('memory_get_usage')&&($Le=ini_bytes("memory_limit"))!="-1")@ini_set("memory_limit",max($Le,2*strlen($F)+memory_get_usage()+8e6));if($F!=""&&strlen($F)<1e6){$sg=$F.(preg_match("~;[ \t\r\n]*\$~",$F)?"":";");if(!$Fd||reset(end($Fd))!=$sg){restart_session();$Fd[]=array($sg,time());set_session("queries",$Gd);stop_session();}}$vh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$ec=";";$jf=0;$Bc=true;$g=connect();if(is_object($g)&&DB!=""){$g->select_db(DB);if($_GET["ns"]!="")set_schema($_GET["ns"],$g);}$ub=0;$Hc=array();$Qf='[\'"'.($w=="sql"?'`#':($w=="sqlite"?'`[':($w=="mssql"?'[':''))).']|/\*|-- |$'.($w=="pgsql"?'|\$[^$]*\$':'');$ni=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$tc=$b->dumpFormat();unset($tc["sql"]);while($F!=""){if(!$jf&&preg_match("~^$vh*+DELIMITER\\s+(\\S+)~i",$F,$A)){$ec=$A[1];$F=substr($F,strlen($A[0]));}else{preg_match('('.preg_quote($ec)."\\s*|$Qf)",$F,$A,PREG_OFFSET_CAPTURE,$jf);list($od,$dg)=$A[0];if(!$od&&$q&&!feof($q))$F.=fread($q,1e5);else{if(!$od&&rtrim($F)=="")break;$jf=$dg+strlen($od);if($od&&rtrim($od)!=$ec){$Ya=$k->hasCStyleEscapes()||($w=="pgsql"&&($dg>0&&strtolower($F[$dg-1])=="e"));$Yf=($od=='/*'?'\*/':($od=='['?']':(preg_match('~^-- |^#~',$od)?"\n":preg_quote($od).($Ya?"|\\\\.":""))));while(preg_match("($Yf|\$)s",$F,$A,PREG_OFFSET_CAPTURE,$jf)){$Ug=$A[0][0];if(!$Ug&&$q&&!feof($q))$F.=fread($q,1e5);else{$jf=$A[0][1]+strlen($Ug);if(!$Ug||$Ug[0]!="\\")break;}}}else{$Bc=false;$sg=substr($F,0,$dg);$ub++;$lg="<pre id='sql-$ub'><code class='jush-$w'>".$b->sqlCommandQuery($sg)."</code></pre>\n";if($w=="sqlite"&&preg_match("~^$vh*+ATTACH\\b~i",$sg,$A)){echo$lg,"<p class='error'>".'不支援ATTACH查詢。'."\n";$Hc[]=" <a href='#sql-$ub'>$ub</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$lg;ob_flush();flush();}$Ch=microtime(true);if($f->multi_query($sg)&&is_object($g)&&preg_match("~^$vh*+USE\\b~i",$sg))$g->query($sg);do{$G=$f->store_result();if($f->error){echo($_POST["only_errors"]?$lg:""),"<p class='error'>".'查詢發生錯誤'.($f->errno?" ($f->errno)":"").": ".error()."\n";$Hc[]=" <a href='#sql-$ub'>$ub</a>";if($_POST["error_stops"])break
2;}else{$ci=" <span class='time'>(".format_time($Ch).")</span>".(strlen($sg)<1000?" <a href='".h(ME)."sql=".urlencode(trim($sg))."'>".'編輯'."</a>":"");$za=$f->affected_rows;$aj=($_POST["only_errors"]?"":$k->warnings());$bj="warnings-$ub";if($aj)$ci.=", <a href='#$bj'>".'警告'."</a>".script("qsl('a').onclick = partial(toggle, '$bj');","");$Pc=null;$Qc="explain-$ub";if(is_object($G)){$y=$_POST["limit"];$Cf=select($G,$g,array(),$y);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$ff=$G->num_rows;echo"<p>".($ff?($y&&$ff>$y?sprintf('%d / ',$y):"").sprintf('%d 行',$ff):""),$ci;if($g&&preg_match("~^($vh|\\()*+SELECT\\b~i",$sg)&&($Pc=explain($g,$sg)))echo", <a href='#$Qc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Qc');","");$Jd="export-$ub";echo", <a href='#$Jd'>".'匯出'."</a>".script("qsl('a').onclick = partial(toggle, '$Jd');","")."<span id='$Jd' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$tc,$xa["format"])."<input type='hidden' name='query' value='".h($sg)."'>"." <input type='submit' name='export' value='".'匯出'."'><input type='hidden' name='token' value='$S'></span>\n"."</form>\n";}}else{if(preg_match("~^$vh*+(CREATE|DROP|ALTER)$vh++(DATABASE|SCHEMA)\\b~i",$sg)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($f->info)."'>".sprintf('執行查詢 OK，%d 行受影響。',$za)."$ci\n";}echo($aj?"<div id='$bj' class='hidden'>\n$aj</div>\n":"");if($Pc){echo"<div id='$Qc' class='hidden explain'>\n";select($Pc,$g,$Cf);echo"</div>\n";}}$Ch=microtime(true);}while($f->next_result());}$F=substr($F,$jf);$jf=0;}}}}if($Bc)echo"<p class='message'>".'沒有命令可執行。'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".sprintf('已順利執行 %d 個查詢。',$ub-count($Hc))," <span class='time'>(".format_time($ni).")</span>\n";}elseif($Hc&&$ub>1)echo"<p class='error'>".'查詢發生錯誤'.": ".implode("",$Hc)."\n";}else
echo"<p class='error'>".upload_error($F)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Nc="<input type='submit' value='".'執行'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$sg=$_GET["sql"];if($_POST)$sg=$_POST["query"];elseif($_GET["history"]=="all")$sg=$Fd;elseif($_GET["history"]!="")$sg=$Fd[$_GET["history"]][0];echo"<p>";textarea("query",$sg,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".js_escape(remove_from_uri("sql|limit|error_stops|only_errors|history"))."');"),"<p>$Nc\n",'限制行數'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'檔案上傳'."</legend><div>";$zd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$zd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Nc":'檔案上傳已經被停用。'),"</div></fieldset>\n";$Md=$b->importServerPath();if($Md){echo"<fieldset><legend>".'從伺服器'."</legend><div>",sprintf('網頁伺服器檔案 %s',"<code>".h($Md)."$zd</code>"),' <input type="submit" name="webfile" value="'.'執行檔案'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])||$_GET["error_stops"]),'出錯時停止')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])||$_GET["only_errors"]),'僅顯示錯誤訊息')."\n","<input type='hidden' name='token' value='$S'>\n";if(!isset($_GET["import"])&&$Fd){print_fieldset("history",'紀錄',$_GET["history"]!="");for($X=end($Fd);$X;$X=prev($Fd)){$x=key($Fd);list($sg,$ci,$xc)=$X;echo'<a href="'.h(ME."sql=&history=$x").'">'.'編輯'."</a>"." <span class='time' title='".@date('Y-m-d',$ci)."'>".@date("H:i:s",$ci)."</span>"." <code class='jush-$w'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$sg)))),80,"</code>").($xc?" <span class='time'>($xc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'清除'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'編輯全部'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$n=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$n):""):where($_GET,$n));$Hi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($n
as$B=>$m){if(!isset($m["privileges"][$Hi?"update":"insert"])||$b->fieldName($m)==""||$m["generated"])unset($n[$B]);}if($_POST&&!$l&&!isset($_GET["select"])){$_=$_POST["referer"];if($_POST["insert"])$_=($Hi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$_))$_=ME."select=".urlencode($a);$v=indexes($a);$Ci=unique_array($_GET["where"],$v);$vg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($_,'該項目已被刪除',$k->delete($a,$vg,!$Ci));else{$M=array();foreach($n
as$B=>$m){$X=process_input($m);if($X!==false&&$X!==null)$M[idf_escape($B)]=$X;}if($Hi){if(!$M)adm_redirect($_);queries_redirect($_,'已更新項目。',$k->update($a,$M,$vg,!$Ci));if(is_ajax()){page_headers();page_messages($l);exit;}}else{$G=$k->insert($a,$M);$qe=($G?last_id():0);queries_redirect($_,sprintf('已新增項目 %s。',($qe?" $qe":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($n
as$B=>$m){if(isset($m["privileges"]["select"])){$Fa=convert_field($m);if($_POST["clone"]&&$m["auto_increment"])$Fa="''";if($w=="sql"&&preg_match("~enum|set~",$m["type"]))$Fa="1*".idf_escape($B);$K[]=($Fa?"$Fa AS ":"").idf_escape($B);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=$k->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$l=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$n){if(!$Z){$G=$k->select($a,array("*"),$Z,array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array($k->primary=>"");}if($I){foreach($I
as$x=>$X){if(!$Z)$I[$x]=null;$n[$x]=array("field"=>$x,"null"=>($x!=$k->primary),"auto_increment"=>($x==$k->primary));}}}edit_form($a,$n,$I,$Hi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Sf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$x)$Sf[$x]=$x;$Ag=referencable_primary($a);$md=array();foreach($Ag
as$Nh=>$m)$md[str_replace("`","``",$Nh)."`".str_replace("`","``",$m["field"])]=$Nh;$Ff=array();$Q=array();if($a!=""){$Ff=fields($a);$Q=table_status($a);if(!$Q)$l='沒有資料表。';}$I=$_POST;$I["fields"]=(array)$I["fields"];if($I["auto_increment_col"])$I["fields"][$I["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($I["fields"])&&!$l){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'已經刪除資料表。',drop_tables(array($a)));else{$n=array();$Ca=array();$Li=false;$kd=array();$Ef=reset($Ff);$Aa=" FIRST";foreach($I["fields"]as$x=>$m){$p=$md[$m["type"]];$yi=($p!==null?$Ag[$p]:$m);if($m["field"]!=""){if(!$m["has_default"])$m["default"]=null;$qg=process_field($m,$yi);$Ca[]=array($m["orig"],$qg,$Aa);if(!$Ef||$qg!==process_field($Ef,$Ef)){$n[]=array($m["orig"],$qg,$Aa);if($m["orig"]!=""||$Aa)$Li=true;}if($p!==null)$kd[idf_escape($m["field"])]=($a!=""&&$w!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$md[$m["type"]],'source'=>array($m["field"]),'target'=>array($yi["field"]),'on_delete'=>$m["on_delete"],));$Aa=" AFTER ".idf_escape($m["field"]);}elseif($m["orig"]!=""){$Li=true;$n[]=array($m["orig"]);}if($m["orig"]!=""){$Ef=next($Ff);if(!$Ef)$Aa="";}}$Uf="";if(support("partitioning")){if(isset($Sf[$I["partition_by"]])){$Pf=array_filter($I,function($x){return
preg_match('~^partition~',$x);},ARRAY_FILTER_USE_KEY);foreach($Pf["partition_names"]as$x=>$B){if($B==""){unset($Pf["partition_names"][$x]);unset($Pf["partition_values"][$x]);}}if($Pf!=get_partitions_info($a)){$Vf=array();if($Pf["partition_by"]=='RANGE'||$Pf["partition_by"]=='LIST'){foreach($Pf["partition_names"]as$x=>$B){$Y=$Pf["partition_values"][$x];$Vf[]="\n  PARTITION ".idf_escape($B)." VALUES ".($Pf["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Uf.="\nPARTITION BY $Pf[partition_by]($Pf[partition])";if($Vf)$Uf.=" (".implode(",",$Vf)."\n)";elseif($Pf["partitions"])$Uf.=" PARTITIONS ".(+$Pf["partitions"]);}}elseif(preg_match("~partitioned~",$Q["Create_options"]))$Uf.="\nREMOVE PARTITIONING";}$Me='資料表已修改。';if($a==""){adm_cookie("adminer_engine",$I["Engine"]);$Me='資料表已建立。';}$B=trim($I["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($B),$Me,alter_table($a,$B,($w=="sqlite"&&($Li||$kd)?$Ca:$n),$kd,($I["Comment"]!=$Q["Comment"]?$I["Comment"]:null),($I["Engine"]&&$I["Engine"]!=$Q["Engine"]?$I["Engine"]:""),($I["Collation"]&&$I["Collation"]!=$Q["Collation"]?$I["Collation"]:""),($I["Auto_increment"]!=""?number($I["Auto_increment"]):""),$Uf));}}page_header(($a!=""?'修改資料表':'建立資料表'),$l,array("table"=>$a),h($a));if(!$_POST){$I=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$I=$Q;$I["name"]=$a;$I["fields"]=array();if(!$_GET["auto_increment"])$I["Auto_increment"]="";foreach($Ff
as$m){$m["has_default"]=isset($m["default"]);$I["fields"][]=$m;}if(support("partitioning")){$I+=get_partitions_info($a);$I["partition_names"][]="";$I["partition_values"][]="";}}}$pb=collations();$Dc=engines();foreach($Dc
as$Cc){if(!strcasecmp($Cc,$I["Engine"])){$I["Engine"]=$Cc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'資料表名稱: <input name="name"',($a==""&&!$_POST?" autofocus":""),' data-maxlength="64" value="',h($I["name"]),'" autocapitalize="off">
',($Dc?"<select name='Engine'>".optionlist(array(""=>"(".'引擎'.")")+$Dc,$I["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($pb&&!preg_match("~sqlite|mssql~",$w)?html_select("Collation",array(""=>"(".'校對'.")")+$pb,$I["Collation"]):""),' <input type="submit" value="儲存">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table id="edit-fields" class="nowrap">
';edit_fields($I["fields"],$pb,"TABLE",$md);echo'</table>
',script("editFields();"),'</div>
<p>
自動遞增: <input type="number" name="Auto_increment" class="size" value="',h($I["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'預設值',"columnShow(this.checked, 5)","jsonly");$xb=($_POST?$_POST["comments"]:adminer_setting("comments"));echo(support("comment")?checkbox("comments",1,$xb,'註解',"editingCommentsClick(this, true);","jsonly").' '.(preg_match('~\n~',$I["Comment"])?"<textarea name='Comment' rows='2' cols='20'".($xb?"":" class='hidden'").">".h($I["Comment"])."</textarea>":'<input name="Comment" value="'.h($I["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'"'.($xb?"":" class='hidden'").'>'):''),'<p>
<input type="submit" value="儲存">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$a));}if(support("partitioning")){$Tf=preg_match('~RANGE|LIST~',$I["partition_by"]);print_fieldset("partition",'分區類型',$I["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Sf,$I["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($I["partition"]),'">)
分區: <input type="number" name="partitions" class="size',($Tf||!$I["partition_by"]?" hidden":""),'" value="',h($I["partitions"]),'">
<table id="partition-table"',($Tf?"":" class='hidden'"),'>
<thead><tr><th>分區名稱<th>值</thead>
';foreach($I["partition_names"]as$x=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($x==count($I["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($I["partition_values"][$x]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Qd=array("PRIMARY","UNIQUE","INDEX");$Q=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$Q["Engine"]))$Qd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$Q["Engine"]))$Qd[]="SPATIAL";$v=indexes($a);$jg=array();if($w=="mongo"){$jg=$v["_id_"];unset($Qd[0]);unset($v["_id_"]);}$I=$_POST;if($I)set_adminer_settings(array("index_options"=>$I["options"]));if($_POST&&!$l&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($I["indexes"]as$u){$B=$u["name"];if(in_array($u["type"],$Qd)){$e=array();$we=array();$gc=array();$M=array();ksort($u["columns"]);foreach($u["columns"]as$x=>$d){if($d!=""){$ve=$u["lengths"][$x];$fc=$u["descs"][$x];$M[]=idf_escape($d).($ve?"(".(+$ve).")":"").($fc?" DESC":"");$e[]=$d;$we[]=($ve?$ve:null);$gc[]=$fc;}}if($e){$Oc=$v[$B];if($Oc){ksort($Oc["columns"]);ksort($Oc["lengths"]);ksort($Oc["descs"]);if($u["type"]==$Oc["type"]&&array_values($Oc["columns"])===$e&&(!$Oc["lengths"]||array_values($Oc["lengths"])===$we)&&array_values($Oc["descs"])===$gc){unset($v[$B]);continue;}}$c[]=array($u["type"],$B,$M);}}}foreach($v
as$B=>$Oc)$c[]=array($Oc["type"],$B,"DROP");if(!$c)adm_redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'已修改索引。',alter_indexes($a,$c));}page_header('索引',$l,array("table"=>$a),h($a));$n=array_keys(fields($a));if($_POST["add"]){foreach($I["indexes"]as$x=>$u){if($u["columns"][count($u["columns"])]!="")$I["indexes"][$x]["columns"][]="";}$u=end($I["indexes"]);if($u["type"]||array_filter($u["columns"],'strlen'))$I["indexes"][]=array("columns"=>array(1=>""));}if(!$I){foreach($v
as$x=>$u){$v[$x]["name"]=$x;$v[$x]["columns"][]="";}$v[]=array("columns"=>array(1=>""));$I["indexes"]=$v;}$we=($w=="sql"||$w=="mssql");$nh=($_POST?$_POST["options"]:adminer_setting("index_options"));echo'
<form action="" method="post">
<div class="scrollable">
<table class="nowrap">
<thead><tr>
<th id="label-type">索引類型
<th><input type="submit" class="wayoff">','欄位'.($we?"<span class='idxopts".($nh?"":" hidden")."'> (".'長度'.")</span>":"");if($we||support("descidx"))echo
checkbox("options",1,$nh,'選項',"indexOptionsShow(this.checked)","jsonly")."\n";echo'<th id="label-name">名稱
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.17.1")."' alt='+' title='".'新增下一筆'."'>",'</noscript>
</thead>
';if($jg){echo"<tr><td>PRIMARY<td>";foreach($jg["columns"]as$x=>$d){echo
select_input(" disabled",$n,$d),"<label><input disabled type='checkbox'>".'降冪 (遞減)'."</label> ";}echo"<td><td>\n";}$ge=1;foreach($I["indexes"]as$u){if(!$_POST["drop_col"]||$ge!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$ge][type]",array(-1=>"")+$Qd,$u["type"],($ge==count($I["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($u["columns"]);$s=1;foreach($u["columns"]as$x=>$d){echo"<span>".select_input(" name='indexes[$ge][columns][$s]' title='".'欄位'."'",($n?array_combine($n,$n):$n),$d,"partial(".($s==count($u["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($w=="sql"?"":$_GET["indexes"]."_")."')"),"<span class='idxopts".($nh?"":" hidden")."'>",($we?"<input type='number' name='indexes[$ge][lengths][$s]' class='size' value='".h($u["lengths"][$x])."' title='".'長度'."'>":""),(support("descidx")?checkbox("indexes[$ge][descs][$s]",1,$u["descs"][$x],'降冪 (遞減)'):""),"</span> </span>";$s++;}echo"<td><input name='indexes[$ge][name]' value='".h($u["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$ge]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.17.1")."' alt='x' title='".'移除'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$ge++;}echo'</table>
</div>
<p>
<input type="submit" value="儲存">
<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["database"])){$I=$_POST;if($_POST&&!$l&&!isset($_POST["add_x"])){$B=trim($I["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'資料庫已刪除。',drop_databases(array(DB)));}elseif(DB!==$B){if(DB!=""){$_GET["db"]=$B;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($B),'已重新命名資料庫。',rename_database($B,$I["collation"]));}else{$i=explode("\n",str_replace("\r","",$B));$Hh=true;$pe="";foreach($i
as$j){if(count($i)==1||$j!=""){if(!create_database($j,$I["collation"]))$Hh=false;$pe=$j;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($pe),'已建立資料庫。',$Hh);}}else{if(!$I["collation"])adm_redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($B).(preg_match('~^[a-z0-9_]+$~i',$I["collation"])?" COLLATE $I[collation]":""),substr(ME,0,-1),'已修改資料庫。');}}page_header(DB!=""?'修改資料庫':'建立資料庫',$l,array(),h(DB));$pb=collations();$B=DB;if($_POST)$B=$I["name"];elseif(DB!="")$I["collation"]=db_collation(DB,$pb);elseif($w=="sql"){foreach(get_vals("SHOW GRANTS")as$td){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$td,$A)&&$A[1]){$B=stripcslashes(idf_unescape("`$A[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($B,"\n")?'<textarea autofocus name="name" rows="10" cols="40">'.h($B).'</textarea><br>':'<input name="name" autofocus value="'.h($B).'" data-maxlength="64" autocapitalize="off">')."\n".($pb?html_select("collation",array(""=>"(".'校對'.")")+$pb,$I["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"relational-databases/system-functions/sys-fn-helpcollations-transact-sql",)):""),'<input type="submit" value="儲存">
';if(DB!="")echo"<input type='submit' name='drop' value='".'刪除'."'>".confirm(sprintf('刪除 %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.17.1")."' alt='+' title='".'新增下一筆'."'>\n";echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["scheme"])){$I=$_POST;if($_POST&&!$l){$z=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$z,'已刪除資料表結構。');else{$B=trim($I["name"]);$z.=urlencode($B);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($B),$z,'已建立資料表結構。');elseif($_GET["ns"]!=$B)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($B),$z,'已修改資料表結構。');else
adm_redirect($z);}}page_header($_GET["ns"]!=""?'修改資料表結構':'建立資料表結構',$l);if(!$I)$I["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" autofocus value="',h($I["name"]),'" autocapitalize="off">
<input type="submit" value="儲存">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'刪除'."'>".confirm(sprintf('刪除 %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('呼叫'.": ".h($da),$l);$Qg=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Nd=array();$Jf=array();foreach($Qg["fields"]as$s=>$m){if(substr($m["inout"],-3)=="OUT")$Jf[$s]="@".idf_escape($m["field"])." AS ".idf_escape($m["field"]);if(!$m["inout"]||substr($m["inout"],0,2)=="IN")$Nd[]=$s;}if(!$l&&$_POST){$Za=array();foreach($Qg["fields"]as$x=>$m){if(in_array($x,$Nd)){$X=process_input($m);if($X===false)$X="''";if(isset($Jf[$x]))$f->query("SET @".idf_escape($m["field"])." = $X");}$Za[]=(isset($Jf[$x])?"@".idf_escape($m["field"]):$X);}$F=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$Za).")";$Ch=microtime(true);$G=$f->multi_query($F);$za=$f->affected_rows;echo$b->selectQuery($F,$Ch,!$G);if(!$G)echo"<p class='error'>".error()."\n";else{$g=connect();if(is_object($g))$g->select_db(DB);do{$G=$f->store_result();if(is_object($G))select($G,$g);else
echo"<p class='message'>".sprintf('程序已被執行，%d 行被影響',$za)." <span class='time'>".@date("H:i:s")."</span>\n";}while($f->next_result());if($Jf)select($f->query("SELECT ".implode(", ",$Jf)));}}echo'
<form action="" method="post">
';if($Nd){echo"<table class='layout'>\n";foreach($Nd
as$x){$m=$Qg["fields"][$x];$B=$m["field"];echo"<tr><th>".$b->fieldName($m);$Y=$_POST["fields"][$B];if($Y!=""){if($m["type"]=="enum")$Y=+$Y;if($m["type"]=="set")$Y=array_sum($Y);}input($m,$Y,(string)$_POST["function"][$B]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="呼叫">
<input type="hidden" name="token" value="',$S,'">
</form>

<pre>
';function
pre_tr($Ug){return
preg_replace('~^~m','<tr>',preg_replace('~\|~','<td>',preg_replace('~\|$~m',"",rtrim($Ug))));}$P='(\+--[-+]+\+\n)';$I='(\| .* \|\n)';echo
preg_replace_callback("~^$P?$I$P?($I*)$P?~m",function($A){$ed=pre_tr($A[2]);return"<table>\n".($A[1]?"<thead>$ed</thead>\n":$ed).pre_tr($A[4])."\n</table>";},preg_replace('~(\n(    -|mysql)&gt; )(.+)~',"\\1<code class='jush-sql'>\\3</code>",preg_replace('~(.+)\n---+\n~',"<b>\\1</b>\n",h($Qg['comment']))));echo'</pre>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$B=$_GET["name"];$I=$_POST;if($_POST&&!$l&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Me=($_POST["drop"]?'已刪除外來鍵。':($B!=""?'已修改外來鍵。':'已建立外來鍵。'));$_=ME."table=".urlencode($a);if(!$_POST["drop"]){$I["source"]=array_filter($I["source"],'strlen');ksort($I["source"]);$Vh=array();foreach($I["source"]as$x=>$X)$Vh[$x]=$I["target"][$x];$I["target"]=$Vh;}if($w=="sqlite")queries_redirect($_,$Me,recreate_table($a,$a,array(),array(),array(" $B"=>($_POST["drop"]?"":" ".format_foreign_key($I)))));else{$c="ALTER TABLE ".table($a);$oc="\nDROP ".($w=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($B);if($_POST["drop"])query_redirect($c.$oc,$_,$Me);else{query_redirect($c.($B!=""?"$oc,":"")."\nADD".format_foreign_key($I),$_,$Me);$l='來源列和目標列必須具有相同的資料類型，在目標列上必須有一個索引並且引用的資料必須存在。'."<br>$l";}}}page_header('外來鍵',$l,array("table"=>$a),h($a));if($_POST){ksort($I["source"]);if($_POST["add"])$I["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$I["target"]=array();}elseif($B!=""){$md=foreign_keys($a);$I=$md[$B];$I["source"][]="";}else{$I["table"]=$a;$I["source"]=array("");}echo'
<form action="" method="post">
';$uh=array_keys(fields($a));if($I["db"]!="")$f->select_db($I["db"]);if($I["ns"]!="")set_schema($I["ns"]);$_g=array_keys(array_filter(table_status('',true),'fk_support'));$Vh=array_keys(fields(in_array($I["table"],$_g)?$I["table"]:reset($_g)));$sf="this.form['change-js'].value = '1'; this.form.submit();";echo"<p>".'目標資料表'.": ".html_select("table",$_g,$I["table"],$sf)."\n";if($w=="pgsql")echo'資料表結構'.": ".html_select("ns",$b->schemas(),$I["ns"]!=""?$I["ns"]:$_GET["ns"],$sf);elseif($w!="sqlite"){$Yb=array();foreach($b->databases()as$j){if(!information_schema($j))$Yb[]=$j;}echo'資料庫'.": ".html_select("db",$Yb,$I["db"]!=""?$I["db"]:$_GET["db"],$sf);}echo'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="變更"></noscript>
<table>
<thead><tr><th id="label-source">來源<th id="label-target">目標</thead>
';$ge=0;foreach($I["source"]as$x=>$X){echo"<tr>","<td>".html_select("source[".(+$x)."]",array(-1=>"")+$uh,$X,($ge==count($I["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$x)."]",$Vh,$I["target"][$x],1,"label-target");$ge++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$rf),$I["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$rf),$I["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"t-sql/statements/create-table-transact-sql",'oracle'=>"SQLRF01111",)),'<p>
<input type="submit" value="儲存">
<noscript><p><input type="submit" name="add" value="新增欄位"></noscript>
';if($B!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$B));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$I=$_POST;$Gf="VIEW";if($w=="pgsql"&&$a!=""){$N=table_status($a);$Gf=strtoupper($N["Engine"]);}if($_POST&&!$l){$B=trim($I["name"]);$Fa=" AS\n$I[select]";$_=ME."table=".urlencode($B);$Me='已修改檢視表。';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$B&&$w!="sqlite"&&$T=="VIEW"&&$Gf=="VIEW")query_redirect(($w=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($B).$Fa,$_,$Me);else{$Xh=$B."_adminer_".uniqid();drop_create("DROP $Gf ".table($a),"CREATE $T ".table($B).$Fa,"DROP $T ".table($B),"CREATE $T ".table($Xh).$Fa,"DROP $T ".table($Xh),($_POST["drop"]?substr(ME,0,-1):$_),'已刪除檢視表。',$Me,'已建立檢視表。',$a,$B);}}if(!$_POST&&$a!=""){$I=adm_view($a);$I["name"]=$a;$I["materialized"]=($Gf!="VIEW");if(!$l)$l=error();}page_header(($a!=""?'修改檢視表':'建立檢視表'),$l,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>名稱: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$I["materialized"],'物化視圖'):""),'<p>';textarea("select",$I["select"]);echo'<p>
<input type="submit" value="儲存">
';if($a!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$a));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$Yd=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Dh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$I=$_POST;if($_POST&&!$l){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'已刪除事件。');elseif(in_array($I["INTERVAL_FIELD"],$Yd)&&isset($Dh[$I["STATUS"]])){$Vg="\nON SCHEDULE ".($I["INTERVAL_VALUE"]?"EVERY ".q($I["INTERVAL_VALUE"])." $I[INTERVAL_FIELD]".($I["STARTS"]?" STARTS ".q($I["STARTS"]):"").($I["ENDS"]?" ENDS ".q($I["ENDS"]):""):"AT ".q($I["STARTS"]))." ON COMPLETION".($I["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'已修改事件。':'已建立事件。'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$Vg.($aa!=$I["EVENT_NAME"]?"\nRENAME TO ".idf_escape($I["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($I["EVENT_NAME"]).$Vg)."\n".$Dh[$I["STATUS"]]." COMMENT ".q($I["EVENT_COMMENT"]).rtrim(" DO\n$I[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'修改事件'.": ".h($aa):'建立事件'),$l);if(!$I&&$aa!=""){$J=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$I=reset($J);}echo'
<form action="" method="post">
<table class="layout">
<tr><th>名稱<td><input name="EVENT_NAME" value="',h($I["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">開始<td><input name="STARTS" value="',h("$I[EXECUTE_AT]$I[STARTS]"),'">
<tr><th title="datetime">結束<td><input name="ENDS" value="',h($I["ENDS"]),'">
<tr><th>每<td><input type="number" name="INTERVAL_VALUE" value="',h($I["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$Yd,$I["INTERVAL_FIELD"]),'<tr><th>狀態<td>',html_select("STATUS",$Dh,$I["STATUS"]),'<tr><th>註解<td><input name="EVENT_COMMENT" value="',h($I["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$I["ON_COMPLETION"]=="PRESERVE",'在完成後儲存'),'</table>
<p>';textarea("EVENT_DEFINITION",$I["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="儲存">
';if($aa!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$aa));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Qg=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$I=$_POST;$I["fields"]=(array)$I["fields"];if($_POST&&!process_fields($I["fields"])&&!$l){$Df=routine($_GET["procedure"],$Qg);$Xh="$I[name]_adminer_".uniqid();drop_create("DROP $Qg ".routine_id($da,$Df),create_routine($Qg,$I),"DROP $Qg ".routine_id($I["name"],$I),create_routine($Qg,array("name"=>$Xh)+$I),"DROP $Qg ".routine_id($Xh,$I),substr(ME,0,-1),'已刪除程序。','已修改子程序。','已建立子程序。',$da,$I["name"]);}page_header(($da!=""?(isset($_GET["function"])?'修改函式':'修改預存程序').": ".h($da):(isset($_GET["function"])?'建立函式':'建立預存程序')),$l);if(!$_POST&&$da!=""){$I=routine($_GET["procedure"],$Qg);$I["name"]=$da;}$pb=get_vals("SHOW CHARACTER SET");sort($pb);$Rg=routine_languages();echo'
<form action="" method="post" id="form">
<p>名稱: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',($Rg?'語言'.": ".html_select("language",$Rg,$I["language"])."\n":""),'<input type="submit" value="儲存">
<div class="scrollable">
<table class="nowrap">
';edit_fields($I["fields"],$pb,$Qg);if(isset($_GET["function"])){echo"<tr><td>".'回傳類型';edit_type("returns",$I["returns"],$pb,array(),($w=="pgsql"?array("void","trigger"):array()));}echo'</table>
',script("editFields();"),'</div>
<p>';textarea("definition",$I["definition"]);echo'<p>
<input type="submit" value="儲存">
';if($da!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$da));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$I=$_POST;if($_POST&&!$l){$z=substr(ME,0,-1);$B=trim($I["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$z,'已刪除序列。');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($B),$z,'已建立序列。');elseif($fa!=$B)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($B),$z,'已修改序列。');else
redirect($z);}page_header($fa!=""?'修改序列'.": ".h($fa):'建立序列',$l);if(!$I)$I["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($I["name"]),'" autocapitalize="off">
<input type="submit" value="儲存">
';if($fa!="")echo"<input type='submit' name='drop' value='".'刪除'."'>".confirm(sprintf('刪除 %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$I=$_POST;if($_POST&&!$l){$z=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$z,'已刪除類型。');else
query_redirect("CREATE TYPE ".idf_escape(trim($I["name"]))." $I[as]",$z,'已建立類型。');}page_header($ga!=""?'修改類型'.": ".h($ga):'建立類型',$l);if(!$I)$I["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'刪除'."'>".confirm(sprintf('刪除 %s?',$ga))."\n";else{echo"<input name='name' value='".h($I['name'])."' autocapitalize='off'>\n";textarea("as",$I["as"]);echo"<p><input type='submit' value='".'儲存'."'>\n";}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["check"])){$a=$_GET["check"];$B=$_GET["name"];$I=$_POST;if($I&&!$l){$G=($B==""||queries("ALTER TABLE ".table($a)." DROP CONSTRAINT ".idf_escape($B)));if(!$I["drop"])$G=queries("ALTER TABLE ".table($a)." ADD".($I["name"]!=""?" CONSTRAINT ".idf_escape($I["name"])."":"")." CHECK ($I[clause])");queries_redirect(ME."table=".urlencode($a),($I["drop"]?'Check has been dropped.':($B!=""?'Check has been altered.':'Check has been created.')),$G);}page_header(($B!=""?'Alter check'.": ".h($B):'Create check'),$l,array("table"=>$a));if(!$I){$gb=check_constraints($a);$I=array("name"=>$B,"clause"=>$gb[$B]);}echo'
<form action="" method="post">
<p>名稱: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">',doc_link(array('sql'=>"create-table-check-constraints.html",'mariadb'=>"constraint/",'pgsql'=>"ddl-constraints.html#DDL-CONSTRAINTS-CHECK-CONSTRAINTS",'mssql'=>"relational-databases/tables/create-check-constraints",)),'<p>';textarea("clause",$I["clause"]);echo'<p><input type="submit" value="儲存">
';if($B!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$B));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$B=$_GET["name"];$wi=trigger_options();$I=(array)trigger($B,$a)+array("Trigger"=>$a."_bi");if($_POST){if(!$l&&in_array($_POST["Timing"],$wi["Timing"])&&in_array($_POST["Event"],$wi["Event"])&&in_array($_POST["Type"],$wi["Type"])){$qf=" ON ".table($a);$oc="DROP TRIGGER ".idf_escape($B).($w=="pgsql"?$qf:"");$_=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($oc,$_,'已刪除觸發器。');else{if($B!="")queries($oc);queries_redirect($_,($B!=""?'已修改觸發器。':'已建立觸發器。'),queries(create_trigger($qf,$_POST)));if($B!="")queries(create_trigger($qf,$I+array("Type"=>reset($wi["Type"]))));}}$I=$_POST;}page_header(($B!=""?'修改觸發器'.": ".h($B):'建立觸發器'),$l,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table class="layout">
<tr><th>時間<td>',html_select("Timing",$wi["Timing"],$I["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>事件<td>',html_select("Event",$wi["Event"],$I["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$wi["Event"])?" <input name='Of' value='".h($I["Of"])."' class='hidden'>":""),'<tr><th>類型<td>',html_select("Type",$wi["Type"],$I["Type"]),'</table>
<p>名稱: <input name="Trigger" value="',h($I["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$I["Statement"]);echo'<p>
<input type="submit" value="儲存">
';if($B!=""){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',$B));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$og=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$I){foreach(explode(",",($I["Privilege"]=="Grant option"?"":$I["Context"]))as$Gb)$og[$Gb][$I["Privilege"]]=$I["Comment"];}$og["Server Admin"]+=$og["File access on server"];$og["Databases"]["Create routine"]=$og["Procedures"]["Create routine"];unset($og["Procedures"]["Create routine"]);$og["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$og["Columns"][$X]=$og["Tables"][$X];unset($og["Server Admin"]["Usage"]);foreach($og["Tables"]as$x=>$X)unset($og["Databases"][$x]);$Ze=array();if($_POST){foreach($_POST["objects"]as$x=>$X)$Ze[$X]=(array)$Ze[$X]+(array)$_POST["grants"][$x];}$ud=array();$of="";if(isset($_GET["host"])&&($G=$f->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($I=$G->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$I[0],$A)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$A[1],$De,PREG_SET_ORDER)){foreach($De
as$X){if($X[1]!="USAGE")$ud["$A[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$I[0]))$ud["$A[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$I[0],$A))$of=$A[1];}}if($_POST&&!$l){$pf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $pf",ME."privileges=",'已刪除使用者。');else{$bf=q($_POST["user"])."@".q($_POST["host"]);$Wf=$_POST["pass"];if($Wf!=''&&!$_POST["hashed"]&&!min_version(8)){$Wf=$f->result("SELECT PASSWORD(".q($Wf).")");$l=!$Wf;}$Mb=false;if(!$l){if($pf!=$bf){$Mb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $bf IDENTIFIED BY ".(min_version(8)?"":"PASSWORD ").q($Wf));$l=!$Mb;}elseif($Wf!=$of)queries("SET PASSWORD FOR $bf = ".q($Wf));}if(!$l){$Ng=array();foreach($Ze
as$hf=>$td){if(isset($_GET["grant"]))$td=array_filter($td);$td=array_keys($td);if(isset($_GET["grant"]))$Ng=array_diff(array_keys(array_filter($Ze[$hf],'strlen')),$td);elseif($pf==$bf){$mf=array_keys((array)$ud[$hf]);$Ng=array_diff($mf,$td);$td=array_diff($td,$mf);unset($ud[$hf]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$hf,$A)&&(!grant("REVOKE",$Ng,$A[2]," ON $A[1] FROM $bf")||!grant("GRANT",$td,$A[2]," ON $A[1] TO $bf"))){$l=true;break;}}}if(!$l&&isset($_GET["host"])){if($pf!=$bf)queries("DROP USER $pf");elseif(!isset($_GET["grant"])){foreach($ud
as$hf=>$Ng){if(preg_match('~^(.+)(\(.*\))?$~U',$hf,$A))grant("REVOKE",array_keys($Ng),$A[2]," ON $A[1] FROM $bf");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'已修改使用者。':'已建立使用者。'),!$l);if($Mb)$f->query("DROP USER $bf");}}page_header((isset($_GET["host"])?'帳號'.": ".h("$ha@$_GET[host]"):'建立使用者'),$l,array("privileges"=>array('','權限')));if($_POST){$I=$_POST;$ud=$Ze;}else{$I=$_GET+array("host"=>$f->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$I["pass"]=$of;if($of!="")$I["hashed"]=true;$ud[(DB==""||$ud?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table class="layout">
<tr><th>伺服器<td><input name="host" data-maxlength="60" value="',h($I["host"]),'" autocapitalize="off">
<tr><th>帳號<td><input name="user" data-maxlength="80" value="',h($I["user"]),'" autocapitalize="off">
<tr><th>密碼<td><input name="pass" id="pass" value="',h($I["pass"]),'" autocomplete="new-password">
';if(!$I["hashed"])echo
script("typePassword(qs('#pass'));");echo(min_version(8)?"":checkbox("hashed",1,$I["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);")),'</table>

';echo"<table class='odds'>\n","<thead><tr><th colspan='2'>".'權限'.doc_link(array('sql'=>"grant.html#priv_level"));$s=0;foreach($ud
as$hf=>$td){echo'<th>'.($hf!="*.*"?"<input name='objects[$s]' value='".h($hf)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$s]' value='*.*' size='10'>*.*");$s++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'伺服器',"Databases"=>'資料庫',"Tables"=>'資料表',"Columns"=>'欄位',"Procedures"=>'程序',)as$Gb=>$fc){foreach((array)$og[$Gb]as$ng=>$vb){echo"<tr><td".($fc?">$fc<td":" colspan='2'").' lang="en" title="'.h($vb).'">'.h($ng);$s=0;foreach($ud
as$hf=>$td){$B="'grants[$s][".h(strtoupper($ng))."]'";$Y=$td[strtoupper($ng)];if($Gb=="Server Admin"&&$hf!=(isset($ud["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$B><option><option value='1'".($Y?" selected":"").">".'授權'."<option value='0'".($Y=="0"?" selected":"").">".'廢除'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$B value='1'".($Y?" checked":"").($ng=="All privileges"?" id='grants-$s-all'>":">".($ng=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$s-all'); };"))),"</label>";}$s++;}}}echo"</table>\n",'<p>
<input type="submit" value="儲存">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="刪除">',confirm(sprintf('刪除 %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$S,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")){if($_POST&&!$l){$le=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$le++;}queries_redirect(ME."processlist=",sprintf('%d 個 Process(es) 被終止',$le),$le||!$_POST["kill"]);}}page_header('處理程序列表',$l);echo'
<form action="" method="post">
<div class="scrollable">
<table class="nowrap checkable odds">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$s=-1;foreach(process_list()as$s=>$I){if(!$s){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($I
as$x=>$X)echo"<th>$x".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($x),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"REFRN30223",));echo"</thead>\n";}echo"<tr>".(support("kill")?"<td>".checkbox("kill[]",$I[$w=="sql"?"Id":"pid"],0):"");foreach($I
as$x=>$X)echo"<td>".(($w=="sql"&&$x=="Info"&&preg_match("~Query|Killed~",$I["Command"])&&$X!="")||($w=="pgsql"&&$x=="current_query"&&$X!="<IDLE>")||($w=="oracle"&&$x=="sql_text"&&$X!="")?"<code class='jush-$w'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($I["db"]!=""?"db=".urlencode($I["db"])."&":"")."sql=".urlencode($X)).'">'.'複製'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($s+1)."/".sprintf('總共 %d 個',max_connections()),"<p><input type='submit' value='".'終止'."'>\n";}echo'<input type="hidden" name="token" value="',$S,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$Q=table_status1($a);$v=indexes($a);$n=fields($a);$md=column_foreign_keys($a);$kf=$Q["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Og=array();$e=array();$bi=null;foreach($n
as$x=>$m){$B=$b->fieldName($m);if(isset($m["privileges"]["select"])&&$B!=""){$e[$x]=html_entity_decode(strip_tags($B),ENT_QUOTES);if(is_shortable($m))$bi=$b->selectLengthProcess();}$Og+=$m["privileges"];}list($K,$vd)=$b->selectColumnsProcess($e,$v);$ce=count($vd)<count($K);$Z=$b->selectSearchProcess($n,$v);$_f=$b->selectOrderProcess($n,$v);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Di=>$I){$Fa=convert_field($n[key($I)]);$K=array($Fa?$Fa:idf_escape(key($I)));$Z[]=where_check($Di,$n);$H=$k->select($a,$K,$Z,$K);if($H)echo
reset($H->fetch_row());}exit;}$jg=$Fi=null;foreach($v
as$u){if($u["type"]=="PRIMARY"){$jg=array_flip($u["columns"]);$Fi=($K?$jg:array());foreach($Fi
as$x=>$X){if(in_array(idf_escape($x),$K))unset($Fi[$x]);}break;}}if($kf&&!$jg){$jg=$Fi=array($kf=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($kf));}if($_POST&&!$l){$gj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$gb=array();foreach($_POST["check"]as$cb)$gb[]=where_check($cb,$n);$gj[]="((".implode(") OR (",$gb)."))";}$gj=($gj?"\nWHERE ".implode(" AND ",$gj):"");if($_POST["export"]){adm_cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$qd=($K?implode(", ",$K):"*").convert_fields($e,$n,$K)."\nFROM ".table($a);$xd=($vd&&$ce?"\nGROUP BY ".implode(", ",$vd):"").($_f?"\nORDER BY ".implode(", ",$_f):"");if(!is_array($_POST["check"])||$jg)$F="SELECT $qd$gj$xd";else{$Bi=array();foreach($_POST["check"]as$X)$Bi[]="(SELECT".limit($qd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$n).$xd,1).")";$F=implode(" UNION ALL ",$Bi);}$b->dumpData($a,"table",$F);exit;}if(!$b->selectEmailProcess($Z,$md)){if($_POST["save"]||$_POST["delete"]){$G=true;$za=0;$M=array();if(!$_POST["delete"]){foreach($e
as$B=>$X){$X=process_input($n[$B]);if($X!==null&&($_POST["clone"]||$X!==false))$M[idf_escape($B)]=($X!==false?$X:idf_escape($B));}}if($_POST["delete"]||$M){if($_POST["clone"])$F="INTO ".table($a)." (".implode(", ",array_keys($M)).")\nSELECT ".implode(", ",$M)."\nFROM ".table($a);if($_POST["all"]||($jg&&is_array($_POST["check"]))||$ce){$G=($_POST["delete"]?$k->delete($a,$gj):($_POST["clone"]?queries("INSERT $F$gj"):$k->update($a,$M,$gj)));$za=$f->affected_rows;}else{foreach((array)$_POST["check"]as$X){$cj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$n);$G=($_POST["delete"]?$k->delete($a,$cj,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$cj)):$k->update($a,$M,$cj,1)));if(!$G)break;$za+=$f->affected_rows;}}}$Me=sprintf('%d 個項目受到影響。',$za);if($_POST["clone"]&&$G&&$za==1){$qe=last_id();if($qe)$Me=sprintf('已新增項目 %s。'," $qe");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Me,$G);if(!$_POST["delete"]){edit_form($a,$n,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$l='按住Ctrl並按一下某個值進行修改。';else{$G=true;$za=0;foreach($_POST["val"]as$Di=>$I){$M=array();foreach($I
as$x=>$X){$x=bracket_escape($x,1);$M[idf_escape($x)]=(preg_match('~char|text~',$n[$x]["type"])||$X!=""?$b->processInput($n[$x],$X):"NULL");}$G=$k->update($a,$M," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Di,$n),!$ce&&!$jg," ");if(!$G)break;$za+=$f->affected_rows;}queries_redirect(remove_from_uri(),sprintf('%d 個項目受到影響。',$za),$G);}}elseif(!is_string($bd=get_file("csv_file",true)))$l=upload_error($bd);elseif(!preg_match('~~u',$bd))$l='檔必須使用UTF-8編碼。';else{adm_cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$G=true;$rb=array_keys($n);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$bd,$De);$za=count($De[0]);$k->begin();$eh=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($De[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$eh]*)$eh~",$X.$eh,$Ee);if(!$x&&!array_diff($Ee[1],$rb)){$rb=$Ee[1];$za--;}else{$M=array();foreach($Ee[1]as$s=>$mb)$M[idf_escape($rb[$s])]=($mb==""&&$n[$rb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$mb))));$J[]=$M;}}$G=(!$J||$k->insertUpdate($a,$J,$jg));if($G)$G=$k->commit();queries_redirect(remove_from_uri("page"),sprintf('已匯入 %d 行。',$za),$G);$k->rollback();}}}$Nh=$b->tableName($Q);if(is_ajax()){page_headers();ob_start();}else
page_header('選擇'.": $Nh",$l);$M=null;if(isset($Og["insert"])||!support("table")){$Pf=array();foreach((array)$_GET["where"]as$X){if(isset($md[$X["col"]])&&count($md[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&(is_array($X["val"])||!preg_match('~[_%]~',$X["val"])))))$Pf["set"."[".bracket_escape($X["col"])."]"]=$X["val"];}$M=$Pf?"&".http_build_query($Pf):"";}$b->selectLinks($Q,$M);if(!$e&&support("table"))echo"<p class='error'>".'無法選擇該資料表'.($n?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($K,$e);$b->selectSearchPrint($Z,$e,$v);$b->selectOrderPrint($_f,$e,$v);$b->selectLimitPrint($y);$b->selectLengthPrint($bi);$b->selectActionPrint($v);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$pd=$f->result(count_rows($a,$Z,$ce,$vd));$D=floor(max(0,$pd-1)/$y);}$Zg=$K;$wd=$vd;if(!$Zg){$Zg[]="*";$Hb=convert_fields($e,$n,$K);if($Hb)$Zg[]=substr($Hb,2);}foreach($K
as$x=>$X){$m=$n[idf_unescape($X)];if($m&&($Fa=convert_field($m)))$Zg[$x]="$Fa AS $X";}if(!$ce&&$Fi){foreach($Fi
as$x=>$X){$Zg[]=idf_escape($x);if($wd)$wd[]=idf_escape($x);}}$G=$k->select($a,$Zg,$Z,$wd,$_f,$y,$D,true);if(!$G)echo"<p class='error'>".error()."\n";else{if($w=="mssql"&&$D)$G->seek($y*$D);$Ac=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($D&&$w=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$y!=""&&$vd&&$ce&&$w=="sql")$pd=$f->result(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".'沒有資料行。'."\n";else{$Oa=$b->backwardKeys($a,$Nh);echo"<div class='scrollable'>","<table id='table' class='nowrap checkable odds'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$vd&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'修改'."</a>");$Xe=array();$rd=array();reset($K);$xg=1;foreach($J[0]as$x=>$X){if(!isset($Fi[$x])){$X=$_GET["columns"][key($K)];$m=$n[$K?($X?$X["col"]:current($K)):$x];$B=($m?$b->fieldName($m,$xg):($X["fun"]?"*":h($x)));if($B!=""){$xg++;$Xe[$x]=$B;$d=idf_escape($x);$Id=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$fc="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($x))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Id.($_f[0]==$d||$_f[0]==$x||(!$_f&&$ce&&$vd[0]==$d)?$fc:'')).'">';echo
apply_sql_function($X["fun"],$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Id.$fc)."' title='".'降冪 (遞減)'."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'搜尋'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$rd[$x]=$X["fun"];next($K);}}$we=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$x=>$X)$we[$x]=max($we[$x],min(40,strlen(utf8_decode($X))));}}echo($Oa?"<th>".'關聯':"")."</thead>\n";if(is_ajax())ob_end_clean();foreach($b->rowDescriptions($J,$md)as$We=>$I){$Ci=unique_array($J[$We],$v);if(!$Ci){$Ci=array();foreach($J[$We]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$Ci[$x]=$X;}}$Di="";foreach($Ci
as$x=>$X){if(($w=="sql"||$w=="pgsql")&&preg_match('~char|text|enum|set~',$n[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($w!='sql'||preg_match("~^utf8~",$n[$x]["collation"])?$x:"CONVERT($x USING ".charset($f).")").")";$X=md5($X);}$Di.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr>".(!$vd&&$K?"":"<td>".checkbox("check[]",substr($Di,1),in_array(substr($Di,1),(array)$_POST["check"])).($ce||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Di)."' class='edit'>".'編輯'."</a>"));foreach($I
as$x=>$X){if(isset($Xe[$x])){$m=$n[$x];$X=$k->value($X,$m);if($X!=""&&(!isset($Ac[$x])||$Ac[$x]!=""))$Ac[$x]=(is_mail($X)?$Xe[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$m["type"])&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$Di;if(!$z&&$X!==null){foreach((array)$md[$x]as$p){if(count($md[$x])==1||end($p["source"])==$x){$z="";foreach($p["source"]as$s=>$uh)$z.=where_link($s,$p["target"][$s],$J[$We][$uh]);$z=($p["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($p["db"]),ME):ME).'select='.urlencode($p["table"]).$z;if($p["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($p["ns"]),$z);if(count($p["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ci))$z.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Ci
as$he=>$W)$z.=where_link($s++,$he,$W);}$X=select_value($X,$z,$m,$bi);$Jd=h("val[$Di][".bracket_escape($x)."]");$Y=$_POST["val"][$Di][bracket_escape($x)];$wc=!is_array($I[$x])&&is_utf8($X)&&$J[$We][$x]==$I[$x]&&!$rd[$x];$Zh=preg_match('~text|lob~',$m["type"]);echo"<td id='$Jd'";if(($_GET["modify"]&&$wc)||$Y!==null){$_d=h($Y!==null?$Y:$I[$x]);echo">".($Zh?"<textarea name='$Jd' cols='30' rows='".(substr_count($I[$x],"\n")+1)."'>$_d</textarea>":"<input name='$Jd' value='$_d' size='$we[$x]'>");}else{$_e=strpos($X,"<i>…</i>");echo" data-text='".($_e?2:($Zh?1:0))."'".($wc?"":" data-warning='".h('使用編輯連結來修改。')."'").">$X</td>";}}}if($Oa)echo"<td>";$b->backwardKeysPrint($Oa,$J[$We]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$Mc=true;if($_GET["page"]!="last"){if($y==""||(count($J)<$y&&($J||!$D)))$pd=($D?$D*$y:0)+count($J);elseif($w!="sql"||!$ce){$pd=($ce?false:found_rows($Q,$Z));if($pd<max(1e4,2*($D+1)*$y))$pd=reset(slow_query(count_rows($a,$Z,$ce,$vd)));else$Mc=false;}}$Nf=($y!=""&&($pd===false||$pd>$y||$D));if($Nf){echo(($pd===false?count($J)+1:$pd-$D*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.'載入更多資料'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".'載入中'."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($Nf){$Ge=($pd===false?$D+(count($J)>=$y?2:1):floor(($pd-1)/$y));echo"<fieldset>";if($w!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'頁'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'頁'."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" …":"");for($s=max(1,$D-4);$s<min($Ge,$D+5);$s++)echo
pagination($s,$D);if($Ge>0){echo($D+5<$Ge?" …":""),($Mc&&$pd!==false?pagination($Ge,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Ge'>".'最後一頁'."</a>");}}else{echo"<legend>".'頁'."</legend>",pagination(0,$D).($D>1?" …":""),($D?pagination($D,$D):""),($Ge>$D?pagination($D+1,$D).($Ge>$D+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'所有結果'."</legend>";$lc=($Mc?"":"~ ").$pd;echo
checkbox("all",1,0,($pd!==false?($Mc?"":"~ ").sprintf('%d 行',$pd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$lc' : checked); selectCount('selected2', this.checked || !checked ? '$lc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>修改</legend><div>
<input type="submit" value="儲存"',($_GET["modify"]?'':' title="'.'按住Ctrl並按一下某個值進行修改。'.'"'),'>
</div></fieldset>
<fieldset><legend>已選中 <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="編輯">
<input type="submit" name="clone" value="複製">
<input type="submit" name="delete" value="刪除">',confirm(),'</div></fieldset>
';}$nd=$b->dumpFormat();foreach((array)$_GET["columns"]as$d){if($d["fun"]){unset($nd['sql']);break;}}if($nd){print_fieldset("export",'匯出'." <span id='selected2'></span>");$Kf=$b->dumpOutput();echo($Kf?html_select("output",$Kf,$ya["output"])." ":""),html_select("format",$nd,$ya["format"])," <input type='submit' name='export' value='".'匯出'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Ac,'strlen'),$e);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'匯入'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'匯入'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$S'>\n","</form>\n",(!$vd&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$N=isset($_GET["status"]);page_header($N?'狀態':'變數');$Ti=($N?show_status():show_variables());if(!$Ti)echo"<p class='message'>".'沒有資料行。'."\n";else{echo"<table>\n";foreach($Ti
as$x=>$X){echo"<tr>","<th><code class='jush-".$w.($N?"status":"set")."'>".h($x)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Kh=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$B=>$Q){json_row("Comment-$B",h($Q["Comment"]));if(!is_view($Q)){foreach(array("Engine","Collation")as$x)json_row("$x-$B",h($Q[$x]));foreach($Kh+array("Auto_increment"=>0,"Rows"=>0)as$x=>$X){if($Q[$x]!=""){$X=format_number($Q[$x]);json_row("$x-$B",($x=="Rows"&&$X&&$Q["Engine"]==($w=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Kh[$x]))$Kh[$x]+=($Q["Engine"]!="InnoDB"||$x!="Data_free"?$Q[$x]:0);}elseif(array_key_exists($x,$Q))json_row("$x-$B");}}}foreach($Kh
as$x=>$X)json_row("sum-$x",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$f->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$j=>$X){json_row("tables-$j",$X);json_row("size-$j",db_size($j));}json_row("");}exit;}else{$Th=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Th&&!$l&&!$_POST["search"]){$G=true;$Me="";if($w=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$G=truncate_tables($_POST["tables"]);$Me='已清空資料表。';}elseif($_POST["move"]){$G=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Me='已轉移資料表。';}elseif($_POST["copy"]){$G=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Me='資料表已經複製';}elseif($_POST["drop"]){if($_POST["views"])$G=drop_views($_POST["views"]);if($G&&$_POST["tables"])$G=drop_tables($_POST["tables"]);$Me='已經將資料表刪除。';}elseif($w!="sql"){$G=($w=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Me='已優化資料表。';}elseif(!$_POST["tables"])$Me='沒有資料表。';elseif($G=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($I=$G->fetch_assoc())$Me.="<b>".h($I["Table"])."</b>: ".h($I["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Me,$G);}page_header(($_GET["ns"]==""?'資料庫'.": ".h(DB):'資料表結構'.": ".h($_GET["ns"])),$l,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'資料表和檢視表'."</h3>\n";$Sh=tables_list();if(!$Sh)echo"<p class='message'>".'沒有資料表。'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'在資料庫搜尋'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'搜尋'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]=$k->convertOperator("LIKE %%");search_tables();}}echo"<div class='scrollable'>\n","<table class='nowrap checkable odds'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'資料表','<td>'.'引擎'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'校對'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'資料長度'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT','oracle'=>'REFRN20286')),'<td>'.'索引長度'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT')),'<td>'.'資料空閒'.doc_link(array('sql'=>'show-table-status.html')),'<td>'.'自動遞增'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'行數'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'catalog-pg-class.html#CATALOG-PG-CLASS','oracle'=>'REFRN20286')),(support("comment")?'<td>'.'註解'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-info.html#FUNCTIONS-INFO-COMMENT-TABLE')):''),"</thead>\n";$R=0;foreach($Sh
as$B=>$T){$Wi=($T!==null&&!preg_match('~table|sequence~i',$T));$Jd=h("Table-".$B);echo'<tr><td>'.checkbox(($Wi?"views[]":"tables[]"),$B,in_array($B,$Th,true),"","","",$Jd),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($B)."' title='".'顯示結構'."' id='$Jd'>".h($B).'</a>':h($B));if($Wi){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($B).'" title="'.'修改檢視表'.'">'.(preg_match('~materialized~i',$T)?'物化視圖':'檢視表').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($B).'" title="'.'選擇資料'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'修改資料表'),"Index_length"=>array("indexes",'修改索引'),"Data_free"=>array("edit",'新增項目'),"Auto_increment"=>array("auto_increment=1&create",'修改資料表'),"Rows"=>array("select",'選擇資料'),)as$x=>$z){$Jd=" id='$x-".h($B)."'";echo($z?"<td align='right'>".(support("table")||$x=="Rows"||(support("indexes")&&$x!="Data_length")?"<a href='".h(ME."$z[0]=").urlencode($B)."'$Jd title='$z[1]'>?</a>":"<span$Jd>?</span>"):"<td id='$x-".h($B)."'>");}$R++;}echo(support("comment")?"<td id='Comment-".h($B)."'>":""),"\n";}echo"<tr><td><th>".sprintf('總共 %d 個',count($Sh)),"<td>".h($w=="sql"?$f->result("SELECT @@default_storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$x)echo"<td align='right' id='sum-$x'>";echo"\n","</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Qi="<input type='submit' value='".'整理（Vacuum）'."'> ".on_help("'VACUUM'");$xf="<input type='submit' name='optimize' value='".'最佳化'."'> ".on_help($w=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'已選中'." <span id='selected'></span></legend><div>".($w=="sqlite"?$Qi:($w=="pgsql"?$Qi.$xf:($w=="sql"?"<input type='submit' value='".'分析'."'> ".on_help("'ANALYZE TABLE'").$xf."<input type='submit' name='check' value='".'檢查'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'修復'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'清空'."'> ".on_help($w=="sqlite"?"'DELETE'":"'TRUNCATE".($w=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'刪除'."'>".on_help("'DROP TABLE'").confirm()."\n";$i=(support("scheme")?$b->schemas():$b->databases());if(count($i)!=1&&$w!="sqlite"){$j=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'轉移到其它資料庫'.": ",($i?html_select("target",$i,$j):'<input name="target" value="'.h($j).'" autocapitalize="off">')," <input type='submit' name='move' value='".'轉移'."'>",(support("copy")?" <input type='submit' name='copy' value='".'複製'."'> ".checkbox("overwrite",1,$_POST["overwrite"],'覆蓋'):""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $R);":"")." }"),"<input type='hidden' name='token' value='$S'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'建立資料表'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'建立檢視表'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'程序'."</h3>\n";$Sg=routines();if($Sg){echo"<table class='odds'>\n",'<thead><tr><th>'.'名稱'.'<td>'.'類型'.'<td>'.'回傳類型'."<td></thead>\n";foreach($Sg
as$I){$B=($I["SPECIFIC_NAME"]==$I["ROUTINE_NAME"]?"":"&name=".urlencode($I["ROUTINE_NAME"]));echo'<tr>','<th><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.h($I["ROUTINE_NAME"]).'</a>','<td>'.h($I["ROUTINE_TYPE"]),'<td>'.h($I["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.'修改'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'建立預存程序'.'</a>':'').'<a href="'.h(ME).'function=">'.'建立函式'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'序列'."</h3>\n";$hh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($hh){echo"<table class='odds'>\n","<thead><tr><th>".'名稱'."</thead>\n";foreach($hh
as$X)echo"<tr><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'建立序列'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'使用者類型'."</h3>\n";$Oi=types();if($Oi){echo"<table class='odds'>\n","<thead><tr><th>".'名稱'."</thead>\n";foreach($Oi
as$X)echo"<tr><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'建立類型'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'事件'."</h3>\n";$J=get_rows("SHOW EVENTS");if($J){echo"<table>\n","<thead><tr><th>".'名稱'."<td>".'排程'."<td>".'開始'."<td>".'結束'."<td></thead>\n";foreach($J
as$I){echo"<tr>","<th>".h($I["Name"]),"<td>".($I["Execute at"]?'在指定時間'."<td>".$I["Execute at"]:'每'." ".$I["Interval value"]." ".$I["Interval field"]."<td>$I[Starts]"),"<td>$I[Ends]",'<td><a href="'.h(ME).'event='.urlencode($I["Name"]).'">'.'修改'.'</a>';}echo"</table>\n";$Kc=$f->result("SELECT @@event_scheduler");if($Kc&&$Kc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Kc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'建立事件'."</a>\n";}if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();