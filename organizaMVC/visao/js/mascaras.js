function mascara(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmascara()", 1);
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}
function mreais(v) {
    v = v.replace(/\D/g, "");						//Remove tudo o que não é dígito
    v = v.replace(/(\d{2})$/, ",$1");			//Coloca a virgula
    v = v.replace(/(\d+)(\d{3},\d{2})$/g, "$1.$2"); 	//Coloca o primeiro ponto
    return "R$ " + v;
}

function mascara_data(data){ 
              var mydata = ''; 
              mydata = mydata + data; 
              if (mydata.length == 2){ 
                  mydata = mydata + '/'; 
                  document.forms[0].data.value = mydata; 
              } 
              if (mydata.length == 5){ 
                  mydata = mydata + '/'; 
                  document.forms[0].data.value = mydata; 
              } 
              if (mydata.length == 10){ 
                  verifica_data(); 
              } 
          } 