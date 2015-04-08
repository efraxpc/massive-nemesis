<!DOCTYPE html>
<html>
<head>
	<title>Pdf</title>
	<style type="text/css">
		#inner {
		    width: 85%;
		    margin: 0 auto;
		}
		h5 {
	    position: absolute;
	    left: 520px;
	    top: 1030px;
	}
	</style>
</head>
<body>
	<div id="outer" style="width:100%">  
	    <div id="inner">
			<h1 class="center">{{{Lang::get('main.texto_hoja_imprimir') }}}</h1>
			<table class='center' border="1">
			@for($i=0;$i < 3;$i++)
				<tr>
					<td>
						{{ HTML::image($file) }}
					</td>
					<td>
						{{ HTML::image($file) }}
					</td>
				</tr>
			@endfor
			</table>  
	    <h5>{{{Lang::get('main.app_name_title_page') }}}</h5>

	    </div>
	</div>

</body>
</html>
