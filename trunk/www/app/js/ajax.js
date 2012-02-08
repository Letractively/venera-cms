function venus_createXMLHttp()
{
        if(typeof XMLHttpRequest != "undefined") { //for mozilla
          return new XMLHttpRequest();
        } else if(window.ActiveXObject) { //for IE
          var aVersions = ["MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0",
                   "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp",
                   "Microsoft.XMLHttp"
                   ];
          for (var i = 0; i < aVersions.length; i++) {
            try { //
              var oXmlHttp = new ActiveXObject(aVersions[i]);

              return oXmlHttp;
            } catch (oError) { 

            }
          }
          throw new Error("Can`t create XMLHttp object :-(");
        }
}

function venus_getFormRequestBody(oForm) 
{ 
        var aParams = new Array();
        for(var i = 0; i < oForm.elements.length; i++) {
          var sParam = encodeURIComponent(oForm.elements[i].name);
          sParam += "=";
          sParam += encodeURIComponent(oForm.elements[i].value);
          aParams.push(sParam);
        }
        return aParams.join("&");
}   
