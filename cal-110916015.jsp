<HTML>
<HEAD>
<TITLE>Welcome to my JSP calculator!!</TITLE>
</HEAD>
<BODY style="background-color:#f0fff0;">
<!--主頁面設計-->
<br><br>
<div style= "text-align:center;">
	<font text-align:center; size="16" color="#9370db" style="text-shadow:3px 3px 3px #cccccc;" face="fantasy">
		My JSP Calculator Homework!!
	</font>
</div>
<br>
<P></P>
<!--作者姓名:林翡，學號:110916015!-->
<!--操作說明:點選按鍵進行計算-->
<!--符合的評分標準:支援整數加減乘除運算70%，支援小數20%，自評:雖然能支援整數跟小數的加減乘除及其他特殊運算，然後我有多了三角函數
的換算，不知道能不能算特殊功能，但還是有不足的地方，像是不能支援負數運算、只能支援兩個數的運算、不能四則運算等等。
總覺得沒到100分-->
<!--然後這個程式我沒參考別人的，從四月初就開始寫，前前後後改了三、四種寫法，因為前面寫的都沒辦法執行，直到這次終於能執行能測試了-->
<!--老師我一開始是用JCREATOR寫的，但後來時間到期就換到VSCODE寫，但換過來時中文會變亂碼，連網頁顯示的中文也是亂碼
    不曉得老師那邊看會不會有影響-->
<%
	//取得submit1的值
	
%>
<%!
	float num1=0,num2=0,num_x=0,num1_x=0,num2_x=0;
	double num_s=0,num1_s=0,num_sin=0,num1_sin=0,num2_sin=0,num_cos=0,num1_cos=0,num2_cos=0,
		num_tan=0,num1_tan=0,num2_tan=0;
	String btn2="";
%>
<%	String btn=request.getParameter("submit1");

	if(btn!=null){
		%>
	<table  width="100" height="50" align="center" bgcolor="#f0ffff" border="3">
	<tr>
		<td align='center' valign="middle">
			<%btn2=btn2+btn;//把點的bitton值加到字串btn2，我先組合字串
			out.print("<INPUT type=\"text\" name=\"txt1\" value=\""+btn2+"\">");//顯示btn2
			if(btn.equals("=")){//點=時進行字串拆解
				if(btn2.contains("+")||btn2.contains("-")||btn2.contains("*")||btn2.contains("/")
				||btn2.contains("%")){
					
					String [] num_container=btn2.split("\\+|\\-|\\*|\\/|\\=|\\%");//把btn2這字串拆解
					num1=Float.parseFloat(num_container[0]);//運算符號前的數字轉成float
					num2=Float.parseFloat(num_container[1]);//運算符號後的數字轉成float
				}
				if(btn2.contains(" x ^ 2 ")){//x^2特別處理
					String [] num_container=btn2.split("\\s+");//因為我只要取得x^2前的數字，所以我利用空格來拆解字串
					num_x=Float.parseFloat(num_container[0]);//轉成float
				}
				if(btn2.contains(" 1 Divided by x ")){//1/x也特別處理
					String [] num_container=btn2.split("\\s+");//這邊我也用空格來拆解字串
					//如果在x^2後面出現數字的例外
					if(num_container[5].equals("=")){
						num1_x=Float.parseFloat(num_container[0]);
					}
					else{
						out.print("error");
						btn2="";
					}
					
				}
				if(btn2.contains(" sqrt x ")){//√x也特別處理
					String [] num_container=btn2.split("\\s+");//一樣用空格拆解
					if(num_container[3].equals("=")){
						num_s=Float.parseFloat(num_container[0]);
					}
					else{
						out.print("error");
						btn2="";
					}
				}
				if(btn2.contains("sin ")){
					String [] num_container=btn2.split("\\s+|\\=");
					num_sin=Float.parseFloat(num_container[1]);
					num2_sin=Math.toRadians(num_sin);//轉成度
				}
				if(btn2.contains("cos ")){
					String [] num_container=btn2.split("\\s+|\\=");
					num_cos=Float.parseFloat(num_container[1]);
					num2_cos=Math.toRadians(num_cos);
				}
				if(btn2.contains("tan ")){
					String [] num_container=btn2.split("\\s+|\\=");
					num_tan=Float.parseFloat(num_container[1]);
					num2_tan=Math.toRadians(num_tan);
				}
				//以下就是依照運算符號進行運算
				if(btn2.contains("+")){
					num2=num1+num2;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2+"\">");
					btn2="";//運算完讓btn2清空
				}else if(btn2.contains("-")){
					num2=num1-num2;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2+"\">");
					btn2="";
				}else if(btn2.contains("*")){
					num2=num1*num2;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2+"\">");
					btn2="";
				}else if(btn2.contains("/")){
					if(num2==0){//除數為0的例外處理
						out.print("error");
						btn2="";
					}else{
						num2=num1/num2;
						out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2+"\">");
						btn2="";
					}
				}else if(btn2.contains("%")){
					num2=num1%num2;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2+"\">");
					btn2="";
				}else if(btn2.contains(" x ^ 2 ")){
					num1_x=num_x*num_x;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num1_x+"\">");
					btn2="";
				}else if(btn2.contains(" 1 Divided by x ")){
					num2_x=1/num1_x;
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num2_x+"\">");
					btn2="";
				}else if(btn2.contains(" sqrt x ")){
					num1_s=Math.sqrt(num_s);
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num1_s+"\">");
					btn2="";
				}else if(btn2.contains("sin ")){
					num1_sin=Math.sin(num2_sin);
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num1_sin+"\">");
					btn2="";
				}else if(btn2.contains("cos ")){
					num1_cos=Math.cos(num2_cos);
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num1_cos+"\">");
					btn2="";
				}else if(btn2.contains("tan ")){
					num1_tan=Math.tan(num2_tan);
					out.print("<INPUT type=\"text\" name=\"txt1\" value=\"" +num1_tan+"\">");
					btn2="";
				}else if(btn2.contains("C")){
					btn2="";
				}
			}else if(btn2.contains("C")||btn2.contains("CE")){
				btn2="";
				out.print("<INPUT type=\"text\" name=\"txt1\" value=\""+btn2+"\">");
			}%>
		</tr>
		</td>
		</table>
	<%}
%>
<FORM action="cal-110916015.jsp" method=post name=FORM1>
<!--計算機的按鍵們-->
<table width="400" height="300" align="center" bgcolor="#f0ffff" border="3">
<tr>
	<td align='center' valign="middle">
		<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="%" name="submit1">
		<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="CE" name="submit1">
		<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="C" name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="sin " name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="cos " name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="tan " name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:100px" type="submit" value=" 1 Divided by x "name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:100px" type="submit" value=" x ^ 2 "name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:100px" type="submit" value=" sqrt x " name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="7" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="8" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="9" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="/" name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="4" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="5" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="6" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="*" name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="1" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="2" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="3" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="-" name="submit1"></td>
	</tr>
	<tr>
	<td align='center' valign="middle">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="0" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="." name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="=" name="submit1">
	<INPUT style= "background-color:#87cefa;height:50px;width:50px" type="submit" value="+" name="submit1"></td>
	</tr>
</tr>
</table>
</FORM>					 			
</BODY>
</HTML>