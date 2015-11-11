<style>

.pictures{
	 
	margin-top:20px;
        text-align:left;
 
}
.pictures img{
	border: 1px solid #604c14;
	margin-right:14px;
	  
}
#popup{
	display:none;
	border: 2px solid #604c14;
	margin-left:100px;
	padding:0px;
	box-shadow: 1px 1px 22px #000;
	background:white;
	position:absolute;
	top:30px;
	width:600px;
}
#popup img{
	margin:0px;
	padding:0px;
}
#popup p.close{
	background:#604c14;
	text-align:right;
	padding:4px;
	margin:0px;
	border-bottom:solid 1px #604c14;
}
#popup p.close a{
	text-decoration:none;
	color:#fff;
}
.logo{
	border:2px solid white;
}

.commercants .txt{
    text-align: left;
}

 
.txt{
	 
}
.popup p, .popup h3{
	text-align:left;
}
.popup infos{
    border:1px solid gray;
    
}
.bloc .info{
    width:220px;
    height:120px;
    padding:20px;
    float:right;
    background:white;
    margin-right:10px;
    border:1px solid #604c14;
}
</style>
<script>
function select(sImg){
	var a=getById('popupContent');
	if(a){
		a.innerHTML='<img style="width:100%" src="css/images/big/'+sImg+'"/>';
		
		var b=getById('popup');
		if(b){
			b.style.display='block';
		}
	}
	
}
function openDetail(sText){
	
	var sTxt='';
	var c=getById('txt_'+sText);
	var a=getById('popupContent');
	if(a && c){
		sTxt=c.innerHTML;
		
		a.innerHTML=sTxt;
		
		var b=getById('popup');
		if(b){
			b.style.display='block';
		}
	}
	
	
}
function closePopup2(){
	var b=getById('popup');
	if(b){
		b.style.display='none';
	}
}
</script>

<div class="bloc">
   
    <h2>Commercants</h2>
<div class="commercants">
	
    <div class="txt" >
        <h3>Maryse Fleurs</h3>
        <p>Toutes compositions florales sur commande 7/7</p>
        <p>Livraison gratuite</p>
        <p>Maryse : 06 77 32 01 92</p>
    </div>
    <div class="txt" >
        <h3>Chez Marine fruits et l&eacute;gumes </h3>
        <p>Paniers de fruits sur commande</p>
        <p>Livraison gratuite &agrave; partir de 20 euros</p>
        <p>Marine : 06 22 89 64 06</p>
    </div>
    <div class="txt" >
        <h3>Fromager</h3>
        <p>Plateaux de fromage sur commande</p>
        <p>Marine : 06 22 89 64 06</p>
    </div>
    <div class="txt" >
        <h3>R&ocirc;tisserie du Gard</h3>
        <p>Traiteur</p>
        <p>Volaille et plats pour vos f&ecirc;tes sur commande</p>
        <p>David Lefour : 07 82 29 32 03</p>
    </div>
	
        	
</div>

<h2>Photos</h2>
<div class="pictures">
    
	<a href="#" onclick="select('fruits.jpg');return false;"><img src="css/images/fruits.jpg"/></a>
	<a href="#" onclick="select('fruits2.jpg');return false;"><img src="css/images/fruits2.jpg"/></a>
 	<a href="#" onclick="select('fruits4.jpg');return false;"><img src="css/images/fruits4.jpg"/></a>
	
	<a href="#" onclick="select('rotisserie.jpg');return false;"><img src="css/images/rotisserie.jpg"/></a>
 	
	<a href="#" onclick="select('fleuriste.jpg');return false;"><img src="css/images/fleuriste.jpg"/></a>
	<a href="#" onclick="select('fleuriste2.jpg');return false;"><img src="css/images/fleuriste2.jpg"/></a>
 	
</div></div>
<div id="popup">
	<p class="close"><a href="#" onclick="closePopup2();return false;">Fermer X</a></p>
	<div id="popupContent"></div>
</div>



