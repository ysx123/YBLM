<?
Function updates($goto)
{

	Switch($goto)
	{

			Case "update_cart":		// 更新购物车
				foreach($_SESSION['user']["article"] as $i=>$val){
					 if (!$_POST['q'][$i]){
						 $_SESSION['user']["article"][$i]=0;
						 $_SESSION['user']["quantity"][$i]=0;
					 }
					 else
						$_SESSION['user']["quantity"][$i]=$_POST['q'][$i];

					 $_GET['page']="view_cart";
				}
			Break;

			Case "del_cart":		// 删除购物车里商品
				 $i = $_GET['i'];
				if($_SESSION['user']["article"][$i]==$_GET['article_id']){
					 //$_SESSION['user']["article"][$i]=0;

					$_SESSION['user']["quantity"][$i] -=1;
					if($_SESSION['user']["quantity"][$i]==-1)
					{
						$arrCount = count($_SESSION['user']["article"]);
						for($k=$i;$k<$arrCount;$k++)
						{
								$_SESSION['user']["quantity"][$k] = $_SESSION['user']["quantity"][$k+1];
								$_SESSION['user']["article"][$k] = $_SESSION['user']["article"][$k+1];
						}
						unset($_SESSION['user']["article"][$k]);
						unset($_SESSION['user']["quantity"][$k]);
					}
							
				} 
				$_GET['page']="view_cart";
			Break;

			Case "add_to_cart":		// 	
				
				if(!is_array($_SESSION['user']["article"]))  $_SESSION['user']["article"]=array();
				if(!is_array($_SESSION['user']["quantity"])) $_SESSION['user']["quantity"]=array();

				$l=count($_SESSION['user']["article"]);

				if(!in_array($_GET['article_id'],$_SESSION['user']["article"]))
				{
					$_SESSION['user']["article"][$l]=$_GET['article_id'];

					$_SESSION['user']["quantity"][$l]=1;
				}
				else{

				// 对于已经存在的物品
					foreach($_SESSION['user']["article"] as $i=>$val){

						if($val==$_GET['article_id'])
							$_SESSION['user']["quantity"][$i] +=1;
					}
				}

				$_GET['page']="view_cart";
			Break;
			Default:

	};

}
?>