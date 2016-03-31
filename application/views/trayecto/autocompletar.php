<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script src="<?= base_url();?>assets/resources/filterList/municipios.js"></script>

  
  <link rel="stylesheet" href="/resources/demos/style.css">
  
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="<?= base_url();?>assets/resources/filterList/municipios.js"></script>
  <script>
  $(function() {

	objetos = $.parseJSON(municipios);
	
	var arrayMuni=new Array();
	
	for (var i=0;i<objetos.length;i++){
		arrayMuni.push(objetos[i].title);
	}


    $( "#municipio" ).autocomplete({
      source: arrayMuni,
      autoFocus: true
    });
  });
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="municipio">Tags: </label>
  <input id="municipio">
</div>
 
 
</body>
</html>