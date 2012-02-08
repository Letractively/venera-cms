function venus_select_city(src) {
	 idcountry=document.getElementById(src+'_city_country_id').value;
	 idregion=0;
	 if(document.getElementById(src+'_city_region_id')!=null) idregion=document.getElementById(src+'_city_region_id').value;
	
			if(idregion==0){
				document.getElementById(src+'_city_region').innerHTML='Loading...';
				document.getElementById(src+'_city_region').style.display='inline';
				document.getElementById(src).innerHTML='';
				document.getElementById(src).style.display='none';
			}else{
				//document.getElementById(src+'_city_region').innerHTML='>Loading...';
				document.getElementById(src+'_city_region').style.display='inline';
				document.getElementById(src).innerHTML='Loading...';
				document.getElementById(src).style.display='inline';
			}
	 
     var req = venus_createXMLHttp();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    var json=eval('('+req.responseText+')'); 
					
					if(json.regions==''){
						document.getElementById(src+'_city_region').innerHTML='';
						document.getElementById(src+'_city_region').style.display='none';
					}else{
						
						document.getElementById(src+'_city_region').innerHTML='<select id="'+src+'_city_region_id"  name="'+src+'_city_region" OnChange="venus_select_city(\''+src+'\')">'+json.regions+'</select>';
						document.getElementById(src+'_city_region').style.display='inline';
					}
					if(json.cities==''){
						document.getElementById(src).innerHTML='';
						document.getElementById(src).style.display='none';
					}else{
						document.getElementById(src).innerHTML='<select name="'+src+'">'+json.cities+'</select>';
						document.getElementById(src).style.display='inline';
					}
               } 
          }
     };
     req.open("GET", "/app/ext/cityselect.php?country="+idcountry+"&region="+idregion); //
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
     req.send(null); 
}