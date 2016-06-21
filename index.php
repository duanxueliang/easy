<?php 
header ("Content-type:  text/html;charset=utf-8");
require_once 'autoload.php';
require_once 'Nuser.class.php';
session_start();
// $userName = $_POST["userName"];
//pdo预编译查询
$dsn = "mysql:host=localhost;dbname=u19";
$pdo = new PDO($dsn,"root","892832",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
//查询全表
$sql = "select * from nuser where useName=?";
//预编译处理  

//循环数组

?>
<!DOCTYPE html>
<html>
     <head>
          <title>easy</title>
          <meta charset="utf-8"> 
          <link type="text/css" rel="stylesheet" href="easyui/themes/bootstrap/easyui.css"/>
          <link type="text/css" rel="stylesheet" href="easyui/themes/icon.css"/>	
          <script type="text/javascript" src="easyui/jquery.min.js"></script>
          <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
          <script type="text/javascript" src="easyui/locale/easyui-lang-zh_CN.js"></script>
          <link type="text/css" rel="stylesheet" href="css/home.css"/>
          <link type="text/css" rel="stylesheet" href="css/fenxiang.css"/>
		  <script type="text/javascript" src="js/yangshi.js"></script>
		  <script type="text/javascript" src="js/fenxiang.js"></script>
     </head>
     
    <body class="easyui-layout">   
        <div data-options="region:'north',title:'栏目',split:true" style="height:100px; margin-left:1200px;">
			    <div style="margin-top:20px; font-size:20px; color:#03458f;">
			    
			       <?php 
			       if (array_key_exists("user",$_SESSION)){
			         echo $_SESSION['user']->getUseName();
			         echo  "<a href='loginout.php'>退出登录</a>";
			       }
			       else{
                        echo "<a  href='login.php' >登录进入 </a>";
                        echo "<a  href='zc.php' style='margin-left:20px;'>立即注册</a>";
			       }?>
			       
			   </div>    
        </div> 
        <div id="self" >
             <div id="self1">
             	 <div id="s1">
             	    <?php 
             	    if (array_key_exists("user",$_SESSION)){
             	    $userName = $_SESSION["user"]->getUseName();
             	    
             	    $dsn = "mysql:host=localhost;dbname=u19";
             	    $pdo = new PDO($dsn,"root","892832",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
             	    //查询全表
             	    $sql = "select * from nuser where useName=?";
             	    //预编译处理
             	    $pstmt = $pdo->prepare($sql);
             	    //执行
             	    $pstmt->execute(array($userName));
             	    while($row = $pstmt->fetch(PDO::FETCH_NUM)){
             	       echo  "<img src='{$row[4]}'>";
             	       echo "<br/>";
             	       echo "<b style='color:green;'>"."欢迎".$userName."来到这里</b>";
             	      }
             	    }
             	     
             	    ?>
             	    
             	 </div>
             	 <div id="s2">
             	 	<table>
             	 		<tr>
             	 			<td><span  id="cself" style="cursor: pointer; color:red;" >个人信息</span></td>
             	 			<td><span  id="cpass" style="cursor: pointer; color:red;">密码</span></td>
             	 		</tr>
             	 		<tr><td colspan="2" ><span style="font-size: 30px;">Summer</span></td></tr>
						<tr><td><span>性别：<em>男</em></span></td><td></td></tr>
						<tr><td><span>积分：<em>540</em></span></td><td></td></tr>
						<tr><td><span>操作：<em>发私信</em></span></td><td></td></tr>
             	 	</table>
             	 </div>
             	 <div id="s3">
             	    <span>发起地点：<em>重庆 渝中</em></span><br />
							    <span>回报执行：<em>预计成功之后 120天内寄送</em></span><br />
							    <span>结束时间：<em> 2016-11-20 05:54:12 </em></span><br />
							    <span>个人微博：<em>http://weibo.com/foyrd</em></span><br />
							    <span>自我介绍：<em>活泼开朗  阳光帅气</em></span><br />
							   
							   
             	 	<div></div>
             	 	<div></div>
             	 	<div></div>
             	 	<div></div>
             	 </div>
         	 </div>
         	 <div id="self2">
         	      <form action="changeself.php"  method="post" style="display: block; color:black;">
                      
                            <div id="htop" >
                            <?php 
                             if (array_key_exists("user",$_SESSION)){
			                    echo "<td  style='color:red;font-size:25px;'>{$_SESSION['user']->getUseName()}".
			                    "<span style='color:black;font-size:25px;'>个人信息设置</span>"."</td>";
			                  }
			                 ?>
                            </div>
                        <table>
                        	<tr id="hbody" >
                        	<?php 
                        	if (array_key_exists("user",$_SESSION)){
                            	$sql = "select * from nuser where useName=?";
                            	$pstmt = $pdo->prepare($sql);
                            	$userName = $_SESSION["user"]->getUseName();
                            	//执行
                            	$pstmt->execute(array($userName));
                            	//提取二位数组中的数据
                            	$row = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                            	 DBUtil::echoTableHead(array("姓名"));
                            	 foreach ($row as $arr){
                            	      echo  "<td ><input  type='text' name='userName' style='width:215px;' value={$arr["useName"]}></td>";
                                }
                                DBUtil::echoTableFood();
                                $userPass = $_SESSION["user"]->getUsePass();
                                DBUtil::echoTableHead(array("姓名"));
                                foreach ($row as $arr){
                                    echo  "<td><input type='text' name='userPass' style='width:215px;' value={$arr["usePass"]}></td>";
                                }
                                DBUtil::echoTableFood();
                                DBUtil::echoTableHead(array("年龄"));
                                foreach ($row as $arr){
                                    echo  "<td><input type='text' name='userAge' style='width:215px;' value={$arr["useAge"]}></td>";
                                }
                                DBUtil::echoTableFood();
                                DBUtil::echoTableHead(array("手机"));
                                foreach ($row as $arr){
                                    echo  "<td><input type='text' name='userPhone' style='width:215px;' value={$arr["usePhone"]}></td>";
                                }
                                DBUtil::echoTableFood();
                                DBUtil::echoTableHead(array("邮箱"));
                                foreach ($row as $arr){
                                    echo  "<td><input type='text' name='userEmail' style='width:215px;' value={$arr["useEmail"]}></td>";
                                }
                                DBUtil::echoTableFood();
                        	}
                        	if (array_key_exists("userName",$_COOKIE)){
                        	    $sql = "select * from nuser where useName=?";
                                $userName = $_COOKIE["userName"];
                                $userPass = $_COOKIE["userPass"];
                                $pstmt = $pdo->prepare($sql);
                                $row = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                                DBUtil::echoTableHead(array("姓名"));
                                echo  "<td><input type='text' name='userName' style='width:215px;' value='$userName'></td>";
                                DBUtil::echoTableFood();
                                DBUtil::echoTableHead(array("密码"));
                                echo  "<td><input type='text' name='userPass'  style='width:215px;' value='$userPass'></td>";
                                DBUtil::echoTableFood();
                        	}
                        	?>
                         
                        	</tr>
                        	<tr>
                        		<td colspan="1">
                        			<input style="background-color: #32cfeb;" type="submit" value="保存">
                        		</td>
                        		<td colspan="1">
                        			<button id="return1" style="background-color: #32cfeb;" >取消</button>
                        		</td>
                        	</tr>
                        	
                        
                        </table>
                    </form>
         	 </div>
         	 <div id="self3">
         	      <form action="changepass.php"  method="post" style="display: block; color:black;">
                            <div id="htop" >
                            <?php 
                             if (array_key_exists("user",$_SESSION)){
			                    echo "<td  style='color:red;font-size:25px;'>{$_SESSION['user']->getUseName()}".
			                    "<span style='color:black;font-size:25px;'>更改密码</span>"."</td>";
			                  }
			                 ?>
                            </div>
                        <table>
                        	<tr id="hbody" >
                        	<?php 
                        	if (array_key_exists("user",$_SESSION)){
                            	$sql = "select * from nuser where useName=?";
                            	$pstmt = $pdo->prepare($sql);
                            	$userName = $_SESSION["user"]->getUseName();
                            	//执行
                            	$pstmt->execute(array($userName));
                            	//提取二位数组中的数据
                            	$row = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                            	 DBUtil::echoTableHead(array("姓名"));
                            	 foreach ($row as $arr){
                            	      echo  "<td ><input  type='text' name='userName' style='width:215px;' value={$arr["useName"]}></td>";
                                }
                                DBUtil::echoTableFood();
                                $userPass = $_SESSION["user"]->getUsePass();
                                DBUtil::echoTableHead(array("密码"));
                                foreach ($row as $arr){
                                    echo  "<td><input type='text' name='userPass' style='width:215px;' value={$arr["usePass"]}></td>";
                                }
                                DBUtil::echoTableFood();
                        	}
                        	if (array_key_exists("userName",$_COOKIE)){
                        	    $sql = "select * from nuser where useName=?";
                                $userName = $_COOKIE["userName"];
                                $userPass = $_COOKIE["userPass"];
                                $pstmt = $pdo->prepare($sql);
                                $row = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                                DBUtil::echoTableHead(array("姓名"));
                                echo  "<td><input type='text' name='userName' style='width:215px;' value='$userName'></td>";
                                DBUtil::echoTableFood();
                                DBUtil::echoTableHead(array("密码"));
                                echo  "<td><input type='text' name='userPass'  style='width:215px;' value='$userPass'></td>";
                                DBUtil::echoTableFood();
                        	}
                        	?>
                         
                        	</tr>
                        	<tr>
                        		<td colspan="1">
                        			<input type="submit"  style="background-color: #32cfeb;" value="保存">
                        		</td>
                        		<td colspan="1">
                        			<button id="return2" style="background-color: #32cfeb;" >取消</button>
                        		</td>
                        	</tr>
                            <tr><td>
                        	<?php 
                               if (array_key_exists("success",$_SESSION)){
                                   echo $_SESSION["success"];
                                }
                              ?>
                        	</td></tr>
                        </table>
                    </form>
         	 </div>
         </div>  
        <div data-options="region:'west',title:'菜单',split:true" style="width:100px;">
            <ul id="tt" class="easyui-tree">   
                <li>   
                    <span>Folder</span>   
                    <ul>   
                        <li>   
                            <span>Sub Folder 1</span>   
                            <ul>   
                                <li>   
                                    <span><a href="#">File 11</a></span>   
                                </li>   
                                <li>   
                                    <span>File 12</span>   
                                </li>   
                                <li>   
                                    <span>File 13</span>   
                                </li>   
                            </ul>   
                        </li>   
                        <li>   
                            <span>File 2</span>   
                        </li>   
                        <li>   
                            <span>File 3</span>   
                        </li>   
                    </ul>   
                </li>   
                <li>   
                    <span>File21</span>   
                </li>   
            </ul> 
        </div>   
        <div data-options="region:'center',title:'内容'" style="padding:5px;background:#eee;"></div>   
    </body>
</html>