function venus_trans_auth_login(login,password,trans_auth_url,auth_domain,redirect) {
	 var data='login='+encodeURI(login)+'&password='+encodeURI(password);
     var req = venus_createXMLHttp();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
					var scode=req.responseText;
                    if(scode==''){
						//auth error
					}else{
						//auth success
						venus_setcookie('securecode',scode,false,'/',auth_domain,false);
						//redirect to redirect url
					}					

               } 
          }
     };
     req.open("POST", trans_auth_url); 
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
	 req.setRequestHeader("Content-length", data.length); 
     req.send(data); 
}