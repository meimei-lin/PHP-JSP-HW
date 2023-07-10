<?php
	session_start();//建立SESSION
	
?>
<HTML>
<HEAD>
<TITLE>PHP calculator</TITLE> MY PHP CALCULATOR!
</HEAD>
<BODY>
<P></P>
<!--作者姓名:林翡，學號:110916015-->
<!--操作說明:點選按鍵進行計算-->
<!--符合的評分標準:支援整數加減乘除運算70%，支援小數20%，自評:PHP我做出來跟JSP的一樣，用同樣邏輯下去做
，只能兩數做運算，不能負數運算等等，但可以很一般的整數、小數加減乘除，希望可以符合前兩項標準，然後我一樣
有用了三角函數的計算-->
<?php
 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	error_reporting(E_ALL & ~(E_NOTICE | E_WARNING));//關提醒跟警告的
	$_SESSION["btn"]=$_POST['submit1'];//取的submit1的值
	if(!is_null($_SESSION["btn"])){
		$_SESSION["btn2"]=$_SESSION["btn2"].$_SESSION["btn"];//把點選按鍵的值組成字串
		print("<INPUT type=\"text\" name=\"txt1\" value=\"".$_SESSION["btn2"]."\">");
		if($_SESSION["btn"]==("=")){//點到=進行字串拆解
			if(strpos($_SESSION["btn2"],'+') !== false){
				$num_container=preg_split("/[+]/",$_SESSION["btn2"]);//btn2包含+的字串拆解
				$num1_add=(float)$num_container[0];//+前面的數字丟num1_add變數
				$num2_add=(float)$num_container[1];//後面數字丟num2_add變數
			}
			if(strpos($_SESSION["btn2"],'-') !== false){
				$num_container=preg_split("/[-]/",$_SESSION["btn2"]);//btn2包含-的字串拆解
				$num1_sub=(float)$num_container[0];//-前面的數字丟num1_sub變數
				$num2_sub=(float)$num_container[1];//後面數字丟num2_sub變數
			}
			if(strpos($_SESSION["btn2"],'*') !== false){
				$num_container=preg_split("/[*]/",$_SESSION["btn2"]);//btn2包含*的字串拆解
				$num1_mul=(float)$num_container[0];//*前面的數字丟num1_mul變數
				$num2_mul=(float)$num_container[1];//後面數字丟num2_mul變數
			}
			if(strpos($_SESSION["btn2"],'/') !== false){
				$num_container=explode("/",$_SESSION["btn2"]);//btn2包含/的字串拆解
				$num1_div=(float)$num_container[0];//(/)前面的數字丟num1_div變數
				$num2_div=(float)$num_container[1];//後面數字丟num2_div變數
			}
			if(strpos($_SESSION["btn2"],'%') !== false){
				$num_container=preg_split("/[%]/",$_SESSION["btn2"]);//btn2包含%的字串拆解
				$num1_rem=(float)$num_container[0];//%前面的數字丟num1_rem變數
				$num2_rem=(float)$num_container[1];//後面數字丟num2_rem變數
			}
			if(strpos($_SESSION["btn2"],'x^2')!==false){//btn2包含x^2的字串拆解
				$num_container=explode("x^2",$_SESSION["btn2"]);//拆解字串
				if($num_container[1]==("=")){
					$num_x=(float)$num_container[0];//轉成float
				}
				else{
					print("<INPUT type=\"text\" name=\"txt1\" value=\""."error，請重新點選"."\">");//在x^2後面有數字的例外處理
					$_SESSION["btn2"]="";
				}
			}
			if(strpos($_SESSION["btn2"],'1 Divided by x')!==false){//btn2包含1 Divided by x的字串拆解
				$num_container=explode("1 Divided by x",$_SESSION["btn2"]);
				if($num_container[1]==("=")){
					$num1_x=(float)$num_container[0];
				}
				else{
					print("<INPUT type=\"text\" name=\"txt1\" value=\""."error，請重新點選"."\">");//如果在1 Divided by x後面出現數字的例外
					$_SESSION["btn2"]="";
				}
			}
			if(strpos($_SESSION["btn2"],'sqrt x')!==false){
				$num_container=explode("sqrt x",$_SESSION["btn2"]);
				if($num_container[1]==("=")){
					$num_s=(float)$num_container[0];
				}
				else{
					print("<INPUT type=\"text\" name=\"txt1\" value=\""."error，請重新點選"."\">");//squrt x後面有數字就錯誤處理
					$_SESSION["btn2"]="";
				}
			}
			if(strpos($_SESSION["btn2"],'sin')!==false){
				$num_container=explode("sin",$_SESSION["btn2"]);;
				$num_sin=(float)$num_container[1];
				$num1_sin=deg2rad($num_sin);//轉成度
			}
			if(strpos($_SESSION["btn2"],'cos')!==false){
				$num_container=explode("cos",$_SESSION["btn2"]);;
				$num_cos=(float)$num_container[1];
				$num1_cos=deg2rad($num_cos);
			}
			if(strpos($_SESSION["btn2"],'tan')!==false){
				$num_container=explode("tan",$_SESSION["btn2"]);;
				$num_tan=(float)$num_container[1];
				$num1_tan=deg2rad($num_tan);
			}
			//下面就是依照運算符號進行運算
			if(strpos($_SESSION["btn2"],'+') !== false){
				$num2_add=$num1_add+$num2_add;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_add."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'-') !== false){
				$num2_sub=$num1_sub-$num2_sub;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_sub."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'*') !== false){
				$num2_mul=$num1_mul*$num2_mul;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_mul."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'/') !== false){
				if($num2_div==0){//除數為0的例外處理
					print("<INPUT type=\"text\" name=\"txt1\" value=\""."除數不能為0，請重新點選"."\">");
					$_SESSION["btn2"]="";
				}else{
					$num2_div=$num1_div/$num2_div;
					print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_div."\">");
					$_SESSION["btn2"]="";
				}
			}else if(strpos($_SESSION["btn2"],'%') !== false){
				$num2_rem=$num1_rem%$num2_rem;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_rem."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'x^2')!==false){
				$num1_x=$num_x*$num_x;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num1_x."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'1 Divided by x')!==false){
				$num2_x=1/$num1_x;
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_x."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'sqrt x')!==false){
				$num1_s=sqrt($num_s);
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num1_s."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'sin')!==false){
				$num2_sin=sin($num1_sin);
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_sin."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'cos')!==false){
				$num2_cos=cos($num1_cos);
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_cos."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'tan')!==false){
				$num2_tan=tan($num1_tan);
				print("<INPUT type=\"text\" name=\"txt1\" value=\"" .$num2_tan."\">");
				$_SESSION["btn2"]="";
			}else if(strpos($_SESSION["btn2"],'C')!==false){
				$_SESSION["btn2"]="";
				print("<INPUT type=\"text\" name=\"txt1\" value=\""."清除，請重新點選"."\">");
			}else if(strpos($_SESSION["btn2"],'CE')!==false){
				$_SESSION["btn2"]="";
				print("<INPUT type=\"text\" name=\"txt1\" value=\""."清除，請重新點選"."\">");
			}
	}else if(strpos($_SESSION["btn2"],'C')!==false){
		$_SESSION["btn2"]="";
		print("<INPUT type=\"text\" name=\"txt1\" value=\""."清除，請重新點選"."\">");
	}else if(strpos($_SESSION["btn2"],'CE')!==false){
		$_SESSION["btn2"]="";
		print("<INPUT type=\"text\" name=\"txt1\" value=\""."清除，請重新點選"."\">");
	}
}	
?>
<FORM action="cal-110916015.php" method=post name=FORM1>
<!--計算機的按鍵們-->
<P>
	<INPUT type="submit" value="%" name="submit1"   style="background-color:#77DDFF;width:50px;height:50px;">
	<INPUT type="submit" value="CE" name="submit1" style="background-color:#77DDFF;width:50px;height:50px;">
	<INPUT type="submit" value="C" name="submit1" style="background-color:#77DDFF;width:50px;height:50px;"></p>
	<p>
	<INPUT type="submit" value="sin" name="submit1"style="width:50px;height:50px;background-color:#77FFEE">
	<INPUT type="submit" value="cos" name="submit1"style="width:50px;height:50px;background-color:#77FFEE">
	<INPUT type="submit" value="tan" name="submit1"style="width:50px;height:50px;background-color:#77FFEE"></p>
	<p>
	<INPUT type="submit" value="1 Divided by x"name="submit1"style="width:100px;height:30px;background-color:#9999FF">
	<INPUT type="submit" value="x^2"name="submit1"style="width:50px;height:30px;background-color:#9999FF">
	<INPUT type="submit" value="sqrt x" name="submit1"style="width:50px;height:30px;background-color:#9999FF"></p>
	<p>
	<INPUT type="submit" value="7" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="8" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="9" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="/" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;"></p>
	<p>
	<INPUT type="submit" value="4" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="5" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="6" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="*" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;"></p>
	<p>
	<INPUT type="submit" value="1" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="2" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="3" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="-" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;"></p>
	<p>
	<INPUT type="submit" value="0" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="." name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="=" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;">
	<INPUT type="submit" value="+" name="submit1"style="width:50px;height:50px;background-color:#77DDFF;"></p>
</FORM>					 			
</BODY>
</HTML>
