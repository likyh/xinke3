// JavaScript Document
//提交订单
$(document).ready(function(){
	$('#OrderForm').submit(function(){ 

		//送餐地址判断
		if($("#ifmemberlogin")[0].value==1 && $("#memberareatype")[0].checked==true){  //会员登录状态下，使用原来地址的判断
		
			var getObj=$("input[name='oldarea']");
			var kk=0;
			for(var i=0; i<getObj.length; i++){
				if(getObj[i].checked==true){
					kk++;
				}
			}
			if(kk!=1){
				alert("请正确选择送餐地址");
				return false;
			}
			
		}else{  //非会员状态下，以及会员登陆状态下填写新地址时的判断
		
			if($("#sarea")[0].checked==true){
				if($("#yunzone")[0].value=="0" || $("#yunzone")[0].value==""){
					alert("请选择送餐区域");
					return false;
				}
				/*
				if($("#zoneid")[0].value=="0"){//#zoneid是一个很奇怪的隐藏表单，不知道什么用的。
					alert("请选择送餐区域");
					return false;
				}
				*/	
				if($("#jaddress")[0].value==""){
					alert("请填写具体地址");
					return false;
				}
			}
				
			if($("#warea")[0].checked==true){
				if($("#xaddress")[0].value==""){
					alert("请填写详细地址");
					return false;
				}
			}
				
		}
		
		if($("#name")[0].value==""){
			alert("请填写客户名称");
			return false;
		}

		var p=$("#tel")[0].value;
		var m=$("#mov")[0].value;
		if(p=="" && m==""){
			alert("联系电话和手机号码，必须至少填写一个");
			return false;
		}else{
			if(m!=""){  //手机号码判断
				if(m.length<10){
					alert("请输入正确的手机号码，如：13912345678");
					return false;
				}
			}
		}

		if($("#payid")[0].value==""){
			alert("请选择付款方式");
			return false;
		}
		
		if($("#sctime")[0].value==""){
			alert("请选择送餐时段");
			return false;
		}

		$('#OrderForm').ajaxSubmit({
			target: 'div#notice',
			url: 'post.php',
			success: function(msg) {
				if(msg.substr(0,2)=="OK"){
					
					//清除cookie
					$.ajax({
						type: "POST",
						url:PDV_RP+"setcookie.php",
						data: "act=setcookie&cookietype=empty&cookiename=DINGCANCART",
						success: function(msg){
						}
					});

					$('div#notice').hide();
					
					//判断是否支付
					if(msg.substr(3,5)=="PAYED"){
						var orderid=msg.substr(9);
						$().alertwindow("您的订单已提交并付款成功，我们会尽快为您送餐","orderdetail.php?orderid="+orderid);
					}else{
						var msg_arr=msg.split("_");
						var md=msg_arr[1];
						var orderid=msg_arr[2];
						//window.location="orderpay.php?orderid="+orderid;
						$().alertwindow("您的订单已提交成功，我们会尽快为您送餐","orderdetail.php?orderid="+orderid+"&md="+md);
					}

				}else if(msg=="1000"){
					$('div#notice').hide();
					alert("您的购物车中没有餐品");
				}else if(msg=="1001"){
					$('div#notice').hide();
					alert("请正确选择送餐地址");
				}else if(msg=="1002"){
					$('div#notice').hide();
					alert("请选择送餐区域");
				}else if(msg=="1003"){
					$('div#notice').hide();
					alert("请填写具体地址");
				}else if(msg=="1004"){
					$('div#notice').hide();
					alert("请填写详细地址");
				}else if(msg=="1005"){
					$('div#notice').hide();
					alert("请选择付款方式");
				}else if(msg=="1006"){
					$('div#notice').hide();
					alert("您尚未登录，不能从会员帐户扣款支付订单");
				}else if(msg=="1007"){
					$('div#notice').hide();
					alert("页面超时，请重新选择送餐时段");
					//重新初始送餐时间
					var tcent=$("#span_tcent").html();
					$.ajax({
						type: "POST",
						url:PDV_RP+"dingcan/post.php",
						data: "act=getsctime&tcent="+tcent,
						success: function(msg){
							var msg_arr=msg.split("_");
							$("#sctime").html(msg_arr[3]);
							if(msg_arr[0]==1){
								$("#centinfo").html("选择此时段的积分比例为<font style='color:#ff6600;font-weight:bold;'>"+msg_arr[1]+"</font>，该订单的所获积分为<font style='color:#ff6600;font-weight:bold;'>"+msg_arr[2]+"</font>");
							}
						}
					});
				}else if(msg=="1008"){
					$('div#notice').hide();
					alert("您的会员账户余额不足，请选择线下支付或进行账户充值");
				}else if(msg=="1009"){
					$('div#notice').hide();
					alert("联系电话和手机号码，必须至少填写一个");
				}else if(msg=="kongcart"){
					$('div#notice').hide();
					alert("您的购物车中没有餐品");
				}else if(msg=="wrongcart"){
					$('div#notice').hide();
					alert("订单错误");
				}else{
					$('div#notice')[0].className='noticediv';
					$('div#notice').show();
					$().setBg();
				}
			}
		});
		return false; 

   }); 
});
