// JavaScript Document
function isEmail(email) 
{   
          var isValid = false;   
           var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;   
            if(regex.test(email)) {   
                isValid = true;   
           }   
            return isValid;   
}
function kiemtralienhe()
{
	if(document.getElementById("email").value=='')
	{
		alert('Nhập Email của bạn');
		document.getElementById("email").focus();
		return false;	
	}
	var email = document.getElementById("email").value;   
	 if(!isEmail(email)) 
	 {   
			alert(email + ' là một địa chỉ email sai');       
			document.getElementById("email").focus();
			return false;
	 } 
	return true;	
}
function Doc_thong_bao(ma_thong_bao)
{
	var xmlhttp=null;
	
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
		
	}
	else
	{
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  
	}
	xmlhttp.open("POST","XL_tin_tuc.php",true);
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("hienthi").innerHTML=xmlhttp.responseText;
		}
	}

	var data = new FormData();
	data.append('ma_thong_bao', ma_thong_bao);
	xmlhttp.send(data);

}
