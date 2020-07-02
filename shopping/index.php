<?
include "shared/session.php";
include "shared/db_connect.php";
include "include/functions/content.php";
include "include/functions/shop_stat_cat.php";
include "include/functions/shop_stat_prod.php";
include "include/functions/updates.php";
include "shared/query_results_limit.php";
updates($_GET['goto']);
?>

<HTML>
	<HEAD>
	<TITLE>网上商城</TITLE>
	<LINK href="css/rsm.css" type=text/css rel=STYLESHEET>
	<script src="js/rsm_webshop.js" type="text/javascript"></script>
	</head>
<BODY leftMargin=0 topMargin=5 MARGINHEIGHT="0" MARGINWIDTH="0">
<DIV align=center>


<TABLE cellspacing=0 cellpadding=0 border=0>
  <TR vAlign=top align=left>
    <TD width=790>
      <TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
        <TR>
          <TD vAlign=top width=168 background="gifs/navbg.gif">
				<?
				include "include/layout/view_cart.php";
				include "include/layout/menu_search.php";
				?>
            <TABLE class=menu_border cellspacing=0 cellpadding=0 width="100%" border=0>
              <TR>
                <TD vAlign=top align=middle>
                  <TABLE class=menu_border cellspacing=0 cellpadding=0 width="100%" border=0>
                    <TR>
                      <TD width="100%">
                        <TABLE cellspacing=0 cellpadding=2 width="100%" border=0>
                          <TR>
                            <TD class=menu_header background="gifs/menu_bgrnd_header_2.gif"><B>商品分类</B></TD>
                              <TD class=menu_header background="gifs/menu_bgrnd_header_2.gif"><a href="http://localhost/YLBM/index.html"><B>返回</B></a> </TD>

                          </TR>
						</TABLE>
					  </TD>
					</TR>
					<?
					include "include/layout/categories.php";
					?>
				 </TABLE>
				</TD>
			 </TR>
		   </TABLE>

								
								
            <TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
              <TR><TD align=middle><IMG height=3 src="gifs/no.gif" border=0></TD></TR>
			</TABLE>
			<BR>
			</P>
		  </TD>

          <TD vAlign=top width=599 background="gifs/bg-body.gif" rowSpan=2>

            <TABLE cellspacing=0 cellpadding=5 width="100%" border=0>
              <TR>
                <TD>
                  <TABLE cellspacing=0 cellpadding=0 border=0>
                    <TR vAlign=top align=left>
                      <TD></TD>
                      <TD width=598>
                        <TABLE id=Table15 cellspacing=0 cellpadding=0 width="100%" border=0>
					<?
						content($_GET['page']);
					?>
								
                          <TR>
                            <TD 
                            style="PADDING-RIGHT: 4px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; PADDING-TOP: 4px" 
                            vAlign=top width=598>
                              <P>
                              <TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
                                <TR>
                                <TD align=middle>
								
								</TD></TR></TABLE></P></TD></TR></TABLE></TD></TR></TABLE>
								</TD></TR></TABLE></TD>
          <TD width=23 background="gifs/bg-body.gif">
            <P><IMG height=1 src="gifs/clearpixel.gif" width=1 
            border=0> </P></TD></TR>
        <TR>
          <TD vAlign=bottom width=168 
background="gifs/navbg.gif">
            <P style="LINE-HEIGHT: 14px"></P></TD>
          <TD background="gifs/bg-body.gif">
            <P><IMG height=1 src="gifs/clearpixel.gif" width=1 
            border=0> </P></TD></TR>
		</TABLE></TD></TR></TABLE>
<TABLE cellspacing=0 cellpadding=0 border=0>
  <TR vAlign=top align=left>
    <TD width=790>
      <TABLE cellspacing=0 cellpadding=0 width="100%" border=0>
        <TR>
          <TD colSpan=3 height=27>
            <P><IMG id=Picture53 height=27 hspace=0 
            src="gifs/shopping.gif" width=768 align=top 
            border=0></P></TD>
          <TD width=21>
            <P></P></TD></TR>
        <TR>
          <TD width=49 background="gifs/navbg.gif" height=23>
            <P></P></TD>
          <TD align=middle width=689>
            </TD>
          <TD width=31 background="gifs/bgbutright.gif">
            <P></P></TD>
          <TD rowSpan=2>
            <P></P></TD></TR>
        <TR>
          <TD background="gifs/navbg.gif">
            <P></P></TD>
          <TD align=middle width=689>
            <P>
			</P>
		  </TD>
          <TD background="gifs/bgbutright.gif">
            <P></P></TD></TR>
        <TR>
          <TD background="gifs/bg-end-left.gif" height=33>
            <P></P></TD>
          <TD background="gifs/bg-end.gif">
            <P></P></TD>
          <TD background="gifs/bottom_corner1.gif">
            <P></P></TD>
          <TD>
            <P></P></TD></TR>

        <TR>
          <TD>
            <P></P></TD>
          <TD width=689>
            <P align=center>
			<?=bottom_links();?>
            </P>
		</TD>
          <TD>
            <P></P></TD>
          <TD>
            <P></P></TD>
		</TR>
        <TR>
          <TD>
            <P></P></TD>
          <TD></TD>
          <TD>
            <P></P></TD>
          <TD>
            <P></P></TD></TR></TABLE></TD></TR></TABLE>



</DIV>

</BODY>
</HTML>
