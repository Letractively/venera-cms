function venus_makerate(rateid,ratevalue,ratetype,callback) {
	 var data='id='+rateid+'&value='+ratevalue+'&type='+ratetype;
     var req = venus_createXMLHttp();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
					var ret=req.responseText;
					//alert(ret);
					if(ret!='error'){
						eval(callback+'('+ret+')');
					}
               } 
          }
     };
     req.open("POST", '/app/ext/makerate.php'); 
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
	 req.setRequestHeader("Content-length", data.length); 
     req.send(data); 
}