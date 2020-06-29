<?
// <desc>General function which displayes mysql queries results </desc>

function query_results_limit($query,$camp_start,$order_start,$order_coresp_array,$fields_alias,$script_name,$l2,$head_title,$no_results_msg,$noform){
global $HTTP_POST_VARS;
global $HTTP_GET_VARS;
global $PHP_SELF;
global $col0;
global $col1;
global $col2;
global $filter;
global $filter_col;


$params = "";
        while (list( $var, $value) = @each( $HTTP_GET_VARS))
                if ($var!='b' && $var!='order' && $var!='camp' && $var!='l1' && $var!='l2' && $var!="filter" && $var!="filter_col") $params.= "$var=".@urlencode( $value)."&";
        while (list( $var, $value) = @each( $HTTP_POST_VARS))
                if ($var!='b' && $var!='order' && $var!='camp' && $var!='l1' && $var!='l2' && $var!="filter" && $var!="filter_col") $params.= "$var=".@urlencode( $value)."&";

$rn="
";
ereg_replace($rn," ","$query");
global $l1;
global $camp;
global $order;
?>
<script language="JavaScript">
function next (){
var n=document.myform.l2.value;
for (i=1;i<=n;i++)
        document.myform.l1.value++;
document.myform.submit();
}

function previous (){
	document.myform.l1.value=document.myform.l1.value-document.myform.l2.value;
	document.myform.submit();
}
</script>
<?

$having_filter="";
for ($i=0;$i<count($filter);$i++)
	if ($filter[$i]){
		$filter[$i]=stripslashes($filter[$i]);
		$having_filter.=$filter_col[$i]." ".$filter[$i]." and "; 
	}


if ($having_filter){
	$having_filter.=" 1>0 ";		
	$hv=array();$hv=explode("having",$query);$having=$hv[1];
	$having=$having_filter.$having;
	$query=$hv[0]." having ".$having;
}
$result = mysql_query ($query);
//echo nl2br($query)."<br>".mysql_error();

if (!mysql_num_rows($result)){
	if ($no_results_msg) 
		echo $no_results_msg;
	else
		echo "<font size=\"2\" face=\"Arial\" color=\"Red\"><b>目前还没有数据.</b></font>";
exit;
}
  $query_temp=$query;
  $column = mysql_fetch_assoc($result);
        $j=0;
        while(list($col_name, $col_value) = @each($column)){
                $column_name[$j]=$col_name;


                if (is_numeric($col_value))
                        $column_numeric[$j]=1;
                $query_temp= str_replace ("as $col_name", "", $query_temp);
                $j++;
        }


if (!$script_name)
        $script_name=$PHP_SELF;
if (!$l2 or $l2<=0)
        $l2=20;
if ($l1=="") $l1=0;
if ($camp==""):
if ($camp_start) 
	{
	

	
		if (!ereg(",",$camp_start))
			$camp=$camp_start;
		else{
				$cs=explode(",",$camp_start);
				if ($cs[0]) $col0=$cs[0];
				if ($cs[1]) $col1=$cs[1];
				if ($cs[2]) $col2=$cs[2];
			}	
			
	}
else{
$tmp=0;
        for ($k=0;$k<count($column_name);$k++):
                if (eregi("HIDDEN",$column_name[$k]))
                        {$camp=$column_name[$k+1];$tmp=1;}
        endfor;
        if (!$tmp)
                $camp=$column_name[0];
}
else:
//unset col0,1,2 when $camp is set
unset($col0);unset($col1);unset($col2);
endif;




if ($order=="")
        if ($order_start) $order=$order_start;
        else                $order="asc";
if ($col0 and $col1 and $col2)
        $camp=" $col0 , $col1 , $col2 ";
$limit_query=$query." order by $camp $order limit $l1, $l2";
        $q=mysql_query($limit_query);
//echo nl2br($limit_query)."<br>err=".mysql_error();
        $q_total=mysql_query($query);

	$n=mysql_num_rows($q);
$n_total=mysql_num_rows($q_total);


if ($n_total%$l2==0)
        $total_pages=$n_total/$l2;
else
        $total_pages=floor($n_total/$l2)+1;


if ($noform!=1) echo "<form method=post name=myform action=\"$script_name\">\n";
                echo "<input type=hidden name=\"pg\" value=\"\"> \n";
                echo "<input type=hidden name=\"where\" value=\"$where\" > \n";
                echo "<input type=hidden name=\"col0\" value=\"$col0\" > \n";
                echo "<input type=hidden name=\"col1\" value=\"$col1\" > \n";
                echo "<input type=hidden name=\"col2\" value=\"$col2\" > \n";
                echo "<input type=hidden name=\"l1\" value=\"$l1\">\n";
                echo "<input type=hidden name=\"l2\" value=\"$l2\">\n";
                echo "<input type=hidden name=\"order\" value=\"$order\">\n";
                echo "<input type=hidden name=\"camp\" value=\"$camp\">\n";
                echo "<input type=hidden name=\"st\" value=\"$st\">\n";
				
        echo "<br><table border=0 cellpadding=\"2\" cellspacing=\"0\" width=650>

  						<tr bgcolor=\"#EFEFEF\"> 
  							<td  bgcolor=\"#EFEFEF\" colspan=".count($column_name)." nowrap><font color=\"#000000\">&nbsp;".$head_title."</td>
						</tr>
		";

if ($order=="asc")
        $order="desc";
else
        $order="asc";

if ($l1==0){
        if ($l2>$n_total)
                echo "<tr bgcolor=\"#EFEFEF\"><td align=\"left\" nowrap><font class=black1>页数 1/$total_pages</font></td><td align=\"right\" colspan=".(count($column_name)-1)." nowrap><font class=\"black1\">$n_total results, displaying 1 - $n_total</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        else
                echo "<tr bgcolor=\"#EFEFEF\"><td align=\"left\" nowrap><font class=black1>页数 1/$total_pages</font></td><td align=\"right\" colspan=".(count($column_name)-1)." nowrap><font class=\"black1\">$n_total results, displaying 1 - $l2</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        if ($total_pages!=1)
			echo "<a href=\"javascript:next()\" class=sec>下一页</a>";

        echo "</td></tr>\n";
        }
elseif ((floor($l1/$l2)+1)==$total_pages)        {
        echo "<tr bgcolor=\"#EFEFEF\"><td align=\"left\" nowrap><font class=black1>页数 $total_pages/$total_pages</font></td><td align=\"right\" colspan=".(count($column_name)-1)." nowrap><font class=\"black1\">$n_total results, displaying ".($l2*floor($l1/$l2)+1)." - $n_total</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:previous()\" class=sec>上一页</a></td></tr>\n";
        }
else{
        echo "<tr bgcolor=\"#EFEFEF\"><td align=\"left\" nowrap><font class=black1>页数 ".(floor($l1/$l2)+1)."/$total_pages</font></td><td align=\"right\" colspan=".(count($column_name)-1)." nowrap><font class=\"black1\">$n_total results, displaying ".($l2*floor($l1/$l2)+1)." - ".($l2*floor($l1/$l2)+$l2)."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:previous()\" class=\"sec\">上一页</a> <a href=\"javascript:next()\" class=\"sec\">下一页</a></td></tr>\n";
        }

if (ereg("\?",$script_name))
        $href=$script_name;
else
        $href=$script_name."?foo=1";


        echo "<tr bgcolor=\"#EFEFEF\" class=\"headerfont\" >\n";
                for ($i=0;$i<count($column_name);$i++):
					$column_name_display[$i]=$column_name[$i];

                        $align_column="left";
						if($column_name_display[$i]=="NoOfRequests")  $align_column="center";
                        if (!eregi("HIDDEN",$column_name[$i])){

	                      if (is_array($order_coresp_array)):
						   		//foreach($order_coresp_array as $key[$i]=>$val[$i]){
								reset($order_coresp_array);
								while(list($key[$i],$val[$i])=each($order_coresp_array)):
									if ($column_name[$i]==$val[$i])
										$column_name[$i]=$key[$i];
								endwhile;
								//}
						   endif;

                 if (is_array($fields_alias)):
					foreach($fields_alias as $key=>$val){
						if ($column_name_display[$i]==$key)
							$column_name_display[$i]=$val;
					}
				endif;

						   echo "\t\t<td align=\"$align_column\" class=\"listheaderfontAdmin\" style=\"color:Black;\" nowrap><a href=\"$href&order=$order&camp=$column_name[$i]&l1=$l1&l2=$l2&$params"."c=1&"."&$get_filter\" class=\"sec\"><b>$column_name_display[$i]</b></a></td>\n";
						}
						
                endfor;
		echo "</tr>\n";
        $count=0;
        while ($a=mysql_fetch_assoc($q)):
                if (is_int ($count/2)) $bg="white";
                else $bg="#EFEFEF";
        echo "<tr bgcolor=\"$bg\">\n";
			   foreach($a as $cn=>$cv){
                	$align="left";
                	//if($cn=="Views")  $align="center";
	                if (!eregi("HIDDEN",$cn))
                        echo "<td align=\"$align\" nowrap><font class=\"black1\">$cv</font></td>";
                }////
        $count++;
        echo "</tr>\n";
        endwhile;
echo "
  						<tr> 
  							<td class=pageSubheader colspan=".count($column_name)." nowrap>&nbsp;</td>
						</tr>
		";

echo "</table>\n";
if ($noform!=1) echo "</form>\n";
}
?>